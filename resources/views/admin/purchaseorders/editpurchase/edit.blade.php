@extends('../layouts.admin')
@section('sub-title','Purchase Orders - Edit')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>



<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                    <h3 class="mb-0 text-uppercase" >Purchase Order - Edit</h3>
                    </div>
                  
                </div>
                </div>

                <div class="card-body">
                    <form method="post" id="myPurchaseForm" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Supplier: </label>
                                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                                    <option value="" disabled selected>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}"> {{$supplier->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-supplier_id"></strong>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Note / Optional: </label>
                                    <textarea name="notes" id="notes" class="form-control">{{$purchasenumber->notes}}</textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="error-notes"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center mt-5">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label font-weight-bold text-uppercase text-dark" >Total Purchased:</label>
                                    <p><large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($purchasenumber->total_purchased_order , 0, ',', ',') }} </p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase font-weight-bold text-dark" >Total Profit: </label>
                                    <p><large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($purchasenumber->total_profit , 0, ',', ',') }} </p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label text-uppercase font-weight-bold text-dark" >Total Price:</label>
                                    <p><large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($purchasenumber->total_price , 0, ',', ',') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col text-right mb-3">
                            <button type="button" name="create_record" id="create_record" class="create_record text-uppercase btn btn-sm btn-primary">New Product</button>
                        </div>
                        <div id="loadeditpuchase">
                            
                            <div id="loading-container" class="loading-container">
                                <div class="loading"></div>
                                <div id="loading-text">loading</div>
                            </div>
                        </div>

                        
                        <input type="hidden" name="hidden_id" id="hidden_id" value="{{$purchasenumber->id}}" />
                        <input type="hidden" name="current_supplier_id" id="current_supplier_id" value="{{$purchasenumber->supplier->id}}" />
                        <input type="hidden" name="purchase_order_number" id="purchase_order_number" value="{{$purchasenumber->purchase_order_number}}" />
                    
                        <div class="form-group text-right">
                            <a href="{{ route("admin.purchase-order.index") }}" class="btn-secondary btn">Back</a>
                            <button class="btn btn-primary" name="purchase_button" id="purchase_button" type="submit"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@section('footer')
    @include('../partials.footer')
@endsection

<form method="post" id="myForm" class="form-horizontal ">
    @csrf
    <div class="modal" id="formModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered ">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <p class="modal-title text-white text-uppercase font-weight-bold">Modal Heading</p>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
        
                
                <div id="loading-productmodal" class="loading-container">
                    <div class="loading"></div>
                    <div id="loading-text">loading</div>
                </div> 
                <div id="modal-body-product" class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Product Name: </label>
                                <input type="text" name="name" id="name" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-name"></strong>
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
                                <label class="control-label text-uppercase" >Expiration: </label>
                                <input type="date" name="expiration" id="expiration" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-expiration"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Purchas QTY:</label>
                                <input type="number" name="stock" id="stock" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-stock"></strong>
                                </span>
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Purchase Amount: </label>
                                <input type="number" name="purchase_amount" id="purchase_amount" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-purchase_amount"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Profit Amount: </label>
                                <input type="number" name="profit" id="profit" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-profit"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Note / Optional: </label>
                                <textarea name="note" id="note" class="form-control"></textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-note"></strong>
                                </span>
                            </div>
                        </div>
                            
                    </div>
                    <input type="hidden" name="product_action" id="product_action" value="Add" />
                    <input type="hidden" name="product_hidden_id" id="product_hidden_id" />
                    <input type="hidden" name="purchase_order_number_id" id="purchase_order_number_id" value="{{$purchasenumber->purchase_order_number}}" />

                </div>

                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-white text-uppercase" data-dismiss="modal">Close</button>
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
    var supplier_id = $('#current_supplier_id').val();
    $("#supplier_id").select2("trigger", "select", {
        data: { id: supplier_id }
    });

    return loadEditPurchase();
});


function loadEditPurchase(){
    var id = $('#hidden_id').val();
    $.ajax({
        url: "/admin/loadeditpurchase/"+id+"/load", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadeditpuchase").html(response);
        }	
    })
}

$(document).on('click', '.edit', function(){
    $('#formModal').modal('show');
    $('.modal-title').text('Edit Product');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/inventories/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#product_button").attr("disabled", true);
            $("#product_button").attr("value", "Loading...");
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
                      url:"/admin/inventories/"+id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                        $('#titletable').text('Loading...');
                      },
                      success:function(data){
                          if(data.success){
                            $('#titletable').text('Products');
                        
                            $('#success-alert').addClass('bg-primary');                
                            $('#success-alert').html('<strong>' + data.success + '</strong>');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });

                            return loadEditPurchase();
                           
                            
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

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Product');
    $("#category_id").select2({
        placeholder: 'Select Category'
    });
    $('#size_id').select2({
        placeholder: 'Select Size'
    })
    $('#product_button').val('Submit');
    $('#product_action').val('Add');
    $('#form_result').html('');
    $('#loading-productmodal').hide();
    
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.inventories.store') }}";
    var type = "POST";

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "/admin/inventories/" + id;
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
                $('#myForm')[0].reset();
                $('#category_id').select2({
                    placeholder: 'Select category'
                });
                $('#size_id').select2({
                    placeholder: 'Select Size'
                });
                $('#formModal').modal('hide');
                return loadEditPurchase();
                
            }
           
        }
    });
});

//sbmit puchase form
$('#myPurchaseForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')

    var id = $('#hidden_id').val();
    var action_url = "/admin/purchase-order/" + id;
    var type = "PUT";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#purchase_button").attr("disabled", true);
            $("#purchase_button").attr("value", "Loading..");
            $('#loading-container').show();
        },
        success:function(data){
            var html = '';
            $('#loading-container').hide();
            $("#purchase_button").attr("disabled", false);
            $("#purchase_button").attr("value", "Update");
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                window.location.href = "/admin/purchase-order";
            }
           
        }
    });
});

</script>
@endsection
