<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Qrcode extends Component
{
    public $data;
    public $statusCode;
    public $loading = false;

    #[On('filter-submitted')]
    public function generateQRCode($data)
    {
        // Set loading menjadi true saat data sedang diproses
        $this->loading = true;

        // Setelah data didapatkan, update nilai data

        // Example data
        // https://iot.amarullz.com/saldo/?cluster=3&cb=45&gb=30

        $BASE_QRCODE_URL = env('BASE_QRCODE_URL');

        $URI = $BASE_QRCODE_URL . '/?cluster=' . $data['clusterId'] . '&cb=' . $data['ruasId'] . '&gb=' . $data['gerbangId'];
        $FALLBACK_URI = asset("assets/images/image-off.svg");

        // Hit API GET
        $response = Http::get($URI);
        $this->statusCode = $response->getStatusCode();

        if($response->getStatusCode() === 500){
            $this->data = $FALLBACK_URI;
        } else {
            $this->dispatch('start-timer');
            $this->data = $URI;
        }

        // Set loading menjadi false setelah data selesai diproses
        $this->loading = false;
    }

    // Method to reset data
    #[On('resetData')]
    public function resetData()
    {
        $this->data = null; // Reset the $data
    }

    public function render()
    {
        return view('livewire.pages.qrcode')
            ->layout('livewire.layouts');
    }
}
