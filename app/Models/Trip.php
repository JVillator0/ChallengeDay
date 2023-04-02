<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'emission_type_id',
        'trip_date',
    ];

    protected $casts = [
        'trip_date' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function emissionType()
    {
        return $this->belongsTo(EmissionType::class);
    }
}
