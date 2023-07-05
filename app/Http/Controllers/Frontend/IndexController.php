<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //
    public function index(){
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(6)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();
        $skip_category_0=Category::skip(0)->first();
        $skip_product_0=Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();

        $skip_category_1=Category::skip(1)->first();
        $skip_product_1=Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

        $skip_brand_1=Brand::skip(1)->first();
        $skip_brand_product_1=Product::where('status',1)->where('brand_id',$skip_category_1->id)->orderBy('id','DESC')->get();

        return view('frontend.index',compact('categories','sliders','products','featured','hot_deals','special_offer','special_deals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1'));
    }


    public function TagWiseProduct($tag){
        if(session()->get('language') == 'hindi') {
            $products = Product::where('status',1)->where('product_tags_hin',$tag)->
        orderBy('id','DESC')->paginate(3);

        }else{
            $products = Product::where('status',1)->where('product_tags_en',$tag)->
        orderBy('id','DESC')->paginate(3);
        }
        $categories = Category::orderBy('category_name_en','ASC')->get();
		return view('frontend.tags.tags_view',compact('products','categories'));

	}


    public function SubCatWiseProduct($subcat_id,$slug){
		$products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
        $breadsubcat = SubCategory::with(['category'])->where('id',$subcat_id)->get();
		return view('frontend.product.subcategory_view',compact('products','categories','breadsubcat'));

	}


    public function SubSubCatWiseProduct($subsubcat_id,$slug){
		$products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
        $breadsubsubcat = SubSubCategory::with(['category','subcategory'])->where('id',$subsubcat_id)->get();
		return view('frontend.product.sub_subcategory_view',compact('products','categories','breadsubsubcat'));

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


    public function ProductDetails($id,$slug){
		$product = Product::findOrFail($id);

        $color_en = $product->product_color_en;
		$product_color_en = explode(',', $color_en);

		$color_hin = $product->product_color_hin;
		$product_color_hin = explode(',', $color_hin);

		$size_en = $product->product_size_en;
		$product_size_en = explode(',', $size_en);

		$size_hin = $product->product_size_hin;
		$product_size_hin = explode(',', $size_hin);

        $multiImag = MultiImage::where('product_id',$id)->get();

        $cat_id = $product->category_id;
		$relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();

	 	return view('frontend.product.product_details',compact('product','multiImag','product_color_en','product_color_hin','product_size_en','product_size_hin','relatedProduct'));

	}


    public function ProductViewAjax($id){

		$product = Product::with('category','brand')->findOrFail($id);
		$color = $product->product_color_en;
		$product_color = explode(',', $color);

		$size = $product->product_size_en;
		$product_size = explode(',', $size);

		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));

	} // end method 


    // Product Seach 
	public function ProductSearch(Request $request){
		$item = $request->search;
		// echo "$item";
        $categories = Category::orderBy('category_name_en','ASC')->get();
		$products = Product::where('product_name_en','LIKE',"%$item%")->get();
		return view('frontend.product.search',compact('products','categories'));


	}
}
