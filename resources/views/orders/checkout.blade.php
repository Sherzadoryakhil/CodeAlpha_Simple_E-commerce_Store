<x-store-layout title="Checkout">
  <header class="reveal">
    <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Step 2 of 3</p>
    <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">Checkout</h1>
    <p class="mt-1 text-sm text-muted">
      Where should we send your order?
    </p>
  </header>

  <div class="mt-8 grid gap-8 lg:grid-cols-5">
    {{-- FORM --}}
    <form method="POST" action="{{ route('orders.store') }}"
      class="reveal order-2 rounded-2xl bg-white p-6 shadow-soft ring-1 ring-primary-100/70 sm:p-8 lg:order-1 lg:col-span-3">
      @csrf

      <h2 class="text-lg font-bold text-ink">Shipping details</h2>
      <p class="mt-1 text-sm text-muted">We’ll use this to deliver your order.</p>

      <div class="divider my-6"></div>

      <div class="space-y-5">
        {{-- Full name --}}
        <div>
          <label for="shipping_name" class="label">Full name</label>
          <input type="text" id="shipping_name" name="shipping_name"
            value="{{ old('shipping_name', auth()->user()->name) }}"
            class="input @error('shipping_name') input-error @enderror" autocomplete="name" required>
          @error('shipping_name')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Phone --}}
        <div>
          <label for="shipping_phone" class="label">Phone</label>
          <input type="text" id="shipping_phone" name="shipping_phone" value="{{ old('shipping_phone') }}"
            class="input @error('shipping_phone') input-error @enderror" autocomplete="tel" required>
          @error('shipping_phone')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Address --}}
        <div>
          <label for="shipping_address" class="label">Shipping address</label>
          <textarea id="shipping_address" name="shipping_address" rows="3"
            class="textarea @error('shipping_address') input-error @enderror" autocomplete="street-address" required>{{ old('shipping_address') }}</textarea>
          @error('shipping_address')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="divider my-6"></div>

      <div class="rounded-2xl bg-primary-soft p-4 ring-1 ring-primary-100/70">
        <div class="flex items-start gap-3">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="mt-0.5 h-5 w-5 shrink-0 text-primary-700" aria-hidden="true"
            focusable="false">
            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
            <path d="M2 10h20"></path>
          </svg>
          <div class="text-sm">
            <p class="font-semibold text-ink">Cash on delivery</p>
            <p class="mt-0.5 text-muted">Pay when your order arrives. No card needed.</p>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-lg mt-6 w-full">
        Place order
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <path d="M20 6L9 17l-5-5"></path>
        </svg>
      </button>

      <p class="mt-3 text-center text-xs text-muted">
        By placing your order you agree to our friendly returns policy.
      </p>
    </form>

    {{-- SUMMARY --}}
    <aside class="reveal order-1 lg:order-2 lg:col-span-2" aria-labelledby="checkout-summary-title">
      <div class="sticky top-24 rounded-2xl bg-white p-6 shadow-soft ring-1 ring-primary-100/70">
        <h2 id="checkout-summary-title" class="text-lg font-bold text-ink">Order summary</h2>

        <ul class="mt-5 divide-y divide-primary-100" role="list">
          @foreach ($items as $item)
            <li class="flex items-start justify-between gap-3 py-3 text-sm">
              <div class="min-w-0">
                <p class="truncate font-medium text-ink">{{ $item['product']->name }}</p>
                <p class="text-xs text-muted">Qty {{ $item['quantity'] }}</p>
              </div>
              <span class="shrink-0 font-semibold text-ink">${{ number_format($item['subtotal'], 2) }}</span>
            </li>
          @endforeach
        </ul>

        <dl class="mt-2 space-y-2 text-sm">
          <div class="flex items-center justify-between">
            <dt class="text-muted">Shipping</dt>
            <dd class="font-semibold text-emerald-700">Free</dd>
          </div>
        </dl>

        <div class="divider my-4"></div>

        <div class="flex items-baseline justify-between">
          <span class="text-base font-bold text-ink">Total</span>
          <span class="text-2xl font-extrabold text-primary-700">${{ number_format($total, 2) }}</span>
        </div>

        <ul class="mt-6 space-y-2 text-xs text-muted">
          <li class="flex items-center gap-2">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="h-4 w-4 shrink-0 text-primary-600" aria-hidden="true" focusable="false">
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

        <a href="{{ route('cart.index') }}" class="btn btn-ghost mt-4 w-full">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M19 12H5"></path>
            <path d="M12 19l-7-7 7-7"></path>
          </svg>
          Back to cart
        </a>
      </div>
    </aside>
  </div>
</x-store-layout>
