<div class="flex flex-col flex-grow mt-5">
    <nav class="flex-1 px-2 space-y-1" id="sidebarNav">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-chart-line mr-3 text-lg"></i>
            Tableau de bord
        </a>
        <a href="{{ route('admin.users.index') }}"
            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 {{ request()->routeIs('admin.users.*') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-users mr-3 text-lg"></i>
            Gestion des utilisateurs
        </a>
        <a href="{{ route('admin.trajets.index') }}"
            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 {{ request()->routeIs('admin.trajets.*') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-route mr-3 text-lg"></i>
            Gestion des trajets
        </a>
        <a href="{{ route('admin.bookings.index') }}"
            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-ticket-alt mr-3 text-lg"></i>
            Réservations
        </a>
        <a href="{{ route('admin.statistics') }}"
            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 {{ request()->routeIs('admin.statistics') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-chart-pie mr-3 text-lg"></i>
            Statistiques
        </a>
        <a href="{{ route('admin.realtime') }}"
            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700 {{ request()->routeIs('admin.realtime') ? 'bg-blue-700' : '' }}">
            <i class="fas fa-clock mr-3 text-lg"></i>
            Temps réel
        </a>
    </nav>
</div>