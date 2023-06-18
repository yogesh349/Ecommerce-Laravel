<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    //

    public function MyCart(){
    	return view('frontend.wishlist.view_mycart');

    }


    public function GetCartProduct(){
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => round($cartTotal),

    	));

    } //end method 


    public function RemoveCartProduct($rowId){
        Cart::remove($rowId);
        if(Session::has('coupon')){
            $coupon_name=Session::get('coupon')['coupon_name'];
            $coupon=Coupon::where('coupon_name',$coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
            $coupon_discount=Session::get('coupon')['coupon_discount'];
     
            $coupon_discount=Session::get('coupon')['coupon_discount'];
            Session::put('coupon',
			[
				'coupon_name'=>$coupon_name,
				'coupon_discount'=>$coupon_discount,
				'discount_amount'=>round((Cart::total()*$coupon->coupon_discount)/100),
				'total_amount'=>Cart::total()-round((Cart::total()*$coupon->coupon_discount)/100),

			]

			);
        }
        return response()->json(['success' => 'Successfully Remove From Cart']);
    }


     // Cart Increment 
     public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if(Session::has('coupon')){
            $coupon_name=Session::get('coupon')['coupon_name'];
            $coupon=Coupon::where('coupon_name',$coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
            $coupon_discount=Session::get('coupon')['coupon_discount'];
     
            $coupon_discount=Session::get('coupon')['coupon_discount'];
            Session::put('coupon',
			[
				'coupon_name'=>$coupon_name,
				'coupon_discount'=>$coupon_discount,
				'discount_amount'=>round((Cart::total()*$coupon->coupon_discount)/100),
				'total_amount'=>Cart::total()-round((Cart::total()*$coupon->coupon_discount)/100),

			]

			);
        }
        return response()->json('increment');

    } // end mehtod
    
    
    public function CartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json('Decrement');
    }// end mehtod 
    




}
