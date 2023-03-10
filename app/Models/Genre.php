<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    /**
     * Get all of the content for the Genre
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function content(): HasMany
    // {
    //     return $this->hasMany(Content::class, 'foreign_key', 'local_key');
    // }
}
