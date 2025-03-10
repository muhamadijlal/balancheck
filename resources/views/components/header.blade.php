<header class="mx-5 space-y-2 border-b border-gray-200 flex justify-between">
    <div class="space-y-3">
        <h1 class="text-4xl font-bold">{{ $title ?? 'Title' }}</h1>
        <p class="text-gray-500 font-normal text-base">{{ $description }}</p>
    </div>

    <div class="lg:hidden">
        @livewire('logout')
    </div>
</header>