
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
              <h3 class="mb-0 text-uppercase" id="titletable">UCS</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-ucs display" cellspacing="0" width="100%">
            <thead class="thead-white">
              <tr>
                
                <th>Product ID</th>
                <th>Product Code</th>
                <th>Receiving Good ID & Supplier</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Product Size</th>
                <th>Purchase QTY</th>
                <th>UCS</th>
                <th>UCS Total</th>
                <th>Date</th>
                
                
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($totalucs as $key => $ucs)
                    <tr data-entry-id="{{ $ucs->id ?? '' }}">
                      
                        <td>
                            {{  $ucs->inventory->product_id ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->product_code ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->purchase_order_number_id ?? '' }} - {{  $ucs->purchase_order->supplier->name ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->long_description ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->category->name ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->size->title ?? '' }}  {{  $ucs->inventory->size->size ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->case ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->inventory->size->ucs ?? '' }}
                        </td>
                        <td>
                            {{  $ucs->ucs ?? '' }}
                        </td>
                        <td>
                            {{ $ucs->created_at->format('F d,Y h:i A') }}
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
    pageLength: 100,
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-ucs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
    
});



</script>