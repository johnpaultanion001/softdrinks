

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-uppercase" id="titletable">Products</h3>
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
              @foreach($orders as $key => $order)
                    <tr data-entry-id="{{ $order->id ?? '' }}">
                      
                      <td>
                          <button type="button" name="edit" edit="{{  $order->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                          <button type="button" name="remove" remove="{{  $order->id ?? '' }}" id="{{  $order->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                      </td>
                      <td>
                          {{  $order->product_number ?? '' }}
                      </td>
                      <td>
                          {{  $order->purchase_order_number_id ?? '' }} - {{  $order->purchase_order->supplier->name ?? '' }}
                      </td>

                      <td>
                          {{  $order->name ?? '' }}
                      </td>
                      <td>
                          {{  $order->stock ?? '' }}
                      </td>
                     
                      <td>
                          {{  $order->size->title ?? '' }} {{  $order->size->size ?? '' }}
                      </td>
                      <td>
                          {{  $order->category->name ?? '' }}
                      </td>

                      <td>
                          {{  $order->expiration ?? '' }}
                      </td>
                      <td>
                          {{  $order->qty ?? '' }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->purchase_amount , 0, ',', ',') }}
            
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->profit , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($order->price , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($order->total_amount_purchase , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->total_profit , 0, ',', ',') }}
                      </td>
                      <td>
                          <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($order->total_price , 0, ',', ',') }}

                      </td>
                      <td>
                          {{  $order->note ?? '' }}
                      </td>
                      <td>
                          {{  $order->purchase_order->user->name ?? '' }}
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