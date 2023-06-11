@extends('admin.admin_master')

@section('admin')
<div class="container-full">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
          
        <div class="col-9">

         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Sub Category List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Sub Category En</th>
                            <th>Sub Category Hin</th>
                            <th style="width: 25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategory as $item)
                        <tr>
                            <td>{{$item['category']['category_name_en']}}</td>
                            <td>{{$item->subcategory_name_en}}</td>
                            <td>{{$item->subcategory_name_hin}}</td>
                            <td>
                                <a href="{{route('subcategory.edit',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                <a href="{{route('subcategory.delete',$item->id)}}" title="Delete Data" class="btn btn-danger"  id="delete"><i class="fa fa-trash"></i></a>
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



        <div class="col-3">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Sub Category</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">


                    <form method="post" action="{{route('subcategory.store')}}">
                        @csrf    
                        
                        <div class="form-group">
                            <h5>Category Select <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" class="form-control" aria-invalid="false">
                                    <option selected disabled value="">Select Category</option>
                                   @foreach ($category as $item)
                                   <option  value="{{$item->id}}">{{$item->category_name_en}}</option>
                                       
                                   @endforeach
                                </select>
                                @error('category_id')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                            <div class="help-block"></div></div>
                        </div>
              
                              <div class="form-group">
                                <h5>SubCategory English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                  <input type="text" name="subcategory_name_en" class="form-control"> 
                                  @error('subcategory_name_en')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                              </div>
              
                              <div class="form-group">
                                  <h5>SubCategory Hindi <span class="text-danger">*</span></h5>
                                  <div class="controls">
                                    <input type="text"  name="subcategory_name_hin" class="form-control"> 
                                    @error('subcategory_name_hin')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>
              
                         <div class="text-xs-right">
                           <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Sub Category">
                         </div>
                       </form>

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