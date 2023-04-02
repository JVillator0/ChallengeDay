<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function categoryTypes()
    {
        return $this->hasMany(CategoryType::class);
    }
}
