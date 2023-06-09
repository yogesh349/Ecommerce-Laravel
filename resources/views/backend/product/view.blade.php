@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
          
        <div class="col-12">

         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Product List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product En</th>
                            <th>Product Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th style="width: 25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td> <img src="{{asset("upload/products/thumbnail/".$item->product_thumbnail)}}" width="30%" height="30%"></td>
                            <td>{{$item->product_name_en}}</td>
                            <td>{{$item->selling_price}}</td>
                            <td>{{$item->product_qty}}</td>
                            <td>
                                @if ($item->discount_price==NULL)
                                <span class="badge badge-pill badge-danger">No Discount</span>
                                    
                                @else
                                @php
                                    
                                    $amount=$item->selling_price-$item->discount_price;
                                    $discount=($amount/$item->selling_price)*100;
                                @endphp
                                <span class="badge badge-pill badge-danger">{{round($discount)}}%</span>
                                    
                                @endif
                                </td>
                            <td>@if ($item->status==1)
                                <span class="badge badge-pill badge-success">Active</span>
                                @else
                                <span class="badge badge-pill badge-danger">InActive</span>
                            @endif</td>
                            <td>
                                <a href="{{route('product.edit',$item->id)}}" class="btn btn-primary btn-sm" title="Product Details Data"><i class="fa fa-eye"></i></a>
                                <a href="{{route('product.edit',$item->id)}}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('product.delete',$item->id)}}" title="Delete Data" class="btn btn-danger btn-sm"  id="delete"><i class="fa fa-trash"></i></a>
                                @if ($item->status==1)
                                <a href="{{route('product.inactive',$item->id)}}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                                @else
                                <a href="{{route('product.active',$item->id)}}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                            @endif</td>
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
          <!-- /.box -->          
        </div>   
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@endsection