<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deparment extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
