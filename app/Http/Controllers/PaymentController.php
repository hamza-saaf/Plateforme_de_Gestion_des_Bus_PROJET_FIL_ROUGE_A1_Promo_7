<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function charge(Request $request)
    {
        try {
            // Set Stripe API Key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Get form data
            $amount = $request->input('amount') * 100; // Convert to cents
            $email = $request->input('email');
            $trajet_id = $request->input('trajet_id');

            // Create a new customer in Stripe
            $customer = Customer::create([
                'email' => $email,
                'source' => $request->input('stripeToken'),
            ]);

            // Process the payment
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $amount,
                'currency' => 'mad',
                'description' => "Reservation for trip #$trajet_id",
            ]);

            // Create reservation record
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'trajet_id' => $trajet_id,
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'amount' => $amount / 100, // Convert back to regular currency
                'payment_id' => $charge->id
            ]);

            // Return success response
            return redirect()->route('trips.show', $trajet_id)
                           ->with('success', 'Votre paiement a été effectué avec succès et votre place est réservée!');
        } catch (\Exception $e) {
            // Handle any errors
            return redirect()->back()
                           ->with('error', 'Une erreur est survenue lors du paiement: ' . $e->getMessage());
        }
    }
}
