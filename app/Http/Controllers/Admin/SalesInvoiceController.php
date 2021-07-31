<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoice;
use App\Models\Order;
use App\Models\OrderSales;
use App\Models\SalesReturn;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\OrderNumber;
use App\Models\PriceType;

use Validator;
use DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SalesInvoiceController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('ordering_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        date_default_timezone_set('Asia/Manila');

        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $customers = Customer::where('isRemove', '0')->latest()->get();
        $orders = Order::where('status', '0')->latest()->get();
        $pricetypes = PriceType::where('isRemove', '0')->latest()->get();
        $product_codes = Inventory::latest()->get();

        $returned = SalesReturn::where('isRemove', 0)->where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        $date = date("F d,Y h:i A");


        return view('admin.salesinvoice.salesinvoice', compact('customers' , 'orders' , 'pricetypes' , 'salesinvoice_id' , 'returned' , 'product_codes' ,'date'));
    }

    public function alltotal(){
        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $orders = Order::where('status', '0')->latest()->get();
        $returned = SalesReturn::where('isRemove', 0)->where('salesinvoice_id', $salesinvoice_id)->latest()->get();

        return view('admin.salesinvoice.alltotal', compact('orders', 'returned'));
    }

    public function sales()
    {
        date_default_timezone_set('Asia/Manila');
        $orders = Order::where('status', '0')->latest()->get();
        return view('admin.salesinvoice.sales', compact('orders'));
    }

    public function return()
    {
        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id;

        $returned = SalesReturn::where('isRemove', 0)->where('salesinvoice_id', $salesinvoice_id)->latest()->get();
        return view('admin.salesinvoice.return', compact('returned'));
    }

    public function productlist(){
        date_default_timezone_set('Asia/Manila');
        $inventories = Inventory::where('isRemove', 0)->where('stock' , '>' , 0)->where('location_id', 2)->whereDate('expiration' , '>' ,date('Y-m-d', strtotime('-1 day')))->orderBy('expiration', 'ASC')->get();
        return view('admin.salesinvoice.productlist', compact('inventories'));
    }

    public function receipt()
    {
        date_default_timezone_set('Asia/Manila');
        $receipts = Order::where('status', '0')->latest()->get();

        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id ;

        return view('admin.salesinvoice.receiptmodal', compact('receipts', 'salesinvoice_id'));
    }
   
   
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'doc_no' => ['required', 'string', 'max:255'],
            'entry_date' => ['required' ,'date','after:yesterday'],
            'remarks' => ['nullable'],
            'customer_id' => ['required'],
            'cash' => ['required' ,'integer','min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $orders = Order::all()->count();
        if($orders < 1){
            return response()->json(['nodata' => 'NO DATA AVAILABLE IN SALES TABLE']);
        }

        $total_sales = Order::sum('total');
        if($request->input('cash') < $total_sales)
        {
            return response()->json(['invalidcash' => 'CASH FIELD MUST BE GREATER THAN TO THE TOTAL AMOUNT ('.$total_sales.')']);
        }

        return response()->json(['print'  => 'PRINT']);
    }

    public function storeandcheckout(Request $request){
        date_default_timezone_set('Asia/Manila');
        Order::latest()->update([
            'customer_id' => $request->get('customer_id'),
        ]);


        $ordernumber = OrderNumber::orderby('id', 'desc')->firstorfail();
        $salesinvoice_id = $ordernumber->salesinvoice_id ;

        $total_amount = Order::sum('total');
        $subtotal = Order::sum('total_amount_receipt');
        $total_discounted = Order::sum('discounted');
        $total_return = SalesReturn::where('isRemove', 0)->sum('amount');

        SalesInvoice::create([
            'salesinvoice_id' =>  $salesinvoice_id,
            'doc_no' =>  $request->get('doc_no'),
            'entry_date' =>  $request->get('entry_date'),
            'remarks' =>  $request->get('remarks'),
            'customer_id' => $request->get('customer_id'),

            'subtotal' =>  $subtotal,
            'total_discount' =>   $total_discounted,
            'total_amount' => $total_amount,

            'total_return' => $total_return,
            'prev_bal' => $request->get('prev_bal'),
            'total_inv_amt' => $total_amount,
            'cash' => $request->get('cash'),
            'new_bal' => $total_amount,
        ]);

        $order_number_id = $ordernumber->order_number;
        $total_profit = Order::sum('profit');
        $total_cost = Order::sum('total_cost');
        $total_qty = Order::sum('purchase_qty');

        OrderSales::create([
            'order_number_id' => $order_number_id,
            'total_profit' => $total_profit,
            'total_sales' => $total_amount,
            'total_cost' => $total_cost,
            'customer_id' => $request->get('customer_id'),
            'total_qty' => $total_qty,
            'subtotal' => $subtotal,
            'total' => $total_amount,
        ]);

        $ids = Order::pluck('inventory_id');
        Inventory::whereIn('id' , $ids)->update([
            'stock' => DB::raw ('stock - orders'),
            'sold' => DB::raw ('sold + orders'),
            'orders' => 0,
        ]);

        $passdata = Order::query()
        ->each(function ($oldRecord) {
                $newPost = $oldRecord->replicate();
                $newPost->setTable('sales');
                $newPost->save();
        });

       
        if($passdata){
            Order::truncate();
            OrderNumber::where('id', 1)->increment('order_number', 1);
            OrderNumber::where('id', 1)->increment('salesinvoice_id', 1);

            return response()->json(['success' => 'Successfully Check Out.']);
        }

       


    }

    public function change(Request $request)
    {
        if($request->ajax()){
            $total_amount = Order::sum('total');
            $change = $request->changee - $total_amount;
            
            return response()->json(['success' =>  number_format($change , 2, '.', ',')]);
            
        }
    }
    public function allrecords(){
        date_default_timezone_set('Asia/Manila');

        $allrecords = SalesInvoice::latest()->get();
        return view('admin.salesinvoice.allrecords', compact('allrecords'));
    }

    
    public function show(SalesInvoice $salesInvoice)
    {
       
    }

    
    public function edit(SalesInvoice $salesInvoice)
    {
        
    }

    
    public function update(Request $request, SalesInvoice $salesInvoice)
    {
        
    }

    public function destroy(SalesInvoice $salesInvoice)
    {
    
    }
}
