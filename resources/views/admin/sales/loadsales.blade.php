<div class="card">
    <div class="card-header border-0">
        <div class="row align-items-center">
        <div class="col-md-12">
            <h3 class="mb-0 text-uppercase" id="title-sales"></h3>
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
                <div class="col-md-3 pt-3">
                   <h3 class="mb-0">Total : <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sales->sum->total , 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="table-responsive">
       
        <!-- Projects table -->
        <table class="table align-items-center table-flush datatable-sales">
        <thead class="thead-light">
            <tr>
            <th scope="col"></th>
            <th scope="col">Actions</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Size</th>
            <th scope="col">Purchase Qty</th>
            <th scope="col">Total</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $key => $sale)
                <tr data-entry-id="{{ $sale->id ?? '' }}">
                    <td>
                        
                    </td>
                    <td>
                        <button type="button" name="edit" edit="{{  $sale->id ?? '' }}" class="edit btn btn-info btn-sm">Edit</button>
                        <button type="button" name="delete" delete="{{  $sale->id ?? '' }}" id="{{  $sale->id ?? '' }}" class="delete btn btn-danger btn-sm">Delete</button>
                    </td>
                    <td>
                        {{  $sale->inventory->name ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->inventory->price ?? '' , 0, ',', '.') }}
                    </td>
                    <td>
                        {{  $sale->inventory->size ?? '' }}
                    </td>
                    <td>
                        {{  $sale->purchase_qty ?? '' }}
                    </td>
                    <td>
                        <large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($sale->total ?? '' ?? '' , 0, ',', '.') }}
                    </td>    
                    <td>
                        {{ $sale->created_at->format('l, j \\/ F / Y h:i:s A') }}
                        
                    </td>
                </tr>
            @empty
                <td>
                    No Data
                </td>
            @endforelse
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
