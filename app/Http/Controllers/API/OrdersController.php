<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Orders::paginate(10);
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
            'title' => 'required|string|max:125',
            'price' => 'required',
            'quantity' => 'required',
            'description' => 'required|string|max:125',
        ]);

        $order = new Orders();
        $order->title = $request->title;
        $order->price = $request->price;
        $order->quantity = $request->quantity;
        $order->Description = $request->description;
        $order->save();

        return response(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        $this->validate($request, [
            'title' => 'required|string|max:125',
            'price' => 'required/integer',
            'qty' => 'required|integer',
            'description' => 'required|string|max:125',
        ]);

        $order = Orders::findOrFail($id);
        $order->title = $request->title;
        $order->price = $request->price;
        $order->qty = $request->qty;
        $order->Description = $request->description;
        $order->save();

        return response(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Orders::FindOrFail($id);

        $orders->delete();

        return ['message' => 'Order Deleted'];
    }
}
