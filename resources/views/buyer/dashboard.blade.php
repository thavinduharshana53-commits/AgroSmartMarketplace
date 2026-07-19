@extends('layouts.buyer')

@section('content')
<div x-data="{
                offerModalOpen: false,
                selectedProduct: {}
            }">
    <!-- Welcome Section -->
    <section class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Welcome Back, {{Auth::user()->name}}! 👤 
        </h1>

        <p class="mt-2 text-base text-gray-500">
            Find the best agricultural products from trusted farmers.
        </p>
    </section>

    <!-- stat-card -->

    <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-2 sm:gap-5 xl:grid-cols-4">
        <x-buyer.state-card
        title="Nearby Products"
        :value="$nearbyProductsCount"
        :link="route('buyer.browseProducts', ['district' => $buyer->district])"
        linkText="Browse nearby products"
        bg="bg-[#F8FAFC]"
        iconBg="bg-[#DDF5D8]">

            <x-slot name="icon">
                <svg class="w-6 h-6 text-[#1F7A1F]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41 11 3H4v7l9.59 9.59a2 2 0 0 0 2.82 0l4.18-4.18a2 2 0 0 0 0-2.82Z" />
                    <circle cx="7.5" cy="7.5" r="1"/>
                </svg>
            </x-slot>

        </x-buyer.state-card>

        <x-buyer.state-card
        title="Active Offers"
        :value="$activeOffers"
        :link="route('buyer.myOffers')"
        link-text="View active offers"
         bg="bg-[#F8FAFC]"
        iconBg="bg-[#FEEDC8]">
            <x-slot name="icon">
                <svg class="w-6 h-6 text-[#FE8802]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
                </svg>
            </x-slot>
        </x-buyer.state-card>

        <x-buyer.state-card
            title="Active Orders"
            :value="$activeOrders"
            :link="route('buyer.orders')"
            link-text="Track active orders"
            bg="bg-[#F8FAFC]"
            iconBg="bg-[#E0EBFD]">
            <x-slot name="icon">
                <svg class="w-6 h-6 text-[#0839FD]" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 7V6a3 3 0 0 1 6 0v1" />
                    <rect x="4" y="7" width="16" height="13" rx="3" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 12h16" />
                </svg>
            </x-slot>
        </x-buyer.state-card>

        <x-buyer.state-card
            title="Completed Orders"
            :value="$completedOrders"
            :link="route('buyer.orders')"
            link-text="View completed orders"
            bg="bg-[#F8FAFC]"
            iconBg="bg-[#EADDFC]">
            <x-slot name="icon">
                <svg class="w-6 h-6 text-[#760AD8]" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 12l2.5 2.5L16 9" />
                </svg>
            </x-slot>
        </x-buyer.state-card>
    </div>

    {{-- Recommended Nearby Products --}}
    <section class="p-6 mt-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

        <div class="flex flex-col gap-3 mb-6 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Recommended Nearby Products
                </h2>

                <p class="mt-1 text-base text-gray-500">
                    Available products near {{ $buyer->city }}, {{ $buyer->district }}.
                </p>
            </div>

            <a
                href="{{ route('buyer.browseProducts') }}"
                class="font-semibold text-[#1F7A1F] hover:text-green-800 whitespace-nowrap">

                View all products →

            </a>

        </div>

        @forelse($products as $product)

            @if($loop->first)
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
            @endif

            <x-buyer.product-card
                :product-id="$product->product_id"
                :image="$product->product_image
                    ? 'storage/'.$product->product_image
                    : 'image/products/default.png'"
                :badge="$product->demand_level"
                :name="$product->product_name"
                :farmer="$product->farmer->name"
                :location="$product->city.', '.$product->district"
                :price="$product->price"
                :minimum-price="$product->minimum_price"
                :quantity="$product->quantity"
                :availability-status="$product->availability_status"
            />

            @if($loop->last)
                </div>
            @endif

        @empty

            <div class="flex flex-col items-center justify-center px-6 py-12 text-center border border-dashed border-gray-300 rounded-xl bg-gray-50">

                <div class="flex items-center justify-center w-14 h-14 text-2xl bg-green-100 rounded-full">
                    📍
                </div>

                <h3 class="mt-4 text-lg font-bold text-gray-900">
                    No nearby products available
                </h3>

                <p class="max-w-md mt-2 text-gray-500">
                    There are currently no available products in
                    {{ $buyer->city }} or {{ $buyer->district }}.
                </p>

                <a
                    href="{{ route('buyer.browseProducts') }}"
                    class="inline-flex px-5 py-2.5 mt-5 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800">

                    Browse all products

                </a>

            </div>

        @endforelse

    </section>
    <x-buyer.submit_offers />
</div>
@endsection