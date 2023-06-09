<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPostCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
class BlogController extends Controller
{
    //
    public function BlogCategory(){

    	$blogcategory = BlogPostCategory::latest()->get();
    	return view('backend.blog.category.category_view',compact('blogcategory'));
    }


    public function BlogCategoryStore(Request $request){

        $request->validate([
             'blog_category_name_en' => 'required',
             'blog_category_name_hin' => 'required',
 
         ],[
             'blog_category_name_en.required' => 'Input Blog Category English Name',
             'blog_category_name_hin.required' => 'Input Blog Category Hindi Name',
         ]);
 
 
 
     BlogPostCategory::insert([
         'blog_category_name_en' => $request->blog_category_name_en,
         'blog_category_name_hin' => $request->blog_category_name_hin,
         'blog_category_slug_en' => strtolower(str_replace(' ', '-',$request->blog_category_name_en)),
         'blog_category_slug_hin' => str_replace(' ', '-',$request->blog_category_name_hin),
         'created_at' => Carbon::now(),
 
 
         ]);
 
         $notification = array(
             'message' => 'Blog Category Inserted Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->back()->with($notification);
 
     } // end method 

     public function BlogCategoryEdit($id){

        $blogcategory = BlogPostCategory::findOrFail($id);
             return view('backend.blog.category.category_edit',compact('blogcategory'));
         }


         public function BlogCategoryUpdate(Request $request){

            $blogcar_id = $request->id;
     
     
         BlogPostCategory::findOrFail($blogcar_id)->update([
             'blog_category_name_en' => $request->blog_category_name_en,
             'blog_category_name_hin' => $request->blog_category_name_hin,
             'blog_category_slug_en' => strtolower(str_replace(' ', '-',$request->blog_category_name_en)),
             'blog_category_slug_hin' => str_replace(' ', '-',$request->blog_category_name_hin),
             'created_at' => Carbon::now(),
     
     
             ]);
     
             $notification = array(
                 'message' => 'Blog Category Updated Successfully',
                 'alert-type' => 'info'
             );
     
             return redirect()->route('blog.category')->with($notification);
     
         } // end method 


           ///////////////////////////// Blog Post ALL Methods //////////////////



  public function ListBlogPost(){
            $blogpost = BlogPost::with('category')->latest()->get();
            return view('backend.blog.post.post_list',compact('blogpost'));
      }
  public function AddBlogPost(){

    $blogcategory = BlogPostCategory::latest()->get();
  	$blogpost = BlogPost::latest()->get();
  	return view('backend.blog.post.post_view',compact('blogpost','blogcategory'));

  }   


  public function BlogPostStore(Request $request){

    $request->validate([
          'post_title_en' => 'required',
          'post_title_hin' => 'required',
          'post_image' => 'required',
      ],[
          'post_title_en.required' => 'Input Post Title English Name',
          'post_title_hin.required' => 'Input Post Title Hindi Name',
      ]);



      if($request->hasFile('post_image')){
        $file=$request->file('post_image');
        // unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
        $filenameWithExt=$request->file('post_image')->getClientOriginalName();
        
        //get just filename
        $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);  

        //GET JUST EXTENSION
        $ext=$request->file('post_image')->getClientOriginalExtension();

        $fileNameToStore=$filename ."_".time().".".$ext;
        $file->move(public_path('upload/products/post'),$fileNameToStore);

        // $path=$request->file('profile_photo_path')->storeAs('public/customer',$fileNameToStore);
    }

  BlogPost::insert([
      'category_id' => $request->category_id,
      'post_title_en' => $request->post_title_en,
      'post_title_hin' => $request->post_title_hin,
      'post_slug_en' => strtolower(str_replace(' ', '-',$request->post_title_en)),
      'post_slug_hin' => str_replace(' ', '-',$request->post_title_hin),
      'post_image' => $fileNameToStore,
      'post_details_en' => $request->post_details_en,
      'post_details_hin' => $request->post_details_hin,
      'created_at'=>Carbon::now()

      ]);

      $notification = array(
          'message' => 'Blog Post Inserted Successfully',
          'alert-type' => 'success'
      );

      return redirect()->route('list.post')->with($notification);

} // end mehtod 
 
 


}
