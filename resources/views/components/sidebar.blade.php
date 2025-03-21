<aside class="hidden min-w-64 min-h-full lg:flex flex-col justify-between">
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

    <div class="flex items-center justify-between sm:hidden lg:flex p-4">
        <div class="flex flex-col">
            <p class="text-base font-semibold">{{ auth()->user()->name }}</p>
            <span class="text-xs text-gray-500">{{ auth()->user()->email }}</span>
        </div>

        @livewire('logout')
    </div>
</aside>