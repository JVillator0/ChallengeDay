<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumption extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'category_type_id',
        'emission_type_id',
        'place_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function emissionType()
    {
        return $this->belongsTo(EmissionType::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class);
    }
}
