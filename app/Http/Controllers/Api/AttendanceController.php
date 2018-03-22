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
use App\Http\Controllers\Traits\UpdateAttendance as UpdateAttendance; 

/**
 * Class AttendanceController
 * @package App\Http\Controllers
 */

class AttendanceController extends controller
{
    use UpdateAttendance;
    
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
        
        $student = $this->updateAttendance($studentId, $statusId, $request);
        
        if(false === $student) {

            return response()->json([
                    'error' => [
                        'message' => 'Leerling niet gevonden of status on bekend.'
                    ]
                ], 404);
        }

        if($student->reason) {
            $reason = $student->reason->reason;
        }

        

        return response()->json(['id' => $student->id, 'status' => $student->status->status, 'color' => $student->status->color, 'reden' => ($reason ? $reason : null) ], 201);      
        
        
    }


}