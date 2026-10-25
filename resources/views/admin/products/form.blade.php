<x-store-layout :title="$product->exists ? 'Edit Product' : 'New Product'">
  <header class="reveal">
    <div class="flex flex-wrap items-end justify-between gap-3">
      <div>
        <p class="text-xs font-semibold uppercase tracking-[0.14em] text-primary-700">Admin · Products</p>
        <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-ink sm:text-3xl">
          {{ $product->exists ? 'Edit' : 'Add' }} product
        </h1>
        <p class="mt-1 text-sm text-muted">
          {{ $product->exists ? 'Update the details of this product.' : 'Add a new item to your catalog.' }}
        </p>
      </div>

      <a href="{{ route('admin.products.index') }}" class="btn btn-ghost btn-sm">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <path d="M19 12H5"></path>
          <path d="M12 19l-7-7 7-7"></path>
        </svg>
        Back to products
      </a>
    </div>
  </header>

  <form method="POST" enctype="multipart/form-data"
    action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
    class="reveal mt-6 max-w-2xl space-y-6 rounded-2xl bg-white p-6 shadow-soft ring-1 ring-primary-100/70 sm:p-8">
    @csrf
    @if ($product->exists)
      @method('PUT')
    @endif

    {{-- BASIC INFO --}}
    <section aria-labelledby="basic-info-title" class="space-y-5">
      <div>
        <h2 id="basic-info-title" class="text-base font-bold text-ink">Basic information</h2>
        <p class="mt-0.5 text-sm text-muted">Name, category, and description.</p>
      </div>

      <div>
        <label for="name" class="label">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
          class="input @error('name') input-error @enderror">
        @error('name')
          <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="category_id" class="label">Category</label>
        <select id="category_id" name="category_id" class="select">
          <option value="">None</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="description" class="label">Description</label>
        <textarea id="description" name="description" rows="4"
          class="textarea @error('description') input-error @enderror">{{ old('description', $product->description) }}</textarea>
        @error('description')
          <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>
    </section>

    <div class="divider"></div>

    {{-- PRICING --}}
    <section aria-labelledby="pricing-title" class="space-y-5">
      <div>
        <h2 id="pricing-title" class="text-base font-bold text-ink">Pricing & stock</h2>
        <p class="mt-0.5 text-sm text-muted">Set the price and available quantity.</p>
      </div>

      <div class="grid gap-4 sm:grid-cols-2">
        <div>
          <label for="price" class="label">Price</label>
          <div class="relative">
            <span
              class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-muted">$</span>
            <input type="number" id="price" step="0.01" name="price"
              value="{{ old('price', $product->price) }}" class="input pl-8 @error('price') input-error @enderror">
          </div>
          @error('price')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="stock" class="label">Stock</label>
          <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? 0) }}"
            class="input @error('stock') input-error @enderror">
          @error('stock')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </section>

    <div class="divider"></div>

    {{-- IMAGE --}}
    <section aria-labelledby="image-title" class="space-y-5">
      <div>
        <h2 id="image-title" class="text-base font-bold text-ink">Product image</h2>
        <p class="mt-0.5 text-sm text-muted">Upload a JPG or PNG. Square images work best.</p>
      </div>

      <div class="flex flex-wrap items-start gap-5">
        @if ($product->exists)
          <div class="h-28 w-28 shrink-0 overflow-hidden rounded-2xl bg-primary-soft ring-1 ring-primary-100">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover"
              loading="lazy"
              onerror="this.onerror=null;this.src='https://placehold.co/300x300/FFF7ED/FB923C?text=Preview';">
          </div>
        @endif

        <div class="min-w-0 flex-1">
          <label for="image" class="label">Upload image</label>
          <input type="file" id="image" name="image"
            class="block w-full cursor-pointer rounded-2xl border border-dashed border-primary-200 bg-primary-soft/60 px-4 py-3 text-sm text-ink file:mr-3 file:cursor-pointer file:rounded-xl file:border-0 file:bg-primary-400 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white hover:file:bg-primary-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2">
          @error('image')
            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </section>

    <div class="divider"></div>

    {{-- ACTIONS --}}
    <div class="flex flex-wrap items-center gap-3">
      <button type="submit" class="btn btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" aria-hidden="true" focusable="false">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
          <path d="M17 21v-8H7v8"></path>
          <path d="M7 3v5h8"></path>
        </svg>
        Save
      </button>

      <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">
        Cancel
      </a>
    </div>
  </form>
</x-store-layout>
