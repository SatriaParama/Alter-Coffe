<x-guest-layout>
  <h1 class="text-2xl font-semibold">Verify your email</h1>
  <p class="mt-2 text-sm text-gray-600">
    Thanks for signing up! Please verify your email address by clicking the link we sent.
    If you didn’t receive it, we can send another.
  </p>

  @if (session('status') == 'verification-link-sent')
    <div class="mt-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-2xl p-3">
      A new verification link has been sent to your email address.
    </div>
  @endif

  <div class="mt-6 space-y-3">
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <x-primary-button>Resend verification email</x-primary-button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="w-full px-4 py-2.5 rounded-2xl bg-white border hover:opacity-90">
        Logout
      </button>
    </form>
  </div>
</x-guest-layout>
