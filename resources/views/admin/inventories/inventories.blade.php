@extends('../layouts.admin')
@section('sub-title','Inventories')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="loadinventories">
     
    <div id="loading-container" class="loading-container">
        <div class="loading"></div>
        <div id="loading-text">loading</div>
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Product Name: </label>
                                        <input type="text" name="name" id="name" class="form-control form_disable" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-name"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6" id="purhase-number">
                                        <div class="form-group" id="puchase-order-number-edit">
                                            <div class="row">
                                                <div class="col"><label class="control-label text-uppercase" >Purchase Order Number: </label></div>
                                            </div>
                                            <select name="purchase_order_number_id" id="purchase_order_number_id" class="form-control select2">
                                                <option value="" disabled selected>Select Purchase Order Number</option>
                                                @foreach ($purchaseorder as $purchase)
                                                    <option value="{{$purchase->id}}">Purchase Order Number: {{$purchase->purchase_order_number}} - Supplier: {{$purchase->supplier->name}} - Date:{{$purchase->created_at->format('l, j \\/ F / Y h:i:s A') }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error-purchase_order_number_id"></strong>
                                            </span>
                                            <div class="col text-right">
                                                <a class="btn btn-sm btn-white text-uppercase" href="/admin/purchase-order">New Purchase Order Number?</a>
                                            </div>
                                        </div>
                                        <div class="form-group" id="puchase-order-number-view">
                                            <div class="row">
                                                <div class="col"><label class="control-label text-uppercase" >Supplier: </label></div>
                                            </div>
                                            <select name="purchase_order_number_id_view"  id="purchase_order_number_id_view" class="form-control select2">
                                                <option value="" disabled selected>Select Purchase Order Number</option>
                                                @foreach ($allpurchaseorder as $purchase)
                                                    <option value="{{$purchase->id}}">{{$purchase->supplier->name}} </option>
                                                @endforeach
                                            </select>
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
                                        <input type="date" name="expiration" id="expiration" class="form-control form_disable" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-expiration"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Purchase QTY:</label>
                                        <input type="number" name="stock" id="stock" class="form-control form_disable" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-stock"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Purchase Amount: </label>
                                        <input type="number" name="purchase_amount" id="purchase_amount" class="form-control form_disable" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-purchase_amount"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Profit Amount: </label>
                                        <input type="number" name="profit" id="profit" class="form-control form_disable" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-profit"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label text-uppercase" >Note / Optional: </label>
                                        <textarea name="note" id="note" class="form-control form_disable"></textarea>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-note"></strong>
                                        </span>
                                    </div>
                                </div>
                                    
                            </div>
                            <input type="hidden" name="product_action" id="product_action" value="Add" />
                            <input type="hidden" name="product_hidden_id" id="product_hidden_id" />
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
    $('#puchase-order-number-edit').show();
    $('#puchase-order-number-view').hide();
    $('#success-alert').hide();
    return loadInventories();
});



function loadInventories(){
    $.ajax({
        url: "loadinventories", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadinventories").html(response);
        }	
    })
}

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
                            $('#success-alert').addClass('bg-primary')
                            $('#success-alert').html('<strong>' + data.success + '</strong> ');
                            $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
                                $("#success-alert").slideUp(500);
                            });
                            return loadInventories();
                            $('#titletable').text('Inventories');
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

$(document).on('click', '.edit', function(){
    $('#formModal').modal('show');
    $('.modal-title').text('Edit Product');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('#form_result').html('');
    $('#purhase-number').hide();
    $('#puchase-order-number-edit').show();
    $('#puchase-order-number-view').hide();
    $('.form_disable').attr('readonly' , false)
    $('.select2').prop("disabled", false);
    $('#product_button').show();
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
                    if(key == 'purchase_order_number_id'){
                        $("#purchase_order_number_id").select2("trigger", "select", {
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


$(document).on('click', '.view', function(){
    $('#formModal').modal('show');
    $('.modal-title').text('View Product');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('.form_disable').attr('readonly' , true)
    $('.select2').prop("disabled", true);
    $('#form_result').html('');
    $('#puchase-order-number-view').show();
    $('#puchase-order-number-edit').hide();
    $('#purhase-number').show();
    var id = $(this).attr('view');
    $.ajax({
        url :"/admin/inventories/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
           
            $('#loading-productmodal').show();
            $('#modal-body-product').hide();
        },
        success:function(data){
            $('#loading-productmodal').hide();
            $('#modal-body-product').show();
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'category_id'){
                        $("#category_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                    if(key == 'purchase_order_number_id'){
                        $("#purchase_order_number_id_view").select2("trigger", "select", {
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
            $('#product_button').hide();
        }
    })
});

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Product');
    $('#category_id').select2({
        placeholder: 'Select Category'
    })
    $('#purchase_order_number_id').select2({
        placeholder: 'Select Purchase Order Number'
    })
    $('#size_id').select2({
        placeholder: 'Select Size'
    })
    $('#product_button').val('Submit');
    $('#product_action').val('Add');
    $('#form_result').html('');
    $('#loading-productmodal').hide();
    $('#puchase-order-number-view').hide();
    $('#puchase-order-number-edit').show();
    $('#product_button').show();
    $('#purhase-number').show();
    $('.form_disable').attr('readonly' , false)
    $('.select2').prop("disabled", false);
    
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.inventories.store') }}";
    var type = "POST";

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "inventories/" + id;
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
                    placeholder: 'Select Category'
                });
                $('#size_id').select2({
                    placeholder: 'Select Size'
                });
                $('#formModal').modal('hide');
                return loadInventories();
                
            }
           
        }
    });
});

</script>
@endsection
