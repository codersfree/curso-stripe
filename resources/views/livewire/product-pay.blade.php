<div>
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-lg font-semibold text-gray-700">
                    Método de pago
                </h1>
    
                <img class="h-8" src="https://codersfree.com/img/payments/credit-cards.png" alt="">
            </div>

            <div class="mb-4">
                <div wire:ignore>
                    <input id="card-holder-name" class="form-control mb-4" placeholder="Nombre del titular de la tarjeta">

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="form-control mb-2"></div>

                    <span id="card-error-message" class="text-red-600 text-sm"></span>
                </div>

                <x-button class="w-full" id="card-button" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </x-button>
            </div>

            @if (count($paymentMethods))
            
                <ul class="space-y-2 mb-4">
                    @foreach ($paymentMethods as $paymentMethod)
                        <li wire:key="{{ $paymentMethod->id }}">
                            <label>
                                <input wire:model="paymentMethodId" type="radio" value="{{$paymentMethod->id}}">

                                {{ $paymentMethod->billing_details->name }} - **** **** **** {{ $paymentMethod->card->last4 }}

                            </label>
                        </li>
                    @endforeach
                </ul>

                <x-danger-button 
                    wire:click="pay"
                    wire:target="pay"
                    wire:loading.attr="disabled">
                    Pagar
                </x-danger-button>

            @endif
        </div>
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
