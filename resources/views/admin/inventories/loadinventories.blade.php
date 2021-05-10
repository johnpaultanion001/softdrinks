
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
              <h3 class="mb-0 text-uppercase" id="titletable">Inventories</h3>
            </div>
            <div class="col text-right">
              <button type="button" name="create_record" id="create_record" class="create_record text-uppercase btn btn-sm btn-primary">New Product</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush datatable-inventries display" cellspacing="0" width="100%"">
            <thead class="thead-light">
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Product Number</th>
                <th scope="col">Purchase Order Number & Supplier</th>
                <th scope="col">Product Name</th>
                <th scope="col">Stock</th>
                <th scope="col">Size</th>
                <th scope="col">Category</th>
                <th scope="col">Expiration</th>
                <th scope="col">Purchase QTY</th>
                <th scope="col">Purchase Amount</th>
                <th scope="col">Profit</th>
                <th scope="col">Price</th>
                <th scope="col">Total Amount Purchase</th>
                <th scope="col">Total Amount Profit</th>
                <th scope="col">Total Amount Price</th>
                <th scope="col">Note</th>
                <th scope="col">User</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody class="text-uppercase font-weight-bold">
              @foreach($inventories as $key => $inventory)
                    <tr data-entry-id="{{ $inventory->id ?? '' }}">
                    
                      <td>
                          <button type="button" name="view" view="{{  $inventory->id ?? '' }}"  class="view text-uppercase btn btn-warning btn-sm">View</button>
                          @if ($inventory->purchase_order->isReturn == 0)
                              <button type="button" name="edit" edit="{{  $inventory->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                          @elseif ($inventory->purchase_order->isReturn == 1)

                          @endif 
                          <button type="button" name="remove" remove="{{  $inventory->id ?? '' }}" id="{{  $inventory->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                      </td>
                      <td>
                          {{  $inventory->product_number ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->purchase_order_number_id ?? '' }} - {{  $inventory->purchase_order->supplier->name ?? '' }}
                      </td>

                      <td>
                          {{  $inventory->name ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->stock ?? '' }}
                      </td>
                      
                      <td>
                          {{  $inventory->size->title ?? '' }}  {{  $inventory->size->size ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->category->name ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->expiration ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->qty ?? '' }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->purchase_amount , 0, ',', ',') }}
            
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->profit , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($inventory->price , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($inventory->total_amount_purchase , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->total_profit , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($inventory->total_price , 0, ',', ',') }}

                      </td>
                      <td>
                          {{  $inventory->note ?? '' }}
                      </td>
                      <td>
                          {{  $inventory->purchase_order->user->name ?? '' }}
                      </td>
                      <td>
                          {{ $inventory->created_at->format('l, j \\/ F / Y h:i:s A') }}
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