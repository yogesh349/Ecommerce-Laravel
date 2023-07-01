<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    //
    public function SiteSetting(){

    	$setting = SiteSetting::find(1);
    	return view('backend.setting.setting_update',compact('setting'));
    }



    public function SiteSettingUpdate(Request $request){

    	$setting_id = $request->id;

    
        if($request->hasFile('logo')){
            $file=$request->file('logo');
            // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('logo')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('logo')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/site'),$fileNameToStore);

            // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);

            SiteSetting::findOrFail($setting_id)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'logo' => $fileNameToStore,

                ]);
           

	    $notification = array(
			'message' => 'Setting Updated with Image Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    	}
        
        else{


    	SiteSetting::findOrFail($setting_id)->update([
		'phone_one' => $request->phone_one,
		'phone_two' => $request->phone_two,
		'email' => $request->email,
		'company_name' => $request->company_name,
		'company_address' => $request->company_address,
		'facebook' => $request->facebook,
		'twitter' => $request->twitter,
		'linkedin' => $request->linkedin,
		'youtube' => $request->youtube,


    	]);

	    $notification = array(
			'message' => 'Setting Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('site.setting')->with($notification);

    	} // end else 
    } // end method 


    public function SeoSetting(){

    	$seo = Seo::find(1);
    	return view('backend.setting.seo_update',compact('seo'));

    }


    public function SeoSettingUpdate(Request $request){

    	$seo_id = $request->id;

    	Seo::findOrFail($seo_id)->update([
		'meta_title' => $request->meta_title,
		'meta_author' => $request->meta_author,
		'meta_keyword' => $request->meta_keyword,
		'meta_description' => $request->meta_description,
		'google_analytics' => $request->google_analytics,		 

    	]);

	    $notification = array(
			'message' => 'Seo Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end mehtod 



}
