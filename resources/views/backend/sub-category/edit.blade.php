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
                 <h3 class="box-title">Edit Sub Category</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">


                    <form method="post" action="{{route('subcategory.update')}}">
                        @csrf    
                        <input type="hidden" name="id" value="{{$subcategory->id}}">
                        
                        <div class="form-group">
                            <h5>Select Select <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" class="form-control" aria-invalid="false">
                                    <option selected disabled value="">Select Your City</option>
                                   @foreach ($category as $item)
                                   <option  value="{{$item->id}}" {{$item->id==$subcategory->category_id ? 'selected':''}}>{{$item->category_name_en}}</option>
                                       
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
                                  <input type="text" name="subcategory_name_en" class="form-control" value="{{$subcategory->subcategory_name_en}}"> 
                                  @error('subcategory_name_en')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                              </div>
              
                              <div class="form-group">
                                  <h5>SubCategory Hindi <span class="text-danger">*</span></h5>
                                  <div class="controls">
                                    <input type="text"  name="subcategory_name_hin" class="form-control" value="{{$subcategory->subcategory_name_hin}}"> 
                                    @error('subcategory_name_hin')
                                      <span class="text-danger">{{$message}}</span>
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
             <!-- /.box -->          
           </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  </div>
@endsection