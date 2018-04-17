<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reason extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'status_id',
        'student_id',
        'reason',
        'deleted'

    ];

    protected $dates = ['deleted_at'];
    

    // Relationships
    
    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function coach()
    {
        return $this->belongsTo('App\Models\Coach');
    }
    
    // Model methods ----------------------------------------------------------
    
    
}
