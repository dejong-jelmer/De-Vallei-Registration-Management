<?php

namespace App\Http\Models;

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
}
