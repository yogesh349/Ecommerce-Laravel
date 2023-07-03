<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //

    public function AllAdminRole(){
        $adminuser=Admin::where('type',2)->latest()->get();
        return view('backend.role.admin_role_all',compact('adminuser'));
    }


    public function AddAdminRole(){
    	return view('backend.role.admin_role_create');
    }


    public function StoreAdminRole(Request $request){
        if($request->hasFile('profile_photo_path')){
            $file=$request->file('profile_photo_path');
            // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('profile_photo_path')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('profile_photo_path')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/admin_images/'),$fileNameToStore);

            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brandd' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
        
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
        
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                'profile_photo_path' => $fileNameToStore,
                'created_at' => Carbon::now(),
        
        
                ]);
        
                $notification = array(
                    'message' => 'Admin User Created Successfully',
                    'alert-type' => 'success'
                );
        
                return redirect()->route('all.admin.user')->with($notification);
        }
    }


    public function EditAdminRole($id){

    	$adminuser = Admin::findOrFail($id);
    	return view('backend.role.admin_role_edit',compact('adminuser'));

    } // end method 



    public function UpdateAdminRole(Request $request){

    	$admin_id = $request->id;
    	$old_img = $request->old_image;

    	if ($request->file('profile_photo_path')) {
            $file=$request->file('profile_photo_path');
            // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('profile_photo_path')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('profile_photo_path')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/admin_images/'),$fileNameToStore);



    	
	Admin::findOrFail($admin_id)->update([
		'name' => $request->name,
		'email' => $request->email,

		'phone' => $request->phone,
		'brandd' => $request->brand,
		'category' => $request->category,
		'product' => $request->product,
		'slider' => $request->slider,
		'coupons' => $request->coupons,

		'shipping' => $request->shipping,
		'blog' => $request->blog,
		'setting' => $request->setting,
		'returnorder' => $request->returnorder,
		'review' => $request->review,

		'orders' => $request->orders,
		'stock' => $request->stock,
		'reports' => $request->reports,
		'alluser' => $request->alluser,
		'adminuserrole' => $request->adminuserrole,
		'type' => 2,
		'profile_photo_path' => $fileNameToStore,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Admin User Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.admin.user')->with($notification);

    	}else{

    	Admin::findOrFail($admin_id)->update([
		'name' => $request->name,
		'email' => $request->email,

		'phone' => $request->phone,
		'brandd' => $request->brand,
		'category' => $request->category,
		'product' => $request->product,
		'slider' => $request->slider,
		'coupons' => $request->coupons,

		'shipping' => $request->shipping,
		'blog' => $request->blog,
		'setting' => $request->setting,
		'returnorder' => $request->returnorder,
		'review' => $request->review,

		'orders' => $request->orders,
		'stock' => $request->stock,
		'reports' => $request->reports,
		'alluser' => $request->alluser,
		'adminuserrole' => $request->adminuserrole,
		'type' => 2,

		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Admin User Updated Successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('all.admin.user')->with($notification);

    	} // end else 

    } // end method 


    public function DeleteAdminRole($id){

        $adminimg = Admin::findOrFail($id);
        $img = $adminimg->profile_photo_path;
        unlink($img);

        Admin::findOrFail($id)->delete();

         $notification = array(
           'message' => 'Admin User Deleted Successfully',
           'alert-type' => 'info'
       );

       return redirect()->back()->with($notification);

    } // end method 


}
