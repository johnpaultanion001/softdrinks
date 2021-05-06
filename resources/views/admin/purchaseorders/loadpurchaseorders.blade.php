
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
              <h3 class="mb-0 text-uppercase" id="titletable">Purchase Orders</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_record" id="create_record" class="text-uppercase create_record btn btn-sm btn-primary">New Purchase Order</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries display" cellspacing="0" width="100%"">
            <thead class="thead-light">
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Purchase Order Number</th>
                <th scope="col">Name Of Supplier</th>
                <th scope="col">Total Orders</th>
                <th scope="col">Total Purchased Order</th>
                <th scope="col">Total Profit</th>
                <th scope="col">Total Price</th>
                <th scope="col">Created By</th>
                <th scope="col">Note</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($orders as $key => $order)
                    <tr data-entry-id="{{ $order->id ?? '' }}">
                       <td>
                            <button type="button" name="view" view="{{  $order->id ?? '' }}" class="view text-uppercase btn btn-warning btn-sm">View</button>
                            
                            @if ($order->isReturn == 0)
                            <a href="{{ route('admin.purchase-order.edit', $order->id) }}"  class="text-uppercase btn btn-info btn-sm">Edit</a>
                            <a href="{{ route('admin.returned.show', $order->id) }}" class="return text-uppercase btn btn-success btn-sm">Return</button>
                            @elseif ($order->isReturn == 1)

                            @endif
                            
                        </td>
                        <td>
                            {{  $order->purchase_order_number ?? '' }}
                        </td>
                        <td>
                            {{  $order->supplier->name ?? '' }}
                        </td>
                        <td>
                            {{  $order->total_orders?? '' }}
                        </td>
                        <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($order->total_purchased_order ?? '' , 0, ',', ',') }}
                        </td>
                        <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($order->total_profit ?? '' , 0, ',', ',') }}
                        </td>
                        <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($order->total_price ?? '' , 0, ',', ',') }}
                        </td>
                        <td>
                            {{  $order->user->name ?? '' }}
                        </td>
                        <td>
                            {{  $order->notes ?? '' }}
                        </td>
                        <td>
                          {{ $order->created_at->format('l, j \\/ F / Y h:i:s A') }}
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
    'columnDefs': [{ 'orderable': false, 'targets': 0 }],
  });

  $('.datatable-inventries:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});


</script>