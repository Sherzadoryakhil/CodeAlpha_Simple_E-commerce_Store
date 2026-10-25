<x-guest-layout>
  {{-- Heading --}}
  <div class="mb-8">
    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Account recovery</p>
    <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">
      Forgot your password?
    </h1>
    <p class="mt-2 text-sm text-muted">
      {{ __('No problem. Enter your email and we’ll send you a reset link so you can choose a new one.') }}
    </p>
  </div>

  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
    @csrf

    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autofocus />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <x-primary-button class="w-full justify-center">
      {{ __('Email Password Reset Link') }}
    </x-primary-button>
  </form>

  <p class="mt-8 text-center text-sm text-muted">
    Remembered it?
    <a href="{{ route('login') }}" class="link">Back to sign in</a>
  </p>
</x-guest-layout>
