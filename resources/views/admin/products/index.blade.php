<x-store-layout title="Manage Products">
  <header class="reveal">
    <div class="flex flex-wrap items-end justify-between gap-3">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Admin</p>
        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">Products</h1>
        <p class="mt-1 text-sm text-muted">
          Manage your catalog — add, edit, and remove products.
        </p>
      </div>

      <div class="flex flex-wrap items-center gap-2">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M6 2l1.5 3h9L18 2"></path>
            <path d="M3 6h18l-1.5 14a2 2 0 0 1-2 1.8H6.5A2 2 0 0 1 4.5 20L3 6z"></path>
            <path d="M9 11h6"></path>
          </svg>
          Orders
        </a>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M12 5v14"></path>
            <path d="M5 12h14"></path>
          </svg>
          Add product
        </a>
      </div>
    </div>
  </header>

  {{-- Table card --}}
  <div class="reveal mt-6 overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70">
    <div class="table-shell !rounded-none !shadow-none !ring-0">
      <table class="table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td>
                <div class="flex items-center gap-3">
                  <div class="h-12 w-12 shrink-0 overflow-hidden rounded-xl bg-primary-soft ring-1 ring-primary-100">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover"
                      loading="lazy"
                      onerror="this.onerror=null;this.src='https://placehold.co/100x100/FFF7ED/FB923C?text=P';">
                  </div>
                  <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-ink">{{ $product->name }}</p>
                    <p class="mt-0.5 text-xs text-muted">#{{ $product->id }}</p>
                  </div>
                </div>
              </td>
              <td class="text-sm text-muted">
                {{ $product->category?->name ?? '—' }}
              </td>
              <td class="text-sm font-semibold text-ink">
                ${{ number_format($product->price, 2) }}
              </td>
              <td>
                @if ($product->stock < 1)
                  <span class="badge badge-danger">Out</span>
                @elseif ($product->stock <= 5)
                  <span class="badge badge-primary">{{ $product->stock }} left</span>
                @else
                  <span class="badge badge-success">{{ $product->stock }}</span>
                @endif
              </td>
              <td>
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.products.edit', $product) }}"
                    class="inline-flex items-center gap-1.5 rounded-xl border border-primary-200 bg-white px-3 py-1.5 text-xs font-semibold text-primary-800 transition hover:border-primary-300 hover:bg-primary-soft">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5" aria-hidden="true"
                      focusable="false">
                      <path d="M12 20h9"></path>
                      <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                    </svg>
                    Edit
                  </a>

                  <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                    onsubmit="return confirm('Delete this product?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                      class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-700 transition hover:border-red-300 hover:bg-red-50">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5" aria-hidden="true"
                        focusable="false">
                        <path d="M3 6h18"></path>
                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                      </svg>
                      Delete
                    </button>
                  </form>
                </div>
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
                      <path d="M6 8h12l-1.4 12H7.4L6 8Z"></path>
                      <path d="M9 8V6a3 3 0 0 1 6 0v2"></path>
                    </svg>
                  </span>
                  <p class="mt-4 text-base font-semibold text-ink">No products yet</p>
                  <p class="mt-1 text-sm text-muted">Add your first product to get started.</p>
                  <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm mt-4">
                    Add product
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-6">{{ $products->links() }}</div>
</x-store-layout>
