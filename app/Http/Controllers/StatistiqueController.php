<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bus;
use App\Models\Reservation;
use App\Models\Alert;
use App\Models\Route;
use App\Models\Trajet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function getStatistics()
    {
        // Utilisateurs actifs (connectés dans les 30 derniers jours)
        $activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDays(30))->count();
        $lastMonthUsers = User::where('last_login_at', '>=', Carbon::now()->subDays(60))
            ->where('last_login_at', '<', Carbon::now()->subDays(30))
            ->count();
        $userGrowth = $lastMonthUsers > 0 ? round((($activeUsers - $lastMonthUsers) / $lastMonthUsers) * 100) : 0;

        // Réservations aujourd'hui
        $todayReservations = Reservation::whereDate('created_at', Carbon::today())->count();
        $yesterdayReservations = Reservation::whereDate('created_at', Carbon::yesterday())->count();
        $ReservationGrowth = $yesterdayReservations > 0 ? round((($todayReservations - $yesterdayReservations) / $yesterdayReservations) * 100) : 0;

        // Bus en service
        $activeBuses = Bus::where('status', 'active')->count();
        $totalBuses = Bus::count();

        // Alertes actives
        $activeAlerts = Alert::where('status', 'active')->count();
        $newAlerts = Alert::where('created_at', '>=', Carbon::now()->subHours(24))->count();

        // Réservations des 7 derniers jours
        $weeklyReservations = Reservation::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('d/m'),
                    'count' => $item->count
                ];
            });

        // Destinations populaires
        $popularDestinations = Route::select(
            'ville_arrivee as name',
            DB::raw('COUNT(reservations.id) as count')
        )
            ->leftJoin('Reservations', 'routes.id', '=', 'Reservations.route_id')
            ->groupBy('ville_arrivee')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        // Get all trajets for the admin dashboard
        $trajets = Trajet::orderBy('date', 'asc')->get();

        return view('Admin.dashboard', compact(
            'activeUsers',
            'userGrowth',
            'todayReservations',
            'reservationGrowth',
            'activeBuses',
            'totalBuses',
            'activeAlerts',
            'newAlerts',
            'weeklyReservations',
            'popularDestinations',
            'trajets'  // Add trajets to the view
        ));
    }
}