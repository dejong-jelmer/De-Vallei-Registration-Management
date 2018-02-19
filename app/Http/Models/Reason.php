<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;


class Reason extends Model
{
    
    protected $fillable = [
        'status_id',
        'student_id',
        'reason',
        'deleted'

    ];

    // Relationships
    
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    
    // Model methods ----------------------------------------------------------
    
    
}
