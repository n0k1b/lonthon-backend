<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

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
