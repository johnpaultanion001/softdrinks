@extends('../layouts.admin')
@section('sub-title','UCS')
@section('navbar')
    @include('../partials.navbar')
@endsection
@section('sidebar')
    @include('../partials.sidebar')
@endsection



@section('content')
<div id="loading-container" class="loading-container">
    <div class="loading"></div>
    <div id="loading-text">loading</div>
</div>
<div id="loaducs">
   
</div>

@section('footer')
    @include('../partials.footer')
@endsection


@endsection

@section('script')
<script>

$(function () {
    
    return loadUCS();
    
});

function loadUCS(){
    $.ajax({
        url: "loaducs", 
        type: "get",
        dataType: "HTMl",
        beforeSend: function() {
            $("#loaducs").hide();
            $('#loading-container').show();
        },
        success: function(response){
            $('#loading-container').hide();
            $("#loaducs").show();
            $("#loaducs").html(response);
        }	
    })
}

</script>
@endsection
