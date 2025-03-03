<li class="rounded-lg {{ request()->routeIs($route) ? "active" : ""}}">
  <a href="{{ route($route) }}" class="flex items-center gap-3 px-4 py-2 rounded-lg font-medium" wire:navigate>
    <p>{{ __($title) }}</p>
  </a>
</li>