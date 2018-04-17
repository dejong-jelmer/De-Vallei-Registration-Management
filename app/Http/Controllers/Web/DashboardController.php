<?php

namespace App\Http\Controllers\Web;

use App\Models\Status;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        
        $statuses = Status::with('students')->get();

        return view('home')->with(compact('statuses'));
    }
}
