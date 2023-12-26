<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the category that owns the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function map()
    {
        return $this->belongsTo(CategorySubcategoryGenreMap::class, 'category_sub_category_map_id', 'id');
    }
    public function media()
    {
        return $this->hasMany(ContentMedia::class, 'content_id');
    }
    public function getThumbnailImageAttribute($value)
    {
        return env('do_url') . $value;
    }

    public function getFeatureImageAttribute($value)
    {
        return env('do_url') . $value;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }



}
