<x-app-layout>

    <x-container class="py-12">

        <div class="mb-24">
            @livewire('subscription')
        </div>

        <div class="mb-24">
            @livewire('payment-method')
        </div>

        @livewire('invoices')
        
    </x-container>

</x-app-layout>