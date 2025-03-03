<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;


class FilterForm extends Component
{
    #[Validate("required")]
    public $cluster;

    #[Validate("required")]
    public $ruas;

    #[Validate("required")]
    public $gerbang;

    public function submitFilter()
    {
        $this->validate();
       
        $this->dispatch('filter-submitted', [
            'clusterId' => $this->cluster,
            'ruasId' => $this->ruas, 
            'gerbangId' => $this->gerbang
        ]);
    }

    public function messages()
    {
        return [
            'cluster.required' => 'Please select a cluster',
            'ruas.required' => 'Please select a ruas',
            'gerbang.required' => 'Please select a gerbang'
        ];
    }

    public function render()
    {
        return view('livewire.filter-form');
    }
}
