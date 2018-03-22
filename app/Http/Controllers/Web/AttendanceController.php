<?php

namespace App\Http\Controllers\Web;

use Excel;
use Carbon\Carbon;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
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

        if(empty($students)) {
            return redirect()->back()->with(['error' => ['Geen leerling(en) geselecteerd.']])->withInput($request->flash());
        }

        if(is_array($students)) {
            for ($i = 0; $i < count($students); $i++) {
                $request->validate([
                    "students.$i" => 'required|integer|exists:students,id',
                ]);
            }
        }
        
        $request->validate([
            'van_datum' => "nullable|required_with:tot_datum|required_without:maand,jaar|date|before_or_equal:$date",
            'tot_datum' => "nullable|required_with:van_datum|required_without:maand,jaar|date|before_or_equal:$date",
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

        if( count(array_filter($requestedStatuses)) == null ) {
            return redirect()->back()->with(['error' => ['Geen status gekozen.']])->withInput($request->flash());
        }

        $from = $request->input('van_datum');
        $to = $request->input('tot_datum');

        $year = $request->input('jaar');
        $month = $request->input('maand');


        if($from && $to) {

            $attendances = Attendance::select('status_id', 'student_id', 'start_tijd', 'eind_tijd')
                            ->with('student', 'status')->whereIn('student_id', $students)
                            ->whereIn('status_id', $requestedStatuses)
                            ->whereDate('start_tijd', '>=', $from)
                            ->whereDate('start_tijd', '<=', $to)
                            ->orderBy('student_id', 'asc')
                            ->get();
        } else {
            
            $attendances = Attendance::select('status_id', 'student_id', 'start_tijd', 'eind_tijd')
                            ->with('student', 'status')->whereIn('student_id', $students)
                            ->whereIn('status_id', $requestedStatuses)
                            ->whereYear('start_tijd', $year)
                            ->whereMonth('start_tijd', $month)
                            ->orderBy('student_id', 'asc')
                            ->get();
        
        }
        

        if($request->input('export')) {
            
            $query = clone $attendances;

            $query = $query->map(function($item) {
                    $item->naam = $item->student->naam;
                    $item->aanwezigheid = $item->status->status;
                    $item->eind_tijd = $item->eind_tijd;    
                    $item->start_tijd = $item->start_tijd;    

                    unset($item->student);
                    unset($item->status);
                    unset($item->student_id);
                    unset($item->status_id);
                    $item->status = $item->aanwezigheid;
                    unset($item->aanwezigheid);
                    return $item;
            });


            return Excel::create('aanwezigheid', function($excel) use ($query) {
                        
                    $excel->sheet('Blad 1', function($sheet) use ($query)
                    {
                        $sheet->fromArray($query);                  

                    });    


            })->export('xlsx');
        }

        $students = Student::has('attendances')->get();
        
        return view('aanwezigheid.index')->with(['attendances' => $attendances, 'students'=> $students, 'statuses' => $statuses])->withInput($request->flash());
    }

    
}
