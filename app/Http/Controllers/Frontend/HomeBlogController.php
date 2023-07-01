<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPostCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeBlogController extends Controller
{
    //
    public function AddBlogPost(){

    	$blogcategory = BlogPostCategory::latest()->get();
    	$blogpost = BlogPost::latest()->get();
    	return view('frontend.blog.blog_list',compact('blogpost','blogcategory'));

    }
}
