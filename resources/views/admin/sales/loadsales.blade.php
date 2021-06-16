<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
        <div class="col-md-12">
        <small class="mb-0 text-uppercase font-weight-bold modal-title" id="title-sales"></small>
        <i class="fa fa-spinner fa-spin text-primary button-loading ml-2"></i>
            
        </div>
        
        <div class="col-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="col-12">
                        <div class="row">
                            
                                <button id="daily" name="daily" class="text-uppercase btn btn-sm btn-primary mt-2 ">Daily</button>
                                <button id="monthly" name="monthly" class="text-uppercase btn btn-sm btn-primary mt-2 ">Monthly</button>
                                <button id="yearly" name="yearly" class="text-uppercase btn btn-sm btn-primary mt-2 ">Yearly</button>
                                <button id="all" name="all" class="text-uppercase btn btn-sm btn-primary mt-2 ">All</button>
                                <button data-toggle="modal" data-target="#modalfilter" class="text-uppercase btn btn-sm btn-primary mt-2">Filter By Date</button>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                   <span class="mb-0 text-uppercase font-weight-bold">Profit: <large class="text-success font-weight-bold mr-1">₱ {{ number_format($sales->sum->profit , 0, ',', ',') }}</large> </span>
                   <br>
                   <span class="mb-0 text-uppercase font-weight-bold">Sales: <large class="text-success font-weight-bold mr-1">₱ {{ number_format($sales->sum->total , 0, ',', ',') }}</large> </span>

                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="table-responsive">
       
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-sales display" cellspacing="0" width="100%">
        <thead class="thead-light">
            <tr>
            <th scope="col">Actions</th> 
            <th scope="col">Order Number</th>
            <th scope="col">Product Number</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Size</th>
            <th scope="col">Qty</th>
            <th scope="col">Sales</th>
            <th scope="col">Profit</th>
            <th scope="col">User</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody class="text-uppercase font-weight-bold">
            @foreach($sales as $key => $sale)
                <tr data-entry-id="{{ $sale->id ?? '' }}">
                    <td>
                        <button type="button" name="receipt" receipt="{{  $sale->id ?? '' }}" class="text-uppercase receipt btn btn-success btn-sm">Receipt</button>  
                    </td>
                    <td>
                        {{  $sale->order_number ?? '' }}
                    </td>
                    <td>
                        {{  $sale->inventory->product_number ?? '' }}
                    </td>
                    <td>
                        {{  $sale->inventory->name ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->inventory->price ?? '' , 0, ',', ',') }}
                    </td>
                    <td>
                        {{  $sale->inventory->size->title ?? '' }} {{  $sale->inventory->size->size ?? '' }}
                    </td>
                    <td>
                        {{  $sale->purchase_qty ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->total ?? '' ?? '' , 0, ',', ',') }}
                    </td>    
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->profit ?? '' ?? '' , 0, ',', ',') }}
                    </td>
                    <td>
                        {{  $sale->user->name ?? '' }}
                    </td>
                    <td>
                        {{ $sale->created_at->format('l, j \\/ F / Y h:i:s A') }}
                        
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

  $('.datatable-sales:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    
});
</script>
