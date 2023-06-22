<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    //

    public function StripeOrder(Request $request){


\Stripe\Stripe::setApiKey('sk_test_51NKZN3SDWbWex4CuYCNdtT8y8eHPfrujy3uES22hDdLdq00Y9AE5ileukTh3onl4fCdb5FTW4UlAQxkVzssPsXUN00t3sYdGuV');


	$token = $_POST['stripeToken'];
	$charge = \Stripe\Charge::create([
	  'amount' => 999*100,
	  'currency' => 'usd',
	  'description' => 'Easy Online Store',
	  'source' => $token,
	  'metadata' => ['order_id' => '6735'],
	]);

	dd($charge);


    }
}
