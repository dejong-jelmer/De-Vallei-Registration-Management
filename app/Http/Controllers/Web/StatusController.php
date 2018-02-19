<?php

namespace App\Http\Controllers\Web;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function getStatus()
    {
        $statuses = Status::get();

        return view('status.status')->with(['statuses' => $statuses]);
    }
}
