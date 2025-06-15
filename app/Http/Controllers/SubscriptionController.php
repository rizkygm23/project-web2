<?php

// app/Http/Controllers/SubscriptionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function form()
    {
        return view('subscription.form');
    }

    public function showForm(Request $request)
{
    $plan = $request->query('plan', '1'); // default 1 bulan
    // Tampilkan view form pembayaran, kirim $plan ke view
    return view('subscription.form', compact('plan'));
}
}

