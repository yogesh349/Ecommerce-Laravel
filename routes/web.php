<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeBlogController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishlistController;

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




// Frontend SubCategory wise Data
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);


// Frontend Sub-SubCategory wise Data
Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);



// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);



// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);



// Get Data from mini cart
Route::get('product/mini/cart/', [CartController::class, 'AddMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);



Route::group(['prefix'=>'user','middleware'=>['user','auth'],'namespace'=>'User'],function(){

            // Add to Wishlist
        Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);


        // Wishlist page
        Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');


        Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);


        Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

        Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
        Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');
        Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');
        Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);
        Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);
        Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');
        Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');
        Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');


});

// Cart Page setup
Route::get('/user/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);
Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);


// All coupons Routes
Route::prefix('coupons')->group(function(){
    Route::get('/view',[CouponController::class,'view'])->name('manage.coupons');
    Route::POST('/store',[CouponController::class,'store'])->name('coupon.store');

    Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
    Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
    Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');


});

// All Shipping Routes
Route::prefix('shipping')->group(function(){
    Route::get('/division/view',[ShippingController::class,'divisionView'])->name('manage.division');
    Route::post('/division/store', [ShippingController::class, 'DivisionStore'])->name('division.store');
    Route::get('/edit/{id}', [ShippingController::class, 'DivisionEdit'])->name('division.edit');
    Route::post('/division/update/{id}', [ShippingController::class, 'DivisionUpdate'])->name('division.update');

Route::get('/division/delete/{id}', [ShippingController::class, 'DivisionDelete'])->name('division.delete');




// Ship District 
Route::get('/district/view', [ShippingController::class, 'DistrictView'])->name('manage.district');
Route::post('/district/store', [ShippingController::class, 'DistrictStore'])->name('district.store');
Route::get('/district/edit/{id}', [ShippingController::class, 'DistrictEdit'])->name('district.edit');
Route::post('/district/update/{id}', [ShippingController::class, 'DistrictUpdate'])->name('district.update');
Route::get('/district/delete/{id}', [ShippingController::class, 'DistrictDelete'])->name('district.delete');


// Ship City
Route::get('/city/view', [ShippingController::class, 'CityView'])->name('manage.city');
Route::post('/city/store', [ShippingController::class, 'CityStore'])->name('city.store');
Route::get('/city/edit/{id}', [ShippingController::class, 'CityEdit'])->name('city.edit');
Route::post('/city/update/{id}', [ShippingController::class, 'CityUpdate'])->name('city.update');
Route::get('/city/delete/{id}', [ShippingController::class, 'CityDelete'])->name('city.delete'); 
Route::get('/district/ajax/{id}', [ShippingController::class, 'DistrictAjax']);


});




// Frontend Coupon Option

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);



// Checkout Routes 

Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
Route::get('/city-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);


Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');


Route::post('/payment-verify',[CheckoutController::class,'verifyPayment'])->name('esewa.payment');
Route::get('/success',[CheckoutController::class,'successPayment']);
Route::get('/failure',[CheckoutController::class,'failurePayment']);



// Admin Order All Routes 

Route::prefix('orders')->group(function(){
    Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('pending-orders'); 
    Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');
    Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');
    Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');
    Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');
    Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');
    Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');
    Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');
    Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
    Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');
    Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');
    Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');
    Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');
    Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');
    });

    // Admin Reports Routes 
Route::prefix('reports')->group(function(){

    Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');
    Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');
    Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');
    Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');    
 });



// Admin Get All User Routes 
Route::prefix('alluser')->group(function(){
    Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-users');
});

// Admin Reports Routes 
Route::prefix('blog')->group(function(){
 Route::get('/category', [BlogController::class, 'BlogCategory'])->name('blog.category'); 
 Route::post('/store', [BlogController::class, 'BlogCategoryStore'])->name('blogcategory.store');
 Route::get('/category/edit/{id}', [BlogController::class, 'BlogCategoryEdit'])->name('blog.category.edit');
 Route::get('/category/delete/{id}', [BlogController::class, 'BlogCategoryEdit'])->name('blog.category.delete');
 Route::post('/update', [BlogController::class, 'BlogCategoryUpdate'])->name('blogcategory.update');   
 
// Admin View Blog Post Routes 
Route::get('/list/post', [BlogController::class, 'ListBlogPost'])->name('list.post');
Route::get('/add/post', [BlogController::class, 'AddBlogPost'])->name('add.post');
Route::post('/post/store', [BlogController::class, 'BlogPostStore'])->name('post-store');
});




//  Frontend Blog Show Routes 

Route::get('/blog', [HomeBlogController::class, 'AddBlogPost'])->name('home.blog');
    
    
// Admin Site Setting Routes 
Route::prefix('setting')->group(function(){

    Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site.setting');
    Route::post('/site/update', [SiteSettingController::class, 'SiteSettingUpdate'])->name('update.sitesetting');
    Route::get('/seo', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting'); 
    Route::post('/seo/update', [SiteSettingController::class, 'SeoSettingUpdate'])->name('update.seosetting');
});



// Admin Return Order Routes 
Route::prefix('return')->group(function(){

    Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');
    Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');
    Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
    Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
  });



  /// Frontend Product Review Routes

Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');



// Admin Manage Review Routes 
Route::prefix('review')->group(function(){
    Route::get('/pending', [ReviewController::class, 'PendingReview'])->name('pending.review');
    Route::get('/admin/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');
    Route::get('/publish', [ReviewController::class, 'PublishReview'])->name('publish.review');
    Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');
    
    });




// Admin Manage Review Routes 
Route::prefix('stock')->group(function(){
    Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
    });