
<div class="row text-center mt-5">
        <div class="col-sm-4">
                <div class="form-group">
                <label class="control-label font-weight-bold text-uppercase text-dark" >Total Purchased:</label>
                <p><large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($products->sum('total_amount_purchase') ?? '' , 0, ',', ',') }} </p>
                </div>
        </div>

        <div class="col-sm-4">
                <div class="form-group">
                <label class="control-label text-uppercase font-weight-bold text-dark" >Total Profit: </label>
                <p><large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($products->sum('total_profit') ?? '' , 0, ',', ',') }} </p>
                </div>
        </div>

        <div class="col-sm-4">
                <div class="form-group">
                <label class="control-label text-uppercase font-weight-bold text-dark" >Total Price:</label>
                <p><large class="text-success font-weight-bold mr-1">₱</large> {{ number_format($products->sum('total_price') ?? '' , 0, ',', ',') }}</p>
                </div>
        </div>
</div>
