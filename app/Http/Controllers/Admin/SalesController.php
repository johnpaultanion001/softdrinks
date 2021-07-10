<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\OrderNumber;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index()
    {
        return view('admin.sales.sales');
    }
    public function loadsales()
    {
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        if($userid == '2'){
            $sales = Sales::where('user_id', $userid)->where('isRemove', 0)->latest()->get();
            return view('admin.sales.loadsales', compact('sales'));
        }
        $sales = Sales::where('isRemove', 0)->latest()->get();
        return view('admin.sales.loadsales', compact('sales'));
    }
    public function daily(){
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
       

        if($userid == '2'){
            $sales = Sales::where('user_id', $userid)->where('isRemove', 0)->latest()->whereDay('created_at', '=', date('d'))
            ->get();
            return view('admin.sales.loadsales', compact('sales'));
        }
        $sales = Sales::where('isRemove', 0)->latest()->whereDay('created_at', '=', date('d'))->get();
        return view('admin.sales.loadsales', compact('sales'));
    }
    public function monthly(){
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        if($userid == '2'){
            $sales = Sales::where('user_id', $userid)->where('isRemove', 0)->latest()->whereMonth('created_at', '=', date('m'))
                        ->get();
            return view('admin.sales.loadsales', compact('sales'));
        }
        $sales = Sales::where('isRemove', 0)->latest()->whereMonth('created_at', '=', date('m'))
                        ->get();
        return view('admin.sales.loadsales', compact('sales'));
    }
    public function yearly(){
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        if($userid == '2'){
            $sales = Sales::where('user_id', $userid)->where('isRemove', 0)->latest()->whereYear('created_at', '=', date('Y'))
            ->get();
            return view('admin.sales.loadsales', compact('sales'));
        }
        $sales = Sales::where('isRemove', 0)->latest()->whereYear('created_at', '=', date('Y'))
                        ->get();
        return view('admin.sales.loadsales', compact('sales'));
    }
 
    function fetch_data(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $userid = auth()->user()->roles()->getQuery()->pluck('id')->first();
        if($userid == '2'){
            if($request->ajax())
            {
                if($request->from_date != '' && $request->to_date != '')
                {
                    $sales = Sales::where('user_id', $userid)->where('isRemove', 0)->latest()->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
                return view('admin.sales.loadsales', compact('sales'));
            }
        }

        if($request->ajax())
            {
                if($request->from_date != '' && $request->to_date != '')
                {
                    $sales = Sales::where('isRemove', 0)->latest()->whereBetween('created_at', array($request->from_date, $request->to_date))->get();
                }
                return view('admin.sales.loadsales', compact('sales'));
            }
    }
    public function receipt(Sales $sale)
    {
       date_default_timezone_set('Asia/Manila');
       $receipts = Sales::where('isRemove', 0)->where('order_number',$sale->order_number)->latest()->get();
       $date = date('F d,Y h:i A');
       return view('admin.sales.receiptmodal', compact('receipts', 'date' ));
    }
}
