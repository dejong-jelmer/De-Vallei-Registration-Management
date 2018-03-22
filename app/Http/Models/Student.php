<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Reason;
use App\Models\Color;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Studentdata;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'naam',
        'coach_id',
        'status_id',
        'color',
        'deleted',
        'deleted_at',
        'created_at',
        'updated_at',
        'deleted_by',

    ];

    protected $dates = ['deleted_at'];
    
    // Relationships
    /**
     * Get the studentdata record belongs to a student.
     * 
     * @return object Studendata model
     */
    public function studentdata()
    {
        return $this->hasOne('App\Models\Studentdata');    
    }

    /**
     * Get the coach that owns the student.
     * @return object Coach model
     */
    public function coach()
    {
        return $this->belongsTo('App\Models\Coach');
    }

    /**
     * Get the attendance that of a the student.
     * @return object Attendance model
     */
    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    /**
     * Get the status of a student (status is owner of student).
     * @return  object Status model
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function reason()
    {
        return $this->belongsTo('App\Models\Reason', 'reason_id');
    }

    public function color()
    {
        return $this->belongsTo('App\Http\Models\Color', 'color_id');
    }
    
    // Model methods ----------------------------------------------------------
    
   
    /**
     * Update stat tijd van nieuwe status en eind tijd van vorig status in de attandance tabel, 
     * als er een reder is wordt de reden gelinkt.
     * 
     * @param Object $status
     * @param Object $reason
     * 
     * @return void
     */
    public function setAttendance($status, $reason=false)
    {
        $time = Carbon::now()->toDateTimeString();

        // ingeval van eerste aanmeldig valt er nog geen eind tijd te updaten anders wel
        if ($lastAttendance = $this->getLastAttendance()) {
        
            $lastAttendance->update(['eind_tijd' => $time]);
        }

        return $this->attendances()->create([
            'start_tijd' => $time,
            'status_id' => $status->id,
            'reason_id' => $reason ? $reason->id : 0,
        ]);
    }

    /**
     * Haal de laatste status wijziging op van leerlings
     * 
     * @return Object
     */
    public function getLastAttendance()
    {
        return $this->attendances()->orderBy('start_tijd', 'desc')->first();
    }

    public function getAttendance($statuses)
    {
        return $this->attendances()->whereIn('attendances.status_id', $statuses)->get();
    }

    
}
