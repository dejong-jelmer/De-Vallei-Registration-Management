<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Coachdata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class StatusController
 * @package App\Http\Controllers
 */


class StatusController extends Controller
{

    /**
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function getStatusen()
    {
        $statusen = Status::get();

        return response()->json(['statusen' => $statusen]);
    }

    public function getStatus($id)
    {
        try {

            $status = Status::findOrFail($id);
        
        } catch (\Expetion $e) {
            return response()->json([
                    'error'=> [
                        'message' => 'Leerling niet gevonden'
                    ]

                ], 404);
        }

        $status->students;
        $status->reason;

        return response()->json([ 'status' => $status ]);
    }

}
