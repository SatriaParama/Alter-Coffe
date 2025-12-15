<x-guest-layout>
  <h1 class="text-2xl font-semibold">Confirm password</h1>
  <p class="mt-2 text-sm text-gray-600">
    Please confirm your password before continuing.
  </p>

  <form method="POST" action="{{ route('password.confirm') }}" class="mt-6 space-y-4">
    @csrf

    <div>
      <x-input-label for="password" value="Password" />
      <x-text-input id="password" name="password" type="password" required autocomplete="current-password" class="mt-2" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <x-primary-button>Confirm</x-primary-button>
  </form>
</x-guest-layout>
