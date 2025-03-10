<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\On;
use Livewire\Component;

class Qrcode extends Component
{
    public $data;
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

        $this->data = $BASE_QRCODE_URL . '/?cluster=' . $data['clusterId'] . '&cb=' . $data['ruasId'] . '&gb=' . $data['gerbangId'];

        // Set loading menjadi false setelah data selesai diproses
        $this->loading = false;

        // Trigger JavaScript to reset the data after 10 seconds
        $this->dispatch('start-timer');
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
            ->layout('livewire.layouts', [
                'title' => 'QR Code',
                'description' => 'Check your QR code now.'
            ]);
    }
}
