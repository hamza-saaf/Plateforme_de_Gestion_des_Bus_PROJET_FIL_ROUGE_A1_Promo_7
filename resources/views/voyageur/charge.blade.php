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
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Confirmer votre réservation</h2>
            
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Montant à payer:</span>
                    <span class="text-xl font-bold text-green-600">{{ number_format($amount, 2) }} DH</span>
                </div>
            </div>

            <form id="payment-form" action="{{ route('charge.post') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="trajet_id" value="{{ $trajet_id }}">

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" 
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                           required>
                </div>

                <div class="space-y-2">
                    <label for="card-element" class="block text-sm font-medium text-gray-700">
                        Carte de crédit ou de débit
                    </label>
                    <div id="card-element" class="p-3 border border-gray-300 rounded-md">
                        <!-- Stripe Element will be inserted here -->
                    </div>
                    <div id="card-errors" role="alert" class="text-red-600 text-sm"></div>
                </div>

                <button type="submit" 
                        class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Confirmer le paiement
                </button>
            </form>
        </div>
    </div>

    <script>
        // Create a Stripe client.
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        // Create an instance of the card Element.
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div.
        card.mount('#card-element');

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
    @else
    <div class="text-center p-6">
        <p class="text-red-600 mb-4">Vous devez être connecté pour effectuer une réservation.</p>
        <a href="{{ route('login') }}" class="inline-block bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">Se connecter</a>
    </div>
    @endauth
</body>

</html>
