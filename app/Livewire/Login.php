<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $password;

    public $errorMessage; // ⚙️ Public property to store error

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['name' => $this->name, 'password' => $this->password])) {
            return redirect()->route('show-qr-code');
        } else {
            $this->errorMessage = 'Cek kembali name dan password anda.';
        }
    }

    public function render()
    {
        return view('livewire.login')
            ->layout("livewire.pages.login");
    }
}
