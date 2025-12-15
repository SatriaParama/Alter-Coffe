<x-guest-layout>
  <h1 class="text-2xl font-semibold">Reset password</h1>
  <p class="mt-2 text-sm text-gray-600">Create a new password for your account.</p>

  <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-4">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div>
      <x-input-label for="email" value="Email" />
      <x-text-input id="email" name="email" type="email" :value="old('email', $request->email)" required autofocus class="mt-2" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="password" value="New Password" />
      <x-text-input id="password" name="password" type="password" required class="mt-2" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div>
      <x-input-label for="password_confirmation" value="Confirm Password" />
      <x-text-input id="password_confirmation" name="password_confirmation" type="password" required class="mt-2" />
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <x-primary-button>Reset password</x-primary-button>
  </form>
</x-guest-layout>
