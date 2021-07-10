<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocationTransfer;
use App\Models\Location;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class LocationTransferController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('location_transfer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $locations = Location::where('isRemove', 0)->latest()->get();
        return view('admin.locationtransfer.locationtransfer',compact('locations'));
    }

    
    public function locationfrom(Request $request, $location)
    {
        $location_from = Inventory::where('isRemove', 0)->where('location_id', $location)->latest()->get();
        return view('admin.locationtransfer.loadlocationfrom', compact('location_from'));
    }
    public function locationto(Request $request, $location)
    {
        $location_to = Inventory::where('isRemove', 0)->where('location_id', $location)->latest()->get();
        return view('admin.locationtransfer.loadlocationto', compact('location_to'));
    }



    public function store(Request $request)
    {
        
    }

    
    public function show(LocationTransfer $locationTransfer)
    {
        
    }

    
    public function edit(LocationTransfer $locationTransfer)
    {
        
    }

    
    public function update(Request $request, LocationTransfer $locationTransfer)
    {
        
    }

   
    public function destroy(LocationTransfer $locationTransfer)
    {
        
    }
}
