<aside class="hidden min-w-72 w-72 h-[110%] lg:flex flex-col justify-between">
    <ul class="space-y-4">
        <li class="rounded-lg {{ request()->routeIs('show-qr-code') ? "active" : ""}}">
            <a href="{{ route('show-qr-code') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium" wire:navigate>
                <x-lucide-scan-qr-code class="size-6 mr-3" />
                <p>{{ __('QR Code') }}</p>
            </a>
        </li>
        <li class="rounded-lg {{ request()->routeIs('tarif') ? "active" : ""}}">
            <a href="{{ route('tarif') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium" wire:navigate>
                <x-lucide-table-2 class="size-6 mr-3" />
                <p>{{ __('Tarif') }}</p>
            </a>
        </li>
    </ul>

    <div class="flex items-center justify-between sm:hidden lg:flex">
        <div class="flex flex-col">
            <p class="text-base font-semibold">Haidarijlal</p>
            <span class="text-xs text-gray-500">m.haidarijl@gmail.com</span>
        </div>

        @livewire('logout')
    </div>
</aside>