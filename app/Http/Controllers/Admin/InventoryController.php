<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\PurchaseOrder;
use App\Models\Size;
use App\Models\Supplier;
use App\Models\UCS;
use App\Models\Location;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class InventoryController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('inventories_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        $suppliers = Supplier::where('isRemove', 0)->latest()->get();
        $purchaseorder = PurchaseOrder::where('isReturn', 0)->latest()->get();
        $allpurchaseorder = PurchaseOrder::latest()->get();
        $sizes = Size::where('isRemove', 0)->latest()->get();
        return view('admin.inventories.inventories',compact('categories','purchaseorder', 'allpurchaseorder', 'sizes' ,'locations'  ,'suppliers'));
    }
    public function loadinventories()
    {
        $inventories = Inventory::where('isRemove', 0)->latest()->get();
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        return view('admin.inventories.loadinventories', compact('categories','inventories' ,'locations'));
    }


  
    public function filter(Request $request){
        //filter

        
        $query = Inventory::query();

        if($request->get('category'))
        {
            $query->where('category_id', $request->get('category'));
        }
        if($request->get('location'))
        {
            $query->where('location_id', $request->get('location'));
            
        }
        if($request->get('supplier'))
        {
            $query->where('supplier_id', $request->get('supplier'));
        }
        if($request->get('size'))
        {
            $query->where('size_id', $request->get('size'));
        }
        
        
        $inventories = $query->where('isRemove', 0)->latest()->get();
        
        $categories = Category::where('isRemove', 0)->latest()->get();
        $locations = Location::where('isRemove', 0)->latest()->get();
        return view('admin.inventories.loadinventories', compact('categories','inventories' ,'locations'));

    }


    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'purchase_order_number_id' => ['required'],
            'category_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required' ,'integer','min:1'],
            'size_id' => ['required'],
            'expiration' => ['required' ,'date','after:today'],
            'purchase_amount' => ['required' ,'integer','min:1'],
            'profit' => ['required' ,'integer','min:1'],
            'product_remarks' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $price = $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;

        $userid = auth()->user()->id;
        $product = Inventory::create([
            'category_id' => $request->input('category_id'),
            'purchase_order_number_id' => $request->input('purchase_order_number_id'),
            'name' => $request->input('name'),
            'stock' => $request->input('stock'),
            'qty' => $request->input('stock'),
            'size_id' => $request->input('size_id'),
            'expiration' => $request->input('expiration'),
            'purchase_amount' => $request->input('purchase_amount'),
            'profit' => $request->input('profit'),
            'price' => $price,
            'total_amount_purchase' => $total_amount_purchase,
            'total_profit' => $total_profit,
            'total_price' => $total_price,
            'product_remarks' => $request->input('product_remarks'),
            'product_number' =>  time().'-'.$userid,
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
        $ucs = Size::where('id', $request->input('size_id'))->firstorfail();
        $ucs_percase = $ucs->ucs * $request->input('stock');
        UCS::create([
            'purchase_order_number_id' => $request->input('purchase_order_number_id'),
            'inventory_id' => $product->product_number,
            'ucs' => $ucs_percase,
            'case' => $product->stock,
            'isPurchase' => 1,
        ]);

        return response()->json(['success' => 'Product Added Successfully.']);
    }


    public function show(Inventory $inventory)
    {
        return view('admin.ordering.viewmodal', compact('inventory'));
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
            'size_id' => ['required'],
            'expiration' => ['required' ,'date','after:today'],
            'purchase_amount' => ['required' ,'integer','min:1'],
            'profit' => ['required' ,'integer','min:1'],
            
            'product_remarks' => ['nullable'],
           
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
            'qty' => $request->input('stock'),
            'size_id' => $request->input('size_id'),
            'expiration' => $request->input('expiration'),
            'purchase_amount' => $request->input('purchase_amount'),
            'profit' => $request->input('profit'),
            'price' => $price,
            'total_amount_purchase' => $total_amount_purchase,
            'total_profit' => $total_profit,
            'total_price' => $total_price,
            'product_remarks' => $request->input('product_remarks'),
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

        $ucs = Size::where('id', $request->input('size_id'))->firstorfail();
        $ucs_percase = $ucs->ucs * $request->input('stock');
        UCS::where('inventory_id',$inventory->product_number)->update([
            'ucs' => $ucs_percase,
            'case' =>  $request->input('stock'),
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
