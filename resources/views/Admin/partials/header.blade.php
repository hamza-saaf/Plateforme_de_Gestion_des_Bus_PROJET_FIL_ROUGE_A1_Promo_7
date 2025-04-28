<header class="bg-white shadow">
    <div class="px-4 py-4 sm:px-6 md:px-8 flex justify-between items-center">
        <h1 class="text-xl font-bold text-gray-900">
            @if(request()->routeIs('admin.dashboard'))
                Tableau de bord
            @elseif(request()->routeIs('admin.users.*'))
                Gestion des utilisateurs
            @elseif(request()->routeIs('admin.trajets.*'))
                Gestion des trajets
            @elseif(request()->routeIs('admin.bookings.*'))
                Réservations
            @elseif(request()->routeIs('admin.statistics'))
                Statistiques
            @elseif(request()->routeIs('admin.realtime'))
                Monitoring en temps réel
            @endif
        </h1>

        <div class="flex items-center">
            <div class="relative">
                <button id="notificationBtn"
                    class="p-1 text-gray-400 rounded-full hover:bg-gray-100 focus:outline-none">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <div id="notificationDropdown"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-10 hidden">
                    <div class="py-2">
                        <div class="px-4 py-2 border-b">
                            <p class="text-sm font-medium text-gray-900">Notifications</p>
                        </div>
                        <div class="px-4 py-2 text-sm text-gray-700 border-b hover:bg-gray-100">
                            <p class="font-medium">Retard signalé</p>
                            <p>Le bus #103 a signalé un retard de 15 minutes</p>
                            <p class="text-xs text-gray-500">Il y a 5 minutes</p>
                        </div>
                        <div class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <p class="font-medium">Nouvelle réservation</p>
                            <p>10 nouvelles réservations pour le trajet Paris-Lyon</p>
                            <p class="text-xs text-gray-500">Il y a 30 minutes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>