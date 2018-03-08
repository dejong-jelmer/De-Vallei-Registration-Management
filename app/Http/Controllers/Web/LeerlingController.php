<?php

namespace App\Http\Controllers\Web;

use DB;
use App\Models\Coach;
use App\Models\Student;
use App\Http\Models\Color;
use App\Models\Studentdata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class LeerlingController extends Controller
{
    
    public function getUpdate()
    {   

        $students = StudentData::with('student')->get();

        return view('leerlingen.gegevens')->with(['students' => $students, ]);
    }

    public function getCreate()
    {   
        $colors = Color::get();
        $coaches = Coach::get();

        $columns = Schema::getColumnListing('studentdatas');
        
        return view('leerlingen.aanmaken')->with(['columns' => $columns, 'coaches' => $coaches, 'colors' => $colors]);
    }

    public function searchStudents(Request $request)
    {
        $query = $request->input('zoeken');

        $students = StudentData::with('student')
                    ->where('voornaam', 'LIKE', "%{$query}%")
                    ->orWhere('achternaam', 'LIKE', "%{$query}%")
                    ->orWhere('leerlingnummer', 'LIKE', "%{$query}%")
                    ->orWhere('postcode', 'LIKE', "%{$query}%")
                    ->orWhere('woonplaats', 'LIKE', "%{$query}%")
                    ->get();


        return view('leerlingen.gegevens')->with(['students' => $students]);

    }

    public function searchStudent(Request $request)
    {
        $request->validate([
                'students' => 'required|integer|exists:students,id'
            ]);

        $id = $request->input('students');
        
        try {
            
            $student = Student::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => 'Leerling niet gevonden']);
        }

        $colors = Color::get();
        $coaches = Coach::get();

        $studentData = collect($student->studentData);
        $student->coach;

        return view('leerlingen.gegevens')->with(['student' => $student, 'studentData' => $studentData, 'coaches' => $coaches, 'colors' => $colors ]);

    }

    public function updateStudentData($id, Request $request)
    {
        try {
            
            $student = Student::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => 'Leerling niet gevonden']);
        }

        $student->update(['coach_id' => $request->coach_id]);
        $student->studentData()->first()->update($request->all());
        $student->save();

        $studentData = collect($student->studentData);
        $coaches = Coach::get();

        return view('leerlingen.gegevens')->with(['success' => 'Leerling gegevens aangepast', 'student' => $student, 'studentData' => $studentData, 'coaches' => $coaches]);
    }

    public function createStudentData(Request $request)
    {
        try {
            
            $student = Student::create([
                'coach_id' => $request->input('coach_id'),
                'naam' => $request->input('voornaam'),
                'status_id' => 1,
                'color' => $request->input('color'),
            ]);

            $request['student_id'] =  $student->id;
            
            $studentData = studentData::create($request->all());
            $studentData->student()->associate($student);            
            $studentData->save();

        } catch (\Expetion $e) {
            
            return redirect()->back()->with(['error' => 'fout bij aanmaken leerlinggegevens']);
            
        }

        $coaches = Coach::get();
        $studentData = collect($student->studentData);

        return view('leerlingen.gegevens')->with(['student' => $student, 'studentData' => $studentData, 'coaches' => $coaches , 'success' => 'Leerling gegevens aangemaakt']);

    }
}
