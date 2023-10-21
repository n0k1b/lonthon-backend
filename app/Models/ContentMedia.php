<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    use HasFactory;
    public function getMediaUrlAttribute($value)
    {
        // if ($this->media_type == 1) {
        //     return $value;
        // }
        return env('do_url') . $value;
    }
}
