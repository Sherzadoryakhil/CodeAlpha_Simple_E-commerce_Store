<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-wrap items-end justify-between gap-3">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Account</p>
        <h2 class="mt-1 text-2xl font-extrabold leading-tight tracking-tight text-ink">
          {{ __('Profile') }}
        </h2>
        <p class="mt-1 text-sm text-muted">
          Manage your personal information, password, and account preferences.
        </p>
      </div>
    </div>
  </x-slot>

  <div class="py-8 sm:py-10">
    <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
      {{-- Update profile information --}}
      <section class="reveal overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70"
        aria-labelledby="update-profile-title">
        <header class="border-b border-primary-100 px-5 py-4 sm:px-8">
          <div class="flex items-start gap-3">
            <span
              class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-primary-soft text-primary-700 ring-1 ring-primary-100"
              aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-5 w-5">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </span>
            <div>
              <h3 id="update-profile-title" class="text-base font-bold text-ink">
                Profile information
              </h3>
              <p class="mt-0.5 text-sm text-muted">
                Update your name and email address.
              </p>
            </div>
          </div>
        </header>

        <div class="px-5 py-6 sm:px-8">
          <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
          </div>
        </div>
      </section>

      {{-- Update password --}}
      <section class="reveal overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70"
        aria-labelledby="update-password-title">
        <header class="border-b border-primary-100 px-5 py-4 sm:px-8">
          <div class="flex items-start gap-3">
            <span
              class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-primary-soft text-primary-700 ring-1 ring-primary-100"
              aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-5 w-5">
                <rect x="4" y="11" width="16" height="10" rx="2"></rect>
                <path d="M8 11V8a4 4 0 0 1 8 0v3"></path>
              </svg>
            </span>
            <div>
              <h3 id="update-password-title" class="text-base font-bold text-ink">
                Update password
              </h3>
              <p class="mt-0.5 text-sm text-muted">
                Use a long, unique password to keep your account safe.
              </p>
            </div>
          </div>
        </header>

        <div class="px-5 py-6 sm:px-8">
          <div class="max-w-xl">
            @include('profile.partials.update-password-form')
          </div>
        </div>
      </section>

      {{-- Delete account --}}
      <section class="reveal overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-red-100"
        aria-labelledby="delete-account-title">
        <header class="border-b border-red-100 bg-red-50/40 px-5 py-4 sm:px-8">
          <div class="flex items-start gap-3">
            <span
              class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-red-50 text-red-600 ring-1 ring-red-100"
              aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-5 w-5">
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                </path>
              </svg>
            </span>
            <div>
              <h3 id="delete-account-title" class="text-base font-bold text-ink">
                Delete account
              </h3>
              <p class="mt-0.5 text-sm text-muted">
                Once deleted, all data is permanently removed. This action cannot be undone.
              </p>
            </div>
          </div>
        </header>

        <div class="px-5 py-6 sm:px-8">
          <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
          </div>
        </div>
      </section>
    </div>
  </div>
</x-app-layout>
