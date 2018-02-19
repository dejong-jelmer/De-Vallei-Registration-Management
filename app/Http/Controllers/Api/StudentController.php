<?php 

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Coach;
use App\Models\Reason;
use App\Models\Student;
use App\Models\Studentdata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class StudentController
 * @package App\Http\Controllers
 */

class StudentController extends controller
{
    
    /**
     * POST /leerlingen
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function createStudent(Request $request)
    {
        try {
            
            $student = Student::create([
                'coach_id' => $request->input('coach_id'),
                'naam' => $request->input('naam'),
                'status_id' => 1,
                'color' => $request->inpu('color'),
            ]);
            
            $studentData = studentData::create($request->all());
            $studentData->student()->associate($student);            
            $studentData->save();

        } catch (\Expetion $e) {
            return response()->json(['created' => false,
                'error' => [
                    'message' => 'Fout bij het aanmaken van een nieuwe leerling',
                    'exeption' => $e->errorInfo
                ],
            ], 400);
        }

        return response()->json(['created' => true], 201);
    }
    
    /**
     * P
     * @param  Request $request
     * @param  $id
     * @return mixed
     */
    public function updateStudent(Request $request, $id)
    {
        
        try {
            
            $student = Student::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'error'=> [
                        'message' => 'Leerling niet gevonden'
                    ]

                ], 404);
        }

        $student->update(['coach_id' => $request->coach_id]);
        $student->studentData()->first()->update($request->all());
        $student->save();

        return response()->json([ 'student' => $student ]);
    }

    /**
     * 
     * @param  $id
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleteStudent($id)
    {
        try {
            
            $student = Student::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'Leerling niet gevonden'
                    ]
                ], 404);
        }

        $student->studentData()->delete();
        $student->delete();
        
        return response()->json(['leerling' => 'verwijderd'], 200);

    }


    /**
     * GET /student
     * @param  
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function getStudents()
    {   
        
        $students = Student::with('studentdata')->get();

        
        return response()->json(['leerlingen' => $students], 200);
        
    }

    
    public function getStudentStatuses()
    {
        $students = Student::with('status', 'reason')->get();

        return response()->json(['leerlingen' => $students], 200);

    }

    public function getStudentStatus($id)
    {
        try {

            $student = Student::findOrFail($id);
      
        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'Leerling niet gevonden'
                    ]
                ], 404);
        }

        $student->status;
        $student->reason;

        return response()->json(['leerling' => $student], 200);
    }

    

}