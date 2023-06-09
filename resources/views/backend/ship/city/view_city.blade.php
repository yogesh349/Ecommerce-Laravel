@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">City List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Province Name </th> 
								<th>District Name </th>
								<th>State Name </th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>
	 @foreach($city as $item)
	 <tr>
		<td> {{ $item['division']['division_name'] }}  </td> 
		<td> {{ $item['district']['district_name'] }}  </td> 
		<td> {{ $item->city_name }}  </td>

		<td width="40%">
 <a href="{{ route('city.edit',$item->id) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
 <a href="{{ route('city.delete',$item->id) }}" class="btn btn-danger" title="Delete Data" id="delete">
 	<i class="fa fa-trash"></i></a>
		</td>

	 </tr>
	  @endforeach
						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->


<!--   ------------ Add State Page -------- -->


          <div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add City </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">


 <form method="post" action="{{ route('city.store') }}" >
	 	@csrf



<div class="form-group">
	<h5>Provision Select <span class="text-danger">*</span></h5>
	<div class="controls">
		<select name="division_id" class="form-control"  >
			<option value="" selected="" disabled="">Select Province</option>
			@foreach($division as $div)
			<option value="{{ $div->id }}">{{ $div->division_name }}</option>	
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
			<option value="{{ $dis->id }}">{{ $dis->district_name }}</option>	
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
	 <input type="text"  name="city_name" class="form-control" > 
	 @error('city_name	') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	</div>
	</div>



			 <div class="text-xs-right">
	<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">					 
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