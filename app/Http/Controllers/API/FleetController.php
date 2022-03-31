<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fleet;
use Illuminate\Http\Request;
use App\Location;
use App\VehicleStatus;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Fleet::get();
        $parent = array();
        foreach ($vehicle as $vehicles) {
            $id  = $vehicle['id'];
            $type = $vehicle['Vehicle_Type'];
            $model = $vehicle['Vehicle_Model'];
            $registration = $vehicle['Vehicle_Reg_No'];
            $location_id = $vehicle['location_id'];
            $status = $vehicle['vehicle_status_id'];
            $locationName = Location::where('id', $location_id)->value('location');
            $vehicleStatus = VehicleStatus::where('id', $status)->value('status');
            $child = array(
                'id' => $id,
                'type' => $type,
                'model' => $model,
                'registration' => $registration,
                'location' => $locationName,
                'status' => $vehicleStatus,
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
            'type' => 'required|string|max:125',
            'model' => 'required|string|max:125',
            'registration' => 'required|string|max:125',
            'location' => 'required',
            'status' => 'required',
        ]);

        $order = new Fleet();
        $vehicle->Vehicle_Reg_No = $request->registration;
        $vehicle->Vehicle_Type = $request->type;
        $vehicle->Vehicle_Model = $request->model;
        $vehicle->location_id = $request->location;
        $vehicle->Vehicle_status_id = $request->location;
        $vehicle->save();

        return response(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fleet  $fleet
     * @return \Illuminate\Http\Response
     */
    public function show(Fleet $fleet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fleet  $fleet
     * @return \Illuminate\Http\Response
     */
    public function edit(Fleet $fleet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fleet  $fleet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fleet $fleet)
    {
        $this->validate($request, [
            'type' => 'required|string|max:125',
            'model' => 'required|string|max:125',
            'registration' => 'required|string|max:125',
            'location' => 'required',
            'status' => 'required',
        ]);

        $vehicle = Fleet::findOrFail($id);
        $vehicle->Vehicle_Reg_No = $request->registration;
        $vehicle->Vehicle_Type = $request->type;
        $vehicle->Vehicle_Model = $request->model;
        $vehicle->location_id = $request->location;
        $vehicle->Vehicle_status_id = $request->location;
        $vehicle->save();

        return response(['status' => 'success'], 200);
        $this->validate($request, [
            'title' => 'required|string|max:125',
            'price' => 'required/integer',
            'qty' => 'required|integer',
            'description' => 'required|string|max:125',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fleet  $fleet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle= Fleet::FindOrFail($id);

        $vehicle->delete();

        return ['message' => 'vehicle Deleted'];
    }
}
