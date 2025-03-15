<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

class Subscription extends Component
{
    public function newSubscription($plan)
    {

        if(!auth()->user()->defaultPaymentMethod()){

            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'Debes agregar un método de pago antes de suscribirte.',
            ]);

            return;
        }

        try {

            if (auth()->user()->subscribed('Suscripciones blog')) {
                auth()->user()
                    ->subscription('Suscripciones blog')
                    ->swap($plan);

                $this->dispatch('newSubscription');

                return;
            }


            auth()->user()
                ->newSubscription('Suscripciones blog', $plan)
                ->create(
                    auth()->user()->defaultPaymentMethod()->id
                );

            $this->dispatch('newSubscription');

        } catch (\Exception $e) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => __($e->getMessage()),
            ]);

            return;
        }
        
    }

    public function cancelSubscription()
    {
        auth()->user()
            ->subscription('Suscripciones blog')
            ->cancel();
    }

    public function resumeSubscription()
    {
        auth()->user()
            ->subscription('Suscripciones blog')
            ->resume();
    }

    public function render()
    {
        auth()->user()->refresh();
        return view('livewire.subscription');
    }
}
