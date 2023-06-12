<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    //
    public function index(){
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en','ASC')->limit(6)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view('frontend.index',compact('categories','sliders','products'));
    }

    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

    public function userProfileStore(Request $request){
        $id=Auth::id();
        $data=User::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        if($request->hasFile('profile_photo_path')){

            $file=$request->file('profile_photo_path');
            // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('profile_photo_path')->getClientOriginalName();
            

            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            

            //GET JUST EXTENSION
            $ext=$request->file('profile_photo_path')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/user_images'),$fileNameToStore);

            // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);

        }
        $data['profile_photo_path']=$fileNameToStore;
        $data->save();
        $notification=array(
            'message'=>'User Profile Updated Sucessfully',
            'alert-type'=>'success'
        );
        return redirect(route('dashboard'))->with($notification);
    }

    public function userChangePassword(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('frontend.profile.change_password',compact('user'));
    }

    public function userUpdatePassword(Request $request){
        $validate=$request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed',
        ]
        );
        $id=Auth::id();
        $user=User::find($id);
        $hashedPassword=User::find(1)->password;
        if(Hash::check($request->current_password,$hashedPassword)){
            if($request->password==$request->password_confirmation){
                $user->password=Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect(route('user.logout'));
            }
        }

    }
}
