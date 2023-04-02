<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmissionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function consumptions()
    {
        return $this->hasMany(Consumption::class);
    }
}
