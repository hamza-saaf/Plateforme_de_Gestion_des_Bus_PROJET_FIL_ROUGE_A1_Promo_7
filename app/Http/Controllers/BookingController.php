<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'route', 'bus'])->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed'
        ]);

        $booking->update($data);
        return redirect()->back()->with('success', 'Réservation mise à jour avec succès!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Réservation supprimée avec succès!');
    }
}