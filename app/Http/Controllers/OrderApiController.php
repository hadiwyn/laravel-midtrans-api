<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function index() {
        $product = Order::all();
        // dd($product);
        return response()->json(['message' => 'success', 'data' => $product]);
    }

    public function show($id)
    {
        $product = Order::find($id);
        return response()->json(['message' => 'Success', 'data' => $product]);
    }

    public function store(request $request)
    {
        $product = Order::create($request->all());
        return response()->json(['message' => 'Success', 'Data' => $product]);
    }

    public function update(request $request, $id)
    {
        $product = Order::find($id);
        $product->update($request->all());
        return response()->json(['Message' => 'Success', 'Data' => $product]);
    }

    public function destroy($id)
    {
        $product = Order::find($id);
        $product->delete();
        return response()->json(['Message' => 'Success', 'data' => null]);
    }

}
