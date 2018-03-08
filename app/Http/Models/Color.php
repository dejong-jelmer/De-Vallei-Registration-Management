<?php

namespace App\Http\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'color',
        'deleted',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }
}
