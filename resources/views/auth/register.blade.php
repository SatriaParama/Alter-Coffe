<x-guest-layout>
  <h1 class="text-2xl font-semibold">Create account</h1>
  <p class="mt-2 text-sm text-gray-600">Join Alter Coffe and order in seconds.</p>

  <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
    @csrf

    <div>
      <x-input-label for="name" value="Name" />
      <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name" class="mt-2" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="email" value="Email" />
      <x-text-input id="email" name="email" type="email" :value="old('email')" required autocomplete="username" class="mt-2" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="password" value="Password" />
      <x-text-input id="password" name="password" type="password" required autocomplete="new-password" class="mt-2" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="password_confirmation" value="Confirm Password" />
      <x-text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-2" />
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <x-primary-button>Create account</x-primary-button>

    <p class="text-center text-sm text-gray-600">
      Already have an account?
      <a class="underline hover:opacity-70" href="{{ route('login') }}">Login</a>
    </p>
  </form>
</x-guest-layout>
