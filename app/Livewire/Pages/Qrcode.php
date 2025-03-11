<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Qrcode extends Component
{
    public $data;
    public $statusCode;
    public $contentType;

    #[On('filter-submitted')]
    public function generateQRCode($data)
    {
        // Example data
        // https://iot.amarullz.com/saldo/?cluster=3&cb=45&gb=30

        $BASE_QRCODE_URL = env('BASE_QRCODE_URL');

        $URI = $BASE_QRCODE_URL . '/?cluster=' . $data['clusterId'] . '&cb=' . $data['ruasId'] . '&gb=' . $data['gerbangId'];
        $FALLBACK_URI = asset("assets/images/image-off.svg");

        // Hit API GET
        $response = Http::get($URI);
        
        $this->statusCode = $response->getStatusCode();
        $this->contentType = $response->getHeaders()['Content-Type'][0];

        // cara alternatif cek Content-Type = 'image/gif'
        if($response->getStatusCode() === 200 && $response->getHeaders()['Content-Type'][0] === 'image/gif'){
            $this->dispatch('start-timer');
            $this->data = $URI;
        } else {
            $this->data = $FALLBACK_URI;
        }
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
