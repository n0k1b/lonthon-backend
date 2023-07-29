<?php

namespace App\Http\Controllers;

use App\Models\BannerImageGallery;
use App\Models\BusinessSetting;
use App\Models\ThumbnailImageGallery;
use Illuminate\Http\Request;

class BusinessSettingController extends Controller
{
    public function index()
    {
        try {
            $data = BusinessSetting::all();
            if ($data) {
                return $this->successJsonResponse("Business settings data found", $data);
            } else {
                return $this->errorJsonResponse("Business settings data not found");
            }
        } catch (\Throwable $th) {
            return $this->exceptionJsonResponse($th);
        }
    }

    public function textEdit()
    {
        $data = BusinessSetting::select('homepage_title', 'homepage_description', 'about_us', 'email', 'contact_info1', 'contact_info2', 'contact_info3', 'facebook_url', 'instagram_url', 'twitter_url', 'terms_and_condition')->first();
        return view("admin.business settings.text")->with("data", $data);
    }

    public function textUpdate(Request $req)
    {
        $d = BusinessSetting::find(1);
        $d->homepage_title = $req->homepage_title;
        $d->homepage_description = $req->homepage_description;
        $d->about_us = $req->about_us;
        $d->email = $req->email;
        $d->contact_info1 = $req->contact_info1;
        $d->contact_info2 = $req->contact_info2;
        $d->contact_info3 = $req->contact_info3;
        $d->facebook_url = $req->facebook_url;
        $d->instagram_url = $req->instagram_url;
        $d->twitter_url = $req->twitter_url;
        $d->terms_and_condition = $req->terms_and_condition;
        $d->save();
        return back();
    }

    public function mediaEdit()
    {
        $data = BusinessSetting::select('favicon', 'homepage_banner_image', 'homepage_promotional_banner1', 'homepage_promotional_banner2', 'logo')->first();
        return view("admin.business settings.media")->with("data", $data);
    }

    public function mediaUpdate(Request $req)
    {
        $data = BusinessSetting::find(1);

        if ($req->file('favicon')) {
            $favicon_file = $req->file('favicon');
            $favicon_filename = "favicon." . $favicon_file->getClientOriginalExtension();
            $data->favicon = $favicon_file->storeAs('/settings', $favicon_filename, 'public');
        }

        if ($req->file('logo')) {
            $logo_file = $req->file('logo');
            $logo_file_name = "logo." . $logo_file->getClientOriginalExtension();
            $data->logo = $logo_file->storeAs('/settings', $logo_file_name, 'public');
        }

        if ($req->file('homepage_banner_image')) {
            $homepage_banner_image_file = $req->file('homepage_banner_image');
            $homepage_banner_image_file_name = "homepage_banner_image." . $homepage_banner_image_file->getClientOriginalExtension();
            $data->homepage_banner_image = $homepage_banner_image_file->storeAs('/settings', $homepage_banner_image_file_name, 'public');
        }

        if ($req->file('homepage_promotional_banner1')) {
            $homepage_promotional_banner1_file = $req->file('homepage_promotional_banner1');
            $homepage_promotional_banner1_file_name = "homepage_promotional_banner1." . $homepage_promotional_banner1_file->getClientOriginalExtension();
            $data->homepage_promotional_banner1 = $homepage_promotional_banner1_file->storeAs('/settings', $homepage_promotional_banner1_file_name, 'public');
        }

        if ($req->file('homepage_promotional_banner2')) {
            $homepage_promotional_banner2_file = $req->file('homepage_promotional_banner2');
            $homepage_promotional_banner2_file_name = "homepage_promotional_banner2." . $homepage_promotional_banner2_file->getClientOriginalExtension();
            $data->homepage_promotional_banner2 = $homepage_promotional_banner2_file->storeAs('/settings', $homepage_promotional_banner2_file_name, 'public');
        }

        $data->save();
        return back();
    }

    public function thumbnailImageGallery()
    {
        $gallery = ThumbnailImageGallery::get();
        return $this->successJsonResponse('Thumbanail image gallery found', $gallery);
    }
    public function bannerImageGallery()
    {
        $gallery = BannerImageGallery::get();
        return $this->successJsonResponse('Banner image gallery found', $gallery);
    }
}
