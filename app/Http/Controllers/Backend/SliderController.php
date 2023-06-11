<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //

    public function view(){
        $sliders=Slider::latest()->get();
        return view('backend.slider.view',compact('sliders'));
    }


    public function store(Request $request){
        $request->validate([

            'slider_image'=>'required',
        ]);


        if($request->hasFile('slider_image')){
            $file=$request->file('slider_image');
            // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('slider_image')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('slider_image')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/slider'),$fileNameToStore);

            // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);
        }

        Slider::insert([
            'slider_image'=>$fileNameToStore,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        $notification=array(
            'message'=>'Brand Inserted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $slider=Slider::findOrFail($id);
        return view('backend.slider.edit',compact('slider'));


    }
    public function update(Request $request){
        $slider_id=$request->id;
        $old_image=$request->old_image;

        if($request->hasFile('slider_image')){
            $file=$request->file('slider_image');

            if(file_exists('upload/slider/'.$old_image)){
                unlink(public_path('upload/slider/'.$old_image));
            }
           
            $filenameWithExt=$request->file('slider_image')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('slider_image')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/slider'),$fileNameToStore);
            // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);
            Slider::findOrFail($slider_id)->update([
                'slider_image'=>$fileNameToStore,  
                'title'=>$request->title,
                'description'=>$request->description,
                
            ]);

            $notification=array(
                'message'=>'Slider Updated Sucessfully',
                'alert-type'=>'info'
            );
            return redirect()->route('manage.slider')->with($notification);

        }else{

            Slider::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
            ]);
            $notification=array(
                'message'=>'Slider Updated Sucessfully',
                'alert-type'=>'info'
            );
            return redirect()->route('manage.slider')->with($notification);



        }



        $notification=array(
            'message'=>'Brand Inserted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function destroy($id){
        $slider=Slider::findOrFail($id);
        unlink(public_path('upload/slider/'.$slider->slider_image));
        Slider::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Slider Deleted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }

    public function activeSliver($id){
        Slider::findOrFail($id)->update([
            'status'=>1
        ]);
        $notification=array(
            'message'=>'Slider Status Updated To Active Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);
    }

    public function inactiveSlider($id){
        Slider::findOrFail($id)->update([
            'status'=>0
        ]);
        $notification=array(
            'message'=>'Slider Status Updated To Inactive Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);
    }
}
