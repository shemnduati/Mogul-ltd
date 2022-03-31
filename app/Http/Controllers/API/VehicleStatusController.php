<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VehicleStatus;
use Illuminate\Http\Request;

class VehicleStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function index()
    {
        return VehicleStatus::paginate(10);
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
            'status' => 'required|string|max:125',
        ]);

        $status = new VehicleStatus();
        $status->status = $request->status;
        $status->save();

        return response(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleStatus  $vehicleStatus
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleStatus $vehicleStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleStatus  $vehicleStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleStatus $vehicleStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleStatus  $vehicleStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleStatus $vehicleStatus)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $status = VehicleStatus::findOrFail($id);
        $status ->status = $request->status;
        $status ->update();
        return response(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleStatus  $vehicleStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = VehicleStatus::FindOrFail($id);

        $status->delete();

        return ['message' => 'status Deleted'];
    }
}
