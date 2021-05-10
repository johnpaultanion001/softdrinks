<span id="form_result"></span>      
<div class="card card-stats" style="border-bottom: 1px solid #111">
<!-- Card body -->
    <div class="card-body">
        <div class="row">
        <div class="col">
            <h3 class="text-uppercase font-weight-bold text-primary mb-0">{{$inventory->name}}</h3>
            <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($inventory->price , 0, ',', ',') }}</span> <small>/ {{$inventory->category->name}}</small>
        </div>
        <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="fas fa-wine-bottle"></i>
            </div>
        </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
            <div class="row text-dark text-justify font-weight-light">
                <div class="col-6">
                    <span class=" text-uppercase">Size: 
                        <span class="text-success font-weight-bold">{{$inventory->size->title}} {{$inventory->size->size}}</span>
                    </span> 
                </div>
                <div class="col-6">
                        <span class= "text-uppercase">Stock/{{$inventory->category->name}}:
                        @if($inventory->stock < 1)
                            <span class="text-warning text-uppercase">0</span>
                            @else
                            <span class="text-success font-weight-bold">{{$inventory->stock}}</span> 
                        @endif
                    </span>
                </div>
                <div class="col-6">
                    <span class="text-uppercase">Expiration: <span class="text-success font-weight-bold"> {{$inventory->expiration}}</span> </span>
                </div>
                <div class="col-6">
                    <span class="text-uppercase">Sold: <span class="text-success font-weight-bold"> {{$inventory->sales}}</span></span>
                </div>
                <div class="col-12">
                    <span class="text-uppercase">Supplier: <span class="text-success font-weight-bold"> {{$inventory->purchase_order->supplier->name}}</span></span>
                </div>
            </div>
        </p>
    </div>
</div>
<div class="card card-stats" style="border-bottom: 1px solid #111">
<!-- Card body -->
    <div class="card-body">
        <div class="form-group">
            <label class="control-label text-success" >QTY: </label>
            <input type="number" name="purchase_qty" id="purchase_qty" class="purchase_qty form-control"  autofocus/>
            <span class="invalid-feedback" role="alert">
                <strong id="error-purchase_qty"></strong>
            </span>
        </div>
    </div>
</div>