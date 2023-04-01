<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmissionType extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
}
