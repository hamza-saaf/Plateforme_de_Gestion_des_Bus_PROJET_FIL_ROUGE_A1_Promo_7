<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function checkoutForm()
    {
        return view('checkout');
    }

    public function processPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            \Stripe\Charge::create([
                "amount" => 1000,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from Laravel",
            ]);

            return back()->with('success', ' Payment successful!');
        } catch (\Exception $ex) {
            return back()->with('error', ' Error: ' . $ex->getMessage());
        }
    }
}

