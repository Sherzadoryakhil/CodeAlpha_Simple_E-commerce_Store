<x-store-layout :title="$product->name">
  <a href="{{ route('home') }}" class="text-sm text-blue-600">&larr; Back to shop</a>

  <div class="grid md:grid-cols-2 gap-8 mt-4 bg-white p-6 rounded shadow">
    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded">

    <div>
      <p class="text-sm text-gray-500">{{ $product->category?->name }}</p>
      <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
      <p class="text-2xl text-blue-600 font-bold my-3">${{ number_format($product->price, 2) }}</p>
      <p class="mb-4">{{ $product->description }}</p>

      @if ($product->stock > 0)
        <p class="text-green-700 text-sm mb-4">In stock ({{ $product->stock }})</p>
        <form method="POST" action="{{ route('cart.add', $product) }}" class="flex gap-2">
          @csrf
          <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
            class="border rounded px-3 py-2 w-20">
          <button class="bg-blue-600 text-white px-5 py-2 rounded">Add to cart</button>
        </form>
      @else
        <p class="text-red-600 mb-4">Out of stock</p>
      @endif
    </div>
  </div>

  @if ($related->count())
    <h2 class="text-xl font-semibold mt-10 mb-4">Related products</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      @foreach ($related as $item)
        <a href="{{ route('products.show', $item) }}" class="bg-white rounded shadow overflow-hidden">
          <img src="{{ $item->image_url }}" class="w-full h-32 object-cover">
          <div class="p-2 text-sm">
            <p class="font-semibold">{{ $item->name }}</p>
            <p class="text-blue-600">${{ number_format($item->price, 2) }}</p>
          </div>
        </a>
      @endforeach
    </div>
  @endif
</x-store-layout>
