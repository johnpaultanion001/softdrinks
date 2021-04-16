@extends('../layouts.admin')
@section('sub-title','Dashboard')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection

@section('content')
  <div id="loaddashboard">
     <div class="loading col-sm-12 text-align-center">
     <div class="row">
        <div class="col-sm-6 mx-auto">
            <img src="https://www.gamudacove.com.my/media/img/loader.gif" alt="">
        </div>
     </div>
    </div>
  </div>
@endsection


@section('script')
<script>

$(function () {
    
    return loadDashboard();
});

function loadDashboard(){
    $.ajax({
        url: "loaddashboard", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $('.loading').show();
        },
        success: function(response){
            $('.loading').hide();
            $("#loaddashboard").html(response);
        }	
    })
}

 

</script>
@endsection




