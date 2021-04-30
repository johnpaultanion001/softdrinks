@extends('../layouts.admin')
@section('sub-title','Ordering')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection

@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Choose Products</h6>
               
                </div>
                <div class="col-lg-6 col-5 text-right" id="cartsbutton">

                 
                    
                </div>
            </div>
            
            <div class="col-xl-10 mx-auto">
                <div class="form-group">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" id="search" name="search" placeholder="Search by name of product or price" type="text">
                    </div>
                </div>
           </div>
          
          
        </div>

    </div>
    
</div>

<div id="loading-container" class="loading-container">
    <div class="loading"></div>
    <div id="loading-text">loading</div>
</div>

<div class="container-fluid mt--6">
            
    
    <div id="loadproduct">
        
    </div>

    
    
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection

      
</div>



<!-- addtocart form cart -->
<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="formModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="loading-productmodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div> 
                    <div id="modalbody-edit">
                    
                    </div>
                    <div id="modalbody">
                    <span id="form_result"></span>      
                        <div class="card card-stats" style="border-bottom: 1px solid #111">
                        <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-success mb-0" id="name"></h5>
                                    <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0" id="price"></span> <small>/ PER CASE</small>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="fas fa-wine-bottle"></i>
                                    </div>
                                </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                <span class="mr-2 font-weight-bold">Size:
                                    <span class="text-success font-weight-bold" id="size"></span>
                                </span>
                                
                                <span class="mr-2 font-weight-bold">Stock:
                                    <span class="text-success font-weight-bold" id="stock"></span>
                                </span>
                                <br>
                                    <span class="text-nowrap font-weight-bold">Expiration:
                                        <span class="text-nowrap text-success font-weight-bold" id="expiration"></span>
                                    </span>
                                    <span class="text-nowrap font-weight-bold">Sold:
                                        <span class="text-nowrap text-success font-weight-bold " id="sales"></span>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="card card-stats" style="border-bottom: 1px solid #111">
                        <!-- Card body -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label text-success" >QTY: </label>
                                    <input type="number" name="purchase_qty" id="purchase_qty" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-purchase_qty"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                </div>
        
                <!-- Modal footer -->
                <div class="modal-footer bg-white">
                    <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>



<!-- checkout form modal -->
<form method="post" id="myCheckoutForm" class="form-horizontal ">
    @csrf
    <div class="modal " id="formCheckoutModal">
    <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title font-weight-bold text-uppercase text-white">Modal Heading</p>
                    <i class="fa fa-spinner fa-spin text-white button-loading pl-2"></i>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <span id="CheckoutForm_result"></span>
                    
                    <div class="row" id="checkoutview">
                    
                    </div>  
                                     
                    <input type="hidden" name="action" id="checkout_action" value="Add" />
                    <input type="hidden" name="hidden_id" id="checkouthidden_id" />
                </div>
        
             
        
            </div>
        </div>
    </div>
</form>


@endsection

@section('script')
<script>

$(function () {
    return loadProduct(),cartsButton();
});

function loadProduct(){
    $.ajax({
        url: "loadproduct", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
            $("#loadproduct").hide();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadproduct").html(response);
            $("#loadproduct").show();
        }	
    })
}
function loadCart(){
    $('#formCheckoutModal').modal('show');
    $('.modal-title').text('Carts Information');
    $.ajax({
        url: "checkout", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#checkoutaction_button").attr("disabled", true);
            $("#checkoutaction_button").attr("value", "Loading..");
            $(".print").attr("disabled", true);
            $(".print").text("Loading..");
            $('.button-loading').show();
        },
        success: function(response){
            $("#checkoutaction_button").attr("disabled", false);
            $("#checkoutaction_button").attr("value", "Check Out");
            $(".print").attr("disabled", false);
            $(".print").text("Print Reciept");
            $('.button-loading').hide();
            $("#checkoutview").html(response);
        }	
    })
}
//carts button
function cartsButton(){
   $.ajax({
        url: "cartsbutton", 
        type: "get",
        dataType: "HTMl",
        success: function(response){
            $("#cartsbutton").html(response);
        }	
    })
}
//search
$('#search').on('keyup',function(){
    $value=$(this).val();
    
        $.ajax({
            type : 'get',
            url : '{{URL::to('/admin/search')}}',
            beforeSend: function() {
                $('#loading-container').show();
                $("#loadproduct").hide();
            },
            data:{'search':$value},
            success:function(data){
                $('#loading-container').hide();
                $('#loadproduct').html(data);
                $("#loadproduct").show();
            }
        });
})
//modal focus
$('#formModal').on('shown.bs.modal', function () {
    $('#purchase_qty').focus();
}) 
//view product
$(document).on('click', '#view', function(){
    $('#formModal').modal('show');
    $('#modalbody-edit').hide();
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('#form_result').html('');
    var id = $(this).attr('view');
    var locale = 'de';
    var options = { minimumFractionDigits: 0, maximumFractionDigits: 2};
    var formatter = new Intl.NumberFormat(locale, options);
    $.ajax({
    url :"/admin/inventories/"+id,
    dataType:"json",
    beforeSend: function() {
        $("#action_button").attr("disabled", true);
        $("#action_button").attr("value", "Loading..");
        $('#modalbody').hide();
        $('#loading-productmodal').show();
        
    },
    success:function(data){
        $('#loading-productmodal').hide();
        $('#modalbody').show();
        $('#purchase_qty').focus();
        $.each(data.result, function(key,value){
            if(key == $('#'+key).attr('id')){
                $('#'+key).val(value)
                if(key == 'name'){
                    $('#name').text(value);
                }
                if(key == 'price'){
                    $('#price').text(formatter.format(value));
                }
                if(key == 'size'){
                    $('#size').text(value);
                }
                if(key == 'stock'){
                    $('#stock').text(value);
                }
                if(key == 'expiration'){
                    $('#expiration').text(value);
                }
                if(key == 'sales'){
                    $('#sales').text(value);
                }
            }
        })
        $('#hidden_id').val(id);
        $('.modal-title').text('Order Description');
        $("#action_button").attr("disabled", false);
        $("#action_button").attr("value", "Order");
        $('#action').val('Add');
        }
    })
  
});

//edit order
$(document).on('click', '#edit', function(){
    $('#formModal').modal('show');
    $('#modalbody').hide();
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('#form_result').html('');
    var id = $(this).attr('edit');
    $('#formCheckoutModal').modal('hide');
    $('.modal-title').text('Edit Record');
    $.ajax({
        url: "/admin/orders/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            $('#modalbody-edit').hide();
            $('#loading-productmodal').show();
        },
        success: function(response){
            $('#loading-productmodal').hide();
            $('#modalbody-edit').show();
            $("#action_button").attr("disabled", false);
            $("#action_button").attr("value", "Update");
            $('#hidden_id').val(id);
            $('#action').val('Edit');
            $("#modalbody-edit").html(response);
        }
    })
});

 

//addtocart 
$('#myForm').on('submit', function(event){
    event.preventDefault();
    var bar = $('.bar');
    var percent = $('.progress-bar');

    var form = $(this);
    $('.form-control').removeClass('is-invalid')
    var id = $('#hidden_id').val();
    var action_url = "/admin/addtocart/" + id;
    var type = "POST";
    
    if($('#action').val() == 'Edit'){
        id = $('#hidden_id').val();
        action_url = "/admin/orders/" + id;
        type = "POST";
    }
    $.ajax({
        url: action_url,
        method:type,
        dataType:"json",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
              $("#action_button").attr("disabled", true);
              $("#action_button").attr("value", "Loading..");
              $('.button-loading').show();
        },
        success:function(data){
            var html = '';
            $('.button-loading').hide();
            if(data.errors){
               $("#action_button").attr("disabled", false);
               $("#action_button").attr("value", "Order");
               $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.nostock){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
                $.alert({
                    title: 'Error Message',
                    content: data.nostock,
                    type: 'red',
                })  
            }
            if(data.expiration){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
                $.alert({
                    title: 'Error Message',
                    content: data.expiration,
                    type: 'red',
                })  
            }
            if(data.expirationtoday){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
                $.alert({
                    title: 'Error Message',
                    content: data.expirationtoday,
                    type: 'red',
                })  
            }
            
            if(data.success){
                
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Order");
              
                $('#formModal').modal('hide');
                $('#myForm')[0].reset();
                $('.form-control').removeClass('is-invalid');
                
                if($('#action').val() == 'Edit'){
                    $.alert({
                        title: 'Success Message',
                        content: data.success,
                        type: 'green',
                    })  
                    return loadProduct(), loadCart() , cartsButton();
                }
                $.confirm({
                    title: data.success,
                    content: 'Do you want to view your cart?',
                    autoClose: 'cancel|10000',
                    type: 'green',
                    buttons: {
                        confirm: {
                            text: 'Yes',
                            btnClass: 'btn-blue',
                            keys: ['enter', 'shift'],
                            action: function(){
                                return loadProduct(), loadCart() , cartsButton();
                            }
                        },
                        cancel:  {
                            text: 'Later',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                            action: function(){
                                return loadProduct() , cartsButton();;
                            }
                        }
                    }
                });
            }
            
        }
    });
});

//checkoutform modal show
$(document).on('click', '#checkout', function(){
    loadCart();
});
//checkout to sales
$('#myCheckoutForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.ordering.checkout_order') }}";
    var type = "POST";
    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend: function(){
            $("#checkoutaction_button").attr("disabled", true);
            $("#checkoutaction_button").attr("value", "Loading..");
        },
        success:function(data){
            $("#checkoutaction_button").attr("disabled", false);
            $("#checkoutaction_button").attr("value", "Check Out");
            if(data.success){
               $.confirm({
                    title: data.success,
                    content: 'Do you want to view your sales?',
                    autoClose: 'cancel|10000',
                    type: 'green',
                    buttons: {
                        confirm: {
                            text: 'Yes',
                            btnClass: 'btn-blue',
                            keys: ['enter', 'shift'],
                            action: function(){
                                window.location.href = "/admin/sales";
                            }
                        },
                        cancel:  {
                            text: 'Later',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                            action: function(){
                                $('#formCheckoutModal').modal('hide');
                                return loadProduct(), loadCart() , cartsButton();;
                            }
                        }
                    }
                });
               
            }
            if(data.nodata){
                $.alert({
                    title: 'Message Error',
                    content: data.nodata,
                    type: 'red',
                });
            }
        }
    });
});

//delete cart
$(document).on('click', '.delete', function(){
    var id = $(this).attr('delete');
    $.confirm({
        title: 'Confirmation',
        content: 'You really want to remove this cart?',
        autoClose: 'cancel|10000',
        type: 'red',
        buttons: {
            confirm: {
                text: 'confirm',
                btnClass: 'btn-blue',
                keys: ['enter', 'shift'],
                action: function(){
                    return $.ajax({
                        url:"/admin/orders/"+id,
                        method:'DELETE',
                        data: {
                            _token: '{!! csrf_token() !!}',
                        },
                        dataType:"json",
                        beforeSend:function(){
                            $("#checkoutaction_button").attr("disabled", true);
                            $("#checkoutaction_button").attr("value", "Loading..");
                        },
                        success:function(data){
                            if(data.success){
                                $("#checkoutaction_button").attr("disabled", false);
                                $("#checkoutaction_button").attr("value", "Check Out");
                                return loadProduct(), loadCart() , cartsButton();;
                            }
                        }
                    })
                }
            },
            cancel:  {
                text: 'cancel',
                btnClass: 'btn-red',
                keys: ['enter', 'shift'],
            }
        }
    });
});

//print cart
$(document).on('click', '.print', function(){
        $('#receipt-body').removeClass('receipt-body');
        var contents = $("#receiptreport").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>Title</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="/assets/css/argon.css" rel="stylesheet" type="text/css" />');

        var source = 'bootstrap.min.js';
        var script = document.createElement('script');
        script.setAttribute('type', 'text/javascript');
        script.setAttribute('src', source);
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
        }, 500);
        $('#receipt-body').addClass('receipt-body')
       
    });


</script>
@endsection


