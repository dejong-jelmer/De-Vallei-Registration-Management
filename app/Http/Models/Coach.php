<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Coachdata;
use App\Http\Models\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Coach extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'coach',
        'status_id',
        'color_id',
        'deleted',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    // Relationships

    public function students()
    {
       return $this->hasMany('App\Models\Student');
    }

    /**
     * Get the coachdata record belogs to a coach.
     */
    public function coachdata()
    {
        return $this->hasOne('App\Models\Coachdata');    
    }

    /**
     * Get the status of a coach (status is owner of coach).
     * @return  object Status model
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function color()
    {
        return $this->belongsTo('App\Http\Models\Color', 'color_id');
    }

    public function reason()
    {
        return $this->belongsTo('App\Models\Reason', 'reason_id');
    }


    // Model methods
    public function getStudents()
    {
       return $this->students()->with('studentdata')->with('status')->with('reason')->get();
    }



}
