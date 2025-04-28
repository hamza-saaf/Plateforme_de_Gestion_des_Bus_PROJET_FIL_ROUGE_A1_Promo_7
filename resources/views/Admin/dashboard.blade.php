@extends('Admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                    <i class="fas fa-users text-white"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Utilisateurs actifs</dt>
                        <dd class="flex items-center">
                            <div class="text-lg font-medium text-gray-900">{{ $activeUsers ?? 0 }}</div>
                            <div class="ml-2 flex items-center text-sm text-green-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="ml-1">{{ $userGrowth ?? 0 }}%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <i class="fas fa-ticket-alt text-white"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Réservations aujourd'hui</dt>
                        <dd class="flex items-center">
                            <div class="text-lg font-medium text-gray-900">{{ $todayBookings ?? 0 }}</div>
                            <div class="ml-2 flex items-center text-sm text-green-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="ml-1">{{ $bookingGrowth ?? 0 }}%</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <i class="fas fa-bus text-white"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Bus en service</dt>
                        <dd class="flex items-center">
                            <div class="text-lg font-medium text-gray-900">{{ $activeBuses ?? 0 }}</div>
                            <div class="ml-2 flex items-center text-sm text-gray-600">
                                <span>sur {{ $totalBuses ?? 0 }}</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Alertes actives</dt>
                        <dd class="flex items-baseline">
                            <div class="text-lg font-medium text-gray-900">{{ $activeAlerts ?? 0 }}</div>
                            <div class="ml-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="ml-1">{{ $newAlerts ?? 0 }}</span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900">Réservations (7 derniers jours)</h3>
        <div class="mt-4 h-64">
            <canvas id="reservationsChart" data-reservations='{{ json_encode($weeklyReservations ?? []) }}'></canvas>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900">Destinations populaires</h3>
        <div class="mt-4 h-64">
            <canvas id="destinationsChart" data-destinations='{{ json_encode($popularDestinations ?? []) }}'></canvas>
        </div>
    </div>
</div>

<div class="mt-8">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg font-medium text-gray-900">Dernières activités</h3>
        </div>
        <ul class="divide-y divide-gray-200">
            <li class="px-4 py-4 sm:px-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                        <i class="fas fa-user-plus text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">Nouveau compte utilisateur créé</p>
                        <p class="text-sm text-gray-500">Thomas Dubois • Il y a 5 minutes</p>
                    </div>
                </div>
            </li>
            <li class="px-4 py-4 sm:px-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-full p-2">
                        <i class="fas fa-ticket-alt text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">Nouvelle réservation</p>
                        <p class="text-sm text-gray-500">Julie Martin - Paris-Lyon • Il y a 12 minutes</p>
                    </div>
                </div>
            </li>
            <li class="px-4 py-4 sm:px-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 rounded-full p-2">
                        <i class="fas fa-route text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">Trajet modifié</p>
                        <p class="text-sm text-gray-500">Bordeaux-Toulouse • Il y a 35 minutes</p>
                    </div>
                </div>
            </li>
            <li class="px-4 py-4 sm:px-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">Alerte de retard</p>
                        <p class="text-sm text-gray-500">Bus #103 - Marseille-Nice • Il y a 1 heure</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuration du graphique des réservations
    const reservationsCtx = document.getElementById('reservationsChart').getContext('2d');
    const reservationsData = JSON.parse(document.getElementById('reservationsChart').dataset.reservations);
    
    new Chart(reservationsCtx, {
        type: 'line',
        data: {
            labels: reservationsData.map(d => d.date),
            datasets: [{
                label: 'Réservations',
                data: reservationsData.map(d => d.count),
                borderColor: 'rgb(59, 130, 246)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Configuration du graphique des destinations
    const destinationsCtx = document.getElementById('destinationsChart').getContext('2d');
    const destinationsData = JSON.parse(document.getElementById('destinationsChart').dataset.destinations);
    
    new Chart(destinationsCtx, {
        type: 'doughnut',
        data: {
            labels: destinationsData.map(d => d.name),
            datasets: [{
                data: destinationsData.map(d => d.count),
                backgroundColor: [
                    'rgb(59, 130, 246)',
                    'rgb(16, 185, 129)',
                    'rgb(99, 102, 241)',
                    'rgb(239, 68, 68)',
                    'rgb(245, 158, 11)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});
</script>
@endpush
@endsection