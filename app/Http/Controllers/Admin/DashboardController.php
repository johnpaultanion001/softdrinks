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

class DashboardController extends Controller
{
    public function dashboard(){

      abort_if(Gate::denies('dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
      return view('admin.dashboard');

    }
    public function loaddashboard(){
      date_default_timezone_set('Asia/Manila');
      
      $allproducts = Inventory::all();
      $productsmonthly = Inventory::whereMonth('created_at', '=', date('m'))->get();

      $outofstock = Inventory::where('stock', '0')->get();
      $outofstockmonthly = Inventory::where('stock', '0')
                                     ->whereMonth('created_at', '=', date('m'))->get();
      $salesmonthly = Sales::whereMonth('created_at', '=', date('m'))->get();

      $allprofit = Sales::all();
      $profitmonthly = Sales::whereMonth('created_at', '=', date('m'))->get(); 
      
      $newproduct = Inventory::latest()->paginate(5);
      $salestoday = Sales::whereDay('created_at', '=', date('d'))->get();
      return view('admin.loaddashboard', compact('allproducts', 'productsmonthly' , 'outofstock', 'outofstockmonthly', 'salesmonthly', 'allprofit','profitmonthly', 'newproduct','salestoday'));
    }

}
