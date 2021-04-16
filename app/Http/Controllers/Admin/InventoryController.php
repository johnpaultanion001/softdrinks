<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;


class InventoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.inventories.inventories',compact('categories'));
    }
    public function loadinventories()
    {
        $inventories = Inventory::latest()->get();
        $categories = Category::all();
        return view('admin.inventories.loadinventories', compact('categories','inventories'));
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
            'size' => ['required', 'string', 'max:255'],
            'price' => ['required' ,'integer','min:1'],
            'expiration' => ['required' ,'date','after:today'],
            'description' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Inventory::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'stock' => $request->input('stock'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'expiration' => $request->input('expiration'),
            'description' => $request->input('description'),
           
        ]);

        return response()->json(['success' => 'Product Added successfully.']);
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
            'category_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required' ,'integer','min:1'],
            'size' => ['required', 'string', 'max:255'],
            'price' => ['required' ,'integer','min:1'],
            'expiration' => ['required' ,'date','after:today'],
            'description' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Inventory::find($inventory->id)->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'stock' => $request->input('stock'),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'expiration' => $request->input('expiration'),
            'description' => $request->input('description'),
           
        ]);
        return response()->json(['success' => 'Product Updated successfully.']);
    }

   
    public function destroy(Inventory $inventory)
    {
        return response()->json(['success' => $inventory->delete()]);
    }
}
