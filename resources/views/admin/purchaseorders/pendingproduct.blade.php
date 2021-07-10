<div class="table-responsive">
    <table class="table align-items-center table-flush datatable-products">
        <thead class="thead-white">
        <tr>
            <th scope="col">Actions</th>
            <th scope="col">Product ID</th>
            <th scope="col">Product Code</th>
            <th scope="col">Long Description</th>
            <th scope="col">Short Description</th>

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
            <th scope="col">Remarks</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold display" cellspacing="0" width="100%">
        @foreach($pendingproducts as $key => $product)
                <tr data-entry-id="{{ $product->id ?? '' }}">
                    <td>
                        <button type="button" name="edit" edit="{{  $product->id ?? '' }}"  class="edit text-uppercase btn btn-info btn-sm">Edit</button>
                        <button type="button" name="remove" remove="{{  $product->id ?? '' }}" id="{{  $product->id ?? '' }}" class="remove text-uppercase btn btn-danger btn-sm">Remove</button>
                    </td>
                    <td>
                        {{  $product->product_id ?? '' }}
                    </td>
                    <td>
                        {{  $product->product_code ?? '' }}
                    </td>
                    <td>
                        {{  $product->long_description ?? '' }}
                    </td>
                    <td>
                        {{  $product->short_description ?? '' }}
                    </td>
                    <td>
                        {{  $product->size->title ?? '' }} {{  $product->size->size ?? '' }}
                    </td>
                    <td>
                        {{  $product->category->name ?? '' }}
                    </td>
                    <td>
                        {{  $product->expiration ?? '' }}
                    </td>                    
                    <td>
                        {{  $product->qty ?? '' }}
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
                        {{  $product->remarks ?? '' }}
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