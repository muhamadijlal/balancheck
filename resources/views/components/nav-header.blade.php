<div class="p-1 bg-gray-100 rounded-xl mt-2 flex items-center gap-2 justify-content-between nav-header lg:hidden">
    <a href="{{ route('show-qr-code') }}" class="text-gray-500 font-bold rounded-lg p-2 w-full text-center {{ request()->routeIs('show-qr-code') ? "active" : ""}}" wire:navigate>QR Code</a>
    <a href="{{ route('tarif') }}" class="text-gray-500 font-bold rounded-lg p-2 w-full text-center {{ request()->routeIs('tarif') ? "active" : ""}}" wire:navigate>Tarif</a>
</div>