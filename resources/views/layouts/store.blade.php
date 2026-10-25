<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#FB923C">
  <title>{{ $title ?? config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-cream font-sans text-ink antialiased" x-data="{ mobileMenuOpen: false }"
  x-on:keydown.escape.window="mobileMenuOpen = false">
  <a href="#main-content"
    class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-2xl focus:bg-primary-400 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">
    Skip to content
  </a>

  <header id="site-navbar" data-navbar
    class="sticky top-0 z-50 border-b border-primary-100/80 bg-white/85 backdrop-blur-xl">
    <div class="navbar-inner mx-auto flex h-[4.5rem] max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
      <a href="{{ route('home') }}" x-on:click="mobileMenuOpen = false" class="group flex min-w-0 items-center gap-3"
        aria-label="{{ config('app.name') }} home">
        <span
          class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-primary-300 to-primary-500 text-white shadow-lift transition duration-300 group-hover:scale-105">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="h-5 w-5" aria-hidden="true" focusable="false">
            <path d="M6 8h12l-1.4 12H7.4L6 8Z"></path>
            <path d="M9 8V6a3 3 0 0 1 6 0v2"></path>
          </svg>
        </span>

        <span class="truncate text-lg font-bold tracking-tight text-ink">
          {{ config('app.name') }}
        </span>
      </a>

      <nav class="hidden items-center gap-1 md:flex" aria-label="Primary navigation">
        <a href="{{ route('home') }}" class="nav-link">
          Home
        </a>
      </nav>

      <div class="hidden items-center gap-2 md:flex">
        <a href="{{ route('cart.index') }}" class="btn btn-secondary btn-sm">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" aria-hidden="true" focusable="false">
            <circle cx="8" cy="21" r="1"></circle>
            <circle cx="19" cy="21" r="1"></circle>
            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
          </svg>
          <span>Cart</span>
          <span data-cart-count class="cart-badge">
            {{ collect(session('cart', []))->sum() }}
          </span>
        </a>

        <div class="mx-1 hidden h-6 w-px bg-primary-100 lg:block"></div>

        @auth
          @if (auth()->user()->is_admin)
            <a href="{{ route('admin.products.index') }}" class="nav-link">
              Admin
            </a>
          @endif

          <a href="{{ route('orders.index') }}" class="nav-link">
            My Orders
          </a>

          <a href="{{ route('profile.edit') }}" class="btn btn-ghost btn-sm max-w-40 truncate">
            {{ Auth::user()->name }}
          </a>

          <form method="POST" action="{{ route('logout') }}" class="inline-flex">
            @csrf

            <button type="submit" class="nav-link text-red-700 hover:bg-red-50 hover:text-red-800">
              Logout
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="nav-link">
            Login
          </a>

          <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
            Get started
          </a>
        @endauth
      </div>

      <div class="flex items-center gap-2 md:hidden">
        <a href="{{ route('cart.index') }}" class="icon-button relative" aria-label="View cart">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="h-5 w-5" aria-hidden="true" focusable="false">
            <circle cx="8" cy="21" r="1"></circle>
            <circle cx="19" cy="21" r="1"></circle>
            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
          </svg>

          <span data-cart-count class="cart-badge absolute -right-1 -top-1">
            {{ collect(session('cart', []))->sum() }}
          </span>
        </a>

        <button type="button" class="icon-button" x-on:click="mobileMenuOpen = !mobileMenuOpen"
          x-bind:aria-expanded="mobileMenuOpen.toString()" aria-controls="mobile-navigation"
          aria-label="Toggle navigation menu">
          <svg x-show="!mobileMenuOpen" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" class="h-5 w-5" aria-hidden="true" focusable="false">
            <path d="M4 7h16"></path>
            <path d="M4 12h16"></path>
            <path d="M4 17h16"></path>
          </svg>

          <svg x-show="mobileMenuOpen" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" class="h-5 w-5" aria-hidden="true" focusable="false">
            <path d="M6 6l12 12"></path>
            <path d="M18 6L6 18"></path>
          </svg>
        </button>
      </div>
    </div>

    <nav id="mobile-navigation" x-show="mobileMenuOpen" x-cloak x-transition:enter="transition duration-200 ease-out"
      x-transition:enter-start="translate-y-2 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
      x-transition:leave="transition duration-150 ease-in" x-transition:leave-start="translate-y-0 opacity-100"
      x-transition:leave-end="translate-y-2 opacity-0" class="border-t border-primary-100 bg-white/95 md:hidden"
      aria-label="Mobile navigation">
      <div class="mx-auto max-w-7xl space-y-2 px-4 py-4 sm:px-6">
        <a href="{{ route('home') }}" x-on:click="mobileMenuOpen = false" class="mobile-link w-full">
          Home
        </a>

        <a href="{{ route('cart.index') }}" x-on:click="mobileMenuOpen = false"
          class="mobile-link w-full justify-between">
          <span>Cart</span>
          <span data-cart-count class="cart-badge">
            {{ collect(session('cart', []))->sum() }}
          </span>
        </a>

        @auth
          @if (auth()->user()->is_admin)
            <a href="{{ route('admin.products.index') }}" x-on:click="mobileMenuOpen = false"
              class="mobile-link w-full">
              Admin
            </a>
          @endif

          <a href="{{ route('orders.index') }}" x-on:click="mobileMenuOpen = false" class="mobile-link w-full">
            My Orders
          </a>

          <a href="{{ route('profile.edit') }}" x-on:click="mobileMenuOpen = false" class="mobile-link w-full">
            {{ Auth::user()->name }}
          </a>

          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
              class="mobile-link w-full justify-center text-red-700 hover:bg-red-50 hover:text-red-800">
              Logout
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" x-on:click="mobileMenuOpen = false" class="mobile-link w-full">
            Login
          </a>

          <a href="{{ route('register') }}" x-on:click="mobileMenuOpen = false" class="btn btn-primary w-full">
            Create account
          </a>
        @endauth
      </div>
    </nav>
  </header>

  <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8" aria-live="polite" aria-atomic="true">
    @if (session('success'))
      <div class="alert alert-success" role="status" data-auto-dismiss="6000">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M8 12.5l2.5 2.5L16 9.5"></path>
        </svg>

        <p>{{ session('success') }}</p>

        <button type="button" class="alert-close" data-dismiss-alert aria-label="Dismiss success message">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            class="h-4 w-4" aria-hidden="true" focusable="false">
            <path d="M6 6l12 12"></path>
            <path d="M18 6L6 18"></path>
          </svg>
        </button>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-error" role="alert" data-auto-dismiss="8000">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <circle cx="12" cy="12" r="10"></circle>
          <path d="M12 8v4"></path>
          <path d="M12 16h.01"></path>
        </svg>

        <p>{{ session('error') }}</p>

        <button type="button" class="alert-close" data-dismiss-alert aria-label="Dismiss error message">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            class="h-4 w-4" aria-hidden="true" focusable="false">
            <path d="M6 6l12 12"></path>
            <path d="M18 6L6 18"></path>
          </svg>
        </button>
      </div>
    @endif
  </div>

  <main id="main-content" class="flex-1 pb-16 pt-2">
    {{ $slot }}
  </main>

  <footer class="mt-auto border-t border-primary-100 bg-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8">
      <div class="md:col-span-2 lg:col-span-2">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
          <span
            class="grid h-10 w-10 place-items-center rounded-2xl bg-gradient-to-br from-primary-300 to-primary-500 text-white shadow-lift">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="h-5 w-5" aria-hidden="true" focusable="false">
              <path d="M6 8h12l-1.4 12H7.4L6 8Z"></path>
              <path d="M9 8V6a3 3 0 0 1 6 0v2"></path>
            </svg>
          </span>

          <span class="text-lg font-bold tracking-tight text-ink">
            {{ config('app.name') }}
          </span>
        </a>

        <p class="mt-4 max-w-md text-sm leading-6 text-muted">
          Discover quality products, simple ordering, and a warm shopping experience designed to feel effortless.
        </p>
      </div>

      <div>
        <h2 class="text-sm font-bold uppercase tracking-[0.14em] text-ink">
          Shop
        </h2>

        <ul class="mt-4 space-y-3">
          <li>
            <a href="{{ route('home') }}" class="footer-link">
              Home
            </a>
          </li>

          <li>
            <a href="{{ route('cart.index') }}" class="footer-link">
              Shopping Cart
            </a>
          </li>
        </ul>
      </div>

      <div>
        <h2 class="text-sm font-bold uppercase tracking-[0.14em] text-ink">
          Account
        </h2>

        <ul class="mt-4 space-y-3">
          @auth
            <li>
              <a href="{{ route('orders.index') }}" class="footer-link">
                My Orders
              </a>
            </li>

            <li>
              <a href="{{ route('profile.edit') }}" class="footer-link">
                Profile
              </a>
            </li>

            @if (auth()->user()->is_admin)
              <li>
                <a href="{{ route('admin.products.index') }}" class="footer-link">
                  Admin Dashboard
                </a>
              </li>
            @endif
          @else
            <li>
              <a href="{{ route('login') }}" class="footer-link">
                Login
              </a>
            </li>

            <li>
              <a href="{{ route('register') }}" class="footer-link">
                Create Account
              </a>
            </li>
          @endauth
        </ul>
      </div>
    </div>

    <div class="border-t border-primary-100">
      <div
        class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-6 text-sm text-muted sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <p>
          &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </p>

        <p>
          Made for a simple and delightful shopping experience.
        </p>
      </div>
    </div>
  </footer>
</body>

</html>
