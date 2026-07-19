@extends('layouts.buyer')

@section('content')

<section
    {{-- Mobile Responsive: Smaller outer padding on mobile --}}
    class="p-2 sm:p-3"
    x-data="{
        offerModalOpen: false,
        selectedProduct: {}
    }">

    <div>
        {{-- Mobile Responsive: Smaller heading on mobile --}}
        <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
            Browse Products
        </h1>

        <p class="mt-1 mb-5 text-sm text-gray-500 sm:text-base">
            Find fresh agricultural products from trusted farmers.
        </p>
    </div>

    <!-- Error Message -->
    @if(session('error'))

        <div
            {{-- Mobile Responsive: Smaller alert padding and text on mobile --}}
            class="px-4 py-3 mt-5 text-sm font-medium text-red-700 border border-red-200 sm:px-5 sm:py-4 sm:mt-6 sm:text-base bg-red-50 rounded-xl">

            {{ session('error') }}

        </div>

    @endif

    <!-- Validation Errors -->
    @if($errors->any())

        <div
            {{-- Mobile Responsive: Smaller validation box on mobile --}}
            class="px-4 py-3 mt-5 text-sm text-red-700 border border-red-200 sm:px-5 sm:py-4 sm:mt-6 sm:text-base bg-red-50 rounded-xl">

            <p class="font-semibold">
                Unable to submit the offer:
            </p>

            <ul class="mt-2 space-y-1 list-disc list-inside">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <x-buyer.location-filters-card
        :search="$search"
        :district="$district"
        :city="$city"
        :districts="$districts"
        :cities="$cities"
    />

    <!-- Products -->
    <div
        {{-- Mobile Responsive: One column on mobile, two on tablet and four on large screens --}}
        class="grid grid-cols-1 gap-4 p-3 mt-5 bg-white border border-gray-200 shadow-sm sm:grid-cols-2 sm:gap-5 sm:p-5 sm:mt-6 xl:grid-cols-4 xl:gap-6 xl:p-6 rounded-2xl">

        @forelse($products as $product)

            <x-buyer.product-card
                :product-id="$product->product_id"
                :image="$product->product_image
                    ? 'storage/'.$product->product_image
                    : 'image/products/default.png'"
                :badge="$product->demand_level"
                :name="$product->product_name"
                :farmer="$product->farmer->name"
                :location="$product->city"
                :price="$product->price"
                :minimum-price="$product->minimum_price"
                :quantity="$product->quantity"
                :availabilityStatus="$product->availability_status"
            />

        @empty

            {{-- Mobile Responsive: Empty message covers every grid column --}}
            <div class="py-10 text-center sm:col-span-2 sm:py-12 xl:col-span-4">

                <h2 class="text-lg font-bold text-gray-900 sm:text-xl">
                    No products available
                </h2>

                <p class="mt-2 text-sm text-gray-500 sm:text-base">
                    There are currently no products available for offers.
                </p>

            </div>

        @endforelse

    </div>

    <x-buyer.submit_offers />

</section>

@endsection