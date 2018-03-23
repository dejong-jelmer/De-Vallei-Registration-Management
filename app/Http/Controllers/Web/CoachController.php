<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Coachdata;
use App\Http\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class CoachController extends Controller
{
    
    public function getUpdate()
    {   
        $coachDatas = CoachData::with('coach')->get();

        return view('coaches.gegevens')->with(['coachDatas' => $coachDatas]);
    }

    public function getCreate()
    {   
        $colors = Color::get();

        $columns = Schema::getColumnListing('coachdatas');
        
        return view('coaches.aanmaken')->with(['columns' => $columns, 'colors' => $colors]);
    }

    public function getStatus()
    {
        
        $coaches = Coach::with('status')->get();

        $statuses = Status::where('coach_selectable', true)->get();

        return view('coaches.status')->with(['coaches' => $coaches, 'statuses' => $statuses]);
    }

    public function getCoach($id)
    {
        
        try {
            
            $coach = Coach::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => 'Coach niet gevonden']);
        }

        $colors = Color::get();

        $coachData = collect($coach->coachData);

        return view('coaches.gegevens')->with(['coach' => $coach, 'coachData' => $coachData, 'colors' => $colors ]);
    }

    public function createCoach(Request $request)
    {
        
        $request->validate([
            'voornaam' => 'required',
            'color_id' => 'required|exists:colors,id',
         ]);

        try {
            
            $coach = Coach::create([
                'coach' => $request->input('voornaam')
            ]);
            
            $coach->coachdata()->create($request->all());
                    
            $color = Color::findOrFail($request->input('color_id'));
            $coach->color()->associate($color);

            $coach->save();


        } catch (\Expetion $e) {
            return redirect()->back()->with(['error' => 'Niet gelukt een nieuwe coach aan te maken.'])->withInput($request->flash());
            
        }

        return redirect()->action('Web\CoachController@getCoach', ['id' => $coach->id])->with(['success' => 'Coach aangemaakt']); 
    }


    public function updateCoach($id, Request $request)
    {
        try {
            
            $coach = Coach::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => 'Coach niet gevonden']);
        }

        $color = Color::findOrFail($request->input('color_id'));

        $coach->color()->associate($color);
        $coach->coach = $request->input('voornaam');
        $coach->coachData()->first()->update($request->all());
        $coach->save();

        return redirect()->action('Web\CoachController@getCoach', ['id' => $coach->id])->with(['success' => 'Coachgegevens aangepast']);
    }

    public function deleteCoach($id)
    {
        try {
            
            $coach = Coach::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => 'Coach niet gevonden']);
        }
        
        $name = $coach->naam;

        $coach->coachData->deleted = true;
        $coach->coachData->deleted_by = Auth::user()->id;
        $coach->coachData()->delete();
        $coach->coachData->save();
        $coach->deleted = true;
        $coach->deleted_by = Auth::user()->id;
        $coach->delete();
        $coach->save();

        return redirect('/home')->with(['success' => "Coach $name verwijderd"]);
    }

    public function updateStatus($coachId, $statusId)
    {

        try {

            $coach = Coach::findOrFail($coachId);
        
        } catch (ModelNotFoundException $e) {
            
            return redirect()->back()->with('error', 'Coach niet gevonden');
        }

        try {
            
            $status = Status::findOrFail($statusId);
        
        } catch (ModelNotFoundException $e) {
            
            return redirect()->back()->with('error', 'Status niet gevonden');
            
        }

        $coach->status()->associate($status);
        $coach->save();


        return redirect()->action('Web\CoachController@getStatus')->with(['success' => "Status van $coach->coach aangepast"]);
    }

    public function updateStatuses(Request $request)
    {
        
        $request->validate([
            'status' => 'required|exists:statuses,id',
            'coach' => 'required|exists:coaches,id'
        ]);

        $statusId = $request->input('status');

        try {
            
            $status = Status::findOrFail($statusId);
        
        } catch (ModelNotFoundException $e) {
            
            return redirect()->back()->with('error', 'Status niet gevonden');
            
        }



        $coachIds = explode(',',$request->input('coach'));


        foreach ($coachIds as $coachId) {
            try {

                $coach = Coach::findOrFail($coachId);
            
            } catch (ModelNotFoundException $e) {
                
                return redirect()->back()->with('error', 'Coach niet gevonden');
            }


            $coach->status()->associate($status);
            $coach->save();
        }
        return redirect()->action('Web\CoachController@getStatus')->with(['success' => 'Status van coaches aangepast']);
        
    }
}
