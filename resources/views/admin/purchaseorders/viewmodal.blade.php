

<div class="row ">

    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label text-uppercase" >DOC NO.</label>
            <input type="text" class="form-control" value="{{$purchasenumber->doc_no}}" readonly/>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label text-uppercase" >Entry Date:</label>
            <input type="text" class="form-control" value="{{$purchasenumber->entry_date}}" readonly/>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label text-uppercase" >PO NO.</label>
            <input type="text" class="form-control" value="{{$purchasenumber->po_no}}" readonly/>
            
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label text-uppercase" >PO Date.</label>
            <input type="text" value="{{$purchasenumber->po_date}}" class="form-control" readonly/>
            
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Supplier Code/Name:</label>
            <input type="text"  class="form-control" value="{{$purchasenumber->supplier->id}} / {{$purchasenumber->supplier->name}}" readonly/>
        
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Location Code/Name:</label>
            <input type="text"  class="form-control"  value="{{$purchasenumber->location->id}} / {{$purchasenumber->location->location_name}}" readonly/>
        </div>
    </div>


    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label text-uppercase" >Name of a Driver:</label>
            <input type="text" class="form-control"  value="{{$purchasenumber->name_of_a_driver}}" readonly/>
            
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label text-uppercase" >Plate Number: </label>
            <input type="text" class="form-control" value="{{$purchasenumber->plate_number}}" readonly/>
            
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label text-uppercase" >Trade Discount:</label>
            <input type="text" class="form-control" value="{{$purchasenumber->trade_discount}}" readonly/>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label class="control-label text-uppercase" >Terms Discount: </label>
            <input type="text" value="{{$purchasenumber->terms_discount}}" readonly class="form-control"/>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Remarks: </label>
            <textarea readonly class="form-control">{{$purchasenumber->remarks}}</textarea>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label text-uppercase" >Reference: </label>
            <textarea  readonly class="form-control">{{$purchasenumber->reference}}</textarea>
            
        </div>
    </div>
    
</div>

<hr>
<div class="row">
      
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Product Count:</label>
                        <input type="text"  class="form-control" readonly value="{{$purchasenumber->total_orders}}"/>
                </div>
        </div>

        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Total Purchased:</label>
                        <input type="text"  class="form-control" readonly value="₱ {{  number_format($purchasenumber->total_purchased_order , 0, ',', ',') }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Total Profit:</label>
                        <input type="text"  class="form-control" readonly value="₱ {{  number_format($purchasenumber->total_profit , 0, ',', ',') }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Total Price:</label>
                        <input type="text"  class="form-control" readonly value="₱ {{  number_format($purchasenumber->total_price , 0, ',', ',') }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Created By:</label>
                        <input type="text"  class="form-control" readonly value="{{ $purchasenumber->user->name }}"/>
                </div>
        </div>
        <div class="col-sm-3">
                <div class="form-group">
                        <label class="control-label text-uppercase" >Vat Amount:</label>
                        <input type="text"  class="form-control" readonly value="₱ 0"/>
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
    <table class="table align-items-center table-flush datatable-productsview display" cellspacing="0" width="100%">
        <thead class="thead-white">
        <tr>
            <th scope="col">Receiving Goods ID</th>
            <th scope="col">Product ID</th>
            <th scope="col">Product Code</th>
            <th scope="col">Long Description</th>
            <th scope="col">Short Description</th>

            <th scope="col">Size</th>
            <th scope="col">Category</th>
            <th scope="col">Expiration</th>

            <th scope="col">Purchase QTY</th>
            <th scope="col">Stock</th>
            <th scope="col">Sold</th>

            <th scope="col">Purchase Amount</th>
            <th scope="col">Profit</th>
            <th scope="col">Price</th>
            <th scope="col">Total Amount Purchase</th>
            <th scope="col">Total Amount Profit</th>
            <th scope="col">Total Amount Price</th>
            <th scope="col">Remarks</th>
            <th scope="col">Created By</th>
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
                        {{  $order->product_id ?? '' }}
                    </td>
                    <td>
                        {{  $order->product_code ?? '' }}
                    </td>
                    <td>
                        {{  $order->long_description ?? '' }}
                    </td>
                    <td>
                        {{  $order->short_description ?? '' }}
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
                        {{  $order->stock ?? '' }}
                    </td>
                    <td>
                        {{  $order->sold ?? '' }}
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
                        {{  $order->product_remarks ?? '' }}
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





