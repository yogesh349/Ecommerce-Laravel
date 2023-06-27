<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    //
    public function profile(){
        $adminData=Admin::find(1);
        return view('admin.profile',compact('adminData'));
    }
    public function editProfile(){
        $editData=Admin::find(1);
        return view('admin.profile_edit',compact('editData'));

    }

    public function profileStore(Request $request){
        $data=Admin::find(1);
        $data->name=$request->name;
        $data->email=$request->email;
        if($request->hasFile('profile_photo_path')){

            $file=$request->file('profile_photo_path');
            unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('profile_photo_path')->getClientOriginalName();
            

            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            

            //GET JUST EXTENSION
            $ext=$request->file('profile_photo_path')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/admin_images'),$fileNameToStore);

            // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);

        }
        $data['profile_photo_path']=$fileNameToStore;
        $data->save();
        $notification=array(
            'message'=>'Admin Profile Updated Sucessfully',
            'alert-type'=>'success'
        );
        return redirect(route('admin.profile'))->with($notification);

    }

    public function adminChangePassword(){
        return view('admin.change_password');
    }

    public function updatePassword(Request $request){
        $validate=$request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed',
        ]
        );
        $hashedPassword=Admin::find(1)->password;
        if(Hash::check($request->current_password,$hashedPassword)){
            $admin=Admin::find(1);
            if($request->password==$request->password_confirmation){
                $admin->password=Hash::make($request->password);
                $admin->save();
                Auth::logout();
                return redirect(route('admin.logout'));

            }

        }
     }


     public function AllUsers(){
		$users = User::latest()->get();
		return view('backend.user.all_user',compact('users'));
	}
}
