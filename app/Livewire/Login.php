<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|email')]
    public $email;

    #[Validate('required')]
    public $password;

    public $errorMessage; // ⚙️ Public property to store error

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('show-qr-code');
        } else {
            $this->errorMessage = 'Cek kembali email dan password anda.';
        }
    }

    public function render()
    {
        return view('livewire.login')
            ->layout("livewire.pages.login");
    }
}
