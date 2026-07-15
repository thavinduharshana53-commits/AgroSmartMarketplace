@extends('layouts.farmer')

@section('content')

<div class="min-h-screen">
    <main class="p-8">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                My Products
            </h1>

            <p class="mt-2 text-gray-600">
                View and manage your published agricultural products.
        </div>

        <div class="space-y-5">

             @forelse($products as $product)

                <x-farmer.myProducts-card
                    :product-id="$product->product_id"
                    :image="$product->product_image
                        ? 'storage/'.$product->product_image
                        : 'image/product-placeholder.png'"

                    :product="$product->product_name"
                    :category="$product->category"
                    :quantity="$product->quantity"
                   
                    :price="$product->price"
                    :minimum-price="$product->minimum_price"
                    :location="$product->city.', '.$product->district"
                    :availability="$product->availability_status"
                    :demand-level="$product->demand_level"
                    :date="$product->created_at->format('d M Y')"
                />

                @empty
                    <div class="p-12 text-center bg-white border border-gray-200 shadow-sm rounded-2xl">
                        <h2 class="mt-4 text-2xl font-bold text-gray-900">
                            No products published yet
                        </h2>

                        <p class="mt-2 text-gray-500">
                            Publish your first agricultural product to start receiving offers.
                        </p>

                        <a
                            href="{{ route('farmer.publishProducts') }}"
                            class="inline-flex items-center px-6 py-3 mt-6 font-semibold text-white bg-green-700 rounded-xl hover:bg-green-800">

                            Publish Your First Product
                        </a>
                    </div>
                @endforelse
        </div>

    </main>
</div>

@endsection



