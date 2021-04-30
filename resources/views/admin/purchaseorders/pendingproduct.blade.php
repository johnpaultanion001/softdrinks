<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-products">
        <thead class="thead-light">
        <tr>
            <th scope="col">Actions</th>
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
        @foreach($pendingproducts as $key => $product)
                <tr data-entry-id="{{ $product->id ?? '' }}">
                    <td>
                        <button type="button" name="edit" edit="{{  $product->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                        <button type="button" name="remove" remove="{{  $product->id ?? '' }}" id="{{  $product->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                    </td>
                    <td>
                        {{  $product->purchase_order_number_id ?? '' }}
                    </td>
                    <td>
                        {{  $product->category->name ?? '' }}
                    </td>
                    <td>
                        {{  $product->name ?? '' }}
                    </td>
                    <td>
                        {{  $product->stock ?? '' }}
                    </td>
                    <td>
                        {{  $product->pcs ?? '' }}
                    </td>
                    <td>
                        {{  $product->size ?? '' }}
                    </td>
                    <td>
                        {{  $product->expiration ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->purchase_amount , 0, ',', ',') }}
           
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->profit , 0, ',', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($product->price , 0, ',', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large>{{  number_format($product->total_amount_purchase , 0, ',', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->total_profit , 0, ',', ',') }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{  number_format($product->total_price , 0, ',', ',') }}

                    </td>
                    <td>
                        {{  $product->note ?? '' }}
                    </td>
                    <td>
                        {{ $product->created_at->format('l, j \\/ F / Y h:i:s A') }}
                    </td>

                    
                </tr>
        @endforeach
        </tbody>
     
    </table>
</div>

<script>
$(function () {
 
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
 
  $.extend(true, $.fn.dataTable.defaults, {
    sale: [[ 1, 'desc' ]],
    pageLength: 100,
  });

  $('.datatable-products:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>