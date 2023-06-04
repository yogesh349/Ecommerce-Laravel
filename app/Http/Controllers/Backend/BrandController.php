<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //

    public function viewBrand(){
        $brands=Brand::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));
    }

    public function store(Request $request){
        $request->validate([

            'brand_name_en'=>'required',
            'brand_name_hin'=>'required',
            'brand_image'=>'required'
        ],
        [
            'brand_name_en.required'=>'Input Brand Hindi Name',
            'brand_name_hin.required'=>'Input Brand English Name'

        ]);


        if($request->hasFile('brand_image')){
            $file=$request->file('brand_image');
            // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('brand_image')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('brand_image')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/brand'),$fileNameToStore);

            // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);
        }

        Brand::insert([
            'brand_name_en'=>$request->brand_name_en,
            'brand_name_hin'=>$request->brand_name_hin,
            'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_hin'=>strtolower(str_replace(' ','-',$request->brand_name_hin)),
            'brand_image'=>$fileNameToStore,
            
        ]);

        $notification=array(
            'message'=>'Brand Inserted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $brand=Brand::findOrFail($id);
        return view('backend.brand.edit',compact('brand'));
    }
    public function update(Request $request){
        $brand_id=$request->id;
        $old_image=$request->old_image;

        if($request->hasFile('brand_image')){
            $file=$request->file('brand_image');
            unlink(public_path('upload/brand/'.$old_image));
            $filenameWithExt=$request->file('brand_image')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('brand_image')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/brand'),$fileNameToStore);
            // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);
            Brand::findOrFail($brand_id)->update([
                'brand_name_en'=>$request->brand_name_en,
                'brand_name_hin'=>$request->brand_name_hin,
                'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_hin'=>strtolower(str_replace(' ','-',$request->brand_name_hin)),
                'brand_image'=>$fileNameToStore,  
            ]);

            $notification=array(
                'message'=>'Brand Updated Sucessfully',
                'alert-type'=>'info'
            );
            return redirect()->route('all.brands')->with($notification);

        }else{

            Brand::findOrFail($brand_id)->update([
                'brand_name_en'=>$request->brand_name_en,
                'brand_name_hin'=>$request->brand_name_hin,
                'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_hin'=>strtolower(str_replace(' ','-',$request->brand_name_hin)), 
            ]);
            $notification=array(
                'message'=>'Brand Updated Sucessfully',
                'alert-type'=>'info'
            );
            return redirect()->route('all.brands')->with($notification);



        }



        $notification=array(
            'message'=>'Brand Inserted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }

    public function destroy($id){
        $brand=Brand::findOrFail($id);
        unlink(public_path('upload/brand/'.$brand->brand_image));
        Brand::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Brand Deleted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }
}
