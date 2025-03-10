<header class="mx-5 space-y-2 pb-2 border-b border-gray-200 flex justify-between">
    <div class="space-y-3">
        <h1 class="text-4xl font-bold">{{ $title ?? 'Title' }}</h1>
    </div>

    <div class="lg:hidden">
        @livewire('logout')
    </div>
</header>