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
    public function genre(): HasMany
    {
        return $this->hasMany(Genre::class, 'genre_id', 'id');
    }
}
