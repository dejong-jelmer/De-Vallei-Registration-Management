<?php 

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class CoachesController
 * @package App\Http\Controllers
 */

class CoachGroupController extends controller
{
    
    /**
     * GET /coachgroep/id 
     * @param  $id
     *
     * @return  mixed
     */
    public function getCoachGroups()
    {
        $coaches = Coach::get();

        return response()->json([ 'coaches' => $coaches ]);

    }

    /**
     * GET /coachgroep/id 
     * @param  $id
     *
     * @return  mixed
     */
    public function getCoachGroup($id)
    {
        try {

           $coachGroup = Coach::findOrFail($id)->getStudents();
      
        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'Groep niet gevonden'
                    ]
                ], 404);
        }

        return response()->json([ 'coachgroep' => $coachGroup ]);

    }

}