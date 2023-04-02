<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'unit',
        'unit_abbreviation',
    ];

    public function categoryTypes()
    {
        return $this->hasMany(CategoryType::class);
    }
}
