<!-- popular-routes.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trajets Populaires - BusFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-green-700 border-gray-200 px-4 lg:px-6 py-3 shadow-md">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            {{-- {{ route('home') }} --}}
            <a href="" class="flex items-center">
                <i class="fas fa-bus text-white text-2xl mr-3"></i>
                <span class="self-center text-xl font-semibold whitespace-nowrap text-white">BusFlow</span>
            </a>
            <div class="flex items-center lg:order-2">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">Connexion</a>
                    {{-- {{ route('register') }} --}}
                    <a href="" class="text-green-700 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">Inscription</a>
                @else
                    <div class="flex items-center">
                        {{-- {{ route('dashboard') } --}}
                        <a href="}" class="text-white hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">
                            <i class="fas fa-user-circle mr-2"></i> Mon compte
                        </a>
                        {{-- {{ route('logout') }} --}}
                        <form method="POST" action="">
                            @csrf
                            <button type="submit" class="text-green-700 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                @endguest
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-white rounded-lg lg:hidden hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-300" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Ouvrir le menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        {{-- {{ route('home') }} --}}
                        <a href="" class="block py-2 pr-4 pl-3 text-white hover:bg-green-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-green-200 lg:p-0">Accueil</a>
                    </li>
                    <li>
                        {{-- {{ route('trips.popular') }} --}}
                        <a href="" class="block py-2 pr-4 pl-3 text-white border-b border-green-600 lg:border-0 lg:hover:text-green-200 lg:p-0" aria-current="page">Trajets populaires</a>
                    </li>
                    <li>
                        {{-- {{ route('trips.index') }} --}}
                        <a href="" class="block py-2 pr-4 pl-3 text-white hover:bg-green-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-green-200 lg:p-0">Tous les trajets</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-white hover:bg-green-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-green-200 lg:p-0">Services</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pr-4 pl-3 text-white hover:bg-green-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-green-200 lg:p-0">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page header -->
    <header class="bg-green-700 py-10">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-white">Trajets Populaires</h1>
                <p class="mt-4 text-green-100 max-w-3xl mx-auto">Découvrez les itinéraires les plus appréciés par nos voyageurs. Réservez dès maintenant pour garantir votre place!</p>
            </div>
        </div>
    </header>

    <!-- Search Form -->
    <section class="bg-white py-8 shadow-lg -mt-8 rounded-t-3xl relative z-10 px-4">
        <div class="max-w-screen-xl mx-auto">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6 text-gray-800">Filtrer les trajets</h2>
                {{-- {{ route('trips.popular') }} --}}
                <form method="GET" action="" class="grid gap-4 md:grid-cols-5">
                    <div>
                        <label for="departure" class="block mb-2 text-sm font-medium text-gray-700">Départ</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-green-600"></i>
                            </div>
                            {{-- {{ request('departure') }} --}}
                            <input type="text" id="departure" name="departure" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5" placeholder="Ville de départ">
                        </div>
                    </div>
                    <div>
                        <label for="destination" class="block mb-2 text-sm font-medium text-gray-700">Destination</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker text-green-600"></i>
                            </div>
                            {{-- {{ request('destination') }} --}}
                            <input type="text" id="destination" name="destination" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5" placeholder="Ville d'arrivée">
                        </div>
                    </div>
                    <div>
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar text-green-600"></i>
                            </div>
                            {{-- {{ request('date') }} --}}
                            <input type="date" id="date" name="date" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>
                    <div>
                        <label for="sort" class="block mb-2 text-sm font-medium text-gray-700">Trier par</label>
                        <select id="sort" name="sort" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                            <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularité</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                            <option value="duration" {{ request('sort') == 'duration' ? 'selected' : '' }}>Durée</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-5 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-300">
                            <i class="fas fa-filter mr-2"></i> Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Popular Routes Grid -->
    <section class="py-10 bg-gray-50 px-4">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Tous nos trajets populaires</h2>
                {{-- {{ $popularRoutes->total() }} --}}
                <div class="text-gray-600"> résultats trouvés</div>
            </div>

            {{-- @if($popularRoutes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach ($popularRoutes as $route)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    @if($route->discount_rate > 0)
                    <div class="bg-red-600 text-white text-xs font-bold px-3 py-1 absolute right-0 mt-4 mr-4 rounded">
                        -{{ $route->discount_rate }}%
                    </div>
                    @endif
                    <div class="p-5">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $route->departure }} - {{ $route->destination }}</h3>
                                <p class="text-gray-600">{{ $route->duration }} min</p>
                            </div>
                            <div class="text-xl font-bold text-green-600">{{ $route->price }} €</div>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 mb-4">
                            <div>
                                <div class="font-medium">Départ</div>
                                <div>{{ $route->departure_time }}</div>
                                <div class="text-xs text-gray-400">{{ $route->departure_date }}</div>
                            </div>
                            <div class="text-center flex flex-col items-center justify-center">
                                <i class="fas fa-bus text-green-600 mb-1"></i>
                                <div class="w-16 h-px bg-gray-300"></div>
                                <span class="text-xs">{{ $route->distance }} km</span>
                            </div>
                            <div class="text-right">
                                <div class="font-medium">Arrivée</div>
                                <div>{{ $route->arrival_time }}</div>
                                <div class="text-xs text-gray-400">{{ $route->arrival_date }}</div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-user-friends text-gray-400 mr-2"></i>
                                <span class="text-gray-600">{{ $route->available_seats }} places disponibles</span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('trips.show', $route->id) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">Détails</a>
                                <a href="{{ route('trips.book', $route->id) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">Réserver</a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-2 border-t border-gray-200 flex justify-between items-center">
                        <div class="flex items-center text-sm">
                            <i class="fas fa-users text-green-600 mr-2"></i>
                            <span>{{ $route->bookings_count }} voyageurs</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $route->rating)
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @else
                                        <i class="far fa-star text-yellow-400"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="ml-2 text-sm text-gray-600">({{ $route->reviews_count }})</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
             --}}
            <!-- Pagination -->
            <div class="mt-8">
                {{-- {{ $popularRoutes->links() }} --}}
            </div>
            
            {{-- @else --}}
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <i class="fas fa-route text-gray-300 text-5xl mb-4"></i>
                <h3 class="text-xl font-medium text-gray-800 mb-2">Aucun trajet trouvé</h3>
                <p class="text-gray-600 mb-6">Aucun trajet ne correspond à vos critères de recherche. Essayez de modifier vos filtres.</p>
                {{-- {{ route('trips.popular') }} --}}
                <a href="" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Réinitialiser les filtres
                </a>
            </div>
            {{-- @endif --}}
        </div>
    </section>

    <!-- Popular Destinations -->
    <section class="py-10 bg-white px-4">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Destinations populaires</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($popularDestinations ?? [] as $destination )
                <a href="{{ route('trips.search', ['destination' => $destination->name]) }}" class="group relative rounded-lg overflow-hidden shadow-md">
                    <img src="/api/placeholder/300/200" alt="{{ $destination->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-white">
                        <h3 class="font-bold text-lg">{{ $destination->name }}</h3>
                        <p class="text-sm flex items-center">
                            <i class="fas fa-bus mr-2"></i> {{ $destination->trips_count }} trajets
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-10 bg-green-700 px-4">
        <div class="max-w-screen-xl mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4 text-white">Recevez nos meilleures offres</h2>
            <p class="text-green-100 mb-8 max-w-2xl mx-auto">Inscrivez-vous à notre newsletter pour être informé des promotions exclusives et des nouveaux trajets populaires.</p>
            
            <form class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
                <input type="email" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" placeholder="Votre adresse email" required>
                <button type="submit" class="bg-green-900 hover:bg-green-800 text-white font-medium py-2.5 px-5 rounded-lg focus:outline-none focus:ring-4 focus:ring-green-300 whitespace-nowrap">S'abonner</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    {{-- <footer class="bg-gray-800 text-white pt-10 pb-6 px-4">
        <div class="max-w-screen-xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">À propos</h3>
                    <p class="text-gray-400 mb-4">BusFlow est une plateforme innovante de gestion des trajets en bus, offrant une expérience utilisateur optimale et des fonctionnalités avancées.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white">Accueil</a></li>
                        <li><a href="{{ route('trips.popular') }}" class="hover:text-white">Trajets populaires</a></li>
                        <li><a href="{{ route('trips.index') }}" class="hover:text-white">Tous les trajets</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Centre d'aide</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Conditions d'utilisation</a></li>
                        <li><a href="#" class="hover:text-white">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:text-white">Signaler un problème</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                            <span>123 Avenue des Transports, 75000 Paris</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3"></i>
                            <span>+33 1 23 45 67 89</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3"></i>
                            <span>contact@busflow.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} BusFlow. Tous droits réservés.</p>
            </div>
        </div>
    </footer> --}}
</body>
</html>