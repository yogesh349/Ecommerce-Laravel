@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="container-full">
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
          
        <div class="col-9">

         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Sub Sub Category List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Sub-Sub Category En</th>
                            <th>Sub-Sub Category Hin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subsubcategory as $item)
                        <tr>
                            <td>{{$item['category']['category_name_en']}}</td>
                            <td>{{$item['subcategory']['subcategory_name_en']}}</td>
                            <td>{{$item->subsubcategory_name_en}}</td>
                            <td>{{$item->subsubcategory_name_hin}}</td>
                            <td>
                                <a href="{{route('subsubcategory.edit',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
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
                 <h3 class="box-title">Add Sub-Sub Category</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">


                    <form method="post" action="{{route('subsubcategory.store')}}">
                        @csrf    
                        
                        <div class="form-group">
                            <h5>Select Category <span class="text-danger">*</span></h5>
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
                            <h5>Select Sub Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subcategory_id" class="form-control" aria-invalid="false">
                                    <option selected disabled value="">Select Sub Category</option>
                                </select>
                                @error('subcategory_id')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                            <div class="help-block"></div></div>
                        </div>
              
                              <div class="form-group">
                                <h5>Sub-SubCategory English <span class="text-danger">*</span></h5>
                                <div class="controls">
                                  <input type="text" name="subsubcategory_name_en" class="form-control"> 
                                  @error('subsubcategory_name_en')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                              </div>
              
                              <div class="form-group">
                                  <h5>Sub-SubCategory Hindi <span class="text-danger">*</span></h5>
                                  <div class="controls">
                                    <input type="text"  name="subsubcategory_name_hin" class="form-control"> 
                                    @error('subsubcategory_name_hin')
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

  <script type="text/javascript">

    $(document).ready(function () {
        $('select[name="category_id"]').change(function (e) { 
            e.preventDefault();
            var category_id=$(this).val();
            if(category_id){
                $.ajax({
                    type: "GET",
                    url: "{{url('/category/subcategory/ajax')}}/"+category_id,
                    dataType: "json",
                    success: function (data) {
                      console.log('danger');
                      var d=$('select[name="subcategory_id"]').empty();
                      $.each(data, function (key, value) { 
                        $('select[name="subcategory_id"]').append('<option value=" '+ value.id +'">'+value.subcategory_name_en + '</option>');


                         
                      });                    
                    }
                });
            }else{
              alert('danger');
            }
            
        });
        
    });
</script>
@endsection