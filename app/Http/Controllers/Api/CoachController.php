<?php 

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
use App\Models\Coachdata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class CoachesController
 * @package App\Http\Controllers
 */

class CoachController
{
        
    

    public function getCoaches()
    {
        $coaches = Coach::with('coachData')->get();

        return response()->json(['coaches' => $coaches]);
    }



    /**
    * GET /coaches/{id}
    * @param integer $id
    * @return mixed
    */

    public function getCoach($id)
    {
        try {
            $coach = Coach::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'error' => [
                        'message' => 'coach niet gevonden'
                    ]], 404);
        }

        $coach->coachData;

        return response()->json(['coach' => $coach], 200);
    }

    /**
     * POST /coaches
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function createCoach(Request $request)
    {
        try {
            
            $coach = Coach::create($request->all());
            
            $coachData = coachData::create($request->all());

            $coachData->coach()->associate($coach);            
            $coachData->save();

        } catch (\Expetion $e) {
            return response()->json(['created' => false,
                'error' => [
                    'message' => 'Fout bij het aanmaken van een nieuwe coach',
                    'exeption' => $e->errorInfo
                ],
            ], 400);
        }

        $coach->coachData;

        return response()->json(['created' => true, 'coach' => $coach], 201);
    }
    
    /**
     * PUT /coaches/id
     * @param  Request $request
     * @param  $id
     * @return mixed
     */
    public function updateCoach(Request $request, $id)
    {
        
        try {
            
            $coach = Coach::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                    'error'=> [
                        'message' => 'coach niet gevonden'
                    ]

                ], 404);
        }

        $coach->update( $request->all() );
        $coach->coachData()->update( $request->all() );
        
        $coach->save();

        $coach->coachData;

        return response()->json(['updated' => true, 'coach' => $coach], 200);
    }

    /**
     * DELETE /coaches/id 
     * @param  $id
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            
            $coach = Coach::findOrFail($id);

        } catch (ModelNotFoundException $e) {
            return response()->json([

                    'error' => [
                        'message' => 'coach niet gevonden'
                    ]
                ], 404);
        }
        
        $coach->coachData()->delete();
        $coach->delete();

        return response()->json(['coach' => 'verwijderd'], 200);
    }


}