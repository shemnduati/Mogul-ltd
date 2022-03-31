<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\VehicleStatus;


class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::get();
        $parent = array();
        foreach ($vehicles as $vehicle) {
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
            'location' => 'required|string|max:125',
            'status' => 'required|string|max:125',
        ]);

        $vehicle = new Vehicle();
        $vehicle ->Vehicle_Type = $request->type;
        $vehicle ->Vehicle_Model = $request->model;
        $vehicle ->Vehicle_Reg_No = $request->registration;
        $vehicle ->location_id = $request->location;
        $vehicle ->vehicle_status_id = $request->status;
        $vehicle ->save();

        return response(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return Vehicle::paginate(10);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required|string|max:125',
            'model' => 'required|string|max:125',
            'registration' => 'required|string|max:125',
            'location' => 'required|string|max:125',
            'status' => 'required|string|max:125',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle ->Vehicle_Type = $request->type;
        $vehicle ->Vehicle_Model = $request->model;
        $vehicle ->Vehicle_Reg_No = $request->registration;
        $vehicle ->location_id = $request->location;
        $vehicle ->vehicle_status_id = $request->status;
        $vehicle ->save();

        return response(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::FindOrFail($id);

        $vehicle ->delete();

        return ['message' => 'status Deleted'];
    }
}
