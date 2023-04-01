<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'location_url',
    ];

    public function consumptions()
    {
        return $this->hasMany(Consumption::class);
    }
}
