<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $gurarded = [];

    /**
     * Get all of the genre for the Subcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function genres()
    {
        return $this->hasMany(CategorySubcategoryGenreMap::class, 'genre_id', 'id');
    }
}
