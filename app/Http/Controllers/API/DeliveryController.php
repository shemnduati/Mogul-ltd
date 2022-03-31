<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Orders;
use App\Models\Location;
use App\Models\Vehicle;
use App\Models\DeliveryStatus;
class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::get();
        $parent = array();
        foreach ($deliveries as $delivery) {
            $id  = $delivery['id'];
            $orderId = $delivery['order_id'];
            $deliveryStatus = $delivery['delivery_status_id'];
            $vehicleId = $delivery['vehicle_id'];
            $locationId = $delivery['location_id'];
            $title = Orders::find($orderId)->title;
            $locationName = Location::where('id', $locationId)->value('location');
            $vehicleReg = Vehicle::where('id', $vehicleId)->value('Vehicle_Reg_No');
            $deliveryStatus = DeliveryStatus::where('id', $deliveryStatus)->value('status');
            $child = array(
                'id' => $id,
                'title' => $title,
                'registration' => $vehicleReg,
                'location' => $locationName,
                'status' => $deliveryStatus,
            );
            array_push($parent, $child);
        }
        return ['parent' => $parent];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'orderId' => 'required',
            'deliveryStatus' => 'required',
            'vehicleId' => 'required',
            'locationId' => 'required',
        ]);

        $delivery = new Delivery();
        $delivery->order_id = $request->orderId;
        $delivery->delivery_status_id = $request->deliveryStatus;
        $delivery->vehicle_id = $request->vehicleId;
        $delivery->location_id = $request->locationId;
        $delivery->delivery_date = $request->locationId;
        $delivery->save();

        return response(['status' => 'success'], 200);
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'orderId' => 'required',
            'deliveryStatus' => 'required',
            'vehicleId' => 'required',
            'locationId' => 'required',
        ]);

        $delivery =  Delivery::findOrFail($id);
        $delivery->order_id = $request->orderId;
        $delivery->delivery_status_id = $request->deliveryStatus;
        $delivery->vehicle_id = $request->vehicleId;
        $delivery->location_id = $request->locationId;
        $delivery->delivery_date = $request->locationId;
        $delivery->save();

        return response(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery = Delivery::FindOrFail($id);

        $delivery->delete();

        return ['message' => 'status Deleted'];
    }
}
