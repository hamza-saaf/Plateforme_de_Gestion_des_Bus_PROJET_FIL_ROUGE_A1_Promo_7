@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="relative bg-slate-700 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <div class="relative pt-6 px-4 sm:px-6 lg:px-8"></div>
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block">Voyagez en toute</span>
                            <span class="block text-slate-300">tranquillité avec BusFlow</span>
                        </h1>
                        <p class="mt-3 text-base text-slate-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Réservez vos billets de bus en ligne facilement et rapidement. Trouvez les meilleurs itinéraires aux meilleurs prix.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-slate-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                    Commencer
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ route('trajets') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-slate-500 hover:bg-slate-600 md:py-4 md:text-lg md:px-10">
                                    Voir les trajets
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ asset('img/bus-hero.jpg') }}" alt="Bus moderne">
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-slate-600 font-semibold tracking-wide uppercase">Avantages</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Une meilleure façon de voyager
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Découvrez pourquoi des milliers de voyageurs choisissent BusFlow pour leurs déplacements.
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-slate-500 text-white">
                                <i class="fas fa-mobile-alt text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Réservation facile</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Réservez vos billets en quelques clics depuis votre smartphone ou votre ordinateur.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-slate-500 text-white">
                                <i class="fas fa-shield-alt text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Paiement sécurisé</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Vos paiements sont sécurisés avec les dernières technologies de cryptage.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-slate-500 text-white">
                                <i class="fas fa-map-marked-alt text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Large réseau</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Accédez à un vaste réseau de destinations à travers le pays.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-slate-500 text-white">
                                <i class="fas fa-headset text-xl"></i>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Support 24/7</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Notre équipe de support est disponible 24/7 pour vous assister.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Popular Routes Section -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-10">
                <h2 class="text-base text-slate-600 font-semibold tracking-wide uppercase">Destinations</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Trajets populaires
                </p>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-3">
                @foreach(\App\Models\Trajet::inRandomOrder()->take(6)->get() as $trajet)
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-bus text-slate-500 text-2xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ $trajet->depart }} → {{ $trajet->destination }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Durée: {{ $trajet->duree }}
                                    </p>
                                </div>
                                <div class="ml-auto">
                                    <span class="text-xl font-bold text-slate-600">{{ $trajet->prix }} DH</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3">
                            <a href="{{ route('trips.show', $trajet) }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                                Voir les détails →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('trajets') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-slate-600 hover:bg-slate-700">
                    Voir tous les trajets
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection