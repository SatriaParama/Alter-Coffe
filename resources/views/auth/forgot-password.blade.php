<x-guest-layout>
  <h1 class="text-2xl font-semibold">Forgot password</h1>
  <p class="mt-2 text-sm text-gray-600">
    Enter your email and we’ll send you a reset link.
  </p>

  <x-auth-session-status class="mt-4" :status="session('status')" />

  <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
    @csrf

    <div>
      <x-input-label for="email" value="Email" />
      <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus class="mt-2" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <x-primary-button>Send reset link</x-primary-button>

    <p class="text-center text-sm text-gray-600">
      Back to <a class="underline hover:opacity-70" href="{{ route('login') }}">Login</a>
    </p>
  </form>
</x-guest-layout>
