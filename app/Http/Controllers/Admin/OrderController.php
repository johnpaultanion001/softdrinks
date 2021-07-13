<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.ordering.editmodal', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        date_default_timezone_set('Asia/Manila');
        $errors =  Validator::make($request->all(), [
            'purchase_qty_edit' => ['required' ,'integer','min:1'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }

        if($request->purchase_qty_edit > $order->inventory->stock){
            return response()->json(['nostock' => 'Insufficient Stocks. Availalbe Stock:'.$order->inventory->stock]);
        }
        if(date('Y-m-d') > $order->inventory->expiration){
            return response()->json(['expiration' => 'This product has expired. Expiration Date:'.$order->inventory->expiration]);
        }
        if(date('Y-m-d') == $order->inventory->expiration){
            return response()->json(['expirationtoday' => 'This product has expired today. Expiration Date:'.$order->inventory->expiration]);
        }
        if($order->inventory->orders  >  $order->inventory->stock){
            return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$order->inventory->orders.' has reach maximum stock of the product' . ' Availalbe Stock:'.$order->inventory->stock]);
        }
        

        if($order->purchase_qty < $request->purchase_qty_edit){
            $changeqty = $request->purchase_qty_edit - $order->purchase_qty;
            
            if($changeqty  > $order->inventory->stock){
                return response()->json(['nostock' => 'Insufficient Stocks. Availalbe Stock:'.$order->inventory->stock]);
            }
            if($order->inventory->orders + $changeqty  >  $order->inventory->stock){
                return response()->json(['maxstock' => 'Insufficient Stocks. This Orders:'.$order->inventory->orders.' has reach maximum stock of the product' . ' Availalbe Stock:'.$order->inventory->stock]);
            }
            // Inventory::where('id',  $order->inventory->id)->decrement('stock', $changeqty);
            // Inventory::where('id',  $order->inventory->id)->increment('sold', $changeqty);

            Inventory::where('id', $order->inventory->id)->increment('orders', $changeqty);
         }
         if($order->purchase_qty > $request->purchase_qty_edit){
            $changeqty = $order->purchase_qty - $request->purchase_qty_edit;
    
            // Inventory::where('id', $order->inventory_id)->increment('stock', $changeqty);
            // Inventory::where('id', $order->inventory_id)->decrement('sold', $changeqty);
            Inventory::where('id', $order->inventory->id)->decrement('orders', $changeqty);
         }

        $total = $request->purchase_qty_edit * $order->inventory->price;
        $profit = $request->purchase_qty_edit * $order->inventory->profit;
        

        $order->inventory_id = $order->inventory->id;
        $order->purchase_qty = $request->purchase_qty_edit;
        $order->total = $total;
        $order->total_amount_receipt = $total;
        $order->profit = $profit;
        
        $order->save();

        return response()->json(['success' => 'Order Successfully Updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //    Inventory::where('id', $order->inventory->id)->increment('stock', $order->purchase_qty);
        //    Inventory::where('id', $order->inventory->id)->decrement('sold', $order->purchase_qty); 

       Inventory::where('id', $order->inventory->id)->decrement('orders', $order->purchase_qty);
       return response()->json(['success' => 'Order Removed Successfully.' , $order->delete()]);
    }
}
