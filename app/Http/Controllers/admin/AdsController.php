<?php

namespace App\Http\Controllers\admin;
use App\Models\AdsModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsController extends Controller
{
  public function index(){
 return view('admin.ads.show')->with("ads",AdsModel::orderByDesc('id')->get());;

  }


  // ads create

  public function create()
  {
      return view('admin.ads.insert');
  }



  public function store(Request $request)
  {
      $request->validate([
        "Type"=>'required',
        "Banner"=>'required',

      ]);
      $adsModel = new AdsModel;
      $adsModel->Type = $request->Type;
    //   $adsModel->FooterName = $request->footername;
      if ($request->hasFile('Banner')) {
          $image_path = date('Y-m-d-H_i_s').'_' .$request->file('Banner')->getClientOriginalName();
            $request->file('Banner')->storeAs('Banner',$image_path,['disk' => 'public']);
            $adsModel->Banner = 'banner/'.$image_path;
        }

        // if ($request->hasFile('footerimg')) {
        //     $image_path = date('Y-m-d-H_i_s').'_' .$request->file('footerimg')->getClientOriginalName();
        //     $request->file('footerimg')->storeAs('banner',$image_path,['disk' => 'public']);
        //     $adsModel->footerImg = 'banner/'.$image_path;
        // }

      if($adsModel->save())
      {
          return back()->with('success', 'Banner added successfully!');
      }else{
          return back()->with('error', 'Opps! Something went wrong');

      }
 }




//ads edit
 public function edit($id)
 {
     return view("admin.ads.edit", ["ads" => AdsModel::find($id)]);
 }

 public function update(Request $request, $id)
 {
     $ads = AdsModel::find($id);
     $ads->Type = $request->type;
    //   $ads->FooterName = $request->footername;


     if ($request->hasFile('Banner')) {
        $image_path = date('Y-m-d-H_i_s').'_' .$request->file('Banner')->getClientOriginalName();
          $request->file('Banner')->storeAs('banner',$image_path,['disk' => 'public']);
          $ads->Banner= 'banner/'.$image_path;
      }

    //   if ($request->hasFile('footerimg')) {
    //       $image_path = date('Y-m-d-H_i_s').'_' .$request->file('footerimg')->getClientOriginalName();
    //       $request->file('footerimg')->storeAs('banner',$image_path,['disk' => 'public']);
    //       $ads->footerImg = 'banner/'.$image_path;
    //   }

    if($ads->save())
    {
        return back()->with('success', 'Banner added successfully!');

    }else{
        return back()->with('error', 'Opps! Something went wrong');

    }
    return redirect('show');
 }

 public function delete(Request $request, $id)
 {
    $ads = AdsModel::find($id);
    $ads->delete();
    return back()->with('success', 'Banner deleted successfully!');
 }
}







