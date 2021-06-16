
    <p class="font-weight-bold text-uppercase text-dark">Total: <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0 text-dark">{{ number_format($receipts->sum->total ?? '' , 0, ',', '.') }} </span></p>
    <div id="receiptreport" class="d-print-inline-flex receiptreport p4 bg-white" style="border-radius: 5px;">
                <div class="col text-right">
                    <h6 class="card-title text-uppercase text-muted mb-0">{{$date}} <h5>
                </div>
                <div class="col">
                    <h5 class="text-center card-title text-uppercase text-muted mb-0">Sample Receipt</h5>
                </div>
                <div class="receipt-body" id="receipt-body">
                        @forelse($receipts as $receipt)
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{$receipt->inventory->name}} </h5>
                                <h5 class="card-title text-uppercase text-muted mb-0">size:{{$receipt->inventory->size->title}}  {{$receipt->inventory->size->size}} </h5>
                                <h5 class="card-title text-uppercase text-muted mb-0">qty:{{$receipt->purchase_qty}} </h5>
                                <h5 class="card-title text-uppercase text-muted mb-0">price:{{$receipt->inventory->price}} </h5>
                                <h5 class="card-title text-uppercase text-muted mb-0">exp:{{$receipt->inventory->expiration}} </h5>
                            </div>
                            <div class="col text-right">
                                <h5 class="card-title text-uppercase text-muted mb-0">₱ {{ number_format($receipt->total ?? '' , 0, ',', ',') }}</h5>
                            </div>
                            
                        @empty
                            <input type="text" value="No Data" readonly  class="noreiept bg-white text-dark form-control border-0"/>
                        @endforelse
                    </div>
            <hr class="my-3">
            <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                <div class="col text-right">
                    <h5 class="card-title text-uppercase text-muted mb-0">₱ {{ number_format($receipts->sum->total ?? '' , 0, ',', ',') }}</h5>
                </div>
            </div>
    </div>
