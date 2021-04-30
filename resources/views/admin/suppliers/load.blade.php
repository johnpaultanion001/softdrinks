
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
              <h3 class="mb-0 text-uppercase" id="titletable">Suppliers</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Supplier</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-suppliers">
            <thead class="thead-light">
              <tr>
                <th>Actions</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Date</th>
                <th>Note</th>
                
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($suppliers as $key => $supplier)
                    <tr data-entry-id="{{ $supplier->id ?? '' }}">
                       
                        <td>
                            <button type="button" name="edit" edit="{{  $supplier->id ?? '' }}" class="text-uppercase edit btn btn-info btn-sm">Edit</button>
                            <button type="button" name="remove" remove="{{  $supplier->id ?? '' }}" id="{{  $supplier->id ?? '' }}" class="text-uppercase remove btn btn-danger btn-sm">Remove</button>
                        </td>
                        <td>
                            {{  $supplier->name ?? '' }}
                        </td>
                        <td>
                            {{  $supplier->address ?? '' }}
                        </td>
                        <td>
                             {{ $supplier->contact ?? '' }}
                        </td>
                        <td>
                            {{ $supplier->created_at->format('l, j \\/ F / Y h:i:s A') }}
                        </td>
                        <td>
                            {{  $supplier->note ?? '' }}
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

  $('.datatable-suppliers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});


</script>