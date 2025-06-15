<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
class TransaksiController extends Controller
{
    //


public function getToken(Request $request)
{
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;
    $plan = $request->query('plan');
    // dd($request->query());


    $harga = 0;
    switch ($plan) {
        case '1':
            $harga = 99000;
            break;
        case '6':
            $harga = 529000;
            break;
        case '12':
            $harga = 1049000;
            break;
        default:
            $harga = 49000;
            break;
    }

    $params = [
        'transaction_details' => [
            'order_id' => uniqid(),
            'gross_amount' => $harga,
        ],
        'customer_details' => [
            'first_name' => auth()->user()->name ?? 'Guest',
            'email' => auth()->user()->email ?? 'guest@example.com',
        ],
    ];

    $snapToken = Snap::getSnapToken($params);

    return response()->json(['token' => $snapToken]);
}

    public function createTransaction(Request $request)
{
    // Midtrans setup
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // Simulasi: Dapatkan user & paket
    $user = auth()->user();
    $plan = [
        'id' => 1,
        'price' => 49000,
        'name' => 'Premium 6 Bulan'
    ];

    $payload = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $plan['price'],
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
        ],
        'item_details' => [[
            'id' => $plan['id'],
            'price' => $plan['price'],
            'quantity' => 1,
            'name' => $plan['name']
        ]]
    ];

    $snapToken = Snap::getSnapToken($payload);
    $user = auth()->user(); // Pastikan ini adalah user yang sedang login
    $plan = $request->plan; // Ambil dari request, atau mapping manual

    $durasi = match($plan) {
        1 => 30, // hari
        6 => 180,
        12 => 365,
        default => 30,
    };

 

    return response()->json(['token' => $snapToken]);
}

public function activate(Request $request)
{
    $user = Auth::user(); // Ambil user yang sedang login
    $plan = $request->plan; // Ambil dari request POST

    $durasi = match($plan) {
        1 => 30,    // 1 bulan
        6 => 180,   // 6 bulan
        12 => 365,  // 12 bulan
        default => 30,
    };

    Subscription::updateOrCreate(
        ['user_id' => $user->id],
        [
            'starts_at' => now(),
            'expires_at' => now()->addDays($durasi),
        ]
    );

    return response()->json(['message' => 'Berhasil aktif langganan']);
}
}
