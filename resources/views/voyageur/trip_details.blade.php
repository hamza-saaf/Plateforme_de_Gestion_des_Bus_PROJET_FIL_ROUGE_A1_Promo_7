@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Trip Details Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <h1 class="text-2xl font-bold text-gray-900">Détails du trajet</h1>
                    <p class="text-sm text-gray-500">Référence: #{{ $trajet->id }}</p>
                </div>

                <!-- Trip Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Informations du trajet</h2>
                            <div class="mt-3 space-y-3">
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-green-600 w-6"></i>
                                    <div class="ml-2">
                                        <p class="text-sm text-gray-500">Départ</p>
                                        <p class="font-medium">{{ $trajet->depart }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker text-red-600 w-6"></i>
                                    <div class="ml-2">
                                        <p class="text-sm text-gray-500">Destination</p>
                                        <p class="font-medium">{{ $trajet->destination }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar text-blue-600 w-6"></i>
                                    <div class="ml-2">
                                        <p class="text-sm text-gray-500">Date</p>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($trajet->date)->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <h2 class="text-lg font-semibold text-gray-900">Prix et disponibilité</h2>
                            <div class="mt-3 space-y-3">
                                <div class="flex items-center">
                                    <i class="fas fa-tag text-purple-600 w-6"></i>
                                    <div class="ml-2">
                                        <p class="text-sm text-gray-500">Prix par personne</p>
                                        <p class="text-xl font-bold text-green-600">{{ number_format($trajet->price, 2) }} DH</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-chair text-orange-600 w-6"></i>
                                    <div class="ml-2">
                                        <p class="text-sm text-gray-500">Places disponibles</p>
                                        <p class="font-medium">{{ $trajet->available_seats }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Réserver votre place</h2>
                        <form id="booking-form" class="space-y-4">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                                <input type="text" id="full_name" name="full_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="tel" id="phone" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div class="border-t border-gray-200 pt-4 mt-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Paiement</h3>
                                
                                <!-- Card Element -->
                                <div class="mb-4">
                                    <label for="card-element" class="block text-sm font-medium text-gray-700 mb-2">
                                        Carte de crédit
                                    </label>
                                    <div id="card-element" class="p-3 border border-gray-300 rounded-md bg-white">
                                        <!-- Stripe Card Element will be inserted here -->
                                        <div class="space-y-2">
                                            <div class="flex items-center border rounded-md p-2">
                                                <i class="fas fa-credit-card text-gray-400 mr-2"></i>
                                                <input type="text" placeholder="Numéro de carte" class="w-full focus:outline-none" maxlength="19">
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <input type="text" placeholder="MM/YY" class="border rounded-md p-2" maxlength="5">
                                                <input type="text" placeholder="CVC" class="border rounded-md p-2" maxlength="3">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total and Submit -->
                                <div class="mt-6 space-y-4">
                                    <div class="flex justify-between items-center font-semibold">
                                        <span class="text-gray-700">Total à payer:</span>
                                        <span class="text-green-600 text-xl">{{ number_format($trajet->price, 2) }} DH</span>
                                    </div>
                                    <button type="submit" class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                                        Confirmer la réservation
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const trajetId = {{ $trajet->id }};

document.addEventListener('DOMContentLoaded', function() {
    const bookingForm = document.getElementById('booking-form');
    
    bookingForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        // Disable submit button and show loading state
        const submitButton = this.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Traitement en cours...';

        fetch(`/trips/${trajetId}/reserve`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                alert('Réservation effectuée avec succès! Référence: ' + data.reservation.transaction_reference);
                // Redirect to confirmation page or refresh
                window.location.reload();
            } else {
                alert(data.message || 'Une erreur est survenue lors de la réservation.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la réservation.');
        })
        .finally(() => {
            // Reset button state
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });
    });

    // Format credit card number with spaces
    const cardInput = document.querySelector('input[placeholder="Numéro de carte"]');
    cardInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s/g, '');
        let formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();
        e.target.value = formattedValue;
    });

    // Format expiry date
    const expiryInput = document.querySelector('input[placeholder="MM/YY"]');
    expiryInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 2) {
            value = value.slice(0,2) + '/' + value.slice(2);
        }
        e.target.value = value;
    });
});
</script>
@endpush
@endsection