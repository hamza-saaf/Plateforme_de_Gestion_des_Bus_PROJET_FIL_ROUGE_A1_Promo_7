<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bus;
use App\Models\Booking;
use App\Models\Alert;
use App\Models\Route;
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
        $todayBookings = Booking::whereDate('created_at', Carbon::today())->count();
        $yesterdayBookings = Booking::whereDate('created_at', Carbon::yesterday())->count();
        $bookingGrowth = $yesterdayBookings > 0 ? round((($todayBookings - $yesterdayBookings) / $yesterdayBookings) * 100) : 0;

        // Bus en service
        $activeBuses = Bus::where('status', 'active')->count();
        $totalBuses = Bus::count();

        // Alertes actives
        $activeAlerts = Alert::where('status', 'active')->count();
        $newAlerts = Alert::where('created_at', '>=', Carbon::now()->subHours(24))->count();

        // Réservations des 7 derniers jours
        $weeklyReservations = Booking::select(
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
            DB::raw('COUNT(bookings.id) as count')
        )
            ->leftJoin('bookings', 'routes.id', '=', 'bookings.route_id')
            ->groupBy('ville_arrivee')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        return view('Admin.dashboard', compact(
            'activeUsers',
            'userGrowth',
            'todayBookings',
            'bookingGrowth',
            'activeBuses',
            'totalBuses',
            'activeAlerts',
            'newAlerts',
            'weeklyReservations',
            'popularDestinations'
        ));
    }
}