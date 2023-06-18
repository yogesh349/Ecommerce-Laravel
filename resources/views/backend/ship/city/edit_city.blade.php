@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">





<!--   ------------ Add State Page -------- -->


          <div class="col-6">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit City </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">


 <form method="post" action="{{ route('city.update',$city->id) }}" >
	 	@csrf



<div class="form-group">
	<h5>Provision Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="division_id" class="form-control"  >
			<option value="" selected="" disabled="">Select Provision</option>
			@foreach($division as $div)
			<option value="{{ $div->id }}" {{ $div->id == $city->division_id ? 'selected': '' }}>{{ $div->division_name }}</option>	
			@endforeach
		</select>
		@error('division_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>



<div class="form-group">
	<h5>District Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="district_id" class="form-control"  >
			<option value="" selected="" disabled="">Select District</option>
			@foreach($district as $dis)
			<option value="{{ $dis->id }}" {{ $dis->id == $city->district_id ? 'selected': '' }}>{{ $dis->district_name }}</option>	
			@endforeach
		</select>
		@error('district_id') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	 </div>
		 </div>



	 <div class="form-group">
		<h5>City Name  <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="text"  name="city_name" class="form-control" value="{{ $city->city_name }}"> 
	 @error('city_name	') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	</div>
	</div>



			 <div class="text-xs-right">
	<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">					 
						</div>
					</form>





					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box --> 
			</div>




		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>


      <script>
		$(document).ready(function () {
			$('select[name="division_id"]').change(function (e) { 
				e.preventDefault();
				$('select[name="district_id"]').html('');
				var division_id=$(this).val();
				$.ajax({
					type: "GET",
					url: "/shipping/district/ajax/"+division_id,
					dataType: "json",
					success: function (response) {
						$.each(response, function (key, value) { 
							$('select[name="district_id"]').append('<option value=" '+ response[key].id +'">'+response[key].district_name + '</option>');

							 
						});
						
					}
				});
				
			});
		});
	  </script>

@endsection 