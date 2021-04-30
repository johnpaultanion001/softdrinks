@extends('../layouts.admin')
@section('sub-title','Purchase Orders - Return')
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
                    <h3 class="mb-0 text-uppercase" >Purchase Order - Return</h3>
                    </div>
                </div>
                </div>

                <div class="card-body">
                    <form method="post" id="myReturnedForm" class="form-horizontal">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Supplier: </label>
                                    <p>{{$returned->supplier->name}}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Date of purchase: </label>
                                    <p>{{$returned->created_at->format('l, j \\/ F / Y h:i:s A') }}</p>
                                  
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Purchase Order Number: </label>
                                    <p>{{$returned->purchase_order_number}}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Total Case Returning: </label>
                                    <p>{{ number_format($returnedproducts->sum('case') ?? '' , 0, ',', ',') }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label text-uppercase" >Total Deposit: </label>
                                    <p><large class="text-success font-weight-bold mr-1">₱</large>{{ number_format($returnedproducts->sum('deposit') ?? '' , 0, ',', ',') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col text-right mb-3">
                            <button type="button" name="create_record" id="create_record" class="create_record text-uppercase btn btn-sm btn-primary">New Return Product</button>
                        </div>
                        <div id="loadreturnproduct">
                            <div id="loading-container" class="loading-container">
                                <div class="loading"></div>
                                <div id="loading-text">loading</div>
                            </div>
                        </div>

                     
                       
                        <input type="hidden" name="hidden_id" id="hidden_id" value="{{$returned->purchase_order_number}}" />
                        <input type="hidden" name="hidden_total_deposit" id="hidden_total_deposit" value="{{$returnedproducts->sum('deposit')}}" />
                        <input type="hidden" name="hidden_total_case" id="hidden_total_case" value="{{$returnedproducts->sum('case')}}" />
                        <div class="form-group text-right">
                            <a href="{{ route("admin.purchase-order.index") }}" class="btn-secondary btn">Back</a>
                            <button class="btn btn-primary" name="purchase_button" id="purchase_button" type="submit">Return</button>
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
        <div class="modal-dialog modal-lg modal-dialog-centered ">
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
                                <label class="control-label text-uppercase" >Name: </label>
                                <input type="text" name="name" id="name" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-name"></strong>
                                </span>
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Case: </label>
                                <input type="number" name="case" id="case" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-case"></strong>
                                </span>
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group">
                               
                                <div class="row">
                                    <div class="col"><label class="control-label text-uppercase" >Status: </label></div>
                                    <div class="col text-right">
                                        <a class="btn btn-sm btn-white text-uppercase" href="/admin/status-return">New Status?</a>
                                    </div>
                                </div>
                                <select name="status_id" id="status_id" class="form-control select2">
                                    <option value="" disabled selected>Select Status</option>
                                    @foreach ($status as $sp)
                                        <option value="{{$sp->id}}" class="text-uppercase"> {{$sp->code}} - {{$sp->title}}  </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-status_id"></strong>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label text-uppercase" >Deposit: </label>
                                <input type="number" name="deposit" id="deposit" class="form-control" />
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-deposit"></strong>
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
                    <input type="hidden" name="purchase_order_number_id" id="purchase_order_number_id" value="{{$returned->purchase_order_number}}" />

                    

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
    return loadPendingReturnProduct();
});


function loadPendingReturnProduct(){
    var id = $('#hidden_id').val();
    $.ajax({
        url: "/admin/returned/"+id+"/loadreturnedproduct", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loadreturnproduct").html(response);
        }	
    })
}

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Return Product');
    $("#status_id").select2({
        placeholder: 'Select Status'
    });
    
    $('#product_button').val('Submit');
    $('#product_action').val('Add');
    $('#form_result').html('');
    $('#loading-productmodal').hide();
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.pendingreturnedproducts.store') }}";
    var type = "POST";

    if($('#product_action').val() == 'Edit'){
        var id = $('#product_hidden_id').val();
        action_url = "/admin/returned/pendingreturnedproducts/" + id;
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
                $.alert({
                    title: 'Success Message',
                    content: data.success,
                    type: 'green',
                });
                $('.form-control').removeClass('is-invalid')
                $('#myForm')[0].reset();
                $('#status_id').select2({
                    placeholder: 'Select Status'
                });
                $('#formModal').modal('hide');
                location.reload();
                
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
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/returned/pendingreturnedproducts/"+id+"/edit",
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
                    if(key == 'status_id'){
                        $("#status_id").select2("trigger", "select", {
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
                      url:"/admin/returned/pendingreturnedproducts/"+id,
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
                            location.reload();
                            $('#titletable').text('RETURNING PRODUCTS');
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


//returned product
$('#myReturnedForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.returned.store') }}";
    var type = "POST";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#purchase_button").attr("disabled", true);
            $("#purchase_button").attr("value", "Returning..");
            $('#loading-container').show();
        },
        success:function(data){
            var html = '';
            $('#loading-container').hide();
            $("#purchase_button").attr("disabled", false);
            $("#purchase_button").attr("value", "Returned");
            if(data.nodata){
                $.alert({
                    title: 'Error Message',
                    content: data.nodata,
                    type: 'red',
                });
            }
            if(data.success){
                $.confirm({
                    title: 'Success Message',
                    content: data.success,
                    type: 'green',
                    buttons: {
                        confirm: {
                            text: 'Ok',
                            btnClass: 'btn-blue',
                            keys: ['enter', 'shift'],
                            action: function(){
                                window.location.href = "/admin/purchase-order";
                            }
                        },
                        
                    }
                });

            }
           
        }
    });
});
</script>
@endsection
