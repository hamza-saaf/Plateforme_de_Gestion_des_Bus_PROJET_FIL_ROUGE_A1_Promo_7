<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout - BusFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    @auth
        <div class="max-w-md mx-auto mt-10">
            <!-- Alert Messages -->
            <div id="alert-container" class="mb-4 hidden">
                <div id="success-alert"
                    class="hidden p-4 mb-4 text-sm rounded-lg bg-green-100 text-green-700 border border-green-400"
                    role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span id="success-message"></span>
                    </div>
                </div>
                <div id="error-alert"
                    class="hidden p-4 mb-4 text-sm rounded-lg bg-red-100 text-red-700 border border-red-400" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span id="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Confirmer votre réservation</h2>

                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Montant à payer:</span>
                        <span class="text-xl font-bold text-green-600">{{ number_format($amount, 2) }} DH</span>
                    </div>
                </div>

                <!-- ... existing payment form ... -->
                <form id="payment-form" action="{{ route('charge.post') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <input type="hidden" name="trajet_id" value="{{ $trajet_id }}">

                    <!-- Traveler Information Section -->
                    <div class="mb-6 border-b pb-6">
                        <h3 class="text-lg font-semibold mb-4">Informations du voyageur</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                                <input type="text" name="full_name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="tel" name="phone" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Adresse</label>
                                <input type="text" name="address" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>
                        </div>
                    </div>

                    <!-- Existing payment elements -->
                    <div class="space-y-2">
                        <label for="card-element" class="block text-sm font-medium text-gray-700">
                            Carte de crédit ou de débit
                        </label>
                        <div id="card-element" class="p-3 border border-gray-300 rounded-md">
                            <!-- Stripe Element will be inserted here -->
                        </div>
                        <div id="card-errors" role="alert" class="text-red-600 text-sm"></div>
                    </div>

                    <button id="submit-button" type="submit"
                        class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span id="button-text">Confirmer le paiement</span>
                        <span id="button-loading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Traitement en cours...
                        </span>
                    </button>
                </form>
                {{--  --}}
            </div>
        </div>

        <script>
            // Create a Stripe client.
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#32325d',
                    }
                }
            });

            // Add an instance of the card Element into the `card-element` div.
            card.mount('#card-element');

            // Handle form submission.
            var form = document.getElementById('payment-form');
            var submitButton = document.getElementById('submit-button');
            var buttonText = document.getElementById('button-text');
            var buttonLoading = document.getElementById('button-loading');

            function showSuccessAlert(message) {
                document.getElementById('alert-container').classList.remove('hidden');
                var alert = document.getElementById('success-alert');
                alert.classList.remove('hidden');
                document.getElementById('success-message').textContent = message;
                setTimeout(function() {
                    alert.classList.add('hidden');
                }, 5000);
            }

            function showErrorAlert(message) {
                document.getElementById('alert-container').classList.remove('hidden');
                var alert = document.getElementById('error-alert');
                alert.classList.remove('hidden');
                document.getElementById('error-message').textContent = message;
                setTimeout(function() {
                    alert.classList.add('hidden');
                }, 5000);
            }

            function setLoading(isLoading) {
                submitButton.disabled = isLoading;
                if (isLoading) {
                    buttonText.classList.add('hidden');
                    buttonLoading.classList.remove('hidden');
                } else {
                    buttonText.classList.remove('hidden');
                    buttonLoading.classList.add('hidden');
                }
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                setLoading(true);

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        showErrorAlert(result.error.message);
                        setLoading(false);
                    } else {
                        // Send the token to your server.
                        var form = document.getElementById('payment-form');
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', result.token.id);
                        form.appendChild(hiddenInput);

                        // Submit the form
                        fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form),
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showSuccessAlert(
                                        'Paiement effectué avec succès! Votre réservation est confirmée.'
                                    );
                                    // Redirect after showing the success message
                                    setTimeout(() => {
                                        window.location.href = '/bookings';
                                    }, 2000);
                                } else {
                                    showErrorAlert(data.message ||
                                        'Une erreur est survenue lors du traitement du paiement.');
                                    setLoading(false);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showErrorAlert(
                                    'Une erreur est survenue lors de la communication avec le serveur.');
                                setLoading(false);
                            });
                    }
                });
            });
        </script>
    @else
        <div class="text-center p-6">
            <p class="text-red-600 mb-4">Vous devez être connecté pour effectuer une réservation.</p>
            <a href="{{ route('login') }}"
                class="inline-block bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">Se connecter</a>
        </div>
    @endauth
</body>

</html>
