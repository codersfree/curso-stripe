<?php

namespace App\Livewire;

use Livewire\Component;

class ProductPay extends Component
{
    public $product;

    public $paymentMethodId;

    public function mount()
    {
        if (auth()->user()->hasDefaultPaymentMethod()) {
            $this->paymentMethodId = auth()->user()->defaultPaymentMethod()->id;
        }
    }

    public function addPaymentMethod($paymentMethod)
    {
        auth()->user()->addPaymentMethod($paymentMethod);

        if(!auth()->user()->hasDefaultPaymentMethod()) {
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }

        $this->paymentMethodId = $paymentMethod;

        $this->pay();
    }

    public function pay()
    {
        try {
            auth()->user()
                ->charge(
                    $this->product->price * 100,
                    $this->paymentMethodId,
                    [
                        'return_url' => route('gracias')
                    ]
                );

            return redirect()->route('gracias');
        } catch (\Exception $e) {
            
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => __($e->getMessage()),
            ]);

            return;
        }
    }


    public function render()
    {
        return view('livewire.product-pay', [
            'intent' => auth()->user()->createSetupIntent(),
            'paymentMethods' => auth()->user()->paymentMethods()
        ]);
    }
}
