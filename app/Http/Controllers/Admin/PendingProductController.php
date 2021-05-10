<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendingProduct;
use App\Models\PurchaseOrder;
use App\Models\UCS;
use App\Models\Size;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use datetime;


class PendingProductController extends Controller
{
    public function index()
    {
       
    }
   
    public function load()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pendingproducts = PendingProduct::latest()->get();
        return view('admin.purchaseorders.pendingproduct', compact('pendingproducts'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'category_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required' ,'integer','min:1'],
            'size_id' => ['required'],
            'expiration' => ['required' ,'date','after:today'],
            'purchase_amount' => ['required' ,'integer','min:1'],
            'profit' => ['required' ,'integer','min:1'],
            'note' => ['nullable'],  
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $price =  $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;

        $purchaseorderid = PurchaseOrder::orderby('id', 'desc')->firstorfail();
        $id = $purchaseorderid->purchase_order_number + 1;
        $userid = auth()->user()->id;

       $product = PendingProduct::create([
            'category_id' => $request->input('category_id'),
            'purchase_order_number_id' => $id,
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
            'note' => $request->input('note'),
            'product_number' =>  time().'-'.$userid,
        ]);
        $ucs = Size::where('id', $request->input('size_id'))->firstorfail();
        $ucs_percase = $ucs->ucs * $request->input('stock');

        UCS::create([
            'purchase_order_number_id' => $id,
            'inventory_id' => $product->product_number,
            'ucs' => $ucs_percase,
            'case' => $product->stock,
        ]);
        return response()->json(['success' => 'Product Added Successfully.']);

      
    }

    public function show($id)
    {
    }

    public function edit(PendingProduct $pending_product)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $pending_product]);
        }
    }

    public function update(Request $request, PendingProduct $pending_product)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'category_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],

            'stock' => ['required' ,'integer','min:1'],
            

            'size_id' => ['required'],
            'expiration' => ['required' ,'date','after:today'],
            
            'purchase_amount' => ['required' ,'integer','min:1'],
            'profit' => ['required' ,'integer','min:1'],
            
            'note' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $price =  $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;

        $purchaseorderid = PurchaseOrder::orderby('id', 'desc')->firstorfail();
        $id = $purchaseorderid->purchase_order_number + 1;

        PendingProduct::find($pending_product->id)->update([
            'category_id' => $request->input('category_id'),
            'purchase_order_number_id' => $id,
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
            'note' => $request->input('note'),
        ]);
        $ucs = Size::where('id', $request->input('size_id'))->firstorfail();
        $ucs_percase = $ucs->ucs * $request->input('stock');
      
        UCS::where('inventory_id',$pending_product->product_number)->update([
            'ucs' => $ucs_percase,
            'case' =>  $request->input('stock'),
        ]);

        return response()->json(['success' => 'Product Updated Successfully.']);
    }

    public function destroy(PendingProduct $pending_product)
    {
        return response()->json(['success' => 'Product Removed Successfully.' , $pending_product->delete()]);
    }
}
