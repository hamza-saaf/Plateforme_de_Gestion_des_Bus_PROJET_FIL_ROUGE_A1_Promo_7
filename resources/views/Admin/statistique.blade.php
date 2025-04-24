<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                    <i class="fas fa-users text-white"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Utilisateurs actifs
                        </dt>
                        <dd class="flex items-center">
                            <div class="text-lg font-medium text-gray-900">{{ $activeUsers }}</div>
                            <div class="ml-2 flex items-center text-sm text-green-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="ml-1">{{ $userGrowth }}%</span>
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
                            <div class="text-lg font-medium text-gray-900">{{ $todayBookings }}</div>
                            <div class="ml-2 flex items-center text-sm text-green-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="ml-1">{{ $bookingGrowth }}%</span>
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
                            <div class="text-lg font-medium text-gray-900">{{ $activeBuses }}</div>
                            <div class="ml-2 flex items-center text-sm text-gray-600">
                                <span>sur {{ $totalBuses }}</span>
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
                            <div class="text-lg font-medium text-gray-900">{{ $activeAlerts }}</div>
                            <div class="ml-2 flex items-center text-sm text-red-600">
                                <i class="fas fa-arrow-up"></i>
                                <span class="ml-1">{{ $newAlerts }}</span>
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
            <canvas id="reservationsChart" data-reservations='{{ json_encode($weeklyReservations) }}'></canvas>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900">Destinations populaires</h3>
        <div class="mt-4 h-64">
            <canvas id="destinationsChart" data-destinations='{{ json_encode($popularDestinations) }}'></canvas>
        </div>
    </div>
</div>

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