<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UCS;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class UCSController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('ucs_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.UCS.ucs');
    }
    public function load()
    {
        $totalucs = UCS::where('isRemove', 0)->where('isPurchase', 1)->latest()->get();
        return view('admin.UCS.load', compact('totalucs'));
    }
   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
