<?php

namespace App\Http\Controllers\Web;


use DB;
use File;
use Excel;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
   
    public function importExcel(Request $request)
    {
        if(!$request->hasFile('file')) {
            return redirect()->back()->with('status', 'Geen bestand geselecteerd.');
        }

        $extension = File::extension($request->file->getClientOriginalName());

        if($extension != 'xls' && $extension != 'xls' && $extension != 'csv' && $extension != 'ods') {

            return redirect()->back()->with('status', 'Bestand is een '.$extension.' bestand. Alleen uploaden van .xls, .xlsx, .csv, .ods bestanden mogelijk.');
        }

        $path = $request->file('file')->path();
        
        switch ($extension) {
            case 'ods':
            case 'xls':
            case 'xlsx':
                $data = Excel::load($path, function($reader) {
                })->first();
                // dd($data);

                break;
            case 'csv':
                $data = Excel::load($path, function($reader) {
                })->get();         
                // dd($data);
                break;
            default:
                break;
        }

        if(!empty($data) && $data->count()) {

            
                foreach ($data as $key => $value) {

                    $student = new Student(['naam' => $value->naam, 'coach_id' => $value->coach_id, 'status_id' => $value->status_id, 'color' => $value->color ]);

                    $student->save();
                }
            

        } 
        
        return redirect()->back()->with('status', 'Upload succes.');

    
    }

    
}