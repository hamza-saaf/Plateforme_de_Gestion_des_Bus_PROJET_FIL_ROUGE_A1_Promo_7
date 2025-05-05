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

<body>
    <div class="bg-gray-50 p-6 rounded-lg">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Réserver votre place</h2>
        <form id="payment-form" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="tel" id="phone" name="phone" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <div class="border-t border-gray-200 pt-4 mt-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Paiement</h3>

                <div class="mb-4">
                    <label for="card-element" class="block text-sm font-medium text-gray-700 mb-2">
                        Carte de crédit
                    </label>
                    <div id="card-element" class="p-3 border border-gray-300 rounded-md bg-white">
                        <!-- Stripe Element will be inserted here -->
                    </div>
                    <div id="card-errors" class="mt-2 text-red-600 text-sm" role="alert"></div>
                </div>

                <h3 class="text-sm font-medium text-neutral-900">Moyens de Paiement</h3>
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <img alt="visa logo" loading="lazy" width="46" height="16" decoding="async"
                        data-nimg="1" class="h-4 object-cover" style="color:transparent"
                        srcset="/_next/image?url=%2Fassets%2Flogos%2Fvisa.webp&w=48&q=75 1x, /_next/image?url=%2Fassets%2Flogos%2Fvisa.webp&w=96&q=75 2x"
                        src="/_next/image?url=%2Fassets%2Flogos%2Fvisa.webp&w=96&q=75">

                    <img alt="mastercard logo" loading="lazy" width="33" height="20" decoding="async"
                        data-nimg="1" class="h-5" style="color:transparent"
                        srcset="/_next/image?url=%2Fassets%2Flogos%2Fmastercard.webp&w=48&q=75 1x, /_next/image?url=%2Fassets%2Flogos%2Fmastercard.webp&w=96&q=75 2x"
                        src="/_next/image?url=%2Fassets%2Flogos%2Fmastercard.webp&w=96&q=75">

                    <img alt="paypal logo" loading="lazy" width="24" height="24" decoding="async"
                        data-nimg="1" class="size-6 object-cover" style="color:transparent"
                        srcset="/_next/image?url=%2Fassets%2Flogos%2Fpaypal.webp&w=32&q=75 1x, /_next/image?url=%2Fassets%2Flogos%2Fpaypal.webp&w=48&q=75 2x"
                        src="/_next/image?url=%2Fassets%2Flogos%2Fpaypal.webp&w=48&q=75">

                    <img alt="cmi logo" loading="lazy" width="36" height="17" decoding="async" data-nimg="1"
                        class="h-[17px] object-cover" style="color:transparent"
                        srcset="/_next/image?url=%2Fassets%2Flogos%2Fcmi.webp&w=48&q=75 1x, /_next/image?url=%2Fassets%2Flogos%2Fcmi.webp&w=96&q=75 2x"
                        src="/_next/image?url=%2Fassets%2Flogos%2Fcmi.webp&w=96&q=75">

                    <img alt="m2t logo" loading="lazy" width="52" height="12" decoding="async"
                        data-nimg="1" class="w-[52px] object-cover" style="color:transparent"
                        srcset="/_next/image?url=%2Fassets%2Flogos%2Fm2t.webp&w=64&q=75 1x, /_next/image?url=%2Fassets%2Flogos%2Fm2t.webp&w=128&q=75 2x"
                        src="/_next/image?url=%2Fassets%2Flogos%2Fm2t.webp&w=128&q=75">

                    <img alt="fatourati logo" loading="lazy" width="114" height="12" decoding="async"
                        data-nimg="1" class="w-[114px] object-cover" style="color:transparent"
                        srcset="/_next/image?url=%2Fassets%2Flogos%2Ffatourati-black.webp&w=128&q=75 1x, /_next/image?url=%2Fassets%2Flogos%2Ffatourati-black.webp&w=256&q=75 2x"
                        src="/_next/image?url=%2Fassets%2Flogos%2Ffatourati-black.webp&w=256&q=75">
                </div>

                <div class="mt-6 space-y-4">
                    <div class="flex justify-between items-center font-semibold">
                        <span class="text-gray-700">Total à payer:</span>
                        <span class="text-green-600 text-xl">{{ number_format($trajet->price, 2) }} DH</span>
                    </div>
                    <button type="submit" id="submit-button"
                        class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                        Confirmer la réservation
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Initialize Stripe
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();

        // Create card Element and mount it
        const card = elements.create('card');
        card.mount('#card-element');

        // Handle form submission
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');
        let paymentIntentId = null;

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            submitButton.disabled = true;

            try {
                // Create PaymentIntent
                const response = await fetch('/payment/create-intent/{{ $trajet->id }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });
                
                const data = await response.json();
                
                if (data.error) {
                    throw new Error(data.error);
                }

                // Confirm card payment
                const {error, paymentIntent} = await stripe.confirmCardPayment(data.clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            email: document.getElementById('email').value
                        }
                    }
                });

                if (error) {
                    throw new Error(error.message);
                }

                // Process the successful payment
                const processResponse = await fetch('/payment/process/{{ $trajet->id }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        phone: document.getElementById('phone').value,
                        payment_intent_id: paymentIntent.id
                    })
                });

                const result = await processResponse.json();
                
                if (result.success) {
                    alert('Payment successful! Your booking has been confirmed.');
                    window.location.href = '/'; // Redirect to home or booking confirmation page
                } else {
                    throw new Error(result.message);
                }
            } catch (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
                submitButton.disabled = false;
            }
        });
    </script>
</body>

</html>
