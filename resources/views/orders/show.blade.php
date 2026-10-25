<x-store-layout :title="'Order #' . $order->id">
  {{-- BREADCRUMB --}}
  <nav class="mb-6 flex items-center gap-2 text-sm text-muted" aria-label="Breadcrumb">
    <a href="{{ route('orders.index') }}" class="link inline-flex items-center gap-1">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round" class="h-4 w-4" aria-hidden="true" focusable="false">
        <path d="M19 12H5"></path>
        <path d="M12 19l-7-7 7-7"></path>
      </svg>
      My orders
    </a>
    <span aria-hidden="true">/</span>
    <span class="truncate font-medium text-ink">Order #{{ $order->id }}</span>
  </nav>

  {{-- HEADER --}}
  <section class="reveal rounded-2xl bg-white p-6 shadow-soft ring-1 ring-primary-100/70 sm:p-8">
    <div class="flex flex-wrap items-start justify-between gap-4">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Order details</p>
        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">
          Order #{{ $order->id }}
        </h1>
        <p class="mt-1 text-sm text-muted">
          Placed on {{ $order->created_at->format('M d, Y H:i') }}
        </p>
      </div>

      <span
        class="badge
          @if (strtolower($order->status) === 'pending') badge-primary
          @elseif (strtolower($order->status) === 'paid' || strtolower($order->status) === 'completed') badge-success
          @elseif (strtolower($order->status) === 'cancelled') badge-danger
          @else badge-muted @endif">
        {{ ucfirst($order->status) }}
      </span>
    </div>
  </section>

  {{-- LAYOUT --}}
  <div class="mt-6 grid gap-6 lg:grid-cols-3">
    {{-- ITEMS --}}
    <section class="reveal lg:col-span-2" aria-labelledby="order-items-title">
      <div class="overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70">
        <div class="border-b border-primary-100 px-6 py-4">
          <h2 id="order-items-title" class="text-base font-bold text-ink">Items</h2>
        </div>

        <ul class="divide-y divide-primary-100" role="list">
          @foreach ($order->items as $item)
            <li class="flex items-start justify-between gap-4 px-6 py-4">
              <div class="min-w-0">
                <p class="truncate font-semibold text-ink">{{ $item->name }}</p>
                <p class="mt-0.5 text-xs text-muted">Qty {{ $item->quantity }}</p>
              </div>
              <span class="shrink-0 text-sm font-semibold text-ink">
                ${{ number_format($item->price * $item->quantity, 2) }}
              </span>
            </li>
          @endforeach
        </ul>

        <div class="border-t border-primary-100 bg-primary-soft/60 px-6 py-4">
          <div class="flex items-baseline justify-between">
            <span class="text-sm font-bold uppercase tracking-wider text-muted">Total</span>
            <span class="text-2xl font-extrabold text-primary-700">
              ${{ number_format($order->total, 2) }}
            </span>
          </div>
        </div>
      </div>
    </section>

    {{-- SHIPPING --}}
    <aside class="reveal lg:col-span-1" aria-labelledby="shipping-title">
      <div class="rounded-2xl bg-white p-6 shadow-soft ring-1 ring-primary-100/70">
        <div class="flex items-center gap-3">
          <span
            class="grid h-10 w-10 place-items-center rounded-2xl bg-primary-soft text-primary-700 ring-1 ring-primary-100"
            aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="h-5 w-5">
              <path d="M3 7l9-4 9 4v10l-9 4-9-4V7z"></path>
              <path d="M3 7l9 4 9-4"></path>
              <path d="M12 11v10"></path>
            </svg>
          </span>
          <h2 id="shipping-title" class="text-base font-bold text-ink">Shipping to</h2>
        </div>

        <dl class="mt-5 space-y-3 text-sm">
          <div>
            <dt class="text-xs font-semibold uppercase tracking-wider text-muted">Name</dt>
            <dd class="mt-0.5 font-medium text-ink">{{ $order->shipping_name }}</dd>
          </div>
          <div>
            <dt class="text-xs font-semibold uppercase tracking-wider text-muted">Phone</dt>
            <dd class="mt-0.5 font-medium text-ink">{{ $order->shipping_phone }}</dd>
          </div>
          <div>
            <dt class="text-xs font-semibold uppercase tracking-wider text-muted">Address</dt>
            <dd class="mt-0.5 whitespace-pre-line leading-relaxed text-ink">{{ $order->shipping_address }}</dd>
          </div>
        </dl>

        <div class="divider my-5"></div>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary w-full">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M19 12H5"></path>
            <path d="M12 19l-7-7 7-7"></path>
          </svg>
          Back to orders
        </a>
      </div>
    </aside>
  </div>
</x-store-layout>
