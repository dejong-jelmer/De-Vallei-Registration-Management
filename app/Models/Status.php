<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Reason;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'status',
        'text',
        'color',
        'student_selectable',
        'coach_selectable',
        'reason_requierd',
        'deleted',
        'deleted_by'

    ];

    protected $dates = ['deleted_at'];

    // Relationships
    
    /*
     * get the student that belongs to the status 
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student', 'status_id');
    }

    /*
     * get the coach that belongs to the status 
     */
    public function coaches()
    {
        return $this->hasMany('App\Models\Coach', 'status_id');
    }

    public function reasons()
    {
        return $this->hasMany('App\Models\Reason');
    }



    // Model methods ----------------------------------------------------------
    
    
}
