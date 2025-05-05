<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trajet;
use App\Models\Booking;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function show($id)
    {
        $trajet = Trajet::findOrFail($id);
        return view('voyageur.checkout', compact('trajet'));
    }

    public function createPaymentIntent($id)
    {
        try {
            $trajet = Trajet::findOrFail($id);
            
            // Create a PaymentIntent with the order amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => $trajet->price * 100, // Amount in cents
                'currency' => 'mad',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function processPayment(Request $request, $id)
    {
        try {
            $trajet = Trajet::findOrFail($id);
            
            // Validate booking details
            $validated = $request->validate([
                'email' => 'required|email',
                'phone' => 'required',
                'payment_intent_id' => 'required'
            ]);

            // Verify payment intent status
            $paymentIntent = PaymentIntent::retrieve($request->payment_intent_id);
            
            if ($paymentIntent->status === 'succeeded') {
                // Create booking record
                $booking = new Booking([
                    'trajet_id' => $trajet->id,
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'amount' => $trajet->price,
                    'payment_id' => $paymentIntent->id,
                    'status' => 'confirmed'
                ]);
                
                $booking->save();

                // Update available seats
                $trajet->decrement('available_seats');

                return response()->json([
                    'success' => true,
                    'message' => 'Payment processed successfully',
                    'booking_id' => $booking->id
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Payment failed'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}


