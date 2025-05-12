<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{
    public function showChargeForm(Request $request)
    {
        $amount = $request->amount;
        $trajet_id = $request->trajet_id;
        
        return view('voyageur.charge', compact('amount', 'trajet_id'));
    }

    public function charge(Request $request)
    {
        try {
            // Set Stripe API Key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Get form data
            $amount = $request->input('amount') * 100; // Convert to cents
            $email = $request->input('email');
            $trajet_id = $request->input('trajet_id');

            // Validate trajet availability
            $trajet = Trajet::findOrFail($trajet_id);
            if ($trajet->available_seats < 1) {
                return response()->json(['message' => 'No seats available'], 400);
            }

            // Create a Stripe charge
            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $request->input('stripeToken'),
                'description' => 'Bus reservation payment',
            ]);

            // Find an available bus for the trajet
            $bus = $trajet->buses()->where('status', 'available')->first();
            if (!$bus) {
                return response()->json(['message' => 'No available bus for this trajet'], 400);
            }

            // Create a reservation
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'trajet_id' => $trajet_id,
                'bus_id' => $bus->id,
                'full_name' => $request->input('full_name'),
                'email' => $email,
                'phone_number' => $request->input('phone_number'),
                'amount_paid' => $amount / 100, // Convert back to dollars
                'payment_id' => $charge->id,
                'status' => 'confirmed',
                'transaction_reference' => $charge->balance_transaction,
                'reservation_date' => now(),
            ]);

            // Decrease available seats for the trajet
            $trajet->decrement('available_seats');

            return response()->json(['message' => 'Payment successful', 'reservation' => $reservation], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Payment failed', 'error' => $e->getMessage()], 500);
        }
    }
}
