<?php

namespace App\Repositories;

use App\Models\Trajet;
use Illuminate\Support\Facades\DB;

class TrajetRepository implements TrajetRepositoryInterface
{
    public function all()
    {
        return Trajet::all();
    }

    public function find($id)
    {
        return Trajet::findOrFail($id);
    }

    public function store(array $data)
    {
        return Trajet::create($data);
    }

    public function update($id, array $data)
    {
        $trajet = Trajet::findOrFail($id);
        $trajet->update($data);
        return $trajet;
    }

    public function destroy($id)
    {
        return Trajet::destroy($id);
    }

    public function search(array $filters)
    {
        return Trajet::where('depart', 'like', "%{$filters['depart']}%")
            ->where('destination', 'like', "%{$filters['destination']}%")
            ->whereDate('date', $filters['date'])
            ->get();
    }

    public function getPopularRoutes()
    {
        return Trajet::select('trajets.*', DB::raw('COUNT(bookings.id) as booking_count'))
            ->leftJoin('bookings', 'trajets.id', '=', 'bookings.trajet_id')
            ->groupBy('trajets.id')
            ->orderByDesc('booking_count')
            ->limit(6)
            ->get();
    }
}
