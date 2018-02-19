<?php

namespace App\Http\Controllers\Web;

use DB;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AanwezigheidsController extends Controller
{
    public function getIndex()
    {
        
        $students = Student::has('attendances')->get();

        $statuses = Status::get();

        return view('aanwezigheid.index')->with(['students'=> $students, 'statuses' => $statuses]);
    }

    public function getStudentAanwezigheid(Request $request)
    {
        $date = Carbon::now();
        $year = $date->year;
        
        $statuses = Status::get();
        $students = $request->input('students');


        if(is_array($students)) {
            for ($i = 0; $i < count($students); $i++) {
                $request->validate([
                    "students.$i" => 'required|integer|exists:students,id',
                ]);
            }
        }
        
        $request->validate([
            'van_datum' => "nullable|required_with:tot_datum|required_without:maand,jaar|date|before_or_equal:$date",
            // 'tot_datum' => "nullable|required_with:van_datum|required_without:maand,jaar|date|before_or_equal:$date",
            'tot_datum' => "nullable|required_with:van_datum|required_without:maand,jaar|date|before_or_equal:2018-12-12",
            'maand' => 'nullable|required_with:jaar|integer|min:1|max:12',
            'jaar' => "nullable|required_with:maand|integer|min:2018|max:$year",
        ]);

        foreach ($statuses as $status) {
            $st = str_replace(' ', '_', $status->status);
            
            $request->validate([
                "$st" => 'integer|exists:statuses,id',
            ]);


            $requestedStatuses[] = $request->input($st);
        }
       
        $from = $request->input('van_datum');
        $to = $request->input('tot_datum');

        $year = $request->input('jaar');
        $month = $request->input('maand');


        if($from && $to) {

            $attendances = Attendance::whereIn('student_id', $students)
                            ->whereIn('status_id', $requestedStatuses)
                            ->whereBetween('created_at', [$from, $to])
                            ->get();
        
        } else {
            
            $attendances = Attendance::whereIn('student_id', $students)
                            ->whereIn('status_id', $requestedStatuses)
                            ->whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->get();
        
        }

        $attendances->each(function($attendance, $key)  {
            $attendance->student;
            $attendance->status;
        });   
        
        $students = Student::has('attendances')->get();

        $statuses = Status::get();

        return view('aanwezigheid.index')->with(['attendances' => $attendances, 'students'=> $students, 'statuses' => $statuses ]);
    }

    
}
