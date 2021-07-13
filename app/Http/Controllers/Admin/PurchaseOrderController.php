<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Inventory;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Size;
use App\Models\UCS;
use App\Models\Location;
use App\Models\PendingProduct;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $products = PendingProduct::latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();
        return view('admin.purchaseorders.purchaseorders', compact('suppliers','products','categories','sizes','locations'));
    }
    public function total()
    {
        $products = PendingProduct::latest()->get();
        return view('admin.purchaseorders.alltotal', compact('products'));
    }
    public function load()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orders = PurchaseOrder::latest()->get();
        return view('admin.purchaseorders.loadpurchaseorders', compact('orders'));
    }

    public function view(PurchaseOrder $purchasenumber)
    {
        $orders = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        return view('admin.purchaseorders.viewmodal', compact('orders', 'suppliers', 'purchasenumber'));
    }
    public function edit(PurchaseOrder $purchasenumber)
    {
        $orders = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $purchaseorder = PurchaseOrder::latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();
        return view('admin.purchaseorders.editpurchase.edit', compact('orders', 'suppliers' , 'categories' , 'purchaseorder', 'purchasenumber' , 'sizes' , 'locations'));
    }
    public function loadedit(PurchaseOrder $purchasenumber)
    {
        $orders = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $purchasenumber->purchase_order_number)->get();
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $purchaseorder = PurchaseOrder::latest()->get();
        return view('admin.purchaseorders.editpurchase.load', compact('orders', 'suppliers' , 'categories' , 'purchaseorder', 'purchasenumber'));
    }
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'supplier_id' => ['required'],
            'name_of_a_driver' => ['required'],
            'plate_number' => ['required'],
            'remarks' => ['nullable'],

            'doc_no' => ['nullable'],
            'entry_date' => ['required' , 'date', 'after:yesterday'],
            'po_no' => ['nullable'],
            'po_date' => ['required' , 'date' ,'after:yesterday'],
            'location_id' => ['required'],
            'reference' => ['nullable'],

            'trade_discount' => ['nullable'],
            'terms_discount' => ['nullable'],
        ]);

        
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $products = PendingProduct::all()->count();
        if($products < 1){
            return response()->json(['nodata' => 'No available Product.']);
        }

        $purchaseorderid = PurchaseOrder::orderby('id', 'desc')->firstorfail();
        $id = $purchaseorderid->purchase_order_number + 1;
        $userid = auth()->user()->id;

        $totalpurchasedorder = PendingProduct::sum('total_amount_purchase');
        $totalprofit = PendingProduct::sum('total_profit');
        $totalprice = PendingProduct::sum('total_price');
        UCS::where('purchase_order_number_id', $id)->update([
            'isPurchase' => '1',
        ]);
        PurchaseOrder::create([
            'user_id' => $userid,
            'supplier_id' => $request->input('supplier_id'),
            'name_of_a_driver' => $request->input('name_of_a_driver'),
            'plate_number' => $request->input('plate_number'),
            'purchase_order_number' => $id,
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
            'total_orders' => $products,
            'remarks' => $request->input('remarks'),

            'doc_no' => $request->input('doc_no'),
            'entry_date' => $request->input('entry_date'),
            'po_no' => $request->input('po_no'),
            'po_date' => $request->input('po_date'),
            'location_id' => $request->input('location_id'),
            'reference' => $request->input('reference'),
            'trade_discount' => $request->input('trade_discount'),
            'terms_discount' => $request->input('terms_discount'),
        ]);

        PendingProduct::latest()->update([
            'location_id' => $request->input('location_id'),
            'supplier_id' => $request->input('supplier_id'),
        ]);
        
        PendingProduct::query()
        ->latest()
        ->each(function ($oldRecord) {
            $newPost = $oldRecord->replicate();
            $newPost->setTable('inventories');
            $newPost->save();
        });
        PendingProduct::latest()->delete();



        return response()->json(['success' => 'Added Purchased Order Successfully.']);
    }
    public function update(Request $request,PurchaseOrder $purchasenumber)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'supplier_id' => ['required'],
            'notes' => ['nullable'],
            'name_of_a_driver' => ['required'],
            'plate_number' => ['required'],

            'doc_no' => ['nullable'],
            'entry_date' => ['required' , 'date'],
            'po_no' => ['nullable'],
            'po_date' => ['required' , 'date'],
            'location_id' => ['required'],
            'reference' => ['nullable'],

            'trade_discount' => ['nullable'],
            'terms_discount' => ['nullable'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $userid = auth()->user()->id;
        $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->sum('total_amount_purchase');
        $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->sum('total_profit');
        $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->sum('total_price');
        $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->count();
        
        PurchaseOrder::find($purchasenumber->id)->update([
            'user_id' => $userid,
            'supplier_id' => $request->input('supplier_id'),
            'name_of_a_driver' => $request->input('name_of_a_driver'),
            'plate_number' => $request->input('plate_number'),
            'purchase_order_number' => $request->input('purchase_order_number'),
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
            'total_orders' => $products,
            'remarks' => $request->input('remarks'),

            'doc_no' => $request->input('doc_no'),
            'entry_date' => $request->input('entry_date'),
            'po_no' => $request->input('po_no'),
            'po_date' => $request->input('po_date'),
            'location_id' => $request->input('location_id'),
            'reference' => $request->input('reference'),
            'trade_discount' => $request->input('trade_discount'),
            'terms_discount' => $request->input('terms_discount'),
        ]);

        Inventory::where('isRemove', 0)->where('purchase_order_number_id',$request->input('purchase_order_number'))->update([
            'supplier_id' => $request->input('supplier_id'),
        ]);

        return response()->json(['success' => 'Purchased Order Updated Successfully.']);
    }
}
