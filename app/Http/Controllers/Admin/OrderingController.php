<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use Validator;
use App\Models\Order;
use App\Models\Sales;
use Gate;
use Symfony\Component\HttpFoundation\Response;



class OrderingController extends Controller
{
    public function getproducts()
    {
        abort_if(Gate::denies('ordering_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $inventories = Inventory::latest()->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->get();
        return view('admin.ordering.ordering', compact('categories','inventories' , 'orders'));
    }
    public function loadproduct()
    {
        date_default_timezone_set('Asia/Manila');
        $inventories = Inventory::where('isRemove', 0)->where('stock' , '>' , 0)->whereDate('expiration' , '>' ,date('Y-m-d', strtotime('-1 day')))->latest()->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->get();
        return view('admin.ordering.loadproduct', compact('categories','inventories', 'orders'));
    }
    public function cartsbutton(){
        $orders = Order::where('status', '0')->get();
        return view('admin.ordering.cartsbutton', compact('orders'));
    }
    public function checkout()
    {
        date_default_timezone_set('Asia/Manila');
        $inventories = Inventory::latest()->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->latest()->get();
        $receipts = Order::where('status', '0')->latest()->get();
        $date = date("Y-m-d H:i:s");

        return view('admin.ordering.checkoutmodal', compact('categories','inventories', 'orders', 'receipts' , 'date'));
    }
    public function checkout_order(Request $request){
        date_default_timezone_set('Asia/Manila');
        $passdata = Order::query()
        ->each(function ($oldRecord) {
                $newPost = $oldRecord->replicate();
                $newPost->setTable('sales');
                $newPost->save();
        });
       if($request->nodata == "No Data"){
        return response()->json(['nodata' => 'No data available']);
       }
        if($passdata){
            Order::truncate();
            return response()->json(['success' => 'Successfully Check Out.']);
        }
    }
    public function loadcart()
    {
        $inventories = Inventory::latest()->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->get();
        return view('admin.ordering.loadcart', compact('categories','inventories', 'orders'));
    }
    public function search(Request $request)
    {
        if($request->ajax()){
            $output="";
            $inventories = Inventory::where('name','LIKE','%'.$request->search."%")
                                    ->Orwhere('price','LIKE','%'.$request->search."%")
                                    ->latest()
                                    ->get();
            return view('admin.ordering.loadproduct', compact('inventories'));
            
        }
    }

    public function addtocart(Request $request, Inventory $inventory)
    {
        date_default_timezone_set('Asia/Manila');
        $errors =  Validator::make($request->all(), [
            'purchase_qty' => ['required' ,'integer','min:1'],
        ]);

        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()]);
        }
        if($request->purchase_qty > $inventory->stock){
            return response()->json(['nostock' => 'Insufficient Stocks. Availalbe Stock:'.$inventory->stock]);
        }
        if(date('Y-m-d') > $inventory->expiration){
            return response()->json(['expiration' => 'This product has expired. Expiration Date:'.$inventory->expiration]);
        }
        if(date('Y-m-d') == $inventory->expiration){
            return response()->json(['expirationtoday' => 'This product has expired today. Expiration Date:'.$inventory->expiration]);
        }
        $total = $request->purchase_qty * $inventory->price;
        $profit = $request->purchase_qty * $inventory->profit;
        $userid = auth()->user()->id;

        $order = new Order();
        $order->inventory_id = $inventory->id;
        $order->purchase_qty = $request->purchase_qty;
        $order->total = $total;
        $order->profit = $profit;
        $order->user_id = $userid;
        $order->save();

        Inventory::where('id', $inventory->id)->decrement('stock', $request->purchase_qty);
        Inventory::where('id', $inventory->id)->increment('sales', $request->purchase_qty);

        return response()->json(['success' => 'Order Successfully Inserted.']);

    }
}
