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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
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
                        <label for="color">Choose Color</label>
                        <select class="form-control" id="color" name="color">
                          
                        </select>
                      </div>



                      <div class="form-group">
                        <label for="size">Choose Size</label>
                        <select class="form-control" id="size" name="size">
                          <option>1</option>
                        </select>
                      </div>  

                      <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" id="qty" value="1" min="1" >
                      </div> <!-- // end form group -->
                       <input type="hidden" id="product_id">
                      <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to Cart</button>
                    
                    
                    
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
            $('#product_id').val(response.product.id);
            

            $('#qty').val();
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


      // Start Add To Cart Product 


function addToCart(){
var product_name = $('#pname').text();
var id = $('#product_id').val();
var color= $('#color option:selected').text();
var size= $('#size option:selected').text();
var quantity = $('#qty').val();
$.ajax({
  type: "POST",
  url: "/cart/data/store/"+id,
  data: {
    color:color,
    size:size,
    quantity:quantity,
    product_name:product_name
   
  },
  dataType: "json",
  success: function (response) {
    $('#closeModel').click(); 
    
    // Sweet alert start
      const Toast=Swal.mixin({
                toast:true,
                position: 'top-end',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000
              });

              if ($.isEmptyObject(response.error)) {
                Toast.fire({
                        type: 'success',
                        title: response.success
                    });
                
              } else {
                Toast.fire({
                        type: 'error',
                        title: response.error
                    });
                
              }
              miniCart();            // Sweet alert end.
  }




});
}
// End Add To Cart Product 

  </script>


<script>

  function miniCart(){
    $.ajax({
      type: "GET",
      url: "/product/mini/cart",
      dataType: "json",
      success: function (response) {
        var miniCart=""
        $('span[id="cartSubTotal"]').text(response.cartTotal);
        $('#cardQty').text(response.cartQty);

        $.each(response.carts, function (key, value) {
          miniCart+=` <div class="cart-item product-summary">
                    <div class="row">
                      <div class="col-xs-4">
                        <div class="image"> <a href="detail.html"><img src=" upload/products/thumbnail/${value.options.image}" alt=""></a> </div>
                        
                      </div>
                      <div class="col-xs-7">
                        <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                        <div class="price"> ${value.price} * ${value.qty}</div>
                      </div>
                      <div class="col-xs-1 action"> 
                        <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                    </div>
                  </div>` 
        });

        $('#miniCart').html(miniCart);
        
      }
    });
  }



  miniCart();


  function  miniCartRemove(rowId){

    $.ajax({
      type: "GET",
      url: "/minicart/product-remove/"+rowId,
      dataType: "json",
      success: function (data) {
        miniCart();
        const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    });


                    if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    });
                }
        
      }
    });

  }
</script>



<script type="text/javascript">
    
  function addToWishList(product_id){
      $.ajax({
          type: "POST",
          dataType: 'json',
          url: "user/add-to-wishlist/"+product_id,
          success:function(data){

            const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                    
                      showConfirmButton: false,
                      timer: 3000
                    });


                    if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }


          }
      })
  }
  </script>
  
  
  
  
  
  
   <!--  /// End Add Wishlist Page  ////   -->


  {{-- Load wish list data --}}
<script>
  function wishlist(){
    $.ajax({
      type: "GET",
      url: "/user/get-wishlist-product",
      dataType: "json",
      success: function (response) {
        var rows="";
        $.each(response, function (key, value) {
          rows += `<tr>
                    <td class="col-md-2"><img src="/upload/products/thumbnail/${value.product.product_thumbnail} " alt="imga"></td>
                    <td class="col-md-7">
                        <div class="product-name"><a href="#">${value.product.product_name_en}</a></div>
                         
                        <div class="price">
                        ${value.product.discount_price == null
                            ? `${value.product.selling_price}`
                            :
                            `${value.product.selling_price-value.product.discount_price} <span>${value.product.selling_price}</span>`
                        }
                            
                        </div>
                    </td>
        <td class="col-md-2">
            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
        </td>
        <td class="col-md-1 close-btn">
            <button class="" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fa fa-times"></i></button>
        </td>
                </tr>`
        });

        $('#wishlist').html(rows);
      }
    });
  }



  wishlist();


// Remove Wish List
  function  wishlistRemove(id){

        $.ajax({
          type: "GET",
          url: "/user/wishlist-remove/"+id,
          dataType: "json",
          success: function (data) {
            wishlist();
            const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',  
                          showConfirmButton: false,
                          timer: 3000
                        });


                        if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        });
                    }
            
          }
        });

}
// End wish list

</script>

  {{-- End wishlist data --}}



  {{-- Cart page start --}}

  <script>
    function cart(){
      $.ajax({
        type: "GET",
        url: "/user/get-cart-product",
        dataType: "json",
        success: function (response) {
          var rows="";
          $.each(response.carts, function (key, value) {
            rows += `<tr>
                      <td class="col-md-2"><img src="/upload/products/thumbnail/${value.options.image} " alt="imga" style="width:60px; height:60px;"></td>
                      <td class="col-md-2">
                          <div class="product-name"><a href="#">${value.name}</a></div> 
                          <div class="price">
                          ${value.price}    
                          </div>
                      </td>

                      <td class="col-md-2">
                        ${value.options.color==null? 
                          `<span>...</span>`:
                          `<strong>${value.options.color}</strong>`

                        }
                      </td>

                      <td class="col-md-2">
                        <strong>${value.options.size}</strong>
                      </td>

                      <td class="col-md-2">
                        <button type="submit" class="btn btn-success btn-sm" onclick="cartIncrement(this.id)" id="${value.rowId}" >+</button>    
                        <input type="text" value="${value.qty}" min="1" max="100" disabled style="width: 27px;">

                        ${value.qty>1
                          ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                          :
                          `<button type="submit" class="btn btn-danger btn-sm" disabled >-</button>`



                        }
                        
                      </td>

                      <td class="col-md-2">
                        <strong>Rs ${value.subtotal}</strong>
                      </td>
        
          <td class="col-md-1 close-btn">
              <button class="" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
          </td>
                  </tr>`
          });
  
          $('#cartPage').html(rows);
        }
      });
    }
  
  
  
    cart();
  
  
  // Remove  cart Code Start
    function  cartRemove(id){
          $.ajax({
            type: "GET",
            url: "/user/cart-remove/"+id,
            dataType: "json",
            success: function (data) {
            cart();
            miniCart();
              const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',  
                            showConfirmButton: false,
                            timer: 3000
                          });
  
  
                          if ($.isEmptyObject(data.error)) {
                          Toast.fire({
                              type: 'success',
                              icon: 'success',
                              title: data.success
                          })
                      }else{
                          Toast.fire({
                              type: 'error',
                              icon: 'error',
                              title: data.error
                          });
                      }
              
            }
          });
  
  }
  // End wish list


   // -------- CART INCREMENT --------//
   function cartIncrement(rowId){
        $.ajax({
            type:'GET',
            url: "/cart-increment/"+rowId,
            dataType:'json',
            success:function(data){
                cart();
                miniCart();
            }
        });
    }
 // ---------- END CART INCREMENT -----///



  // -------- CART Decrement  --------//
  function cartDecrement(rowId){
        $.ajax({
            type:'GET',
            url: "/cart-decrement/"+rowId,
            dataType:'json',
            success:function(data){
                cart();
                miniCart();
            }
        });
    }
 // ---------- END CART Decrement -----///
  
  </script>

  {{-- Cart Page End --}}
</body>
</html>