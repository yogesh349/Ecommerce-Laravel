<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShipCity;
use App\Models\ShipDistrict;
use Carbon\Carbon;
use Illuminate\Http\Request;
require '../vendor/autoload.php';
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;
use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //
    public function DistrictGetAjax($division_id){

    	$ship = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
    	return json_encode($ship);

    } // end method 


    public function StateGetAjax($district_id){

    	$ship = ShipCity::where('district_id',$district_id)->orderBy('city_name','ASC')->get();
    	return json_encode($ship);

    } // end method 


    public function CheckoutStore(Request $request){
        $data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['post_code'] = $request->post_code;
    	$data['division_id'] = $request->division_id;
    	$data['district_id'] = $request->district_id;
    	$data['city_id'] = $request->city_id;
    	$data['notes'] = $request->notes;
		$cartTotal = FacadesCart::total();
		$cart=FacadesCart::content();

        if ($request->payment_method == 'esewa') {
    		return view('frontend.payment.stripe',compact('data','cartTotal','cart'));
    	}elseif ($request->payment_method == 'cash') {
    		return view('frontend.payment.cash',compact('data','cartTotal','cart'));
    	}else{
            return 'cash';
    	}



    }// end mehtod. 

	public function verifyPayment(Request $request){
		$pid=uniqid();
		$tax_amount=$request->txAmt;
		$serice_charge=$request->psc;
		$delivery_charge=$request->pdc;
		Session::put('order_details',[
			'division_id'=>$request->division_id,
			'district_id'=>$request->district_id,
			'city_id'=>$request->city_id,
			'name'=>$request->shipping_name,
			'email'=> $request->shipping_email,
			'phone'=>$request->shipping_phone,
			'post_code'=>$request->post_code,
			'notes'=>$request->notes,
		]);
		$cart=FacadesCart::content();
		// Set success and failure callback URLs.

		if (Session::has('coupon')) {
			# code...
			$amount=Session::get('coupon')['total_amount'];

		}else{
			$amount=round(FacadesCart::total());

		}


		$successUrl = url('/success');
		$failureUrl = url('/failure');

		// Config for development.
		$config = new Config($successUrl, $failureUrl);

		// Config for production.
		// $config = new Config($successUrl, $failureUrl, 'b4e...e8c753...2c6e8b');

		// Initialize eSewa client.
		$esewa = new Client($config);
		$esewa->process($pid, $amount, $tax_amount, $serice_charge, $delivery_charge);

	}
	public function successPayment(Request $request){
		$oid=$request->oid;
		$amount=$request->amt;
		$reference_id=$request->refId;
		$order_id=Order::insertGetId([
			'user_id'=>Auth::id(),
			'division_id'=>Session::get('order_details')['division_id'],
			'district_id'=>Session::get('order_details')['district_id'],
			'city_id'=>Session::get('order_details')['city_id'],
			'name'=>Session::get('order_details')['name'],
			'email'=>Session::get('order_details')['email'],
			'phone'=>Session::get('order_details')['phone'],
			'post_code'=>Session::get('order_details')['post_code'],
			'notes'=>Session::get('order_details')['notes'],
			'payment_method'=>'Esewa',
			'amount'=>$amount,
			'order_number'=>$oid,
			'invoice_no'=>'TRI'.mt_rand(100000,9999999),
			'order_date'=>Carbon::now()->format('d F Y'),
			'order_month'=>Carbon::now()->format('F'),
			'order_year'=>Carbon::now()->format('d F Y'),
			'status'=>'Pending',
			'created_at'=>Carbon::now()
		]);

      $carts=FacadesCart::content();
	  foreach ($carts as $cart) {
		OrderItem::insert([

			'order_id'=>$order_id,
			'product_id'=>$cart->id,
			'color'=>$cart->options->color,
			'size'=>$cart->options->size,
			'qty'=>$cart->qty,
			'price'=>$cart->price,
			'created_at'=>Carbon::now(),

		]);
	  }
     $invoice=Order::findOrFail($order_id);
	  $data=[
		'invoice_no'=>$invoice->invoice_no,
		'amount'=>$amount,
		'name'=>Session::get('order_details')['name'],
		'email'=>Session::get('order_details')['email'],


	  ];
	  Mail::to(Session::get('order_details')['email'])->send(new OrderMail($data));

	  if(Session::has('coupon')){
		Session::forget('coupon');
	  }
	  FacadesCart::destroy();

	  $notification=array(
		'message'=>'Your Order Placed Successfully',
		'alert-type'=>'success'
	);
	return redirect()->route('dashboard')->with($notification);

	}


	public function failurePayment(){
		dd("Failure");
	}




}
