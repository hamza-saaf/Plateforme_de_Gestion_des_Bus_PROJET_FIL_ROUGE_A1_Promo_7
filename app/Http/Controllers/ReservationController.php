<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'trajet', 'bus'])->latest()->paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        return view('admin.reservations.show', compact('reservation'));
    }

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
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'trajet_id' => $trajet_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'amount_paid' => $trajet->price,
            'status' => 'pending',
            'reservation_date' => $trajet->date,
            'transaction_reference' => 'RES-' . strtoupper(Str::random(10))
        ]);

        // Update available seats
        $trajet->decrement('available_seats');

        return response()->json([
            'success' => true,
            'message' => 'Réservation créée avec succès!',
            'reservation' => $reservation
        ]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $reservation->update($data);
        return redirect()->back()->with('success', 'Réservation mise à jour avec succès!');
    }

    public function destroy(Reservation $reservation)
    {
        // If cancelling a confirmed reservation, increment available seats
        if ($reservation->status === 'confirmed') {
            $reservation->trajet->increment('available_seats');
        }

        $reservation->delete();
        return redirect()->route('admin.reservations.index')
            ->with('success', 'Réservation supprimée avec succès!');
    }

    public function userReservations()
    {
        $reservations = Reservation::with(['trajet'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
            
        return view('voyageur.reservations', compact('reservations'));
    }
}