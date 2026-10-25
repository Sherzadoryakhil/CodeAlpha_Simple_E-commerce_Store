<x-store-layout title="Shop">
  {{-- HERO --}}
  <section
    class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary-100 via-primary-soft to-white shadow-soft reveal"
    aria-labelledby="shop-hero-title">
    <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-primary-200/60 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-32 -left-24 h-72 w-72 rounded-full bg-primary-300/40 blur-3xl">
    </div>

    <div class="relative grid items-center gap-8 p-6 sm:p-10 md:grid-cols-2 md:p-12">
      <div class="reveal">
        <span class="badge badge-primary">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="h-3.5 w-3.5" aria-hidden="true" focusable="false">
            <path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 16.8 5.8 21.3l2.4-7.4L2 9.4h7.6L12 2z"></path>
          </svg>
          New arrivals every week
        </span>

        <h1 id="shop-hero-title"
          class="mt-4 text-3xl font-extrabold tracking-tight text-ink text-balance sm:text-4xl md:text-5xl">
          Find something you’ll love,<br class="hidden sm:block">
          <span class="bg-gradient-to-r from-primary-500 to-primary-700 bg-clip-text text-transparent">
            delivered with care.
          </span>
        </h1>

        <p class="mt-4 max-w-lg text-base leading-relaxed text-muted">
          Thoughtfully curated products, fair prices, and a shopping experience built around you.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
          <a href="#products" class="btn btn-primary btn-lg">
            Browse products
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" aria-hidden="true" focusable="false">
              <path d="M5 12h14"></path>
              <path d="M13 5l7 7-7 7"></path>
            </svg>
          </a>
          <a href="{{ route('cart.index') }}" class="btn btn-secondary btn-lg">
            View cart
          </a>
        </div>

        <dl class="mt-8 grid max-w-md grid-cols-3 gap-4">
          <div>
            <dt class="text-xs font-semibold uppercase tracking-wider text-muted">Free shipping</dt>
            <dd class="mt-1 text-sm font-semibold text-ink">Over $50</dd>
          </div>
          <div>
            <dt class="text-xs font-semibold uppercase tracking-wider text-muted">Easy returns</dt>
            <dd class="mt-1 text-sm font-semibold text-ink">30 days</dd>
          </div>
          <div>
            <dt class="text-xs font-semibold uppercase tracking-wider text-muted">Support</dt>
            <dd class="mt-1 text-sm font-semibold text-ink">7 days a week</dd>
          </div>
        </dl>
      </div>

      <div class="relative reveal">
        <div class="absolute -inset-4 rounded-[2rem] bg-primary-200/50 blur-2xl" aria-hidden="true"></div>
        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1200&q=80"
          alt="A shopper browsing a curated lifestyle collection"
          class="relative aspect-[4/3] w-full rounded-3xl object-cover shadow-lift" loading="eager"
          onerror="this.onerror=null;this.src='https://placehold.co/1200x900/FFF7ED/FB923C?text=Shop';">
      </div>
    </div>
  </section>

  {{-- CATEGORY CARDS --}}
  <section class="mt-12" aria-labelledby="categories-title">
    <div class="flex flex-wrap items-end justify-between gap-3">
      <div>
        <h2 id="categories-title" class="section-title">Shop by category</h2>
        <p class="mt-1 text-sm text-muted">Browse our most-loved collections.</p>
      </div>
    </div>

    <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-3 stagger">
      <a href="{{ route('home', ['category' => 'electronics']) }}"
        class="group relative overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-card hover:ring-primary-200 reveal">
        <div class="relative aspect-[16/10] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1498049794561-7780e7231661?auto=format&fit=crop&w=1200&q=80"
            alt="Electronics — headphones, watches and gadgets"
            class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" loading="lazy"
            onerror="this.onerror=null;this.src='https://placehold.co/800x500/FFF7ED/FB923C?text=Electronics';">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
        </div>
        <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 p-4">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-white/80">Collection</p>
            <h3 class="mt-0.5 text-lg font-bold text-white">Electronics</h3>
          </div>
          <span
            class="grid h-9 w-9 place-items-center rounded-xl bg-white/90 text-primary-700 transition duration-300 group-hover:bg-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="h-4 w-4" aria-hidden="true" focusable="false">
              <path d="M5 12h14"></path>
              <path d="M13 5l7 7-7 7"></path>
            </svg>
          </span>
        </div>
      </a>

      <a href="{{ route('home', ['category' => 'clothing']) }}"
        class="group relative overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-card hover:ring-primary-200 reveal">
        <div class="relative aspect-[16/10] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?auto=format&fit=crop&w=1200&q=80"
            alt="Clothing — everyday wear and essentials"
            class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" loading="lazy"
            onerror="this.onerror=null;this.src='https://placehold.co/800x500/FFF7ED/FB923C?text=Clothing';">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
        </div>
        <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 p-4">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-white/80">Collection</p>
            <h3 class="mt-0.5 text-lg font-bold text-white">Clothing</h3>
          </div>
          <span
            class="grid h-9 w-9 place-items-center rounded-xl bg-white/90 text-primary-700 transition duration-300 group-hover:bg-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="h-4 w-4" aria-hidden="true" focusable="false">
              <path d="M5 12h14"></path>
              <path d="M13 5l7 7-7 7"></path>
            </svg>
          </span>
        </div>
      </a>

      <a href="{{ route('home', ['category' => 'home']) }}"
        class="group relative overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-card hover:ring-primary-200 reveal">
        <div class="relative aspect-[16/10] overflow-hidden">
          <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=1200&q=80"
            alt="Home — warm, minimal living essentials"
            class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" loading="lazy"
            onerror="this.onerror=null;this.src='https://placehold.co/800x500/FFF7ED/FB923C?text=Home';">
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
        </div>
        <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 p-4">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-white/80">Collection</p>
            <h3 class="mt-0.5 text-lg font-bold text-white">Home</h3>
          </div>
          <span
            class="grid h-9 w-9 place-items-center rounded-xl bg-white/90 text-primary-700 transition duration-300 group-hover:bg-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="h-4 w-4" aria-hidden="true" focusable="false">
              <path d="M5 12h14"></path>
              <path d="M13 5l7 7-7 7"></path>
            </svg>
          </span>
        </div>
      </a>
    </div>
  </section>

  {{-- FILTER BAR --}}
  <section id="products" class="mt-12 scroll-mt-24" aria-labelledby="products-title">
    <div class="flex flex-wrap items-end justify-between gap-3">
      <div>
        <h2 id="products-title" class="section-title">All products</h2>
        <p class="mt-1 text-sm text-muted">
          @if (request('search') || request('category'))
            Showing results for
            @if (request('search'))
              <span class="font-semibold text-ink">“{{ request('search') }}”</span>
            @endif
            @if (request('search') && request('category'))
              in
            @endif
            @if (request('category'))
              <span class="font-semibold text-ink">{{ request('category') }}</span>
            @endif
          @else
            Fresh picks from every category.
          @endif
        </p>
      </div>
    </div>

    <form method="GET"
      class="mt-5 flex flex-col gap-3 rounded-2xl bg-white p-3 shadow-soft ring-1 ring-primary-100/70 sm:flex-row sm:items-center">
      <label class="relative flex-1">
        <span class="sr-only">Search products</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round"
          class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-muted" aria-hidden="true"
          focusable="false">
          <circle cx="11" cy="11" r="7"></circle>
          <path d="M21 21l-4.3-4.3"></path>
        </svg>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
          class="input pl-10">
      </label>

      <label class="sm:w-56">
        <span class="sr-only">Filter by category</span>
        <select name="category" class="select">
          <option value="">All categories</option>
          @foreach ($categories as $category)
            <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </label>

      <button type="submit" class="btn btn-primary sm:w-auto">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <path d="M4 5h16"></path>
          <path d="M7 12h10"></path>
          <path d="M10 19h4"></path>
        </svg>
        Filter
      </button>
    </form>
  </section>

  {{-- PRODUCT GRID --}}
  <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 stagger">
    @forelse ($products as $product)
      <article
        class="group relative flex flex-col overflow-hidden rounded-2xl bg-white shadow-soft ring-1 ring-primary-100/70 transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-lift hover:ring-primary-200 reveal">
        <a href="{{ route('products.show', $product) }}"
          class="relative block aspect-[4/3] overflow-hidden bg-primary-soft" aria-label="View {{ $product->name }}">
          <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
            class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105" loading="lazy"
            onerror="this.onerror=null;this.src='https://placehold.co/800x600/FFF7ED/FB923C?text=Product';">

          @if ($product->stock < 1)
            <span class="badge badge-danger absolute left-3 top-3">Out of stock</span>
          @elseif ($product->stock <= 5)
            <span class="badge badge-primary absolute left-3 top-3">Only {{ $product->stock }} left</span>
          @endif
        </a>

        <div class="flex flex-1 flex-col p-5">
          <p class="text-xs font-semibold uppercase tracking-wider text-muted">
            {{ $product->category?->name ?? 'Uncategorized' }}
          </p>

          <h3 class="mt-1 text-base font-semibold leading-snug text-ink">
            <a href="{{ route('products.show', $product) }}" class="transition hover:text-primary-700">
              {{ $product->name }}
            </a>
          </h3>

          <div class="mt-auto flex items-end justify-between gap-3 pt-4">
            <p class="text-lg font-bold text-primary-700">
              ${{ number_format($product->price, 2) }}
            </p>

            <a href="{{ route('products.show', $product) }}"
              class="inline-flex items-center gap-1 text-sm font-semibold text-primary-700 transition hover:text-primary-800">
              View
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-4 w-4 transition duration-300 group-hover:translate-x-0.5"
                aria-hidden="true" focusable="false">
                <path d="M5 12h14"></path>
                <path d="M13 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </article>
    @empty
      <div
        class="col-span-full flex flex-col items-center justify-center rounded-2xl bg-white p-10 text-center shadow-soft ring-1 ring-primary-100/70">
        <img src="https://images.unsplash.com/photo-1607083206968-13611e3d76db?auto=format&fit=crop&w=800&q=80"
          alt="Empty results illustration" class="mb-6 h-40 w-auto rounded-2xl object-cover" loading="lazy"
          onerror="this.onerror=null;this.src='https://placehold.co/800x600/FFF7ED/FB923C?text=No+products';">

        <h3 class="text-lg font-bold text-ink">No products found</h3>
        <p class="mt-1 max-w-md text-sm text-muted">
          We couldn’t find anything matching your filters. Try a different search or browse all products.
        </p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-5">
          Browse all products
        </a>
      </div>
    @endforelse
  </div>

  <div class="mt-10">{{ $products->links() }}</div>
</x-store-layout>
