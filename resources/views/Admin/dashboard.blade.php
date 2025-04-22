<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusFlow - Tableau de bord Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-gray-100" x-data="dashboard()">
    <!-- Navigation latérale -->
    <div class="flex h-screen overflow-hidden">
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-blue-800 text-white">
                <div class="flex items-center justify-center h-16 bg-blue-900">
                    <span class="text-2xl font-bold">BusFlow</span>
                </div>
                <div class="flex flex-col flex-grow mt-5">
                    <nav class="flex-1 px-2 space-y-1" id="sidebarNav">
                        <a href="#" data-tab="dashboard"
                            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700">
                            <i class="fas fa-chart-line mr-3 text-lg"></i>
                            Tableau de bord
                        </a>
                        <a href="#" data-tab="users"
                            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700">
                            <i class="fas fa-users mr-3 text-lg"></i>
                            Gestion des utilisateurs
                        </a>
                        <a href="#" data-tab="routes"
                            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700">
                            <i class="fas fa-route mr-3 text-lg"></i>
                            Gestion des trajets
                        </a>
                        <a href="#" data-tab="bookings"
                            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700">
                            <i class="fas fa-ticket-alt mr-3 text-lg"></i>
                            Réservations
                        </a>
                        <a href="#" data-tab="stats"
                            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700">
                            <i class="fas fa-chart-pie mr-3 text-lg"></i>
                            Statistiques
                        </a>
                        <a href="#" data-tab="realtime"
                            class="nav-link flex items-center px-4 py-2 text-sm font-medium rounded-md hover:bg-blue-700">
                            <i class="fas fa-clock mr-3 text-lg"></i>
                            Temps réel
                        </a>
                    </nav>
                </div>
                <div class="px-4 py-4 bg-blue-900">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-circle text-2xl"></i>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium">Admin</div>
                            <a href="#" class="text-xs text-blue-200 hover:text-white">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="bg-white shadow">
                <div class="px-4 py-4 sm:px-6 md:px-8 flex justify-between items-center">
                    <h1 class="text-xl font-bold text-gray-900" id="headerTitle">
                        <span data-tab="dashboard" class="tab-title hidden">Tableau de bord</span>
                        <span data-tab="users" class="tab-title hidden">Gestion des utilisateurs</span>
                        <span data-tab="routes" class="tab-title hidden">Gestion des trajets</span>
                        <span data-tab="bookings" class="tab-title hidden">Réservations</span>
                        <span data-tab="stats" class="tab-title hidden">Statistiques</span>
                        <span data-tab="realtime" class="tab-title hidden">Monitoring en temps réel</span>
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

            <main class="flex-1 overflow-y-auto bg-gray-100 p-4 sm:p-6 md:p-8">
                <!-- Tableau de bord principal -->
                <div x-show="activeTab === 'dashboard'">
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
                                                <div class="text-lg font-medium text-gray-900">2,453</div>
                                                <div class="ml-2 flex items-center text-sm text-green-600">
                                                    <i class="fas fa-arrow-up"></i>
                                                    <span class="ml-1">7%</span>
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
                                            <dt class="text-sm font-medium text-gray-500 truncate">Réservations
                                                aujourd'hui</dt>
                                            <dd class="flex items-center">
                                                <div class="text-lg font-medium text-gray-900">324</div>
                                                <div class="ml-2 flex items-center text-sm text-green-600">
                                                    <i class="fas fa-arrow-up"></i>
                                                    <span class="ml-1">12%</span>
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
                                                <div class="text-lg font-medium text-gray-900">42</div>
                                                <div class="ml-2 flex items-center text-sm text-gray-600">
                                                    <span>sur 50</span>
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
                                                <div class="text-lg font-medium text-gray-900">3</div>
                                                <div class="ml-2 flex items-center text-sm text-red-600">
                                                    <i class="fas fa-arrow-up"></i>
                                                    <span class="ml-1">2</span>
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
                                <canvas id="reservationsChart"></canvas>
                            </div>
                        </div>

                        <div class="bg-white shadow rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900">Destinations populaires</h3>
                            <div class="mt-4 h-64">
                                <canvas id="destinationsChart"></canvas>
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
                                            <p class="text-sm font-medium text-gray-900">Nouveau compte utilisateur
                                                créé</p>
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
                                            <p class="text-sm text-gray-500">Julie Martin - Paris-Lyon • Il y a 12
                                                minutes</p>
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
                                            <p class="text-sm text-gray-500">Bus #103 - Marseille-Nice • Il y a 1 heure
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section gestion des utilisateurs -->
                <div x-show="activeTab === 'users'" class="bg-white shadow rounded-lg" style="display: none;">
                    <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Gestion des utilisateurs</h3>
                        <div class="flex">
                            <div class="mr-4 relative">
                                <input type="text" placeholder="Rechercher..."
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md pl-10">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-user-plus mr-2"></i> Ajouter
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Statut</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date d'inscription</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-500"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Marie Dupont</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">marie.dupont@exemple.fr</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12/03/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="text-yellow-600 hover:text-yellow-900 mr-3"><i
                                                class="fas fa-ban"></i></button>
                                        <button class="text-red-600 hover:text-red-900"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-500"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Pierre Martin</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">pierre.martin@exemple.fr</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28/02/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="text-yellow-600 hover:text-yellow-900 mr-3"><i
                                                class="fas fa-ban"></i></button>
                                        <button class="text-red-600 hover:text-red-900"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-500"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Sophie Bernard</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">sophie.bernard@exemple.fr</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Suspendu</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/01/2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 mr-3"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="text-green-600 hover:text-green-900 mr-3"><i
                                                class="fas fa-check"></i></button>
                                        <button class="text-red-600 hover:text-red-900"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Précédent</a>
                            <a href="#"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Suivant</a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Affichage de <span class="font-medium">1</span> à <span
                                        class="font-medium">3</span> sur <span class="font-medium">150</span>
                                    utilisateurs
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                    aria-label="Pagination">
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Précédent</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-100">1</a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">15</a>
                                    <a href="#"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Suivant</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section gestion des trajets -->
                <div x-show="activeTab === 'routes'" style="display: none;">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Gestion des trajets</h3>
                        <button type="button" @click="showRouteModal = true"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-plus mr-2"></i> Ajouter un trajet
                        </button>
                    </div>

                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Trajets disponibles</h3>
                            <div class="relative">
                                <input type="text" placeholder="Rechercher des trajets..."
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md pl-10">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Départ</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Départ</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll("#sidebarNav .nav-link");
            links.forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    links.forEach(l => l.classList.remove("bg-blue-700"));
                    this.classList.add("bg-blue-700");
                    const activeTab = this.getAttribute("data-tab");
                    console.log("Tab actif :", activeTab);
                });
            });
        });


        function setActiveTab(tabName) {
            document.querySelectorAll(".tab-title").forEach(span => {
                span.classList.add("hidden");
                if (span.dataset.tab === tabName) {
                    span.classList.remove("hidden");
                }
            });
        }
        document.addEventListener("DOMContentLoaded", () => {
            setActiveTab("dashboard");
            document.querySelectorAll("[data-tab]").forEach(link => {
                link.addEventListener("click", function() {
                    setActiveTab(this.dataset.tab);
                });
            });
            const notifBtn = document.getElementById("notificationBtn");
            const notifDropdown = document.getElementById("notificationDropdown");

            notifBtn.addEventListener("click", function() {
                notifDropdown.classList.toggle("hidden");
            });
            document.addEventListener("click", function(event) {
                if (!notifBtn.contains(event.target) && !notifDropdown.contains(event.target)) {
                    notifDropdown.classList.add("hidden");
                }
            });
        });
    </script>
</body>

</html>
