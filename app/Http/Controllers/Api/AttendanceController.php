<?php 

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Reason;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class AttendanceController
 * @package App\Http\Controllers
 */

class AttendanceController extends controller
{
    
    /**
     * Update de status van leerling (bijv. aanwezig/afwezig ect), log tijdstip. Optineel reden voor status 
     * 
     * @param  int $studentId
     * @param  int $statusId
     * @param  Illuminate\Http\Request
     *
     * @return JSON Object
     */
    public function updateStudentAttendance($studentId, $statusId, Request $request)
    {
        
        $reason = false;
        // als reden tekst gegeven is
        $reasonText = $request->input('reden') ?  : $reasonText = false;
        

        try {
            
            $student = Student::findOrFail($studentId);
            
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Leerling niet gevonden.'
                ]
            ], 404);
        }
        
        try {

            $status = Status::findOrFail($statusId);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'Status niet bekend.'
                ]
            ], 404);
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

            // hier wordt de aanwzigheid gelogt met start tijd en eind tijd
            $student->setAttendance($status, $reason);
            $student->status()->associate($status);
            $student->save();
        }

        return response()->json(['id' => $student->id, 'status' => $student->status->status, 'color' => $student->status->color, 'reden' => ($reason ? $student->reason->reason : null) ], 201);      
        
        
    }


}