
    <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label text-uppercase font-weight-bold text-dark" >Supplier: </label>
                    <p>{{$purchasenumber->supplier->name}} </p>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label text-uppercase font-weight-bold text-dark" >Note: </label>
                    <p>{{$purchasenumber->notes}} </p>
                </div>
            </div>

    </div>


    <div class="row text-center mt-5">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label font-weight-bold text-uppercase text-dark" >Total Purchased:</label>
                <p><large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($purchasenumber->total_purchased_order , 0, ',', ',') }} </p>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label text-uppercase font-weight-bold text-dark" >Total Profit: </label>
                <p><large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($purchasenumber->total_profit , 0, ',', ',') }} </p>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label text-uppercase font-weight-bold text-dark" >Total Price:</label>
                <p><large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($purchasenumber->total_price , 0, ',', ',') }}</p>
            </div>
        </div>
    </div>


    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0 text-uppercase" id="titletable">Products</h3>
        </div>
      
    </div>
    <div class="pending-product col mt-4">
    <div class="table-responsive">
    <table class="table align-items-center table-flush datatable-productsview">
        <thead class="thead-light">
        <tr>
           
            <th scope="col">Purchase Order Number</th>
            <th scope="col">Category</th>
            <th scope="col">Name</th>
            <th scope="col">Stock / Per Case</th>
            <th scope="col">Stock / Per PCS</th>
            <th scope="col">Size</th>
            <th scope="col">Expiration</th>
            <th scope="col">Purchase Amount / Per Case</th>
            <th scope="col">Profit / Per Case</th>
            <th scope="col">Price / Per Case</th>
            <th scope="col">Total Amount Purchase</th>
            <th scope="col">Total Amount Profit</th>
            <th scope="col">Total Amount Price</th>
            <th scope="col">Note</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
        @foreach($orders as $key => $order)
                <tr data-entry-id="{{ $order->id ?? '' }}">
                   
                    <td>
                        {{  $order->purchase_order_number_id ?? '' }}
                    </td>
                    <td>
                        {{  $order->category->name ?? '' }}
                    </td>
                    <td>
                        {{  $order->name ?? '' }}
                    </td>
                    <td>
                        {{  $order->stock ?? '' }}
                    </td>
                    <td>
                        {{  $order->pcs ?? '' }}
                    </td>
                    <td>
                        {{  $order->size ?? '' }}
                    </td>
                    <td>
                        {{  $order->expiration ?? '' }}
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
                        {{ $order->created_at->format('l, j \\/ F / Y h:i:s A') }}
                    </td>

                    
                </tr>
        @endforeach
        </tbody>
    </table>
</div>

    </div>

    


<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    sale: [[ 1, 'desc' ]],
    pageLength: 100,
  });

  $('.datatable-productsview:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>





