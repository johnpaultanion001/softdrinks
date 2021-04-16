@extends('../layouts.admin')
@section('sub-title','Sales')
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

<!-- Page content -->
<div class="container-fluid mt--6">
      <div class="row">
        
        <div class="col-xl-12" id="loadsales">
            <div class="loading col-sm-12 text-align-center">
                <div class="row">
                    <div class="col-sm-6 mx-auto">
                        <img src="https://www.gamudacove.com.my/media/img/loader.gif" alt="">
                    </div>
                </div>
            </div>
        </div>
       

       
        <!-- Footer -->
        @section('footer')
            @include('../partials.footer')
        @endsection
      </div>
</div>

<!-- modal Filter -->
<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">Filter Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
               <div class="form-group">
                    <label class="control-label" >From: </label>
                    <input type="date" name="from_date" id="from_date"  class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-purchase_qty"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label" >To: </label>
                    <input type="date"  name="to_date" id="to_date"  class="form-control" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-purchase_qty"></strong>
                    </span>
                </div>
        </div>
        <div class="col text-right">
          <button id="filter" name="filter"  type="button" class="btn btn-default">Submit</button>
        </div>
            
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')
<script>

$(function () {
    
    return loadSales();
});

function loadSales(){
    $.ajax({
        url: "loadsales", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
            $('.loading').show();
        },
        success: function(response){
          
            $("#loadsales").html(response);
            $('#title-sales').html('All Sales');
            $('.loading').hide();
        }
        	
    })
}
//daily
$(document).on('click', '#daily', function(){
   $.ajax({
        url: "sales-daily", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
        },
        success: function(response){
            $("#loadsales").html(response);
            $('#title-sales').html('Daily Sales');
        }	
    })
});
//monthly
$(document).on('click', '#monthly', function(){
   $.ajax({
        url: "sales-monthly", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
        },
        success: function(response){
            $("#loadsales").html(response);
            $('#title-sales').html('Monthly Sales');
        }	
    })
});
//yearly
$(document).on('click', '#yearly', function(){
    $.ajax({
        url: "sales-yearly", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('#title-sales').html('Loading...');
        },
        success: function(response){
            $("#loadsales").html(response);
            $('#title-sales').html('Yearly Sales');
        }	
    })
});
//all
$(document).on('click', '#all', function(){
    return loadSales();
});

//filter by date
function fetch_data(from_date = '', to_date = '')
    {
        $.ajax({
            url:"{{ route('admin.daterange.fetch_data') }}",
            method:"POST",
            data:{from_date:from_date, to_date:to_date, _token:_token},
            dataType:"HTMl",
            beforeSend: function() {
                 $('#title-sales').html('Loading...');
            },
            success:function(data)
            {
                $('#modalfilter').modal('hide');
                $("#loadsales").html(data);
                $('#title-sales').html('Filter By Date');
            }
        });
    }
    
    $(document).on('click', '#filter', function(){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if(from_date != '' &&  to_date != '')
        {
            fetch_data(from_date, to_date);
        }
        else
        {
            alert('Both Date is required');
        }
    });

 

</script>
@endsection


