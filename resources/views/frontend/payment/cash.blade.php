@extends('frontend.main_master')
@section('title')
Cash On Delivery
@endsection
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Cash On Delivery</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->




<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">





<div class="col-md-6">
	<!-- checkout-progress-sidebar -->
	<div class="checkout-progress-sidebar ">
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="unicase-checkout-title">Your Shopping Amount </h4>
				</div>
				<div class="">
					<table class="table table-bordered">
						<thead>
						  <tr>
							<th scope="col">SN</th>
							<th scope="col">Product Name</th>
							<th scope="col">Quantity</th>
							<th scope="col">Price</th>
							<th scope="col">Total</th>
						  </tr>
						</thead>
						<tbody>
							@php
								$increment=1
							@endphp
							@foreach ($cart as $item)
						  <tr>
							<th>{{$increment++}}</th>
							<td>{{$item->name}}</td>
							<td>{{$item->qty}}</td>
							<td>{{$item->price}}</td>
							<td>{{$item->price *$item->qty}}</td>
							
						  </tr>
						  @endforeach
						</tbody>
					  </table>
					<ul class="nav nav-checkout-progress list-unstyled">


						 
						<li style="float: right;">
							@if(Session::has('coupon'))

							<strong>SubTotal: </strong> ${{ $cartTotal }}
							<hr>

							<strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name']
							}}
							( {{ session()->get('coupon')['coupon_discount'] }} % )
							<hr>

							<strong>Coupon Discount : </strong> ${{
							session()->get('coupon')['discount_amount'] }}
							<hr>

							<strong>Grand Total : </strong> ${{ session()->get('coupon')['total_amount']
							}}
							<hr>


							@else

							<strong>SubTotal: </strong> Rs {{ $cartTotal }}
							<hr>

							<strong>Grand Total : </strong> Rs {{ $cartTotal }}
							<hr>


							@endif

						</li>




					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- checkout-progress-sidebar -->
</div> <!--  // end col md 6 -->







				<div class="col-md-6">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Pay With Esewa</h4>
								</div>

                        <div>
                            <img src="{{ asset('frontend/assets/images/payments/cash.png') }}"> 
                        </div>
                        <br>
                        <br>


							

						<form action="{{route('cash.order')}}" method="POST">
							@csrf
							
							<input value="{{$data['shipping_name']}}" name="name" type="hidden">
							<input value="{{$data['shipping_email']}}" name="email" type="hidden">
							<input value="{{$data['shipping_phone']}}" name="phone" type="hidden">
							<input value="{{$data['division_id']}}" name="division_id" type="hidden">
							<input value="{{$data['district_id']}}" name="district_id" type="hidden">
							<input value="{{$data['city_id']}}" name="city_id" type="hidden">
							<input value="{{$cartTotal }}" name="amount" type="hidden">
							<input value="{{$data['notes']}}" name="notes" type="hidden">
							<input value="{{$data['post_code']}}" name="post_code" type="hidden">
							<input value="2" name="txAmt" type="hidden">
							<input value="2" name="psc" type="hidden">
							<input value="100" name="pdc" type="hidden">
							<input value="EPAYTEST" name="scd" type="hidden">
							<button class="btn btn-primary">Submit Payment</button>
						</form>

							</div>
						</div>
					</div>
					<!-- checkout-progress-sidebar -->
				</div><!--  // end col md 6 -->
			</form>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- === ===== BRANDS CAROUSEL ==== ======== -->

		<!-- ===== == BRANDS CAROUSEL : END === === -->
	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection