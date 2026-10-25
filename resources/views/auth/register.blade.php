<x-guest-layout>
  {{-- Heading --}}
  <div class="mb-8">
    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Get started</p>
    <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">
      Create your account
    </h1>
    <p class="mt-2 text-sm text-muted">
      One quick step and you’re ready to shop.
    </p>
  </div>

  <form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf

    <!-- Name -->
    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
        autofocus autocomplete="name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
        autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div>
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div>
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

      <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
        required autocomplete="new-password" />

      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <x-primary-button class="w-full justify-center">
      {{ __('Register') }}
    </x-primary-button>
  </form>

  <p class="mt-8 text-center text-sm text-muted">
    Already registered?
    <a href="{{ route('login') }}" class="link">Sign in</a>
  </p>
</x-guest-layout>
