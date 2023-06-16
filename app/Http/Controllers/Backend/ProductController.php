<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function addproduct(){
        $categories=Category::latest()->get();
        $brands=Brand::latest()->get();
        return view('backend.product.add',compact('categories','brands'));
    }

    public function store(Request $request){
        $request->validate([
            'brand_id'=>'required',
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'subsubcategory_id'=>'required',
            'product_name_en'=>'required',
            'product_name_hin'=>'required',
            'product_code'=>'required',
            'product_qty'=>'required',
            'selling_price'=>'required',
            'discount_price'=>'required',
            'product_thumbnail'=>'required',
            'multi_img'=>'required',
            'short_desc_en'=>'required',
            'long_desc_en'=>'required',
            'long_desc_hin'=>'required',
        ]);


        if($request->hasFile('product_thumbnail')){
            $file=$request->file('product_thumbnail');
            // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('product_thumbnail')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('product_thumbnail')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/products/thumbnail'),$fileNameToStore);

            // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);
        }
        $product_id =Product::insertGetId(
            [
                'brand_id'=>$request->brand_id,
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'subsubcategory_id'=>$request->subsubcategory_id,
                'product_name_en'=>$request->product_name_en,
                'product_name_hin'=>$request->product_name_hin,
                'product_slug_en'=>strtolower(str_replace(' ','-',$request->product_name_en)),
                'product_slug_hin'=>str_replace(' ','-',$request->product_slug_hin),
                'product_code'=>$request->product_code,
                'product_qty'=>$request->product_qty,
                'product_tags_en'=>$request->product_tags_en,
                'product_tags_hin'=>$request->product_tags_hin,
                'product_size_en'=>$request->product_size_en,
                'product_size_hin'=>$request->product_size_hin,
                'product_color_en'=>$request->product_color_en,
                'product_color_hin'=>$request->product_color_hin,
                'selling_price'=>$request->selling_price,
                'discount_price'=>$request->discount_price,
                'short_desc_en'=>$request->short_desc_en,
                'short_desc_hin'=>$request->short_desc_hin,
                'long_desc_en'=>$request->long_desc_en,
                'long_desc_hin'=>$request->long_desc_hin,
                'product_thumbnail'=>$fileNameToStore,
                'hot_deals'=>$request->hot_deals,
                'featured'=>$request->featured,
                'special_offer'=>$request->special_offer,
                'special_deals'=>$request->special_deals,
                'status'=>1,
                'created_at'=>Carbon::now(),
            ]
            );

            // Multiple Image Upload Part
            $multiImages=$request->file('multi_img');
            foreach ($multiImages as $image) {
                # code...
                $multifilenameWithExt=$image->getClientOriginalName();
            
            //get just filename
            $multifilename=pathinfo($multifilenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$image->getClientOriginalExtension();

            $multifileNameToStore=$multifilename ."_".time().".".$ext;
            $image->move(public_path('upload/products/Multi-Image'),$multifileNameToStore);

            MultiImage::insert([
                'product_id'=>$product_id,
                'image_name'=>$multifileNameToStore,
                'created_at'=>Carbon::now()
            ]);

            }

            $notification=array(
                'message'=>'Product Inserted Sucessfully',
                'alert-type'=>'success'
            );
            return redirect(route('manage.product'))->with($notification);

    }

    public function manageProduct(){
        $products=Product::latest()->get();
        return view('backend.product.view',compact('products'));
    }

    public function editProduct($id){
        $multiImg=MultiImage::where('product_id',$id)->get();
        $brands=Brand::latest()->get();
        $categories=Category::latest()->get();
        $subcategories=SubCategory::latest()->get();
        $subsubcategories=SubSubCategory::latest()->get();
        $product=Product::findOrFail($id);
        return view('backend.product.edit',compact('multiImg','brands','categories','subcategories','subsubcategories','product'));
    }

    public function updateProduct(Request $request){
        $product_id=$request->product_id;
        Product::findOrFail($product_id)->update(
            [
                'brand_id'=>$request->brand_id,
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id,
                'subsubcategory_id'=>$request->subsubcategory_id,
                'product_name_en'=>$request->product_name_en,
                'product_name_hin'=>$request->product_name_hin,
                'product_slug_en'=>strtolower(str_replace(' ','-',$request->product_name_en)),
                'product_slug_hin'=>str_replace(' ','-',$request->product_slug_hin),
                'product_code'=>$request->product_code,
                'product_qty'=>$request->product_qty,
                'product_tags_en'=>$request->product_tags_en,
                'product_tags_hin'=>$request->product_tags_hin,
                'product_size_en'=>$request->product_size_en,
                'product_size_hin'=>$request->product_size_hin,
                'product_color_en'=>$request->product_color_en,
                'product_color_hin'=>$request->product_color_hin,
                'selling_price'=>$request->selling_price,
                'discount_price'=>$request->discount_price,
                'short_desc_en'=>$request->short_desc_en,
                'short_desc_hin'=>$request->short_desc_hin,
                'long_desc_en'=>$request->long_desc_en,
                'long_desc_hin'=>$request->long_desc_hin,
                'hot_deals'=>$request->hot_deals,
                'featured'=>$request->featured,
                'special_offer'=>$request->special_offer,
                'special_deals'=>$request->special_deals,
                'status'=>1,
                'created_at'=>Carbon::now(),
            ]
            );

            $notification=array(
                'message'=>'Product Updated Without Image Sucessfully',
                'alert-type'=>'success'
            );
            return redirect(route('manage.product'))->with($notification);
    }

    public function multiImageUpdate(Request $request){
        $imgs=$request->multi_img;
        foreach ($imgs as $id => $img) {
            # code...
            $imgDel=MultiImage::findOrFail($id);
            $image_with_path='upload/products/Multi-Image,'.$imgDel->image_name;
            if(file_exists($image_with_path)){
                unlink('upload/products/Multi-Image/'.$imgDel->image_name);   
            }
            $multifilenameWithExt=$img->getClientOriginalName();
            //get just filename
            $multifilename=pathinfo($multifilenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$img->getClientOriginalExtension();

            $multifileNameToStore=$multifilename ."_".time().".".$ext;
            $img->move(public_path('upload/products/Multi-Image'),$multifileNameToStore);
            
            MultiImage::where('id',$id)->update(
                [
                    'image_name'=>$multifileNameToStore,
                    'updated_at'=>Carbon::now(),

                ]
                );
        }

        $notification=array(
            'message'=>'Product Updated With Image Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);

    }


    public function updateThumbnailImg(Request $request){
        $product_id=$request->product_id;
        $oldThumbnail_Img=$request->old_image;
        $file_img_path='upload/products/thumbnail/'.$oldThumbnail_Img;
        if(file_exists($file_img_path)){
            unlink($file_img_path);   
        }
        

        if($request->hasFile('product_thumbnail')){
            $file=$request->file('product_thumbnail');
            // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filenameWithExt=$request->file('product_thumbnail')->getClientOriginalName();
            
            //get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

            //GET JUST EXTENSION
            $ext=$request->file('product_thumbnail')->getClientOriginalExtension();

            $fileNameToStore=$filename ."_".time().".".$ext;
            $file->move(public_path('upload/products/thumbnail'),$fileNameToStore);

        }


        Product::findOrFail($product_id)->update([
            'product_thumbnail'=>$fileNameToStore,
            'updated_at'=>Carbon::now(),

        ]);
        $notification=array(
            'message'=>'Product Updated With Thumbnail Image Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);

    }

    public function multiImagedestroy($id){
        $oldImg=MultiImage::findOrFail($id);
        $file_img_path='upload/products/Multi-Image/'.$oldImg->image_name;
        if(file_exists($file_img_path)){
            unlink('upload/products/Multi-Image/'.$oldImg->image_name);   
        }
        MultiImage::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Product Multi Image Deleted Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);

    }

    public function inActiveProduct($id){
        Product::findOrFail($id)->update([
            'status'=>0
        ]);
        $notification=array(
            'message'=>'Product Status Updated To InActive Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);


    }

    public function activeProduct($id){
        Product::findOrFail($id)->update([
            'status'=>1
        ]);
        $notification=array(
            'message'=>'Product Status Updated To Active Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);

    }

    public function deleteProduct($id){
        $product=Product::findOrFail($id);
        $file_img_path='upload/products/thumbnail/'.$product->product_thumbnail;
        if(file_exists($file_img_path)){
            unlink('upload/products/thumbnail/'.$product->product_thumbnail);   
        }
        $product->delete();
        $images=MultiImage::where('product_id',$id)->get();
        foreach ($images as $img) {
            # code...
            $multiimg_exits='upload/products/Multi-Image/'.$img->image_name;
            if($multiimg_exits){
                unlink($multiimg_exits);
                MultiImage::where('product_id',$id)->delete();
            }
        }

        $notification=array(
            'message'=>'Product Deleted Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->back()->with($notification);


    }

    
}
