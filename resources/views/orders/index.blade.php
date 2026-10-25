<x-store-layout title="My Orders">
  <header class="reveal">
    <div class="flex flex-wrap items-end justify-between gap-3">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Account</p>
        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">My orders</h1>
        <p class="mt-1 text-sm text-muted">Track and review everything you’ve ordered.</p>
      </div>

      <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <path d="M6 8h12l-1.4 12H7.4L6 8Z"></path>
          <path d="M9 8V6a3 3 0 0 1 6 0v2"></path>
        </svg>
        Continue shopping
      </a>
    </div>
  </header>

  <div class="mt-8">
    @forelse ($orders as $order)
      <a href="{{ route('orders.show', $order) }}"
        class="reveal group mb-3 flex flex-col gap-4 rounded-2xl bg-white p-5 shadow-soft ring-1 ring-primary-100/70 transition-all duration-300 ease-out hover:-translate-y-0.5 hover:shadow-card hover:ring-primary-200 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
          <span
            class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-primary-soft text-primary-700 ring-1 ring-primary-100"
            aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="h-5 w-5">
              <path d="M6 2l1.5 3h9L18 2"></path>
              <path d="M3 6h18l-1.5 14a2 2 0 0 1-2 1.8H6.5A2 2 0 0 1 4.5 20L3 6z"></path>
              <path d="M9 11h6"></path>
            </svg>
          </span>

          <div class="min-w-0">
            <p class="text-xs font-semibold uppercase tracking-wider text-muted">Order</p>
            <p class="mt-0.5 truncate text-base font-semibold text-ink group-hover:text-primary-700">
              #{{ $order->id }}
            </p>
            <p class="mt-0.5 text-xs text-muted">{{ $order->created_at->format('M d, Y') }}</p>
          </div>
        </div>

        <div class="flex items-center justify-between gap-4 sm:justify-end">
          <span
            class="badge
              @if (strtolower($order->status) === 'pending') badge-primary
              @elseif (strtolower($order->status) === 'paid' || strtolower($order->status) === 'completed') badge-success
              @elseif (strtolower($order->status) === 'cancelled') badge-danger
              @else badge-muted @endif">
            {{ ucfirst($order->status) }}
          </span>

          <div class="text-right">
            <p class="text-xs font-semibold uppercase tracking-wider text-muted">Total</p>
            <p class="mt-0.5 text-lg font-bold text-primary-700">${{ number_format($order->total, 2) }}</p>
          </div>

          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"
            class="h-5 w-5 shrink-0 text-muted transition duration-300 group-hover:translate-x-0.5 group-hover:text-primary-700"
            aria-hidden="true" focusable="false">
            <path d="M9 18l6-6-6-6"></path>
          </svg>
        </div>
      </a>
    @empty
      <div
        class="reveal flex flex-col items-center rounded-2xl bg-white p-10 text-center shadow-soft ring-1 ring-primary-100/70">
        <span
          class="grid h-16 w-16 place-items-center rounded-2xl bg-primary-soft text-primary-700 ring-1 ring-primary-100"
          aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="h-8 w-8">
            <path d="M6 2l1.5 3h9L18 2"></path>
            <path d="M3 6h18l-1.5 14a2 2 0 0 1-2 1.8H6.5A2 2 0 0 1 4.5 20L3 6z"></path>
            <path d="M9 11h6"></path>
          </svg>
        </span>

        <h2 class="mt-5 text-lg font-bold text-ink">No orders yet</h2>
        <p class="mt-1 max-w-md text-sm text-muted">
          When you place your first order, it’ll appear here so you can track it any time.
        </p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-5">
          Start shopping
        </a>
      </div>
    @endforelse
  </div>

  <div class="mt-6">{{ $orders->links() }}</div>
</x-store-layout>
