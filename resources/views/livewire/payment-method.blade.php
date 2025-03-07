<div>
    <div class="bg-white rounded shadow-lg">
        <div class="px-8 py-6">

            <h1 class="text-gray-700 text-lg font-semibold mb-4">Agregar método de pago</h1>

            <div class="flex" wire:ignore>
                <p class="text-gray-600 mr-6">
                    Información de tarjeta
                </p>
                <div class="flex-1">
                    <input id="card-holder-name" class="form-control mb-4" placeholder="Nombre del titular de la tarjeta">

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="form-control mb-2"></div>

                    <span id="card-error-message" class="text-red-600 text-sm"></span>
                </div>
            </div>
        </div>

        <footer class="px-8 py-6 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-end">
                <x-button id="card-button" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </x-button>
            </div>
        </footer>
    </div>

    @push('js')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');
        </script>

        <script>
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            

            cardButton.addEventListener('click', async (e) => {

                //Deshabilitar boton
                cardButton.disabled = true;

                const clientSecret = cardButton.dataset.secret;

                const {
                    setupIntent,
                    error
                } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: {
                                name: cardHolderName.value
                            }
                        }
                    }
                );

                //Habilitar boton
                cardButton.disabled = false;

                if (error) {
                    let span = document.getElementById('card-error-message');
                    span.textContent = error.message;
                } else {

                    cardHolderName.value = '';
                    cardElement.clear();

                    @this.addPaymentMethod(setupIntent.payment_method);
                }
                
            });
        </script>
    @endpush
</div>
