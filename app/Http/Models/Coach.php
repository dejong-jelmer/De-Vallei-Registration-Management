<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coach;
use App\Models\Student;
use App\Models\Coachdata;
use Illuminate\Database\Eloquent\Model;


class Coach extends Model
{
    
    protected $fillable = [
        'coach', 
        'color',
        'deleted'

    ];
    
    // Relationships

    public function students()
    {
       return $this->hasMany('App\Models\Student');
    }

    /**
     * Get the coachdata record belogs to a coach.
     */
    public function coachData()
    {
        return $this->hasOne('App\Models\Coachdata');    
    }



    // Model methods
    public function getStudents()
    {
       return $this->students()->with('studentdata')->with('status')->with('reason')->get();
    }



}
