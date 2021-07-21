<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendingProduct;
use App\Models\Inventory;
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

     function autocomplete(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = Inventory::where('product_code', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:absolute; margin-top: -20px; margin-left: 12px;">';
            foreach($data as $row)
            {
                $output .= '
                <li><a class="dropdown-item" href="#" class="text-dark">'.$row->product_code.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    function autocompleteresult(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = Inventory::where('product_code', 'LIKE', "%{$query}%")->get();
           
            foreach($data as $row)
            {
                return response()->json(['result' => $row , 'inventory_id' => $row->id]);
            }
        
        }
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
            'long_description' => ['required'],
            'short_description' => ['required'],
            'product_code' => ['required', 'string', 'max:255'],
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

        $price =  $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;

        $purchaseorderid = PurchaseOrder::orderby('id', 'desc')->firstorfail();
        $id = $purchaseorderid->purchase_order_number + 1;
        $userid = auth()->user()->id;

       $product = PendingProduct::create([
            
            'purchase_order_number_id' => $id,

            'category_id' => $request->input('category_id'),
            'long_description' => $request->input('long_description'),
            'short_description' => $request->input('short_description'),
            'product_code' => $request->input('product_code'),

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
            'product_id' => time().$userid,
           
        ]);
        $ucs = Size::where('id', $request->input('size_id'))->firstorfail();
        $ucs_percase = $ucs->ucs * $request->input('stock');

        UCS::create([
            'purchase_order_number_id' => $id,
            'inventory_id' => $product->product_id,
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
            'long_description' => ['required'],
            'short_description' => ['required'],

            'product_code' => ['required', 'string', 'max:255'],
            
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

        $price =  $request->input('purchase_amount') + $request->input('profit');
        $total_amount_purchase = $request->input('purchase_amount') * $request->input('stock');
        $total_profit = $request->input('profit') * $request->input('stock'); 
        $total_price = $total_amount_purchase + $total_profit;

        $purchaseorderid = PurchaseOrder::orderby('id', 'desc')->firstorfail();
        $id = $purchaseorderid->purchase_order_number + 1;

        PendingProduct::find($pending_product->id)->update([
            'category_id' => $request->input('category_id'),
            'purchase_order_number_id' => $id,
            'long_description' => $request->input('long_description'),
            'short_description' => $request->input('short_description'),
            'product_code' => $request->input('product_code'),

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
