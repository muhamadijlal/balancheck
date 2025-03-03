<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Tarif extends Component
{
    public function render()
    {
        return view('livewire.pages.tarif')
            ->layout('livewire.layouts', [
                'title' => 'Tarif',
                'description' => 'Check list tarif ruas.'
            ]);
    }
}
