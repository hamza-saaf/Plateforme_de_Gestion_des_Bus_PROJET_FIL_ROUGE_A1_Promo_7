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
                return response()->json([
                    'success' => false,
                    'message' => 'Désolé, il n\'y a plus de places disponibles pour ce trajet.'
                ]);
            }

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

            // Generate unique transaction reference
            $transactionRef = 'BUS-' . strtoupper(Str::random(8));

            // Use phone number from the form
            $phone_number = $request->input('phone');

            // Create reservation record
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'trajet_id' => $trajet_id,
                'bus_id' => $trajet->bus_id,
                'full_name' => $request->input('full_name'),
                'email' => $email,
                'phone_number' => $phone_number, // Updated to use form input
                'amount_paid' => $amount / 100,
                'payment_id' => $charge->id,
                'status' => 'confirmed',
                'transaction_reference' => $transactionRef,
                'reservation_date' => now()
            ]);

            // Update available seats
            $trajet->decrement('available_seats');

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Paiement effectué avec succès!',
                'reservation' => [
                    'id' => $reservation->id,
                    'transaction_reference' => $transactionRef,
                    'amount' => $amount / 100,
                    'status' => 'confirmed'
                ]
            ]);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Payment Error: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors du paiement: ' . $e->getMessage()
            ]);
        }
    }
}
