<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function store(Request $request, $trajet_id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
        ]);

        $trajet = Trajet::findOrFail($trajet_id);

        // Check if seats are available
        if ($trajet->available_seats < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Désolé, il n\'y a plus de places disponibles pour ce trajet.'
            ], 400);
        }

        // Create reservation
        $reservation = new Reservation([
            'trajet_id' => $trajet_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'amount_paid' => $trajet->price,
            'status' => 'pending',
            'transaction_reference' => 'RES-' . strtoupper(Str::random(10))
        ]);

        $reservation->save();

        // Update available seats
        $trajet->decrement('available_seats');

        return response()->json([
            'success' => true,
            'message' => 'Réservation créée avec succès!',
            'reservation' => $reservation
        ]);
    }
}