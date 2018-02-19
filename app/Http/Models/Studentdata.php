<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Status;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;


class Studentdata extends Model
{
    
    protected $fillable = [
        'student_id',
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'geboortedatum',
        'straat',
        'huisnummer',
        'huisnummer_toevoeging',
        'postcode',
        'woonplaats',
        'leerlingnummer',
        'telefoon_1',
        'telefoon_2',
        'email',
        'ouder_verzorger_1',
        'ouder_verzorger_2',
        'aanwezig',
        'voogd',
        'deleted'

    ];
    // Relationships
    
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    // Model methods
   
    
}
