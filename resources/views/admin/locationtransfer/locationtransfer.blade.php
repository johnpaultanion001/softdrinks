@extends('../layouts.admin')
@section('sub-title','Location Transfer')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <small class="text-white">LT No.</small>
                    <input type="text" name="lt_no" id="lt_no" class="form-control form_disable" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-lt_no"></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <small class="text-white">Entry Date</small>
                    <input type="date" name="entry_date" id="entry_date" class="form-control form_disable" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-entry_date"></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-2">
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <small class="text-white">Reference</small>
                    <input type="text" name="reference" id="reference" class="form-control form_disable" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-reference"></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <small class="text-white">Reference Date</small>
                    <input type="date" name="reference_date" id="reference_date" class="form-control form_disable" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-reference_date"></strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
           

            <div class="col-sm-5">
                <div class="form-group">
                    <small class="text-white">Prepared By</small>
                    <input type="text" name="prepared_by" id="prepared_by" class="form-control form_disable" />
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-prepared_by"></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-2">
                
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <small class="text-white">Remarks</small>
                    <input type="text" name="remarks" id="remarks" class="form-control form_disable"/>
                    <span class="invalid-feedback" role="alert">
                        <strong id="error-remarks"></strong>
                    </span>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="form-group">
                <small class="text-white">Location From</small>
                    <select name="location_from" id="location_from" class="form-control select2">
                        <option value="" disabled selected>Filter By Location</option>
                        @foreach ($locations as $location)
                            <option value="{{$location->id}}"> {{$location->location_name}}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="col-sm-2">
                
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                <small class="text-white">Location To</small>
                    <select name="location_to" id="location_to" class="form-control select2">
                        <option value="" disabled selected>Filter By Location</option>
                        @foreach ($locations as $location)
                            <option value="{{$location->id}}"> {{$location->location_name}}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6 table-load">
  <div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0 text-uppercase" id="titletable">Location From</h3>
                </div>
                </div>
            </div>
            <div id="loadlocationfrom"></div>

            <div id="loading-locationfrom" class="loading-container" style="position: absolute; margin-left: 40%; z-index: 2;">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div> 
        <!-- table -->
            
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0 text-uppercase" id="titletable">Location To</h3>
                </div>
                </div>
            </div>
            <div id="loadlocationto"></div>

            <div id="loading-locationto" class="loading-container" style="position: absolute; margin-left: 40%; z-index: 2;">
                <div class="loading"></div>
                <div id="loading-text">loading</div>
            </div> 
        <!-- table -->
            
        </div>
    </div>

  </div>
</div>
@endsection

@section('script')
<script>
$(function () {

    $("#location_from").select2("trigger", "select", {
        data: { id: 1 }
    });

    $("#location_to").select2("trigger", "select", {
        data: { id: 2 }
    });
  
});

$('select[name="location_from"]').on("change", function(event){
  var location_from = $('#location_from').val();
  if(location_from != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"location_transfer/" + location_from + "/from" ,
          method:"GET",
          dataType: "HTMl",
         
          beforeSend: function() {
            
            $('#loading-locationfrom').show();
          },
          success:function(data){
            $('#loading-locationfrom').hide();
            $("#loadlocationfrom").html(data);
          }
         });
        }
});

$('select[name="location_to"]').on("change", function(event){
  var location_to = $('#location_to').val();
  if(location_to != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"location_transfer/" + location_to + "/to" ,
          method:"GET",
          dataType: "HTMl",
         
          beforeSend: function() {
            
            $('#loading-locationto').show();
          },
          success:function(data){
            $('#loading-locationto').hide();
            $("#loadlocationto").html(data);
          }
         });
        }
});






</script>
@endsection
