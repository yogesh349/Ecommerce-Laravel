<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});




Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::middleware(['auth:admin'])->group(function(){


    // Admin All route
Route::get('admin/logut',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('admin/profile',[AdminProfileController::class,'profile'])->name('admin.profile');
Route::get('admin/profile/edit',[AdminProfileController::class,'editProfile'])->name('admin.profile.edit');
Route::post('admin/profile/store',[AdminProfileController::class,'profileStore'])->name('admin.profile.store');
Route::get('admin/change/password',[AdminProfileController::class,'adminChangePassword'])->name('admin.change.password');
Route::post('update/change/password',[AdminProfileController::class,'updatePassword'])->name('admin.update.password');


Route::prefix('brand')->group(function(){
    Route::get('/view',[BrandController::class,'viewBrand'])->name('all.brands');
    Route::post('/store',[BrandController::class,'store'])->name('brand.store');
    Route::get('/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
    Route::post('/update',[BrandController::class,'update'])->name('brand.update');
    Route::get('/delete/{id}',[BrandController::class,'destroy'])->name('brand.delete');

});

// Admin Category Routes

Route::prefix('category')->group(function(){
    Route::get('/view',[CategoryController::class,'view'])->name('all.category');
    Route::post('/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/update',[CategoryController::class,'update'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'destroy'])->name('category.delete');

    // Admin Sub Category

    Route::get('/sub/view',[SubCategoryController::class,'view'])->name('all.subCategory');
    Route::post('sub/store',[SubCategoryController::class,'store'])->name('subcategory.store');
    Route::get('sub/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
    Route::post('sub/update',[SubCategoryController::class,'update'])->name('subcategory.update');
    Route::get('sub/delete/{id}',[SubCategoryController::class,'destroy'])->name('subcategory.delete');

    // Admin Sub sub category controller
    Route::get('sub/sub/view',[SubCategoryController::class,'subsubview'])->name('all.subsubCategory');
    Route::get('subcategory/ajax/{category_id}',[SubCategoryController::class,'getsubCategory']);
    Route::get('sub-subcategory/ajax/{subcategory_id}',[SubCategoryController::class,'getsubsubCategory']);
    Route::post('sub/sub/store',[SubCategoryController::class,'subsubstore'])->name('subsubcategory.store');
    Route::get('sub/sub/edit/{id}',[SubCategoryController::class,'subsubedit'])->name('subsubcategory.edit');
    Route::post('sub/sub/update',[SubCategoryController::class,'subsubupdate'])->name('subsubcategory.update');
    

});


// Admin Product Routes

Route::prefix('product')->group(function(){
    Route::get('/add',[ProductController::class,'addproduct'])->name('add.product');
    Route::post('/store',[ProductController::class,'store'])->name('product-store');
    Route::get('/manage',[ProductController::class,'manageProduct'])->name('manage.product');
    Route::get('/edit/{id}',[ProductController::class,'editProduct'])->name('product.edit');
    Route::post('/update',[ProductController::class,'updateProduct'])->name('product.update');
    Route::post('image/update',[ProductController::class,'multiImageUpdate'])->name('update.product.image');
    Route::post('image/thumbnail/update',[ProductController::class,'updateThumbnailImg'])->name('update.product.thumbmail');
    Route::get('mulit-image/delete/{id}',[ProductController::class,'multiImagedestroy'])->name('product.multiImage.delete');
    Route::get('active/{id}',[ProductController::class,'activeProduct'])->name('product.active');
    Route::get('inactive/{id}',[ProductController::class,'inActiveProduct'])->name('product.inactive');
    Route::get('/delete/{id}',[ProductController::class,'deleteProduct'])->name('product.delete');

});

Route::prefix('slider')->group(function(){
    Route::get('/view',[SliderController::class,'view'])->name('manage.slider');
    Route::post('/store',[SliderController::class,'store'])->name('slider.store');
    Route::get('/edit/{id}',[SliderController::class,'edit'])->name('slider.edit');
    Route::post('/update',[SliderController::class,'update'])->name('slider.update');
    Route::get('/delete/{id}',[SliderController::class,'destroy'])->name('slider.delete');
    Route::get('active/{id}',[SliderController::class,'activeSliver'])->name('slider.active');
    Route::get('inactive/{id}',[SliderController::class,'inactiveSlider'])->name('slider.inactive');

});

});



// User All Routes

Route::get('/',[IndexController::class,'index']);

Route::get('user/logout',[IndexController::class,'userLogout'])->name('user.logout');
Route::get('user/profile',[IndexController::class,'userProfile'])->name('user.profile');
Route::post('user/profile/store',[IndexController::class,'userProfileStore'])->name('user.profile.store');
Route::get('user/change/password',[IndexController::class,'userChangePassword'])->name('change.password');
Route::post('user/update/password',[IndexController::class,'userUpdatePassword'])->name('user.change.password');




// Admin Brands Routes


//// Frontend All Routes /////
/// Multi Language All Routes ////

Route::get('/language/hindi', [LanguageController::class, 'Hindi'])->name('hindi.language');

Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');


// Product Details page

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);




// Frontend Product Tags Page 
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);