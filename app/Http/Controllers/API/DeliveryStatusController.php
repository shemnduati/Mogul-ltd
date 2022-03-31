<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeliveryStatus;
use Illuminate\Http\Request;

class DeliveryStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeliveryStatus::paginate(10);
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

        $status = new DeliveryStatus();
        $status->status = $request->status;
        $status->save();

        return response(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryStatus  $deliveryStatus
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryStatus $deliveryStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryStatus  $deliveryStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryStatus $deliveryStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryStatus  $deliveryStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveryStatus $deliveryStatus)
    {
        
        $this->validate($request, [
            'status' => 'required',
        ]);

        $status = DeliveryStatus::findOrFail($id);
        $status ->status = $request->status;
        $status ->update();
        return response(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryStatus  $deliveryStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryStatus $deliveryStatus)
    {
        $status = DeliveryStatus::FindOrFail($id);

        $status->delete();

        return ['message' => 'status Deleted'];
    }
}
