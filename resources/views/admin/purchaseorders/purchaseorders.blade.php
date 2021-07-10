@extends('../layouts.admin')
@section('sub-title','Purchase Orders')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="loadpurchaseorder">
    <div id="loading-container" class="loading-container">
        <div class="loading"></div>
        <div id="loading-text">loading</div>
    </div>
</div>

@section('footer')
    @include('../partials.footer')
@endsection


<!-- view modal -->
<div class="modal" id="viewModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header bg-primary">
                <p class="modal-title font-weight-bold text-uppercase text-white ">Modal Heading</p>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div id="loading-container" class="loading-container">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div>
                <div class="modal-body" id="view-purchase-order">
                    
                </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-primary text-uppercase text-white" data-dismiss="modal">Close</button>
            </div>
        
        </div>
    </div>
</div>

<!-- Create Purchase Order Modal -->
<form method="post" id="purchaseorderForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="purchaseorderModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <p class="modal-title-purchase font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >DOC NO.</label>
                                    <input type="text" name="doc_no" id="doc_no" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-doc_no"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Entry Date:</label>
                                    <input type="date" name="entry_date" id="entry_date" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-entry_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PO NO.</label>
                                    <input type="text" name="po_no" id="po_no" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_no"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >PO Date.</label>
                                    <input type="date" name="po_date" id="po_date" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-po_date"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><label class="control-label text-uppercase" >Supplier: </label></div>
                                        <div class="col text-right">
                                            <a class="btn btn-sm btn-white text-uppercase" href="/admin/suppliers">New Supplier?</a>
                                        </div>
                                    </div>
                                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                                        <option value="" disabled selected>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">Supplier Code: {{$supplier->id}} - {{$supplier->name}}</option>
                                            
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-supplier_id"></strong>
                                    </span>
                                   
                                </div>
                               
                            </div>
                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col"><label class="control-label text-uppercase" >Location: </label></div>
                                        <div class="col text-right">
                                            <a class="btn btn-sm btn-white text-uppercase" href="/admin/locations">New Location?</a>
                                        </div>
                                    </div>
                                    <select name="location_id" id="location_id" class="form-control select2">
                                        <option value="" disabled selected>Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{$location->id}}">Location Code: {{$location->id}} - {{$location->location_name}}</option>
                                            
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-location_id"></strong>
                                    </span>
                                   
                                </div>
                               
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Name of a Driver:</label>
                                    <input type="text" name="name_of_a_driver" id="name_of_a_driver" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-name_of_a_driver"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Plate Number: </label>
                                    <input type="text" name="plate_number" id="plate_number" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-plate_number"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Trade Discount:</label>
                                    <input type="text" name="trade_discount" id="trade_discount" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-trade_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Terms Discount: </label>
                                    <input type="text" name="terms_discount" id="terms_discount" class="form-control"/>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-terms_discount"></strong>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Remarks: </label>
                                    <textarea name="remarks" id="remarks" autocomplete="on" class="form-control"></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-remarks"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Reference: </label>
                                    <textarea name="reference" id="reference" autocomplete="on" class="form-control"></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-reference"></strong>
                                    </span>
                                </div>
                            </div>
                            
                    </div>
 
                    <div id="alltotal"> 

                    </div>
                   
                   
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0 text-uppercase" id="titletable">Pending Products</h3>
                        </div>
                        
                        <div class="col text-right">
                            <button type="button" name="create_product" id="create_product" class="text-uppercase create_product btn btn-sm btn-default">New Product</button>
                        </div>
                    </div>
                    <div id="loading-containermodal" class="loading-container">
                        <div class="loading"></div>
                        <div id="loading-text">loading</div>
                    </div>
                    <div id="pending-product" class="pending-product col mt-4">
                   
                    </div>

                   

                    <input type="hidden" name="purchase_action" id="purchase_action" value="Add" />
                    <input type="hidden" name="purchase_hidden_id" id="purchase_hidden_id" />
                    
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
                    <input type="submit" name="purchase_button" id="purchase_button" class="text-uppercase btn btn-primary" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>

<!-- Create Product Order Modal -->
<form method="post" id="productForm" class="form-horizontal">
    @csrf
    <div class="modal" id="productModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <p class="modal-title-product font-weight-bold text-uppercase text-white ">Modal Heading</p>
                    <button type="button" class="close  text-white" data-dismiss="modal">&times;</button>
                </div>
                <div id="loading-productmodal" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div> 
                <div id="modal-body-product" class="modal-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Product Code: </label>
                                <input type="text" name="product_code" id="product_code" class="form-control" autocomplete="off"/>
                                <div id="productCodeList"></div>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_code"></strong>
                                </span>
                               
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Long Description: </label>
                               <input type="text" name="long_description" id="long_description" class="form-control"/>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-long_description"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" >Short Description: </label>
                                <input type="text" name="short_description" id="short_description" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-short_description"></strong>
                                </span>
                            </div>
                        </div>
                  

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col"><label class="control-label text-uppercase" >Category: </label></div>
                                    <div class="col text-right">
                                        <a class="btn btn-sm btn-white text-uppercase" href="/admin/categories">New Category?</a>
                                    </div>
                                </div>
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}"> {{$category->name}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-category_id"></strong>
                                </span>
                            </div>
                        </div>
                       <div class="col-sm-6">
                            <div class="form-group">
                               <div class="row">
                                    <div class="col"><label class="control-label text-uppercase" >Size: </label></div>
                                    <div class="col text-right">
                                        <a class="btn btn-sm btn-white text-uppercase" href="/admin/sizes">New Size?</a>
                                    </div>
                                </div>
                                <select name="size_id" id="size_id" class="form-control select2">
                                    <option value="" disabled selected>Select Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{$size->id}}"> {{$size->title}} {{$size->size}} - {{$size->category->name}} - UCS:{{$size->ucs}} </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-size_id"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Expiration: </label>
                                <input type="date" name="expiration" id="expiration" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-expiration"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Purchase QTY: </label>
                                <input type="number" name="stock" id="stock" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-stock"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Purchase Amount:</label>
                                <input type="number" name="purchase_amount" id="purchase_amount" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-purchase_amount"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" >Profit Amount:</label>
                                <input type="number" name="profit" id="profit" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-profit"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" >Product Remarks: </label>
                                <textarea name="product_remarks" id="product_remarks" class="form-control"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-product_remarks"></strong>
                                </span>
                            </div>
                        </div>
                              
                    </div>
                    <input type="hidden" name="product_action" id="product_action" value="Add" />
                    <input type="hidden" name="product_hidden_id" id="product_hidden_id" />
                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase"  id="back-button" >Back</button>
                    <input type="submit" name="product_button" id="product_button" class="text-uppercase btn btn-default" value="Submit" />
                </div>
        
            </div>
        </div>
    </div>
</form>




@endsection

@section('script')
<script>

$(function () {
    return loadPurchaseOrder() , alltotal();
});

//alltotal 
function alltotal(){
    $.ajax({
        url: "totalpendingproduct", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#alltotal").html(response);
        }	
    })
}

function loadPurchaseOrder(){
    $.ajax({
        url: "loadpurchaseorder", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadpurchaseorder").html(response);
            
        }	
    })
}

//pending product
function loadPendingProduct(){
    $.ajax({
        url: "loadpendingproduct", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
          
            $('#loading-containermodal').show();
            $("#pending-product").hide();

        },
        success: function(response){
            $('#loading-containermodal').hide();
            $("#pending-product").show();
            $("#pending-product").html(response);
        }	
    })
}

//view purchase order modal
$(document).on('click', '.view', function(){
    $('#viewModal').modal('show');
    var id = $(this).attr('view');
    $('.modal-title').text('VIEW RECEIVING GOODS');
    $.ajax({
        url: "/admin/purchase-order/"+id, 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loading-container").show();
            $("#view-purchase-order").hide();
        },
        success: function(response){
            $("#loading-container").hide();
            $("#view-purchase-order").show();
            $("#view-purchase-order").html(response);
        }
    })
});

// back button
$(document).on('click', '#back-button', function(){
    $('#productModal').modal('hide');
    purchaseModal();
});

//create purchase order
function purchaseModal(){
    $('#purchaseorderModal').modal('show');
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-purchase').text('INSERT RECEIVING GOODS');
    $('#purchase_button').val('Submit');
    $('#supplier_id').select2({
        placeholder: 'Select Supplier'
    })
    $('#purchase_action').val('Add');

    loadPendingProduct();
    alltotal();
}
//store and update purchase order
$('#purchaseorderForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.purchase-order.store') }}";
    var type = "POST";

    if($('#purchase_action').val() == 'Edit'){
        var id = $('#purchase_hidden_id').val();
        action_url = "purchase-order/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#purchase_button").attr("disabled", true);
            $("#purchase_button").attr("value", "Loading..");
            $('#loading-containermodal').show();
            $("#pending-product").hide();
        },
        success:function(data){
            var html = '';
            $('#loading-containermodal').hide();
            $("#pending-product").show();
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if($('#purchase_action').val() == 'Edit'){
                        $("#purchase_button").attr("disabled", false);
                        $("#purchase_button").attr("value", "Update");
                    }else{
                        $("#purchase_button").attr("disabled", false);
                        $("#purchase_button").attr("value", "Submit");
                    }
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.nodata){
                if($('#purchase_action').val() == 'Edit'){
                    $("#purchase_button").attr("disabled", false);
                    $("#purchase_button").attr("value", "Update");
                }else{
                    $("#purchase_button").attr("disabled", false);
                    $("#purchase_button").attr("value", "Submit");
                }
                $.alert({
                    title: 'Error Message',
                    content: data.nodata,
                    type: 'red',
                });
            }
            if(data.success){
                if($('#purchase_action').val() == 'Edit'){
                    $("#purchase_button").attr("disabled", false);
                    $("#purchase_button").attr("value", "Update");
                }else{
                    $("#purchase_button").attr("disabled", false);
                    $("#purchase_button").attr("value", "Submit");
                }
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
                $('#purchaseorderForm')[0].reset();
                $('#supplier_id').select2({
                    placeholder: 'Select supplier'
                });
                $('#purchaseorderModal').modal('hide');
                loadPurchaseOrder();
                
            }  
        }
    });
});

$(document).on('click', '#create_record', function(){
   purchaseModal();
});
//create product
$(document).on('click', '#create_product', function(){
    $('#purchaseorderModal').modal('hide');
    $('#productModal').modal('show');
    $('#productForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title-product').text('Add New Product');
    $('#product_button').val('Submit');
    $('#category_id').select2({
        placeholder: 'Select Category'
    })
    $('#size_id').select2({
        placeholder: 'Select Size'
    })
    $('#product_action').val('Add');
    $('#loading-productmodal').hide();
});

//edit product
$(document).on('click', '.edit', function(){
    $('#purchaseorderModal').modal('hide');
    $('#productModal').modal('show');
    $('.modal-title-product').text('Edit Product');
    $('#productForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    $('#productCodeList').fadeOut();
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/purchase-order/pending-product/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#product_button").attr("disabled", true);
            $("#product_button").attr("value", "Loading..");
            $('#loading-productmodal').show();
            $('#modal-body-product').hide();
        },
        success:function(data){
            $('#loading-productmodal').hide();
            $('#modal-body-product').show();
            if($('#product_action').val() == 'Edit'){
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Update");
            }else{
                $("#product_button").attr("disabled", false);
                $("#product_button").attr("value", "Submit");
            }
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'category_id'){
                        $("#category_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'size_id'){
                        $("#size_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                }
            })
            $('#product_hidden_id').val(id);
            $('#product_button').val('Update');
            $('#product_action').val('Edit');
        }
    })
});

// store and update product
$('#productForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.pending-product.store') }}";
    var type = "POST";

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "purchase-order/pending-product/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#product_button").attr("disabled", true);
            $("#product_button").attr("value", "Loading..");
            $('#loading-productmodal').show();
            $('#modal-body-product').hide();
        },
        success:function(data){
            var html = '';
            $('#loading-productmodal').hide();
            $('#modal-body-product').show();
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if($('#product_action').val() == 'Edit'){
                        $("#product_button").attr("disabled", false);
                        $("#product_button").attr("value", "Update");
                    }else{
                        $("#product_button").attr("disabled", false);
                        $("#product_button").attr("value", "Submit");
                    }
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                if($('#product_action').val() == 'Edit'){
                    $("#product_button").attr("disabled", false);
                    $("#product_button").attr("value", "Update");
                }else{
                    $("#product_button").attr("disabled", false);
                    $("#product_button").attr("value", "Submit");
                }
                $('#success-alert').addClass('bg-primary');
                $('#success-alert').html('<strong>' + data.success + '</strong>');
                $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
                $('.form-control').removeClass('is-invalid')
                $('#productForm')[0].reset();
                $('#category_id').select2({
                    placeholder: 'Select Category'
                });
                $('#size_id').select2({
                    placeholder: 'Select Size'
                });
                $('#productModal').modal('hide');
                purchaseModal();
                alltotal();
                
            }
           
        }
    });
});

//remove product
$(document).on('click', '.remove', function(){
  var id = $(this).attr('remove');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to remove this product?',
      autoClose: 'cancel|10000',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              keys: ['enter', 'shift'],
              action: function(){
                  return $.ajax({
                      url:"/admin/purchase-order/pending-product/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $('#loading-productmodal').show();
                        $('#modal-body-product').hide();
                      },
                      success:function(data){
                          if(data.success){
                            $('#success-alert').addClass('bg-primary');
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            purchaseModal();
                            alltotal();
                            $('#loading-productmodal').hide();
                            $('#modal-body-product').show();
                            
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

//autocomplete

$('#product_code').keyup(function(){ 
       
        if($('#product_action').val() == 'Edit'){
            $('#productCodeList').fadeOut();
        }else{
        var query = $(this).val();
        if(query != '')
        {
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('admin.pending-product.autocomplete') }}",
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
                if (data == undefined){
                    $('#productCodeList').fadeOut();
                }
                $('#productCodeList').fadeIn();  
                $('#productCodeList').html(data);
              }
            });
        }
        if(query == ''){
            $('#productCodeList').fadeOut();
            }
        
        }
    });

    $(document).on('click', 'li', function(){  
        var query = $(this).text();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('admin.pending-product.autocompleteresult') }}",
          method:"POST",
          dataType:"json",
          data:{query:query, _token:_token},
          success:function(data){

            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                }
                if(key == 'category_id'){
                        $("#category_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'size_id'){
                        $("#size_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
            })
            $('#productCodeList').fadeOut(); 
          }
         });
        }
    });  

  

</script>
@endsection
