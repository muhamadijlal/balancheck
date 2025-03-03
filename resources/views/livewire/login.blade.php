<x-card class="w-[350px]">
    <x-card.header>
      <x-card.title>Login</x-card.title>
      <x-card.description>login with your account.</x-card.description>
    </x-card.header>
    <form wire:submit="login">
        <x-card.content>
            <div class="grid w-full items-center gap-4">
                <div class="flex flex-col space-y-1.5">
                    <x-label htmlfor="email">Email</x-label>
                    <x-input
                        id="email"
                        type="email"
                        wire:model="email"
                        placeholder="example@example.com"
                    />
                    @error("email") <span class="text-red-500 mt-3 text-sm">{{ __($message) }}</span> @enderror
                </div>
                <div class="flex flex-col space-y-1.5">
                    <x-label htmlfor="password">Password</x-label>
                    <x-input
                        id="password"
                        type="password"
                        wire:model="password"
                        placeholder="********"
                    />
                    @error("password") <span class="text-red-500 mt-3 text-sm">{{ __($message) }}</span> @enderror
                </div>
            </div>
        </x-card.content>
        <x-card.footer class="flex justify-end">
            <x-button type="submit">Login</x-button>
        </x-card.footer>
    </form>
</x-card>

