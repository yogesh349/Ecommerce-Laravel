@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<section class="content">


    <!-- Basic Forms -->
     <div class="box">
       <div class="box-header with-border">
         <h4 class="box-title">Add Product</h4>
         
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col">
               <form method="POST" action="{{route('product-store')}}" enctype="multipart/form-data">
                @csrf
                 <div class="row">
                   <div class="col-12">	
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Brand Select <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="brand_id" class="form-control" aria-invalid="false">
                                        <option selected disabled value="">Select Brand</option>
                                       @foreach ($brands as $brand)
                                       <option  value="{{$brand->id}}">{{$brand->brand_name_en}}</option>
                                           
                                       @endforeach
                                    </select>
                                    @error('brand_id')
                                          <span class="text-danger">{{$message}}</span>
                                      @enderror
                                <div class="help-block"></div></div>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Category Select <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="category_id" class="form-control" aria-invalid="false">
                                        <option selected disabled value="">Select Category</option>
                                       @foreach ($categories as $item)
                                       <option  value="{{$item->id}}">{{$item->category_name_en}}</option>
                                           
                                       @endforeach
                                    </select>
                                    @error('category_id')
                                          <span class="text-danger">{{$message}}</span>
                                      @enderror
                                <div class="help-block"></div></div>
                            </div>
  
                            
                        </div>

                        <div class="col-md-4">

                            <div class="form-group">
                                <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="subcategory_id" class="form-control" aria-invalid="false">
                                        <option selected disabled value="">Select SubCategory</option>
                                
                                    </select>
                                    @error('subcategory_id')
                                          <span class="text-danger">{{$message}}</span>
                                      @enderror
                                <div class="help-block"></div></div>
                            </div>
           
                            
                            
                        </div>
                    </div>
             
                         <div class="row">
                             <div class="col-md-4">
                                 <div class="form-group">
                                     <h5>SubSubCategory Select <span class="text-danger">*</span></h5>
                                     <div class="controls">
                                         <select name="subsubcategory_id" class="form-control" aria-invalid="false">
                                             <option selected disabled value="">Select SubSubCategory</option>

                                         </select>
                                         @error('subsubcategory_id')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                     <div class="help-block"></div></div>
                                 </div>
     
                             </div>
     
                             <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" class="form-control">
                                         <div class="help-block">
                                            @error('product_name_en')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror</div>
                                        </div>
                                </div>
                                 
                             </div>
     
                             <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name Hin<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_hin" class="form-control">
                                         <div class="help-block">
                                            @error('product_name_hin')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror</div>
                                        </div>
                                </div>              
                             </div>
                         </div>

                         <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Code<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" class="form-control">
                                         <div class="help-block">
                                            @error('product_code')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror</div>
                                        </div>
                                </div>   
                                
                            </div>
    
                            <div class="col-md-4">
                               <div class="form-group">
                                   <h5>Product Quantity <span class="text-danger">*</span></h5>
                                   <div class="controls">
                                       <input type="text" name="product_qty" class="form-control">
                                           @error('product_qty')
                                              <span class="text-danger">{{$message}}</span>
                                          @enderror
                                       </div>
                               </div>
                                
                            </div>
    
                            <div class="col-md-4">
                               <div class="form-group">
                                   <h5>Product Tags En<span class="text-danger">*</span></h5>
                                   <div class="controls">
                                       <input type="text" name="product_tags_en" class="form-control" value="Lorem,ispum,fsf" data-role="tagsinput">
                                           @error('product_tags_en')
                                              <span class="text-danger">{{$message}}</span>
                                          @enderror
                                       </div>
                               </div>              
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags Hin<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_tags_hin" class="form-control" value="Lorem,ispum,dfsdf" data-role="tagsinput">
                                            @error('product_tags_hin')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                        </div>
                                </div>   
                                
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Size En<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_en" class="form-control" value="Small,Medium,Large" data-role="tagsinput">
                                            @error('product_size_en')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                        </div>
                                </div>
                                
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Size Hin<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_hin" class="form-control" value="Small,Medium,Large"data-role="tagsinput">
                                            @error('product_size_hin')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                        </div>
                                </div>
                                          
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Color En<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_color_en" class="form-control" value="Red,White,Green" data-role="tagsinput">
                                            @error('product_color_en')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                        </div>
                                </div>   
                                
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Color Hin<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_color_hin" class="form-control" value="Black,White,Grey" data-role="tagsinput">
                                            @error('product_color_hin')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                        </div>
                                </div>
                                
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Selling Price<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="selling_price" class="form-control">
                                         <div class="help-block">
                                            @error('selling_price')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror</div>
                                        </div>
                                </div> 
                                          
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount_price" class="form-control">
                                            @error('discount_price')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                        </div>
                                </div>   
                                
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Main Thumbnail<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="product_thumbnail" class="form-control" onchange="mainthumnail(this)">
                                            @error('product_thumbnail')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                           <img src="" alt="" id="mainThumb">
                                        </div>
                                </div>  
                                
                                
                            </div>
    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Multiple Image<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="multi_img[]" class="form-control" multiple id="multiImg">
                                            @error('multi_img')
                                               <span class="text-danger">{{$message}}</span>
                                           @enderror
                                           <div class="row" id="preview_img">


                                           </div>
                                        </div>
                                </div>  
                                
                                          
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_desc_en" id="textarea" class="form-control" placeholder="Textarea text"></textarea>
                                    
                                </div>   
                                
                            </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description Hin<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_desc_hin" id="textarea" class="form-control" placeholder="Textarea text"></textarea>
                                    
                                </div>   
                                
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="long_desc_en" rows="10" cols="80">
                                            Long Description English.
                                        </textarea>
                                    
                                </div>   
                                
                            </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description Hin<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="long_desc_hin" rows="10" cols="80">
                                            Long Description Hindi.
                                        </textarea>
                                    
                                </div>   
                                
                            </div>
                            </div>
                        </div>
                        <hr>


 
                      
                   
                  
                   <div class="row">   
                       <div class="col-md-6">
                           <div class="form-group">
                               <div class="controls">
                                   <fieldset>
                                       <input type="checkbox" id="checkbox_2" value="1" name="hot_deals">
                                       <label for="checkbox_2">Hot Deals</label>
                                   </fieldset>
                                   <fieldset>
                                       <input type="checkbox" id="checkbox_3" value="1" name="featured">
                                       <label for="checkbox_3">Featured</label>
                                   </fieldset>
                               <div class="help-block"></div></div>
                           </div>
                       </div>

                       <div class="col-md-6">
                        <div class="form-group">
                            <div class="controls">
                                <fieldset>
                                    <input type="checkbox" id="checkbox_4" value="1" name="special_offer">
                                    <label for="checkbox_4">Special Offer</label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_5" value="1" name="special_deals">
                                    <label for="checkbox_5">Special Deals</label>
                                </fieldset>
                            <div class="help-block"></div></div>
                        </div>
                    </div>
                   <div class="text-xs-right">
                       <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
                   </div>
               </form>

           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
     </div>
     <!-- /.box -->

   </section>

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
                        $('select[name="subsubcategory_id"]').html('');
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

        $('select[name="subcategory_id"]').change(function (e) { 
            e.preventDefault();
            var subcategory_id=$(this).val();
            if(subcategory_id){
                $.ajax({
                    type: "GET",
                    url: "{{url('/category/sub-subcategory/ajax')}}/"+subcategory_id,
                    dataType: "json",
                    success: function (data) {
                      var d=$('select[name="subsubcategory_id"]').empty();
                      $.each(data, function (key, value) { 
                        $('select[name="subsubcategory_id"]').append('<option value=" '+ value.id +'">'+value.subsubcategory_name_en + '</option>');


                         
                      });                    
                    }
                });
            }else{
              alert('danger');
            }
            
        });
        
    });
</script>


<script>
    function mainthumnail(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader=new FileReader();
            reader.onload=function(e){
                $('#mainThumb').attr('src',e.target.result).width(80).height(80);

            }
            reader.readAsDataURL(input.files[0]);
        }
        
    }
</script>

---------------------------Show Multi Image JavaScript Code ------------------------

<script>
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>
================================= End Show Multi Image JavaScript Code. ====================
@endsection