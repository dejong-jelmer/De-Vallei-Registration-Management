<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getDiagramInput()
    {
        $statuses = Status::get();

        foreach ($statuses as $status) {
        
            $attendances[] = Student::has('attendances')->where('status_id', $status->id)->count();
            $colors[] = $status->color;

        }

        return response()->json(['attendances' => $attendances, 'colors' => $colors]);
    }

    public function getStatuses()
    {
        $students = Student::with('status', 'reason')->orderBy('updated_at', 'desc')->take(10)->get();

        return response()->json($students);
    }
}
