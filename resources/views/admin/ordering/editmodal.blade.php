<span id="form_result"></span>          
<div class="card card-stats" style="border-bottom: 1px solid #111">
<!-- Card body -->
    <div class="card-body">
        <div class="row">
        <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0" id="name">{{$order->inventory->name}}</h5>
            <large class="text-success font-weight-bold mr-1">Total:  ₱</large><span class="h2 font-weight-bold mb-0" id="price">{{$order->total}}</span>
        </div>
        <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="fas fa-wine-bottle"></i>
            </div>
        </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
        <span class="text-success mr-2 font-weight-bold" id="size">Size: {{$order->inventory->size}}</span>
        <span class="text-success mr-2 font-weight-bold" id="stock"> / Stock: {{$order->inventory->stock}}</span>
        <br>
        <span class="text-nowrap font-weight-bold " id="expiration">Expiration: {{$order->inventory->expiration}}</span>
        </p>
    </div>
</div>
<div class="card card-stats" style="border-bottom: 1px solid #111">
<!-- Card body -->
    <div class="card-body">
        <div class="form-group">
            <label class="control-label" >Purchase QTY: </label>
            <input type="number" name="purchase_qty" id="purchase_qty" value="{{$order->purchase_qty}}" class="form-control"/>
            <span class="invalid-feedback" role="alert">
                <strong id="error-purchase_qty"></strong>
            </span>
        </div>
    </div>
</div>
