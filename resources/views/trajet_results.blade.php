<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($trajets as $trajet)
        <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg shadow-lg overflow-hidden border border-gray-300 hover:shadow-2xl transition-shadow duration-300">
            <div class="relative">
                <img src="{{ asset('img/BusCard.avif') }}" alt="Bus Image" class="w-full h-48 object-cover rounded-t-lg">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-40"></div>
                <div class="absolute bottom-0 left-0 p-4 text-white">
                    <h3 class="text-lg font-bold flex items-center">
                        {{ $trajet->depart }}
                        <i class="fas fa-arrow-right mx-2 text-yellow-400"></i>
                        {{ $trajet->destination }}
                    </h3>
                    <p class="text-sm">{{ $trajet->date }}</p>
                </div>
            </div>

            <div class="p-6">
                <div class="mb-4">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-map-marker-alt text-green-500"></i>
                        <p class="ml-3 text-sm text-gray-600">Départ: <span class="font-medium text-gray-800">{{ $trajet->depart }}</span></p>
                    </div>

                    <div class="flex items-center mb-3">
                        <i class="fas fa-map-marker text-red-500"></i>
                        <p class="ml-3 text-sm text-gray-600">Destination: <span class="font-medium text-gray-800">{{ $trajet->destination }}</span></p>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-calendar text-blue-500"></i>
                        <p class="ml-3 text-sm text-gray-600">Date: <span class="font-medium text-gray-800">{{ $trajet->date }}</span></p>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-300">
                    <span class="text-xl font-bold text-green-600">{{ $trajet->price }} DH</span>
                    <a href="{{ route('trips.show', $trajet->id) }}" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors duration-300 font-medium">
                        Voir les détails
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
