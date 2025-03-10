<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name') }}</title>
  @vite(['resources/css/luvi-ui.css', 'resources/css/app.css', 'resources/js/app.js'])
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
  </style>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  @livewireStyles
</head>
<body class="px-6 pt-6 md:px-12 md:pt-12 h-full">
  <div class="mt-5 mb-8 space-y-6">
    <x-header title="{{ __('Apps Pembacaan saldo') }}" description="{{ __('Aplikasi pembacaan asal gerbang dan saldo') }}" />
    <x-nav-header />
  </div>

  <div class="flex gap-10 h-[calc(100vh-12rem)]">
    <x-sidebar />

    <main class="w-[calc(100% - 256px)] h-full flex-1 overflow-y-scroll overflow-x-hidden px-5">
      {{ $slot }}
    </main>
  </div>
  @livewireScripts
  @stack('scripts')
  </body>
</html>