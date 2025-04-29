<h2 class="text-2xl font-bold items-center text-gray-800">Résultats de recherche</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($trajets as $trajet)
        <div
            class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300">
            <div class="bg-green-600 text-white px-4 py-2 font-semibold flex justify-between items-center">
                <span>Trajet {{ $loop->iteration }}</span>
                <span class="text-white font-bold">{{ $trajet->price }} DH</span>
            </div>

            <div class="p-5">
                <div class="mb-4">
                    <div class="flex items-start mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-500">Départ</p>
                            <p class="font-medium text-gray-800">{{ $trajet->depart }}</p>
                        </div>
                    </div>

                    <div class="flex items-start mb-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-500">Destination</p>
                            <p class="font-medium text-gray-800">{{ $trajet->destination }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-calendar text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-500">Date</p>
                            <p class="font-medium text-gray-800">{{ $trajet->date }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('trips.show', $trajet->id) }}"
                        class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-300 font-medium">
                        Voir les détails
                    </a>
                </div>
            </div>
        </div>
        @if (count($trajets) == 0)
            <div class="bg-gray-50 rounded-lg border border-gray-200 p-6 text-center">
                <p class="text-gray-500">Aucun trajet ne correspond à votre recherche.</p>
            </div>
        @endif
    @endforeach
</div>
