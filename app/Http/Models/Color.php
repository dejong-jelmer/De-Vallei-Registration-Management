<?php

namespace App\Http\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Color extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'color',
        'deleted',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['deleted_at'];
    
    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function coaches()
    {
        return $this->hasMany('App\Models\Coach');
    }
}
