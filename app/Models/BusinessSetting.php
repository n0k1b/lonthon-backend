<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getHomepageBannerImageAttribute($value)
    {
        return env('APP_URL') . 'storage/' . $value;
    }

    public function getHomepagePromotionalBanner1Attribute($value)
    {
        return env('APP_URL') . 'storage/' . $value;
    }

    public function getHomepagePromotionalBanner2Attribute($value)
    {
        return env('APP_URL') . 'storage/' . $value;
    }

    public function getLogoAttribute($value)
    {
        return env('APP_URL') . 'storage/' . $value;
    }

    public function getFaviconAttribute($value)
    {
        return env('APP_URL') . 'storage/' . $value;
    }
}
