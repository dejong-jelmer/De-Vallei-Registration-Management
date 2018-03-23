<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Status;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Traits\UpdateAttendance as UpdateAttendance; 

class StatusController extends Controller
{
    use UpdateAttendance;

    public function getStatus()
    {
        $statuses = Status::whereNotIn('status',['afwezig', 'aanwezig'])->get();


        return view('status.status')->with(['statuses' => $statuses]);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'delete' => 'boolean',
        ]);



        try {
            $status = Status::findOrFail($id);

        } catch (Exception $e) {
            return back()->with(['error' => 'Status niet gevonden']);
            
        }

        if($request->input('delete')) {
            
            $afwezig = Status::where('status', 'afwezig')->first();

            $request['reden'] = 'vorige status verwijderd';
            foreach($status->students as $student) {
                $this->updateAttendance($student->id, $afwezig->id, $request);
            }

            foreach ($status->coaches as $coach) {
                $coach->status()->associate($afwezig);
                $coach->save();
            }

            $status->update(['deleted' => true, 'deleted_by' => Auth::user()->id]);
            $status->save();
            $status->delete($afwezig);

            return back()->with(['success' => 'Status verwijderd']);

        }

        $text = $request->input('text') ? $request->input('text') : strtolower($status->status);

        $status->update([
            'student_selectable' => $request->input('student_selectable') === 'on' ? $request['student_selectable'] = true : $request['student_selectable'] = false,

            'coach_selectable' => $request->input('coach_selectable') === 'on' ? $request['coach_selectable'] = true : $request['coach_selectable'] = false,

            'reason_requierd' => $request->input('reason_requierd') === 'on' ? $request['reason_requierd'] = true : $request['reason_requierd'] = false,

            'text' => $text,
        ]);

        return back()->with(['success' => 'Status aangepast']);
    }

    public function createStatus(Status $status, Request $request)
    {
        try {
            
            $status->create([
                'status' => $request->input('status'),
                'student_selectable' => $request->input('student_selectable') === 'on' ? $request['student_selectable'] = true : $request['student_selectable'] = false,

                'coach_selectable' => $request->input('coach_selectable') === 'on' ? $request['coach_selectable'] = true : $request['coach_selectable'] = false,

                'reason_requierd' => $request->input('reason_requierd') === 'on' ? $request['reason_requierd'] = true : $request['reason_requierd'] = false,

                'text' => $request->input('text') ?  : $request->input('status'),
                'color' => $request->input('color')


            ]);
            
        } catch (Exception $e) {
            return back()->with(['error' => 'aanmaken nieuwe status mislukt']);
        }

        return back()->with(['success' => 'nieuwe status aangemaakt']);


    }
}
