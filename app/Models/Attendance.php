<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;


class Attendance extends Model
{
    
    protected $fillable = [
        'student_id',
        'status_id',
        'reason_id',
        'start_tijd',
        'eind_tijd',
    ];

    // Relationships
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

     
}
