
<div class="col-md-12">
    <div class="row">
        <div class="col-md-4 bg-primary mt-2 mr-1" style="border-radius: 5px;">
            <p class="font-weight-bold">Grand Total: <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($orders->sum->total ?? '' , 0, ',', '.') }} </span></p>
            <div id="receiptreport" class="d-print-inline-flex receiptreport p4 bg-white" style="border-radius: 5px;">
                        <div class="col text-right">
                            <h6 class="card-title text-uppercase text-muted mb-0">{{$date}} <h5>
                        </div>
                        <div class="col">
                            <h5 class="text-center card-title text-uppercase text-muted mb-0">Sample Receipt</h5>
                        </div>
                        <div class="receipt-body overflow-auto" style="max-height: 270px;">
                                @forelse($receipts as $receipt)
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{$receipt->inventory->name}} </h5>
                                        <h5 class="card-title text-uppercase text-muted mb-0">size:{{$receipt->inventory->size}} </h5>
                                        <h5 class="card-title text-uppercase text-muted mb-0">qty:{{$receipt->purchase_qty}} </h5>
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
                            <h5 class="card-title text-uppercase text-muted mb-0">₱ {{ number_format($orders->sum->total ?? '' , 0, ',', ',') }}</h5>
                        </div>
                    </div>
            </div>
            <div class="col mb-2 mt-2">       
                <button type="button" id="print" name="print" class="text-uppercase print btn text-white btn-default">Print Reciept</button>
                <input type="submit" name="checkoutaction_button" id="checkoutaction_button" class="text-uppercase btn btn-white" value="Check Out"/>
            </div>
           
          
       </div>
       <div class="col-md-7 mx-auto mt-2 overflow-auto bg-default" style="max-height: 500px; border-radius: 5px;">
                @forelse($orders as $order)
                    <div class="card col-12 mt-2" style="border-bottom: 1px solid #111">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{$order->inventory->name}} </h5>
                                    <large class="text-success font-weight-bold mr-1">₱</large><span class="h2 font-weight-bold mb-0">{{ number_format($order->total ?? '' , 0, ',', ',') }} </span>
                                </div>
                                <div class="col-auto">
                                
                                        <button type="button" id="edit" name="edit" edit="{{  $order->id ?? '' }}" class="edit btn btn-info btn-sm"><i class="far fa-edit"></i></button>
                                        <button type="button"  id="delete"  name="delete" delete="{{  $order->id ?? '' }}" class="delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                
                                
                                </div> 
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-nowrap font-weight-bold ">Purchase QTY: <span class="text-success mr-2 font-weight-bold" >{{$order->purchase_qty}}</span></span>
                                <span class="text-nowrap font-weight-bold ">Date: <span class="text-success mr-2 font-weight-bold" > {{ $order->created_at->format('l, j \\/ F / Y h:i:s A') }}</span></span>
                            </p>
                        
                        </div>
                    </div>  
                @empty
                   <input type="text" name="nodata" id="nodata" value="No Data" readonly  class="bg-default text-white form-control border-0"/>        
                @endforelse

        </div>

    </div>

</div>

