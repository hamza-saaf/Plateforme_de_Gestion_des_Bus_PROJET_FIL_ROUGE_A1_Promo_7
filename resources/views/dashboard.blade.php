@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tableau de bord</h2>

                @hasrole('admin')
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-blue-100 border-l-4 border-blue-500 p-4 rounded">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-users text-blue-500 text-3xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-blue-600">Utilisateurs totaux</p>
                                    <p class="text-2xl font-semibold text-blue-800">{{ \App\Models\User::count() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-ticket-alt text-green-500 text-3xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-green-600">Réservations totales</p>
                                    <p class="text-2xl font-semibold text-green-800">{{ \App\Models\Reservation::count() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-100 border-l-4 border-purple-500 p-4 rounded">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-bus text-purple-500 text-3xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-purple-600">Trajets actifs</p>
                                    <p class="text-2xl font-semibold text-purple-800">{{ \App\Models\Trajet::count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white border rounded-lg shadow-sm">
                            <div class="p-4 border-b">
                                <h3 class="text-lg font-medium text-gray-900">Actions rapides</h3>
                            </div>
                            <div class="p-4">
                                <div class="space-y-4">
                                    <a href="{{ route('admin.users.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Ajouter un utilisateur
                                    </a>
                                    <a href="{{ route('admin.trajets.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-plus-circle mr-2"></i>
                                        Créer un nouveau trajet
                                    </a>
                                    <a href="{{ route('admin.bookings.index') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-list mr-2"></i>
                                        Gérer les réservations
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border rounded-lg shadow-sm">
                            <div class="p-4 border-b">
                                <h3 class="text-lg font-medium text-gray-900">Activité récente</h3>
                            </div>
                            <div class="p-4">
                                <div class="space-y-4">
                                    @foreach(\App\Models\Reservation::latest()->take(5)->get() as $reservation)
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <i class="fas fa-ticket-alt text-gray-400 mr-3"></i>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">{{ $reservation->full_name }}</p>
                                                    <p class="text-sm text-gray-500">{{ $reservation->trajet->depart }} → {{ $reservation->trajet->destination }}</p>
                                                </div>
                                            </div>
                                            <span class="text-sm text-gray-500">{{ $reservation->created_at->diffForHumans() }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white border rounded-lg shadow-sm">
                            <div class="p-4 border-b">
                                <h3 class="text-lg font-medium text-gray-900">Mes réservations récentes</h3>
                            </div>
                            <div class="p-4">
                                @if(auth()->user()->bookings->count() > 0)
                                    <div class="space-y-4">
                                        @foreach(auth()->user()->bookings()->latest()->take(5)->get() as $booking)
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <i class="fas fa-ticket-alt text-gray-400 mr-3"></i>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $booking->trajet->depart }} → {{ $booking->trajet->destination }}</p>
                                                        <p class="text-sm text-gray-500">{{ $booking->created_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </div>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 text-center py-4">Vous n'avez pas encore de réservations</p>
                                @endif
                            </div>
                        </div>

                        <div class="bg-white border rounded-lg shadow-sm">
                            <div class="p-4 border-b">
                                <h3 class="text-lg font-medium text-gray-900">Actions rapides</h3>
                            </div>
                            <div class="p-4">
                                <div class="space-y-4">
                                    <a href="{{ route('trajets') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-search mr-2"></i>
                                        Rechercher un trajet
                                    </a>
                                    <a href="{{ route('profile.show') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-user mr-2"></i>
                                        Gérer mon profil
                                    </a>
                                    <a href="{{ route('bookings') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-history mr-2"></i>
                                        Voir mon historique
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasrole
            </div>
        </div>
    </div>
</div>
@endsection