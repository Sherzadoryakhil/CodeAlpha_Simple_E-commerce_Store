<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-ink antialiased">
  <div class="min-h-screen bg-cream">
    <div class="grid min-h-screen lg:grid-cols-2">

      {{-- LEFT: Brand / side image --}}
      <aside class="relative hidden overflow-hidden bg-primary-soft lg:block" aria-hidden="true">
        {{-- Gradient blobs --}}
        <div class="pointer-events-none absolute -left-24 -top-24 h-72 w-72 rounded-full bg-primary-200/70 blur-3xl">
        </div>
        <div
          class="pointer-events-none absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-primary-300/50 blur-3xl">
        </div>

        {{-- Backdrop image --}}
        <img src="https://images.unsplash.com/photo-1607083206869-4c7672e72a8a?auto=format&fit=crop&w=1400&q=80"
          alt="Warm shopping lifestyle scene"
          class="absolute inset-0 h-full w-full object-cover opacity-40 mix-blend-luminosity" loading="lazy"
          onerror="this.onerror=null;this.src='https://placehold.co/1200x1600/FFF7ED/FB923C?text=Shopping';">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-primary-950/40 via-primary-900/20 to-primary-950/60"></div>

        {{-- Content --}}
        <div class="relative flex h-full flex-col justify-between p-10 xl:p-14">
          <a href="/" class="inline-flex items-center gap-3">
            <span
              class="grid h-11 w-11 place-items-center rounded-2xl bg-gradient-to-br from-primary-300 to-primary-500 text-white shadow-lift">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-5 w-5">
                <path d="M6 8h12l-1.4 12H7.4L6 8Z"></path>
                <path d="M9 8V6a3 3 0 0 1 6 0v2"></path>
              </svg>
            </span>
            <span class="text-lg font-bold tracking-tight text-white">
              {{ config('app.name') }}
            </span>
          </a>

          <div class="max-w-md">
            <span class="badge bg-white/15 text-white ring-1 ring-inset ring-white/25">
              Trusted by shoppers
            </span>

            <p class="mt-5 text-3xl font-extrabold leading-tight tracking-tight text-white text-balance xl:text-4xl">
              A warm welcome to a<br>kinder kind of shopping.
            </p>

            <p class="mt-4 text-sm leading-relaxed text-white/80">
              Thoughtfully selected products, honest prices, and a checkout you’ll actually enjoy.
            </p>

            <ul class="mt-8 space-y-3 text-sm text-white/90">
              <li class="flex items-center gap-3">
                <span class="grid h-8 w-8 place-items-center rounded-xl bg-white/15 ring-1 ring-inset ring-white/25">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-4 w-4">
                    <path d="M20 6L9 17l-5-5"></path>
                  </svg>
                </span>
                Free shipping over $50
              </li>
              <li class="flex items-center gap-3">
                <span class="grid h-8 w-8 place-items-center rounded-xl bg-white/15 ring-1 ring-inset ring-white/25">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-4 w-4">
                    <path d="M20 6L9 17l-5-5"></path>
                  </svg>
                </span>
                Easy 30-day returns
              </li>
              <li class="flex items-center gap-3">
                <span class="grid h-8 w-8 place-items-center rounded-xl bg-white/15 ring-1 ring-inset ring-white/25">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-4 w-4">
                    <path d="M20 6L9 17l-5-5"></path>
                  </svg>
                </span>
                Secure checkout, always
              </li>
            </ul>
          </div>

          <p class="text-xs text-white/70">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
          </p>
        </div>
      </aside>

      {{-- RIGHT: Form column --}}
      <main class="flex min-h-screen flex-col bg-cream">
        {{-- Mobile brand bar --}}
        <div class="flex items-center justify-between px-6 pt-6 lg:hidden">
          <a href="/" class="inline-flex items-center gap-3">
            <span
              class="grid h-10 w-10 place-items-center rounded-2xl bg-gradient-to-br from-primary-300 to-primary-500 text-white shadow-lift">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-5 w-5">
                <path d="M6 8h12l-1.4 12H7.4L6 8Z"></path>
                <path d="M9 8V6a3 3 0 0 1 6 0v2"></path>
              </svg>
            </span>
            <span class="text-base font-bold tracking-tight text-ink">
              {{ config('app.name') }}
            </span>
          </a>

          <a href="{{ route('home') }}" class="text-sm font-semibold text-primary-700 hover:text-primary-800">
            Back to shop
          </a>
        </div>

        {{-- Slot wrapper (centered form) --}}
        <div class="flex flex-1 items-center justify-center px-4 py-10 sm:px-6 lg:px-10">
          <div class="w-full max-w-md">
            {{ $slot }}
          </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>
