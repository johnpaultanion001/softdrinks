<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendingReturnedProduct;
use App\Models\PurchaseOrder;
use App\Models\Returned;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PendingReturnedProductController extends Controller
{
   
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'status_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'deposit' => ['required' ,'integer','min:1'],
            'case' => ['required' ,'integer','min:1'],
            'note' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        PendingReturnedProduct::create([
            'return_id' => '1',
            'purchase_order_number_id' => $request->input('purchase_order_number_id'),
            'status_id' => $request->input('status_id'),
            'name' => $request->input('name'),
            'case' => $request->input('case'),
            'deposit' => $request->input('deposit'),
            'note' => $request->input('note'),
        ]);
        return response()->json(['success' => 'Returned Product Added Successfully.']);
    }
    public function storeedit(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'status_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'deposit' => ['required' ,'integer','min:1'],
            'case' => ['required' ,'integer','min:1'],
            'note' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        PendingReturnedProduct::create([
            'return_id' => '1',
            'purchase_order_number_id' => $request->input('purchase_order_number_id'),
            'status_id' => $request->input('status_id'),
            'name' => $request->input('name'),
            'case' => $request->input('case'),
            'deposit' => $request->input('deposit'),
            'note' => $request->input('note'),
        ]);
        $totalcase = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('case');
        $totaldeposit = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('deposit');
        $totalproduct = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->count();
       
        Returned::find($request->input('hidden_id'))->update([
            'total_case_return' => $totalcase,
            'total_deposit' => $totaldeposit,
            'total_orders_returned' => $totalproduct,
        ]);

        return response()->json(['success' => 'Returned Product Added Successfully.']);
    }

    public function show(PendingReturnedProduct $pendingreturnedproduct)
    {
        //
    }
     public function edit(PendingReturnedProduct $pendingreturnedproduct)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $pendingreturnedproduct]);
        }
    }

    public function update(Request $request, PendingReturnedProduct $pendingreturnedproduct)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'status_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'deposit' => ['required' ,'integer','min:1'],
            'case' => ['required' ,'integer','min:1'],
            'note' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        PendingReturnedProduct::find($pendingreturnedproduct->id)->update([
            'return_id' => '1',
            'purchase_order_number_id' => $request->input('purchase_order_number_id'),
            'status_id' => $request->input('status_id'),
            'name' => $request->input('name'),
            'case' => $request->input('case'),
            'deposit' => $request->input('deposit'),
            'note' => $request->input('note'),
        ]);
        return response()->json(['success' => 'Returned Product Updated Successfully.']);
    }
    public function updateedit(Request $request, PendingReturnedProduct $pendingreturnedproduct)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'status_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'deposit' => ['required' ,'integer','min:1'],
            'case' => ['required' ,'integer','min:1'],
            'note' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        PendingReturnedProduct::find($pendingreturnedproduct->id)->update([
            'return_id' => '1',
            'purchase_order_number_id' => $request->input('purchase_order_number_id'),
            'status_id' => $request->input('status_id'),
            'name' => $request->input('name'),
            'case' => $request->input('case'),
            'deposit' => $request->input('deposit'),
            'note' => $request->input('note'),
        ]);
        $totalcase = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('case');
        $totaldeposit = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->sum('deposit');
        $totalproduct = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $request->input('purchase_order_number_id'))->count();
       
        Returned::find($request->input('hidden_id'))->update([
            'total_case_return' => $totalcase,
            'total_deposit' => $totaldeposit,
            'total_orders_returned' => $totalproduct,
        ]);
        return response()->json(['success' => 'Returned Product Updated Successfully.']);
    }
    public function destroy(PendingReturnedProduct $pendingreturnedproduct)
    {
        PendingReturnedProduct::find($pendingreturnedproduct->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Returned Product Removed Successfully.']);
    }
    public function destroyedit(PendingReturnedProduct $pendingreturnedproduct)
    {
        PendingReturnedProduct::find($pendingreturnedproduct->id)->update([
            'isRemove' => '1',
        ]);

        $totalcase = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $pendingreturnedproduct->purchase_order_number_id)->sum('case');
        $totaldeposit = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $pendingreturnedproduct->purchase_order_number_id)->sum('deposit');
        $totalproduct = PendingReturnedProduct::where('isRemove', 0)->where('purchase_order_number_id', $pendingreturnedproduct->purchase_order_number_id)->count();
       
        Returned::where('purchase_order_number_id',$pendingreturnedproduct->purchase_order_number_id)->update([
            'total_case_return' => $totalcase,
            'total_deposit' => $totaldeposit,
            'total_orders_returned' => $totalproduct,
        ]);
        return response()->json(['success' => 'Returned Product Removed Successfully.']);
    }
}
