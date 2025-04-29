<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BusFlow') }}</title>
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    @stack('styles')
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-green-700 border-gray-200 px-4 lg:px-6 py-3 shadow-md">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('home') }}" class="flex items-center">
                <i class="fas fa-bus text-white text-2xl mr-3"></i>
                <span class="self-center text-xl font-semibold whitespace-nowrap text-white">BusFlow</span>
            </a>
            
            <div class="flex items-center lg:order-2">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="text-green-700 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                        Inscription
                    </a>
                @else
                    <div class="flex items-center">
                        <span class="text-white mr-4">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-green-700 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                @endguest
            </div>

            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="{{ route('home') }}" class="block py-2 pr-4 pl-3 text-white hover:bg-green-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-green-200 lg:p-0">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('trips.popular') }}" class="block py-2 pr-4 pl-3 text-white hover:bg-green-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-green-200 lg:p-0">
                            Trajets populaires
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('trips.search') }}" class="block py-2 pr-4 pl-3 text-white hover:bg-green-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-green-200 lg:p-0">
                            Rechercher
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-screen-xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">À propos</h3>
                    <p class="text-gray-400">BusFlow est votre partenaire de confiance pour des voyages en bus confortables et abordables à travers le Maroc.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Accueil</a></li>
                        <li><a href="{{ route('trips.popular') }}" class="text-gray-400 hover:text-white">Trajets populaires</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><i class="fas fa-phone mr-2"></i> +212 5XX-XXXXXX</li>
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i> contact@busflow.ma</li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> Casablanca, Maroc</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} BusFlow. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>