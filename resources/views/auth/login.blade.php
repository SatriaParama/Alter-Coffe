<x-guest-layout>
  <h1 class="text-2xl font-semibold">Welcome back</h1>
  <p class="mt-2 text-sm text-gray-600">Login to continue your Alter Coffe experience.</p>

  <x-auth-session-status class="mt-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
    @csrf

    <div>
      <x-input-label for="email" value="Email" />
      <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="mt-2" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="password" value="Password" />
      <x-text-input id="password" type="password" name="password" required autocomplete="current-password" class="mt-2" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex items-center justify-between text-sm">
      <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#EFE6D8] focus:ring-[#EFE6D8]" />
        <span class="text-gray-700">Remember me</span>
      </label>

      @if (Route::has('password.request'))
        <a class="underline text-gray-700 hover:opacity-70" href="{{ route('password.request') }}">
          Forgot password?
        </a>
      @endif
    </div>

    <x-primary-button>Login</x-primary-button>

    <p class="text-center text-sm text-gray-600">
      New here?
      <a class="underline hover:opacity-70" href="{{ route('register') }}">Create an account</a>
    </p>
  </form>
</x-guest-layout>
