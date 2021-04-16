<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index()
    {
        return view('admin.sales.sales');
    }
    public function loadsales()
    {
        $sales = Sales::latest()->get();
        return view('admin.sales.loadsales', compact('sales'));
    }
    public function daily(){
        date_default_timezone_set('Asia/Manila');
        $sales = Sales::whereDay('created_at', '=', date('d'))
                        ->get();
        return view('admin.sales.loadsales', compact('sales'));
    }
    public function monthly(){
        date_default_timezone_set('Asia/Manila');
        $sales = Sales::whereMonth('created_at', '=', date('m'))
                        ->get();
                        
        return view('admin.sales.loadsales', compact('sales'));
    }
    public function yearly(){
        date_default_timezone_set('Asia/Manila');
        $sales = Sales::whereYear('created_at', '=', date('Y'))
                        ->get();
        return view('admin.sales.loadsales', compact('sales'));
    }
 
    function fetch_data(Request $request)
    {
     if($request->ajax())
        {
            if($request->from_date != '' && $request->to_date != '')
            {
                $sales = Sales::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
            }
            
            return view('admin.sales.loadsales', compact('sales'));
        }
    }
}
