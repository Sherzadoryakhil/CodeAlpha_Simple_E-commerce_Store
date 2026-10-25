<x-store-layout title="Your Cart">
  <header class="reveal">
    <div class="flex flex-wrap items-end justify-between gap-3">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Step 1 of 3</p>
        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">Shopping cart</h1>
        <p class="mt-1 text-sm text-muted">
          Review your items before continuing to checkout.
        </p>
      </div>

      <a href="{{ route('home') }}" class="btn btn-ghost btn-sm">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <path d="M19 12H5"></path>
          <path d="M12 19l-7-7 7-7"></path>
        </svg>
        Continue shopping
      </a>
    </div>
  </header>

  @if ($items->isEmpty())
    {{-- EMPTY STATE --}}
    <section
      class="reveal mt-8 overflow-hidden rounded-3xl bg-white p-8 text-center shadow-soft ring-1 ring-primary-100/70 sm:p-12"
      aria-labelledby="empty-cart-title">
      <div class="mx-auto max-w-md">
        <div class="relative mx-auto">
          <div class="absolute inset-0 -z-10 rounded-full bg-primary-100/60 blur-2xl" aria-hidden="true"></div>
          <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=1200&q=80"
            alt="Empty shopping cart illustration" class="mx-auto h-56 w-auto rounded-3xl object-cover shadow-card"
            loading="lazy"
            onerror="this.onerror=null;this.src='https://placehold.co/800x600/FFF7ED/FB923C?text=Empty+Cart';">
        </div>

        <h2 id="empty-cart-title" class="mt-8 text-2xl font-extrabold tracking-tight text-ink">
          Your cart is empty
        </h2>
        <p class="mt-2 text-sm leading-relaxed text-muted">
          Nothing here yet — but there’s plenty to love. Browse our latest arrivals and add your favourites.
        </p>

        <div class="mt-6 flex flex-wrap justify-center gap-3">
          <a href="{{ route('home') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" aria-hidden="true" focusable="false">
              <path d="M6 8h12l-1.4 12H7.4L6 8Z"></path>
              <path d="M9 8V6a3 3 0 0 1 6 0v2"></path>
            </svg>
            Start shopping
          </a>

          @guest
            <a href="{{ route('register') }}" class="btn btn-secondary">
              Create account
            </a>
          @endguest
        </div>
      </div>
    </section>
  @else
    {{-- CART CONTENT --}}
    <div class="mt-8 grid gap-8 lg:grid-cols-3">
      {{-- ITEMS LIST --}}
      <section class="lg:col-span-2" aria-labelledby="cart-items-title">
        <h2 id="cart-items-title" class="sr-only">Cart items</h2>

        <ul class="space-y-4" role="list">
          @foreach ($items as $item)
            <li
              class="reveal overflow-hidden rounded-2xl bg-white p-4 shadow-soft ring-1 ring-primary-100/70 transition-all duration-300 ease-out hover:shadow-card hover:ring-primary-200 sm:p-5">
              <div class="flex flex-wrap items-center gap-4 sm:flex-nowrap">
                <a href="{{ route('products.show', $item['product']) }}"
                  class="relative block h-24 w-24 shrink-0 overflow-hidden rounded-2xl bg-primary-soft ring-1 ring-primary-100"
                  aria-label="View {{ $item['product']->name }}">
                  <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}"
                    class="h-full w-full object-cover transition duration-700 ease-out hover:scale-105" loading="lazy"
                    onerror="this.onerror=null;this.src='https://placehold.co/200x200/FFF7ED/FB923C?text=Item';">
                </a>

                <div class="min-w-0 flex-1">
                  <p class="text-xs font-semibold uppercase tracking-wider text-muted">
                    {{ $item['product']->category?->name ?? 'Product' }}
                  </p>
                  <a href="{{ route('products.show', $item['product']) }}"
                    class="mt-0.5 block truncate text-base font-semibold text-ink transition hover:text-primary-700">
                    {{ $item['product']->name }}
                  </a>
                  <p class="mt-1 text-sm text-muted">
                    ${{ number_format($item['product']->price, 2) }} each
                  </p>
                </div>

                <div class="ml-auto flex items-center gap-2 sm:ml-0">
                  <form method="POST" action="{{ route('cart.update', $item['product']) }}"
                    class="flex items-center gap-2">
                    @csrf @method('PATCH')
                    <label for="quantity-{{ $item['product']->id }}" class="sr-only">Quantity</label>
                    <input type="number" id="quantity-{{ $item['product']->id }}" name="quantity"
                      value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}"
                      class="input w-20 px-3 py-2 text-center">
                    <button type="submit" class="btn btn-secondary btn-sm">
                      Update
                    </button>
                  </form>
                </div>

                <div class="w-full text-right sm:w-28 sm:text-right">
                  <p class="text-xs font-semibold uppercase tracking-wider text-muted">Subtotal</p>
                  <p class="mt-0.5 text-lg font-bold text-primary-700">
                    ${{ number_format($item['subtotal'], 2) }}
                  </p>
                </div>

                <form method="POST" action="{{ route('cart.remove', $item['product']) }}" class="w-full sm:w-auto">
                  @csrf @method('DELETE')
                  <button type="submit"
                    class="btn btn-ghost btn-sm w-full text-red-700 hover:bg-red-50 hover:text-red-800 sm:w-auto"
                    aria-label="Remove {{ $item['product']->name }} from cart">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                      <path d="M3 6h18"></path>
                      <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                      <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                      <path d="M10 11v6"></path>
                      <path d="M14 11v6"></path>
                    </svg>
                    Remove
                  </button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
      </section>

      {{-- SUMMARY --}}
      <aside class="lg:col-span-1" aria-labelledby="summary-title">
        <div class="reveal sticky top-24 rounded-2xl bg-white p-6 shadow-soft ring-1 ring-primary-100/70">
          <h2 id="summary-title" class="text-lg font-bold text-ink">Order summary</h2>

          <dl class="mt-5 space-y-3 text-sm">
            <div class="flex items-center justify-between">
              <dt class="text-muted">Subtotal</dt>
              <dd class="font-semibold text-ink">${{ number_format($total, 2) }}</dd>
            </div>
            <div class="flex items-center justify-between">
              <dt class="text-muted">Shipping</dt>
              <dd class="font-semibold text-emerald-700">Free</dd>
            </div>

            <div class="divider"></div>

            <div class="flex items-baseline justify-between">
              <dt class="text-base font-bold text-ink">Total</dt>
              <dd class="text-2xl font-extrabold text-primary-700">
                ${{ number_format($total, 2) }}
              </dd>
            </div>
          </dl>

          <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg mt-6 w-full">
            Proceed to checkout
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" aria-hidden="true" focusable="false">
              <path d="M5 12h14"></path>
              <path d="M13 5l7 7-7 7"></path>
            </svg>
          </a>

          <a href="{{ route('home') }}" class="btn btn-ghost mt-2 w-full">
            Continue shopping
          </a>

          <ul class="mt-6 space-y-2 text-xs text-muted">
            <li class="flex items-center gap-2">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-4 w-4 shrink-0 text-primary-600" aria-hidden="true"
                focusable="false">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>
              Secure checkout
            </li>
            <li class="flex items-center gap-2">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-4 w-4 shrink-0 text-primary-600" aria-hidden="true"
                focusable="false">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>
              30-day returns
            </li>
            <li class="flex items-center gap-2">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-4 w-4 shrink-0 text-primary-600" aria-hidden="true"
                focusable="false">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>
              Friendly support
            </li>
          </ul>
        </div>
      </aside>
    </div>
  @endif
</x-store-layout>
