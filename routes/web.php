<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\IndexController;

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
})->name('dashboard');



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Admin All route
Route::get('admin/logut',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('admin/profile',[AdminProfileController::class,'profile'])->name('admin.profile');
Route::get('admin/profile/edit',[AdminProfileController::class,'editProfile'])->name('admin.profile.edit');
Route::post('admin/profile/store',[AdminProfileController::class,'profileStore'])->name('admin.profile.store');
Route::get('admin/change/password',[AdminProfileController::class,'adminChangePassword'])->name('admin.change.password');
Route::post('update/change/password',[AdminProfileController::class,'updatePassword'])->name('admin.update.password');


// User All Routes

Route::get('/',[IndexController::class,'index']);

Route::get('user/logout',[IndexController::class,'userLogout'])->name('user.logout');
Route::get('user/profile',[IndexController::class,'userProfile'])->name('user.profile');
Route::post('user/profile/store',[IndexController::class,'userProfileStore'])->name('user.profile.store');
Route::get('user/change/password',[IndexController::class,'userChangePassword'])->name('change.password');
Route::post('user/update/password',[IndexController::class,'userUpdatePassword'])->name('user.change.password');




// Admin Brands Routes

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
    Route::post('sub/sub/store',[SubCategoryController::class,'subsubstore'])->name('subsubcategory.store');
    Route::get('sub/edit/{id}',[SubCategoryController::class,'subsubedit'])->name('subsubcategory.edit');
    Route::post('sub/sub/update',[SubCategoryController::class,'subsubupdate'])->name('subsubcategory.update');

});
