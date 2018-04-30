<?php

namespace App\Http\Controllers\Web;


use DB;
use File;
use Excel;
use App\Models\Coach;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
   
    
    public function index()
    {
        return view('leerlingen.import');
    }

    public function import(Request $request)
    {
        if(!$request->hasFile('file')) {
            return redirect()->back()->with('error', 'Geen bestand geselecteerd.');
        }

        $extension = File::extension($request->file->getClientOriginalName());

        if($extension != 'xls' && $extension != 'xlsx' && $extension != 'csv') {

            return redirect()->back()->with('status', 'Bestand is een '.$extension.' bestand. Alleen uploaden van .xls, .xlsx, .csv bestanden mogelijk.');
        }

        $path = $request->file('file')->path();
        
        switch ($extension) {
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
                    $naam = [];
                    $voornaam = '';
                    $achternaam = ''; 
                    $tussenvoegsel = '';

                    $naam = explode(' ', $value->naam);
                    
                    switch (count($naam)) {
                        case 1:
                            $voornaam = $naam[0]; 
                            break;
                        case 2:
                            $voornaam = $naam[0]; 
                            $achternaam = $naam[1];  
                            break;
                        case 3:
                            $voornaam = $naam[0]; 
                            $tussenvoegsel = $naam[1];
                            $achternaam = $naam[2];
                            break;
                        case 4:
                            $voornaam = $naam[0]; 
                            $tussenvoegsel = $naam[1] .' '. $naam[2];
                            $achternaam = $naam[3];
                            break;
                        default:
                            $voornaam = $naam[0];
                            array_shift($naam);
                            $achternaam = implode(' ', $naam);
                            break;
                    }


                    $student = Student::create([
                        'naam' => $voornaam,
                    ]);

                    $coach = Coach::where('coach', $value->coach)->first();
               
                    $student->studentdata()->create([
                        'voornaam' => $voornaam,
                        'tussenvoegsel' => $tussenvoegsel,
                        'achternaam' => $achternaam,
                    ]);
                    $student->coach()->associate($coach);
                    $student->save();

                }
            

        } 
        
        return redirect()->back()->with('success', 'Leerlinglijst geimporteerd.');

    
    }

    
}