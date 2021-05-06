<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class InventoryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('inventories_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::latest()->get();
        $purchaseorder = PurchaseOrder::where('isReturn', 0)->latest()->get();
        $allpurchaseorder = PurchaseOrder::latest()->get();
        return view('admin.inventories.inventories',compact('categories','purchaseorder', 'allpurchaseorder'));
    }
    public function loadinventories()
    {
        $inventories = Inventory::where('isRemove', 0)->latest()->get();
        $categories = Category::latest()->get();
        return view('admin.inventories.loadinventories', compact('categories','inventories'));
    }


  
    public function create()
    {
      
    }


    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'purchase_order_number_id' => ['required'],
            'category_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],

            'stock' => ['required' ,'integer','min:1'],
            'pcs' => ['required' ,'integer','min:1'],

            'size' => ['required', 'string', 'max:255'],
            'expiration' => ['required' ,'date','after:today'],
            
            'purchase_amount' => ['required' ,'integer','min:1'],
            'profit' => ['required' ,'integer','min:1'],
            
            'note' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $price = $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;
        Inventory::create([
            'category_id' => $request->input('category_id'),
            'purchase_order_number_id' => $request->input('purchase_order_number_id'),
            'name' => $request->input('name'),

            'stock' => $request->input('stock'),
            'pcs' => $request->input('pcs'),

            'size' => $request->input('size'),
            'expiration' => $request->input('expiration'),
            
            
            'purchase_amount' => $request->input('purchase_amount'),
            'profit' => $request->input('profit'),
            'price' => $price,

            'total_amount_purchase' => $total_amount_purchase,
            'total_profit' => $total_profit,
            'total_price' => $total_price,

            'note' => $request->input('note'),
        ]);

        $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('total_amount_purchase');
        $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('total_profit');
        $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('total_price');
        $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->count();

        PurchaseOrder::where('purchase_order_number',$request->input('purchase_order_number_id'))->update([
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
            'total_orders' => $products,
        ]);

        return response()->json(['success' => 'Product Added Successfully.']);
    }


    public function show(Inventory $inventory)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $inventory]);
        }
    }

  
    public function edit(Inventory $inventory)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $inventory]);
        }
    }

   
    public function update(Request $request, Inventory $inventory)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'purchase_order_number_id' => ['required'],
            'category_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],

            'stock' => ['required' ,'integer','min:1'],
            'pcs' => ['required' ,'integer','min:1'],

            'size' => ['required', 'string', 'max:255'],
            'expiration' => ['required' ,'date','after:today'],
            
            'purchase_amount' => ['required' ,'integer','min:1'],
            'profit' => ['required' ,'integer','min:1'],
            
            'note' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        //end
        $price = $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;
        
        Inventory::find($inventory->id)->update([
            'category_id' => $request->input('category_id'),
            'purchase_order_number_id' => $request->input('purchase_order_number_id'),
            'name' => $request->input('name'),

            'stock' => $request->input('stock'),
            'pcs' => $request->input('pcs'),

            'size' => $request->input('size'),
            'expiration' => $request->input('expiration'),
            
            
            'purchase_amount' => $request->input('purchase_amount'),
            'profit' => $request->input('profit'),
            'price' => $price,

            'total_amount_purchase' => $total_amount_purchase,
            'total_profit' => $total_profit,
            'total_price' => $total_price,

            'note' => $request->input('note'),
        ]);

        $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('total_amount_purchase');
        $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('total_profit');
        $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('total_price');
        $products = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->count();
        
        PurchaseOrder::where('purchase_order_number',$request->input('purchase_order_number_id'))->update([
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
            'total_orders' => $products,
        ]);

        return response()->json(['success' => 'Product Updated successfully.']);
    }

   
    public function destroy(Inventory $inventory)
    {
        Inventory::find($inventory->id)->update([
            'isRemove' => '1',
        ]);
        
        $totalpurchasedorder = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $inventory->purchase_order_number_id)->sum('total_amount_purchase');
        $totalprofit = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $inventory->purchase_order_number_id)->sum('total_profit');
        $totalprice = Inventory::where('isRemove', 0)->where('purchase_order_number_id', $inventory->purchase_order_number_id)->sum('total_price');
        
        PurchaseOrder::where('purchase_order_number',$inventory->purchase_order_number_id)->update([
            'total_purchased_order' => $totalpurchasedorder,
            'total_profit' => $totalprofit,
            'total_price' => $totalprice,
        ]);

        return response()->json(['success' => 'Product Removed Successfully.']);
    }
}
