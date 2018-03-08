<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Color;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class StatusController
 * @package App\Http\Controllers
 */


class ColorController extends Controller
{

    /**
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function getColors()
    {
        $colors = Color::where('deleted', false)->get();

        return response()->json(['colors' => $colors]);
    }

    public function getColor($id)
    {
        try {

            $color = Color::findOrFail($id);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'error'=> [
                        'message' => 'Kleur niet gevonden'
                    ]

                ], 404);
        }

        $status->students;
        $status->reason;

        return response()->json([ 'color' => $color ]);
    }

}
