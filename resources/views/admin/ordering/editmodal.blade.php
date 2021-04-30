<span id="form_result"></span>          
<div class="card card-stats" style="border-bottom: 1px solid #111">
<!-- Card body -->
    <div class="card-body">
        <div class="row">
        <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0" id="name">{{$order->inventory->name}}</h5>
            <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{$order->total}}</span> / TOTAL
        </div>
        <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="fas fa-wine-bottle"></i>
            </div>
        </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
        <span class="mr-2 font-weight-bold">Size: <span class="text-success">{{$order->inventory->size}}</span></span>
        <span class="mr-2 font-weight-bold">Stock: <span class="text-success">{{$order->inventory->stock}}</span></span>
        <span class="mr-2 font-weight-bold">Price: <span class="text-success">{{$order->inventory->price}} / PER CASE</span></span>

        <br>
        <span class="text-nowrap font-weight-bold ">Expiration: <span class="text-success">{{$order->inventory->expiration}}</span></span>
        <span class="text-nowrap font-weight-bold ">Sold: <span class="text-success">{{$order->inventory->sales}}</span></span>
        
        </p>
    </div>
</div>
<div class="card card-stats" style="border-bottom: 1px solid #111">
<!-- Card body -->
    <div class="card-body">
        <div class="form-group">
            <label class="control-label text-success" >QTY: </label>
            <input type="number" name="purchase_qty_edit" id="purchase_qty_edit" value="{{$order->purchase_qty}}" class="form-control"/>
            <span class="invalid-feedback" role="alert">
                <strong id="error-purchase_qty_edit"></strong>
            </span>
        </div>
    </div>
</div>
