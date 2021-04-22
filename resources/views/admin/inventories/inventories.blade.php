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



<form method="post" id="myForm" class="form-horizontal ">
            @csrf
            <div class="modal" id="formModal">
                <div class="modal-dialog modal-lg modal-dialog-centered ">
                    <div class="modal-content">
                
                        <!-- Modal Header -->
                        <div class="modal-header bg-primary">
                            <p class="modal-title text-white text-uppercase font-weight-bold">Modal Heading</p>
                            <i class="ml-2 fa fa-spinner fa-spin text-white button-loading"></i>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>
                
                        <!-- Modal body -->
                        <div class="modal-body">
                            <span id="form_result"></span>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" >Product Name : </label>
                                        <input type="text" name="name" id="name" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-name"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" >Product Stock / Per Case : </label>
                                        <input type="number" name="stock" id="stock" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-stock"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" >Product Price / Per Case : </label>
                                        <input type="number" name="price" id="price" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-price"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" >Category : </label>
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
                                        <label class="control-label" >Product Size : </label>
                                        <input type="text" name="size" id="size" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-size"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label" >Expiration : </label>
                                        <input type="date" name="expiration" id="expiration" class="form-control" />
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-expiration"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label" >Description / Optional : </label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error-description"></strong>
                                        </span>
                                    </div>
                                </div>
                               
                               
                            </div>
                            
                            
                           
                          

                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </div>
                
                        <!-- Modal footer -->
                        <div class="modal-footer bg-white">
                            <i class="fa fa-spinner fa-spin text-primary button-loading"></i>
                            <input type="submit" name="action_button" id="action_button" class="text-uppercase btn btn-default" value="Save" />
                        </div>
                
                    </div>
                </div>
            </div>
        </form>
@endsection

@section('script')
<script>

$(function () {
    
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

$(document).on('click', '.delete', function(){
  var id = $(this).attr('delete');
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
    var id = $(this).attr('edit');

    $.ajax({
        url :"/admin/inventories/"+id+"/edit",
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading...");
            $('.button-loading').show();
        },
        success:function(data){
            $('.button-loading').hide();
            if($('#action').val() == 'Edit'){
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Update");
            }else{
                $("#action_button").attr("disabled", false);
                $("#action_button").attr("value", "Submit");
            }
            $.each(data.result, function(key,value){
                if(key == $('#'+key).attr('id')){
                    $('#'+key).val(value)
                    if(key == 'category_id'){
                        $("#category_id").select2("trigger", "select", {
                            data: { id: value }
                        });
                    }
                }
            })
            $('#hidden_id').val(id);
            $('#action_button').val('Update');
            $('#action').val('Edit');
        }
    })
});

$(document).on('click', '#create_record', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid')
    $('.modal-title').text('Add New Product');
    $('#category_id').select2({
        placeholder: 'Select category'
    })
    $('#action_button').val('Submit');
    $('#action').val('Add');
    $('#form_result').html('');
    $('.button-loading').hide();
    
});

$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('admin.inventories.store') }}";
    var type = "POST";

    if($('#action').val() == 'Edit'){
        var id = $('#hidden_id').val();
        action_url = "inventories/" + id;
        type = "PUT";
    }

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
            $("#action_button").attr("value", "Loading..");
            $('.button-loading').show();
        },
        success:function(data){
            var html = '';
            $('.button-loading').hide();
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if($('#action').val() == 'Edit'){
                        $("#action_button").attr("disabled", false);
                        $("#action_button").attr("value", "Update");
                    }else{
                        $("#action_button").attr("disabled", false);
                        $("#action_button").attr("value", "Submit");
                    }
                  
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                if($('#action').val() == 'Edit'){
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Update");
                }else{
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Submit");
                }
                $.alert({
                    title: 'Success Message',
                    content: data.success,
                    type: 'green',
                });
                $('.form-control').removeClass('is-invalid')
                $('#myForm')[0].reset();
                $('#category_id').select2({
                    placeholder: 'Select category'
                });
                $('#formModal').modal('hide');
                return loadInventories();
                
            }
           
        }
    });
});

</script>
@endsection
