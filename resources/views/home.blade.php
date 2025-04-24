<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusFlow - Gestion simplifiée des trajets en bus</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#1e293b'
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.0/cdn.min.js" defer></script>
    <!-- Flowbite -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-slate-500 border-gray-200 px-4 lg:px-6 py-3 shadow-md">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="/" class="flex items-center">
                <img src="{{ asset('img/BusFlow_300_px2.png') }}" alt="iPhone" class="w-60 rounded-sm">
            </a>
            <div class="flex items-center lg:order-2">

                <a href="{{ route('login') }}"
                    class="text-white hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">Connexion</a>
                <a href=""
                    class="text-slate-700 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">Inscription</a>
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-white rounded-lg lg:hidden hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-300"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Ouvrir le menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="#"
                            class="block py-2 pr-4 pl-3 text-white border-b border-slate-600 lg:border-0 lg:hover:text-slate-200 lg:p-0"
                            aria-current="page">Accueil</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-slate-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-slate-200 lg:p-0">Trajets</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-slate-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-slate-200 lg:p-0">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-slate-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-slate-200 lg:p-0">À
                            propos</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-slate-800 lg:hover:bg-transparent lg:border-0 lg:hover:text-slate-200 lg:p-0">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Search Form -->
    <section class="bg-slate-500 bg-gradient-to-br from-slate-700 to-slate-900 py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="text-white">
                    <h1 class="text-4xl font-bold mb-4">Simplifiez vos déplacements en bus</h1>
                    <p class="text-xl mb-8">Planifiez, réservez et gérez vos trajets en un clic. BusFlow rend vos
                        voyages plus faciles et plus agréables.</p>
                    <div class="flex space-x-4">
                        <a href="search"
                            class="px-6 py-3 bg-white text-slate-700 hover:bg-gray-100 rounded-lg font-medium flex items-center">
                            <i class="fas fa-search mr-2"></i> Chercher un trajet
                        </a>
                        {{-- {{ route('register') }} --}}
                        <a href=""
                            class="px-6 py-3 bg-transparent border-2 border-white text-white hover:bg-slate-800 rounded-lg font-medium flex items-center">
                            <i class="fas fa-user-plus mr-2"></i> Créer un compte
                        </a>
                    </div>
                </div>
                <div class="relative hidden md:block">
                    <img src="/api/placeholder/600/400" alt="Bus moderne" class="rounded-lg shadow-xl">
                    <div class="absolute -bottom-6 -right-6 bg-slate-600 text-white p-4 rounded-lg shadow-lg">
                        <div class="text-lg font-bold">+ de 500</div>
                        <div class="text-sm">Trajets quotidiens</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Form -->
    <section id="search" class="bg-white py-12 shadow-lg -mt-8 rounded-t-3xl relative z-10 px-4">
        <div class="max-w-screen-xl mx-auto">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Rechercher un trajet</h2>

                <form id="search-form" method="GET" action="{{ route('search') }}" class="grid gap-6 md:grid-cols-4">
                    <div>
                        <label for="depart" class="block mb-2 text-sm font-medium text-gray-700">Départ</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-slate-600"></i>
                            </div>
                            <input type="text" id="depart" name="depart"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full pl-10 p-2.5"
                                placeholder="Ville de départ" required>
                            <p class="mt-1 text-sm text-red-600 error-message" data-error="depart"></p>

                        </div>
                    </div>
                    <div>
                        <label for="destination"
                            class="block mb-2 text-sm font-medium text-gray-700">Destination</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker text-slate-600"></i>
                            </div>
                            <input type="text" id="destination" name="destination"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full pl-10 p-2.5"
                                placeholder="Ville d'arrivée" required>
                            <p class="mt-1 text-sm text-red-600 error-message" data-error="destination"></p>
                        </div>
                    </div>
                    <div>
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-calendar text-slate-600"></i>
                            </div>
                            <input type="date" id="date" name="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full pl-10 p-2.5"
                               >

                        </div>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-slate-600 hover:bg-slate-700 text-white font-medium py-2.5 px-5 rounded-lg focus:outline-none focus:ring-4 focus:ring-slate-300">
                            <i class="fas fa-search mr-2"></i> Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div id="search-results" class="searchBox  max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @include('trajet_results', ['trajets' => $trajets ?? []])
    </div>
    {{-- <div class="Resutat_de_recherch">
            <h3>Resultat</h3>
            @foreach ($trajets as $trajet)
                <div>
                    <ul>
                        <li>Depart:{{ $trajet->depart }}</li>
                        <li>Destination:{{ $trajet->destination }}</li>
                        <li>Date:{{ $trajet->date }}</li>
                        <li>Prix:{{ $trajet->price }} DH</li>
                    </ul>
                </div>
            @endforeach
        </div> --}}
    <!-- Featured Routes -->
    <section class="py-12 bg-gray-50 px-4">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Trajets populaires</h2>
                <a href="{{ route('trajetsPopulaires') }}"
                    class="text-slate-600 hover:text-slate-800 font-medium flex items-center">
                    Voir plus <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($popularRoutes as $route)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $route->departure }} -
                                        {{ $route->destination }}</h3>
                                    <p class="text-gray-600">{{ $route->duration }} min</p>
                                </div>
                                <div class="text-xl font-bold text-slate-600">{{ $route->price }} €</div>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500 mb-4">
                                <div>
                                    <div class="font-medium">Départ</div>
                                    <div>{{ $route->departure_time }}</div>
                                </div>
                                <div class="text-center">
                                    <i class="fas fa-bus text-slate-600"></i>
                                </div>
                                <div class="text-right">
                                    <div class="font-medium">Arrivée</div>
                                    <div>{{ $route->arrival_time }}</div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <i class="fas fa-user-friends text-gray-400 mr-2"></i>
                                    <span class="text-gray-600">{{ $route->available_seats }} places
                                        disponibles</span>
                                </div>
                                <a href="{{ route('trips.show', $route->id) }}"
                                    class="px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white rounded-lg text-sm">Réserver</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Fallback if no routes -->
                @if (count($popularRoutes) == 0)
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-8">
                        <i class="fas fa-bus text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-xl">Aucun trajet populaire à afficher pour le moment.</p>
                    </div>
                @endif
            </div> --}}
        </div>
    </section>

    <!-- Features -->
    <section class="py-12 bg-white px-4">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-2xl font-bold text-center mb-2 text-gray-800">Pourquoi choisir BusFlow ?</h2>
            <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Notre plateforme vous offre une expérience de
                voyage optimale avec des fonctionnalités uniques et innovantes.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-slate-50 p-6 rounded-lg text-center">
                    <div class="bg-slate-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marked-alt text-slate-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Géolocalisation</h3>
                    <p class="text-gray-600">Suivez votre bus en temps réel et visualisez votre itinéraire sur une
                        carte interactive.</p>
                </div>

                <div class="bg-slate-50 p-6 rounded-lg text-center">
                    <div class="bg-slate-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bell text-slate-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Notifications</h3>
                    <p class="text-gray-600">Recevez des alertes en temps réel pour les retards, changements d'horaires
                        ou d'itinéraires.</p>
                </div>

                <div class="bg-slate-50 p-6 rounded-lg text-center">
                    <div class="bg-slate-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chair text-slate-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Choix du siège</h3>
                    <p class="text-gray-600">Sélectionnez votre siège préféré grâce à notre interface de réservation
                        visuelle.</p>
                </div>

                <div class="bg-slate-50 p-6 rounded-lg text-center">
                    <div class="bg-slate-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-cloud-sun text-slate-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Météo intégrée</h3>
                    <p class="text-gray-600">Consultez les prévisions météorologiques pour chaque étape de votre
                        voyage.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- App Showcase -->
    <section class="py-12 bg-gray-50 px-4">
        <div class="max-w-screen-xl mx-auto">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">BusFlow, accessible partout</h2>
                    <p class="text-gray-600 mb-6">Notre application est disponible sur tous vos appareils. Profitez de
                        l'accès à vos réservations même en mode hors ligne et gérez vos voyages où que vous soyez.</p>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Accès à vos billets même sans connexion internet</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Suivi des bus en temps réel sur la carte</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                            <span class="text-gray-700">Notifications personnalisées pour vos trajets</span>
                        </li>
                    </ul>
                    <div class="flex space-x-4 mt-8">
                        <a href="#"
                            class="bg-black text-white px-5 py-2 rounded-lg flex items-center hover:bg-gray-800">
                            <i class="fab fa-apple text-2xl mr-2"></i>
                            <div>
                                <div class="text-xs">Télécharger sur</div>
                                <div class="font-medium">App Store</div>
                            </div>
                        </a>
                        <a href="#"
                            class="bg-black text-white px-5 py-2 rounded-lg flex items-center hover:bg-gray-800">
                            <i class="fab fa-google-play text-2xl mr-2"></i>
                            <div>
                                <div class="text-xs">Disponible sur</div>
                                <div class="font-medium">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="relative mx-auto md:ml-auto">
                    <img src="/api/placeholder/300/600" alt="Application mobile BusFlow"
                        class="rounded-xl shadow-xl mx-auto">
                    <div class="absolute -bottom-4 -left-4 bg-slate-600 text-white p-4 rounded-lg shadow-lg">
                        <div class="text-lg font-bold">4.8/5</div>
                        <div class="text-sm">Note utilisateurs</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-12 bg-white px-4">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-2xl font-bold text-center mb-12 text-gray-800">Ce que nos utilisateurs pensent de BusFlow
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"J'utilise BusFlow tous les jours pour me rendre au travail. Les
                        notifications en temps réel m'ont sauvé de nombreuses fois !"</p>
                    <div class="flex items-center">
                        <img src="/api/placeholder/40/40" class="rounded-full mr-3" alt="Avatar">
                        <div>
                            <div class="font-medium text-gray-800">Sophie Martin</div>
                            <div class="text-sm text-gray-500">Utilisatrice quotidienne</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"La sélection visuelle des sièges est géniale ! Je peux choisir
                        exactement où je veux m'asseoir pour mon trajet."</p>
                    <div class="flex items-center">
                        <img src="/api/placeholder/40/40" class="rounded-full mr-3" alt="Avatar">
                        <div>
                            <div class="font-medium text-gray-800">Thomas Dubois</div>
                            <div class="text-sm text-gray-500">Voyageur fréquent</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"En tant qu'administrateur de flotte, BusFlow nous a permis
                        d'optimiser nos trajets et d'améliorer considérablement la satisfaction de nos clients. L'outil
                        de gestion est intuitif et puissant."</p>
                    <div class="flex items-center">
                        <img src="/api/placeholder/40/40" class="rounded-full mr-3" alt="Avatar">
                        <div>
                            <div class="font-medium text-gray-800">Marc Leroy</div>
                            <div class="text-sm text-gray-500">Gestionnaire de flotte</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-12 bg-slate-700 px-4">
        <div class="max-w-screen-xl mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4 text-white">Restez informé des nouvelles fonctionnalités</h2>
            <p class="text-slate-100 mb-8 max-w-2xl mx-auto">Inscrivez-vous à notre newsletter pour recevoir nos
                actualités, les nouveaux itinéraires et des offres exclusives.</p>

            <form class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
                <input type="email"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5"
                    placeholder="Votre adresse email" required>
                <button type="submit"
                    class="bg-slate-900 hover:bg-slate-800 text-white font-medium py-2.5 px-5 rounded-lg focus:outline-none focus:ring-4 focus:ring-slate-300 whitespace-nowrap">S'abonner</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6 px-4">
        <div class="max-w-screen-xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">À propos</h3>
                    <p class="text-gray-400 mb-4">BusFlow est une plateforme innovante de gestion des trajets en bus,
                        offrant une expérience utilisateur optimale et des fonctionnalités avancées.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Accueil</a></li>
                        <li><a href="#" class="hover:text-white">Trajets</a></li>
                        <li><a href="#" class="hover:text-white">Services</a></li>
                        <li><a href="#" class="hover:text-white">À propos</a></li>
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
                            <span>+212650200682</span>
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
    </footer>
    <script>
        document.getElementById('search-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();

            fetch(form.action + '?' + params, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.html) {
                        document.getElementById('search-results').innerHTML = data.html;
                    } else if (data.errors) {
                        
                        const errors = Object.values(data.errors).flat().join('\n');
                        console('Validation failed:\n' + errors);
                    }
                });
        });
    </script>

</body>

</html>
