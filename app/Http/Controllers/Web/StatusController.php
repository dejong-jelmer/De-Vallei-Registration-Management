<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Status;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class StatusController extends Controller
{
    public function getStatus()
    {
        $statuses = Status::get();


        return view('status.status')->with(['statuses' => $statuses]);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'color' => 'exists:statuses,color',
            'delete' => 'boolean',
        ]);



        try {
            $status = Status::findOrFail($id);

        } catch (Exception $e) {
            return back()->with(['error' => 'Status niet gevonden']);
            
        }

        if($request->input('delete')) {

            $status->update(['deleted' => true, 'deleted_by' => Auth::user()->id]);
            $status->save();
            $status->delete();

            return back()->with(['success' => 'Status verwijderd']);

        }

        $text = $request->input('text') ? $request->input('text') : $status->status;

        $status->update([
            'student_selectable' => $request->input('student_selectable') === 'on' ? $request['student_selectable'] = true : $request['student_selectable'] = false,

            'coach_selectable' => $request->input('coach_selectable') === 'on' ? $request['coach_selectable'] = true : $request['coach_selectable'] = false,

            'reason_requierd' => $request->input('reason_requierd') === 'on' ? $request['reason_requierd'] = true : $request['reason_requierd'] = false,

            'text' => $text,
            'color' => $request->input('color')
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

                'text' => $request->input('text'),
                'color' => $request->input('color')


            ]);
            
        } catch (Exception $e) {
            return back()->with(['error' => 'aanmaken nieuwe status mislukt']);
        }

        return back()->with(['success' => 'nieuwe status aangemaakt']);


    }
}
