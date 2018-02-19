<?php

namespace App\Http\Controllers\Web;

use DB;
use App\Models\Student;
use App\Models\Studentdata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchStudents(Request $request)
    {
        $query = $request->input('zoeken');

        $students = StudentData::
                    where('voornaam', 'LIKE', "%{$query}%")
                    ->orWhere('achternaam', 'LIKE', "%{$query}%")
                    ->orWhere('leerlingnummer', 'LIKE', "%{$query}%")
                    ->orWhere('postcode', 'LIKE', "%{$query}%")
                    ->orWhere('woonplaats', 'LIKE', "%{$query}%")
                    ->with('student')->get();

        if(count($students) == 1) {

            return view('zoeken.resultaat')->with(['student' => $students[0]]);
        }

        return view('zoeken.resultaat')->with(['students' => $students]);

    }

    public function searchStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->studentData;


        return view('zoeken.resultaat')->with(['student' => $student]);

    }
}
