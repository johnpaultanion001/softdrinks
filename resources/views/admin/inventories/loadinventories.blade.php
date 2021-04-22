
<div class="header bg-primary pb-6">
    <div class="container-fluid">
      
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6 table-load">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0" id="titletable">Inventories</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_record" id="create_record" class="create_record btn btn-sm btn-primary">New Product</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries">
            <thead class="thead-light">
              <tr>
                <th scope="col"></th>
                <th scope="col">Actions</th>
                <th scope="col">Name</th>
                <th scope="col">Stocks</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Size</th>
                <th scope="col">Sales</th>
                <th scope="col">Expiration</th>
                <th scope="col">Created At</th>
                <th scope="col">Description</th>
              </tr>
            </thead>
            <tbody>
              @foreach($inventories as $key => $inventory)
                    <tr data-entry-id="{{ $inventory->id ?? '' }}">
                        <td>
                           
                        </td>
                        <td>
                            <button type="button" name="edit" edit="{{  $inventory->id ?? '' }}" class="edit btn btn-info btn-sm">Edit</button>
                            <button type="button" name="delete" delete="{{  $inventory->id ?? '' }}" id="{{  $inventory->id ?? '' }}" class="delete btn btn-danger btn-sm">Delete</button>
                        </td>
                        <td>
                            {{  $inventory->name ?? '' }}
                        </td>
                        <td>
                            {{  $inventory->stock ?? '' }}
                        </td>
                        <td>
                            <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($inventory->price ?? '' , 0, ',', '.') }}
                        </td>
                        <td>
                            {{  $inventory->category->name ?? '' }}
                        </td>
                        <td>
                            {{  $inventory->size ?? '' }}
                        </td>
                        <td>
                            {{  $inventory->sales ?? '' }}
                        </td>    
                        <td>
                            {{  $inventory->expiration ?? '' }}
                        </td>
                        
                        <td>
                            {{  $inventory->created_at ?? '' }}
                        </td>
                        <td>
                            {{  $inventory->description ?? '' }}
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
    @section('footer')
        @include('../partials.footer')
    @endsection
  </div>
</div>

<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    sale: [[ 1, 'desc' ]],
    pageLength: 100,
  });

  $('.datatable-inventries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});


</script>