<?php

namespace App\Http\Controllers\Web;

use DB;
use Auth;
use App\Models\Coach;
use App\Models\Color;
use App\Models\Status;
use App\Models\Student;
use App\Models\Studentdata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Traits\UpdateAttendance as UpdateAttendance; 

class StudentController extends Controller
{
    use UpdateAttendance;
    
       
    public function getUpdate()
    {   

        $studentDatas = StudentData::with('student')->get();

        return view('leerlingen.gegevens')->with(['studentDatas' => $studentDatas]);
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

        $studentDatas = StudentData::with('student')
                    ->where('voornaam', 'LIKE', "%{$query}%")
                    ->orWhere('achternaam', 'LIKE', "%{$query}%")
                    ->orWhere('leerlingnummer', 'LIKE', "%{$query}%")
                    ->orWhere('postcode', 'LIKE', "%{$query}%")
                    ->orWhere('woonplaats', 'LIKE', "%{$query}%")
                    ->get();


        return view('leerlingen.gegevens')->with(['studentDatas' => $studentDatas]);

    }

    public function getStatus()
    {
        $students = Student::with('status')->get();

        $statuses = Status::get();

        return view('leerlingen.status')->with(['students' => $students, 'statuses' => $statuses]);
    }

    public function getStudent($id)
    {
        
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

    public function updateStudent($id, Request $request)
    {
        
        
        try {
            
            $student = Student::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => 'Leerling niet gevonden']);
        }

        $coach = Coach::findOrFail($request->input('coach_id'));
        $color = Color::findOrFail($request->input('color_id'));

        $student->coach()->associate($coach);
        $student->color()->associate($color);
        $student->naam = $request->input('voornaam');
        $student->studentData()->first()->update($request->all());
        $student->save();

        return redirect()->action('Web\StudentController@getStudent', ['id' => $student->id])->with(['success' => 'Leerlinggegevens aangepast']);
    }

    public function createStudent(Request $request)
    {
         $request->validate([
            'voornaam' => 'required',
            'coach_id' => 'required|exists:coaches,id',
            'color_id' => 'required|exists:colors,id',
         ]);
            
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
            
            return redirect()->back()->with(['error' => 'fout bij aanmaken leerlinggegevens']);
            
        }

        return redirect()->action('Web\StudentController@getStudent', ['id' => $student->id])->with(['success' => 'Leerlinggegevens aangemaakt']);
        
    }

    public function deleteStudent($id)
    {
        try {
            
            $student = Student::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return back()->with(['error' => 'Leerling niet gevonden']);
        }
        
        $name = $student->naam;

        $student->studentData->deleted = true;
        $student->studentData->deleted_by = Auth::user()->id;
        $student->studentData()->delete();
        $student->studentData->save();
        $student->deleted = true;
        $student->deleted_by = Auth::user()->id;
        $student->delete();
        $student->save();

        return redirect('/home')->with(['success' => "Leerling $name verwijderd"]);
    }

    public function updateStatus($studentId, $statusId, Request $request) 
    {

       
        $student = $this->updateAttendance($studentId, $statusId, $request);

        if(false === $student) {

            return redirect()->back()->with(['error' => 'Leerling niet gevonden of status on bekend.']);
        }
        

        return redirect()->action('Web\StudentController@getStatus')->with(['success' => "Status van $student->naam aangepast"]);
    }

    public function updateStatuses(Request $request)
    {
        
        $request->validate([
            'status' => 'required|exists:statuses,id',
            'student' => 'required|exists:students,id'
        ]);

        $statusId = $request->input('status');

              $studentIds = explode(',',$request->input('student'));


        foreach ($studentIds as $studentId) {
            
            $student = $this->updateAttendance($studentId, $statusId, $request);

            if(false === $student) {

                return back()->with(['error' => 'Leerling niet gevonden of status on bekend.']);
            }
        
        }
        
        return redirect()->action('Web\StudentController@getStatus')->with(['success' => 'Status van leerlingen aangepast']);
        
    }
}
