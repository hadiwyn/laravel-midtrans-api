<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('home');
    }

    // public function checkout(Request $request)
    // {

    //     // $id = rand();
    //     // $totalPrice = '100000';
    //     // $qty = Order::find($qty);
    //     // $name = Order::find($name);
    //     // $phone = Order::find($phone);

    //     $request->request->add(['total_price' => $request->qty * 50000, 'status' => 'Unpaid']);
    //     $order = Order::create($request->all());


    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = config('midtrans.is_production');
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;

    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' => $order->id,
    //             'gross_amount' => $order->total_price,
    //         ),
    //         'customer_details' => array(
    //             'first_name' => $request->name,
    //             'last_name' => '',
    //             'phone' => $request->phone,
    //         ),
    //     );

    //     $snapToken = \Midtrans\Snap::getSnapToken($params);
    //     return view('checkout', compact('snapToken', 'order'));



    // }

    public function checkout(Request $request)
{
    $id = $request->input('transaction_id');
    $nama = $request->input('nama');
    $tour_name = $request->input('tourname');
    $harga = $request->input('harga');
    $telepon = $request->input('telepon');
    $qty = $request->input('quantity');
    $date_visit = $request->input('date_visit');
    $date_add = $request->input('date_add');

    // hitung total harga
    $totalPrice = $harga * $qty;

    // buat order baru
    $order = new Order();
    $order->id = $id;
    $order->name = $nama;
    $order->tour_name = $tour_name;
    $order->price = $harga;
    $order->total_price = $totalPrice;
    $order->phone = $telepon;
    $order->qty = $qty;
    $order->date_visit = $date_visit;
    $order->date_add = $date_add;
    $order->status = 'Unpaid';
    $order->save();



    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;

    $params = array(
        'transaction_details' => array(
            'order_id' => $id,
            'gross_amount' => $totalPrice,
        ),
        'customer_details' => array(
            'first_name' => $nama,
            'last_name' => '',
            'phone' => $telepon,
        ),
    );

    $snapToken = \Midtrans\Snap::getSnapToken($params);
    return view('checkout', compact('snapToken', 'order'));
}


    public function callback(Request $request)
    {
        $server_key = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $server_key);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }

    public function invoice($id) {
        $order = Order::find($id);
        return view('invoice', compact('order'));
    }
    public function ticket($id) {
        $order = Order::find($id);
        return view('ticket', compact('order'));
    }

    public function success() {
        return view('success');
    }

}
