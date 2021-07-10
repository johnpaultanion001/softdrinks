<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use Validator;
use App\Models\Order;
use App\Models\Sales;
use App\Models\OrderNumber;
use App\Models\Customer;
use App\Models\PriceType;
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
        $customers = Customer::where('isRemove', '0')->latest()->get();
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        return view('admin.ordering.ordering', compact('categories','inventories' , 'orders','customers','pricetypes'));
    }
    public function loadproduct()
    {
        date_default_timezone_set('Asia/Manila');
        $inventories = Inventory::where('isRemove', 0)->where('stock' , '>' , 0)->whereDate('expiration' , '>' ,date('Y-m-d', strtotime('-1 day')))->orderBy('expiration', 'ASC')->get();
        $categories = Category::all();
        $orders = Order::where('status', '0')->get();
        return view('admin.ordering.loadproduct', compact('categories','inventories', 'orders'));
    }

    public function selectcustomer(Request $request,Customer $customer){
        if (request()->ajax()) {
            return response()->json(['result' => $customer]);
        }
    }
    public function selectpricetype(Request $request, PriceType $pricetype){
        if (request()->ajax()) {
            return response()->json(['result' => $pricetype]);
        }
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
        $customers = Customer::where('isRemove', '0')->latest()->get();
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $orderid = $ordernumber->order_number;

        return view('admin.ordering.checkoutmodal', compact('categories','inventories', 'orders', 'receipts' , 'date' ,'customers' , 'pricetypes' , 'orderid'));
    }
    public function checkout_order(Request $request){
        date_default_timezone_set('Asia/Manila');

        $orders = Order::all()->count();
        if($orders < 1){
            return response()->json(['nodata' => 'No data available']);
        }

        $orders1 = Order::all()->count();
        $discount =  PriceType::find($request->get('pricetype'));
        $discounted = $discount->discount / $orders1;

        Order::latest()->update([
            'customer_id' => $request->get('customer'),
            'pricetype_id' => $request->get('pricetype'),
            'discounted' => $discounted,
        ]);
        Order::latest()->decrement('profit', $discounted);
        Order::latest()->decrement('total', $discounted);


        $passdata = Order::query()
        ->each(function ($oldRecord) {
                $newPost = $oldRecord->replicate();
                $newPost->setTable('sales');
                $newPost->save();
        });

       
        if($passdata){
            Order::truncate();
            OrderNumber::where('id', 1)->increment('order_number', 1);
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
            $inventories = Inventory::where('long_description','LIKE','%'.$request->search."%")
                                    ->Orwhere('short_description','LIKE','%'.$request->search."%")
                                    ->Orwhere('price','LIKE','%'.$request->search."%")
                                    ->Orwhere('product_code','LIKE','%'.$request->search."%")
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

        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $id = $ordernumber->order_number;

        $total = $request->purchase_qty * $inventory->price;
        $profit = $request->purchase_qty * $inventory->profit;
        $total_cost = $request->purchase_qty * $inventory->purchase_amount;

        $userid = auth()->user()->id;

        $order = new Order();
        $order->inventory_id = $inventory->id;
        $order->purchase_qty = $request->purchase_qty;
        $order->total = $total;
        $order->profit = $profit;
        $order->user_id = $userid;
        $order->order_number = $id;
        $order->total_cost = $total_cost;

        $order->save();

        Inventory::where('id', $inventory->id)->decrement('stock', $request->purchase_qty);
        Inventory::where('id', $inventory->id)->increment('sold', $request->purchase_qty);

        return response()->json(['success' => 'Order Successfully Inserted.']);

    }
}
