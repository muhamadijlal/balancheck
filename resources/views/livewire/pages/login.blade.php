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
  @livewireStyles
</head>
<body>
    <div class="grid h-screen place-content-center place-items-center">
        @livewire('login')
    </div>
@livewireScripts
</body>
</html>