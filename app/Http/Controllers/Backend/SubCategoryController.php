<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    public function view(){
        $subcategory=SubCategory::latest()->get();
        $category=Category::orderBy('category_name_en','ASC')->get();
        return view('backend.sub-category.view',compact('subcategory','category'));
    }

    public function store(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_name_en'=>'required',
            'subcategory_name_hin'=>'required',
        ],
        [
            'category_id'=>'Please Select Any Option',
            'subcategory_name_en.required'=>'Input Sub Category Hindi Name',
            'subcategory_name_hin.required'=>'Input Sub Category English Name'

        ]);

        SubCategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name_en'=>$request->subcategory_name_en,
            'subcategory_name_hin'=>$request->subcategory_name_hin,
            'subcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_hin'=>strtolower(str_replace(' ','-',$request->subcategory_name_hin)),    
        ]);

        $notification=array(
            'message'=>'Sub Category Inserted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $subcategory=Subcategory::findOrFail($id);
        $category=Category::orderBy('category_name_en','ASC')->get();
        return view('backend.sub-category.edit',compact('subcategory','category'));
    }

    public function update(Request $request){

        $subcategory_id=$request->id;

        SubCategory::findOrFail($subcategory_id)->update([
            'category_id'=>$request->category_id,
            'subcategory_name_en'=>$request->subcategory_name_en,
            'subcategory_name_hin'=>$request->subcategory_name_hin,
            'subcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_hin'=>strtolower(str_replace(' ','-',$request->subcategory_name_hin)), 
        ]);
        $notification=array(
            'message'=>'Sub Category Updated Sucessfully',
            'alert-type'=>'info'
        );
        return redirect()->route('all.subCategory')->with($notification);

    }

    public function destroy($id){
        $subcategory=SubCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Category Deleted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }


    // Sub sub category
    public function subsubview(){
        $subsubcategory=SubSubCategory::latest()->get();
        $category=Category::orderBy('category_name_en','ASC')->get();
        return view('backend.sub-category.subview',compact('subsubcategory','category'));

        
    }
    public function getsubCategory($category_id){
        $sub_cat=SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en')->get();
        return json_decode($sub_cat);
    }

    public function subsubstore(Request $request){

        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'subsubcategory_name_en'=>'required',
            'subsubcategory_name_hin'=>'required',
        ],
        [
            'category_id'=>'Please Select Any Option',
            'category_id'=>'Please Select Any Option',
            'subcategory_name_en.required'=>'Input sub-sub Category Hindi Name',
            'subcategory_name_hin.required'=>'Input sub-sub Category English Name'

        ]);

        SubSubCategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'subsubcategory_name_en'=>$request->subsubcategory_name_en,
            'subsubcategory_name_hin'=>$request->subsubcategory_name_hin,
            'subsubcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin'=>strtolower(str_replace(' ','-',$request->subsubcategory_name_hin)),    
        ]);

        $notification=array(
            'message'=>'Sub-Sub Category Inserted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function subsubedit($id){
        $subsubcategory=SubSubCategory::find($id);
        $category=Category::orderBy('category_name_en','ASC')->get();
        return view('backend.sub-category.subsub-edit',compact('subsubcategory','category'));  
    }
    public function subsubupdate(Request $request){



        SubSubCategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'subsubcategory_name_en'=>$request->subsubcategory_name_en,
            'subsubcategory_name_hin'=>$request->subsubcategory_name_hin,
            'subsubcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin'=>strtolower(str_replace(' ','-',$request->subsubcategory_name_hin)),    
        ]);

        $notification=array(
            'message'=>'Sub-Sub Category Updated Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.subsubCategory')->with($notification);
    }


    public function subsubdestroy($id){
        $subcategory=SubCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Category Deleted Sucessfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }
}
