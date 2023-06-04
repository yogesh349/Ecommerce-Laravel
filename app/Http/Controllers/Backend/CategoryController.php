<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function view(){
        $category=Category::latest()->get();
        return view('backend.category.view',compact('category'));
    }

    public function store(Request $request){
        $request->validate([

            'category_name_en'=>'required',
            'category_name_hin'=>'required',
            'category_icon'=>'required'
        ],
        [
            'category_name_en.required'=>'Input Category Hindi Name',
            'category_name_hin.required'=>'Input Category English Name'

        ]);

        Category::insert([
            'category_name_en'=>$request->category_name_en,
            'category_name_hin'=>$request->category_name_hin,
            'category_slug_en'=>strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_hin'=>strtolower(str_replace(' ','-',$request->category_name_hin)),
            'category_icon'=>$request->category_icon,
            
        ]);

        $notification=array(
            'message'=>'Category Inserted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }

    public function edit($id){
        $category=Category::findOrFail($id);
        return view('backend.category.edit',compact('category'));
    }

    public function update(Request $request){

        $category_id=$request->id;

        Category::findOrFail($category_id)->update([
            'category_name_en'=>$request->category_name_en,
            'category_name_hin'=>$request->category_name_hin,
            'category_slug_en'=>strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_hin'=>strtolower(str_replace(' ','-',$request->category_name_hin)), 
            'category_icon'=>$request->category_icon,
        ]);
        $notification=array(
            'message'=>'Category Updated Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->route('all.category')->with($notification);

    }

    public function destroy($id){
        $category=Category::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Category Deleted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }
}
