<!doctype html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Alter Coffe</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#FAF7F2] text-gray-900">
  {{-- soft background --}}
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-br from-white to-[#EFE6D8] opacity-60"></div>
    <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-white/60 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-white/50 blur-3xl"></div>
  </div>

  <main class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-md">
      {{-- brand --}}
      <div class="text-center mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
          <span class="text-xl font-semibold tracking-wide">Alter Coffe</span>
        </a>
        <p class="mt-2 text-sm text-gray-600">Modern coffee, made for your vibe.</p>
      </div>

      {{-- card --}}
      <div class="bg-white/80 backdrop-blur border rounded-3xl shadow-sm p-7">
        {{ $slot }}
      </div>

      {{-- bottom link --}}
      <p class="text-center text-xs text-gray-600 mt-6">
        © {{ date('Y') }} Alter Coffe. All rights reserved.
      </p>
    </div>
  </main>
</body>
</html>
