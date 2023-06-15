<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/blue.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.transitions.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/rateit.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap-select.min.css')}}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu --> 

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="{{asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/echo.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.rateit.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/lightbox.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


    @if (Session::has('message'))
    var type= "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info('{{Session::get('message')}}');
            break;
        
        case 'success':
            toastr.success('{{Session::get('message')}}');
            break;
        case 'warning':
            toastr.warning('{{Session::get('message')}}');
            break;
  
        case 'error':
            toastr.error('{{Session::get('message')}}');
            break;
        default:
            break;
    }
        
    @endif
  
  </script>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="..." alt="Card image cap" style="height:200px; width:200px;" id="pimage">
                       
                      </div>

                </div>

                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">Product Price: <strong class="text-danger"><span id="product_price"> </span></strong> <del id="old_price"></del></li>
                        <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                        <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                        <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                        <li class="list-group-item">Stock: <span id="available"> </span>  
                          <span id="stockout"> </span> 
                          <strong></strong></li>
                      </ul>
                    
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose Color</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="color">
                          
                        </select>
                      </div>



                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose Size</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="size">
                          <option>1</option>
                        </select>
                      </div>  

                      <div class="form-group">
                        <label for="exampleFormControlInput1">Quantity</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" value="1" min="1" >
                      </div> <!-- // end form group -->

                      <button type="submit" class="btn btn-primary mb-2">Add to Cart</button>
                    
                    
                    
                </div>


                
            </div>

          
        </div>
        
      </div>
    </div>
  </div>



<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  function productView(id) {
    $.ajax({
        type: "GET",
        url: "/product/view/modal/"+id,
        dataType: "json",
        success: function (response) {
            $('#pname').text(response.product.product_name_en);
            $('#pcode').text(response.product.product_code);
            $('#pcategory').text(response.product.category.category_name_en);
            $('#pbrand').text(response.product.brand.brand_name_en);
            $('#pimage').attr('src','upload/products/thumbnail/'+response.product.product_thumbnail);
            $("select[name='color']").empty();
            $.each(response.color, function (key, value) { 
                $("select[name='color']").append("<option value='"+value+"'>"+value+"</option>");
                 
            });

            $("select[name='size']").empty();
            $.each(response.size, function (key, value) { 
                $("select[name='size']").append("<option value='"+value+"'>"+value+"</option>");  
            });


            if(response.product.discount_price==null){
              $('#product_price').text('');
              $('#old_price').text('');
              $('#product_price').text("Rs "+response.product.selling_price);


            }else{
              $('#product_price').text(response.product.selling_price-response.product.discount_price);
              $('#old_price').text("Rs "+response.product.selling_price);

            }
            $('#available').text('');
            $('#stockout').text('');
            if (response.product.product_qty >0) {
              $('#available').text('available');
              $('#available').css("background","green");
              
              $('#available').addClass('badge badge-pill badge-success')

              
            } else {
              $('#stockout').text('stockout');
              $('#stockout').css("background","red");
              $('#stockout').addClass('badge badge-pill badge-danger')
              
            }
            
        } 
    });
  }

  </script>
</body>
</html>