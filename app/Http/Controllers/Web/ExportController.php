<?php

namespace App\Http\Controllers\Web;

use Excel;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Studentdata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    public function exportStudents($type, Request $request)
    {
        
        // switch ($export) {
        //     case 'leerlingen':
                
        //         $data = Studentdata::get()->toArray();
        //         break;
            
        //     default:
        //         $data = Attendance::get()->toArray();
        //         break;
        // }

        dd($request->input('query') );
        return Excel::create($export, function($excel) use ($data) {

                $excel->sheet('Blad 1', function($sheet) use ($data)

                {

                    $sheet->fromArray($data);

                });

        })->download($type);
    }
}

