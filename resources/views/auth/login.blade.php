<x-guest-layout>
  {{-- Heading --}}
  <div class="mb-8">
    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Welcome back</p>
    <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">
      Sign in to your account
    </h1>
    <p class="mt-2 text-sm text-muted">
      Good to see you again. Enter your details to continue.
    </p>
  </div>

  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autofocus autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div>
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="current-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="flex items-center justify-between gap-3">
      <label for="remember_me" class="inline-flex items-center gap-2">
        <input id="remember_me" type="checkbox" class="checkbox" name="remember">
        <span class="text-sm text-muted">{{ __('Remember me') }}</span>
      </label>

      @if (Route::has('password.request'))
        <a class="link text-sm" href="{{ route('password.request') }}">
          {{ __('Forgot your password?') }}
        </a>
      @endif
    </div>

    <x-primary-button class="w-full justify-center">
      {{ __('Log in') }}
    </x-primary-button>
  </form>

  <p class="mt-8 text-center text-sm text-muted">
    Don’t have an account?
    <a href="{{ route('register') }}" class="link">Create one</a>
  </p>
</x-guest-layout>
