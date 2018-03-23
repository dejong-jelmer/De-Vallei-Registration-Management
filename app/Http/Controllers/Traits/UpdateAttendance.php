<?php 

namespace App\Http\Controllers\Traits;

use App\Models\Status;
use App\Models\Reason;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;


trait UpdateAttendance {

    public function updateAttendance($studentId, $statusId, $request)
    {      
            
        $reason = false;
        // als reden tekst gegeven is
        $reasonText = $request->input('reden') ?  : $reasonText = false;
        

        try {
            
            $student = Student::findOrFail($studentId);
            
        } catch (ModelNotFoundException $e) {
            return false;
        }
        
        try {

            $status = Status::findOrFail($statusId);

        } catch (ModelNotFoundException $e) {
            return false;
        }
        
            // als leerling niet al die status heeft
            if ($student->status_id !== $statusId) {
                // als er een reden tekst is maak reden aan
                if (false !== $reasonText) {
                    $reason = new Reason(['reason' => $reasonText, 'student_id' => $student->id, 'status_id' => $status->id]);
                }

            
            // als er een reden aangemaakt is associeer met leerling en status, anders dissocieer vorig reden van leerling
            if($reason) {
                $reason->student()->associate($student);
                $reason->status()->associate($status);
                $reason->save();

                $student->reason()->associate($reason);
                $student->save();
            } else {
                $student->reason()->dissociate();
            }

            // hier wordt de aanwezigheid gelogt met start tijd en eind tijd
            $student->setAttendance($status, $reason);
            $student->status()->associate($status);
            $student->save();
        }

        return $student;
    }
}