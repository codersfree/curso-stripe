<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Invoices extends Component
{
    #[On('newSubscription')]
    public function render()
    {
        return view('livewire.invoices', [
            'invoices' => auth()->user()->invoices()
        ]);
    }
}
