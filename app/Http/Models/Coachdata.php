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


class Coachdata extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'email',
        'telefoon',
        'mobiel',
        'straat',
        'huisnummer',
        'postcode',
        'deleted'

    ];

    protected $dates = ['deleted_at'];
    

    // Relationships
    public function coach()
    {
        return $this->belongsTo('App\Models\Coach');
    }
    

    // Model methods
   
    
}
