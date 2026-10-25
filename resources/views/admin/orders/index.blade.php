<x-store-layout title="Manage Orders">
  <header class="reveal">
    <div class="flex flex-wrap items-end justify-between gap-3">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Admin</p>
        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">Orders</h1>
        <p class="mt-1 text-sm text-muted">
          Review incoming orders and update their status.
        </p>
      </div>

      <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <path d="M19 12H5"></path>
          <path d="M12 19l-7-7 7-7"></path>
        </svg>
        Products
      </a>
    </div>
  </header>

  <div class="reveal mt-6 overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70">
    <div class="table-shell !rounded-none !shadow-none !ring-0">
      <table class="table">
        <thead>
          <tr>
            <th class="w-16">#</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Total</th>
            <th class="w-80">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
            <tr>
              <td>
                <span class="badge badge-muted">#{{ $order->id }}</span>
              </td>

              <td>
                <div class="flex items-center gap-3">
                  <span
                    class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-primary-soft text-sm font-bold text-primary-700 ring-1 ring-primary-100"
                    aria-hidden="true">
                    {{ strtoupper(mb_substr($order->user->name ?? '?', 0, 1)) }}
                  </span>
                  <span class="min-w-0">
                    <span class="block truncate text-sm font-semibold text-ink">{{ $order->user->name }}</span>
                  </span>
                </div>
              </td>

              <td class="text-sm text-muted">
                {{ $order->created_at->format('M d, Y') }}
              </td>

              <td class="text-sm font-semibold text-ink">
                ${{ number_format($order->total, 2) }}
              </td>

              <td>
                <form method="POST" action="{{ route('admin.orders.update', $order) }}"
                  class="flex flex-wrap items-center gap-2">
                  @csrf @method('PATCH')
                  <select name="status" class="select w-full max-w-[10.5rem] px-3 py-2 text-sm"
                    aria-label="Update status for order #{{ $order->id }}">
                    @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $s)
                      <option value="{{ $s }}" @selected($order->status === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                  </select>
                  <button type="submit" class="btn btn-secondary btn-sm">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                      <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                      <path d="M17 21v-8H7v8"></path>
                      <path d="M7 3v5h8"></path>
                    </svg>
                    Save
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">
                <div class="flex flex-col items-center py-10 text-center">
                  <span
                    class="grid h-14 w-14 place-items-center rounded-2xl bg-primary-soft text-primary-700 ring-1 ring-primary-100"
                    aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                      <path d="M6 2l1.5 3h9L18 2"></path>
                      <path d="M3 6h18l-1.5 14a2 2 0 0 1-2 1.8H6.5A2 2 0 0 1 4.5 20L3 6z"></path>
                      <path d="M9 11h6"></path>
                    </svg>
                  </span>
                  <p class="mt-4 text-base font-semibold text-ink">No orders yet</p>
                  <p class="mt-1 text-sm text-muted">New orders will appear here as they come in.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-6">{{ $orders->links() }}</div>
</x-store-layout>
