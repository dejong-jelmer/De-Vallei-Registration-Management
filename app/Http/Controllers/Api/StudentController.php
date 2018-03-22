<?php 

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use App\Models\Coach;
use App\Models\Reason;
use App\Models\Student;
use App\Http\Models\Color;
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
                'naam' => $request->input('voornaam'),
            ]);

            $coach = Coach::findOrFail($request->input('coach_id'));
            $color = Color::findOrFail($request->input('color_id'));

            $student->studentdata()->create($request->all());
            $student->coach()->associate($coach);
            $student->color()->associate($color);
            $student->save();


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

        $student->studentData->deleted = true;
        $student->studentData->deleted_by = Auth::user()->id;
        $student->studentData()->delete();
        $student->studentData->save();
        $student->deleted = true;
        $student->deleted_by = Auth::user()->id;
        $student->delete();
        $student->save();
        
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