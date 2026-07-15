@extends('layouts.buyer')

@section('content')

<div class="min-h-screen">

    {{-- Mobile Responsive: Smaller page padding on mobile --}}
    <main class="p-2 sm:p-4 lg:p-8">

        {{-- Page Header --}}
        {{-- Mobile Responsive: Smaller bottom spacing on mobile --}}
        <div class="mb-5 sm:mb-6">

            {{-- Mobile Responsive: Smaller heading on mobile --}}
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                My Orders
            </h1>

            {{-- Mobile Responsive: Smaller description on mobile --}}
            <p class="mt-2 text-sm text-gray-600 sm:text-base">
                View and track your wholesale product orders.
            </p>

        </div>

        @forelse($orders as $order)

            <x-buyer.order-card
                :order-id="$order->order_id"
                :image="$order->product->product_image
                    ? 'storage/'.$order->product->product_image
                    : 'image/product-placeholder.png'"
                :product="$order->product->product_name"
                :farmer="$order->farmer->name"
                :location="$order->product->city.', '.$order->product->district"
                :quantity="$order->quantity"
                :accepted-price="$order->accepted_price"
                :total-amount="$order->total_amount"
                :status="$order->order_status"
                :farmerPhone="$order->farmer->contact_number"
                :date="$order->created_at->format('d M Y')"
                :has-review="$order->review !== null"
            />

        @empty

            {{-- Mobile Responsive: Responsive empty-state spacing --}}
            <div class="px-4 py-10 text-center bg-white border border-gray-200 shadow-sm sm:px-6 sm:py-12 rounded-2xl">

                <h2 class="text-lg font-bold text-gray-900 sm:text-xl">
                    No Orders found
                </h2>

                <p class="mt-2 text-sm text-gray-500 sm:text-base">
                    Your accepted offers will appear here as orders.
                </p>

                {{-- Mobile Responsive: Full-width button on mobile --}}
                <a
                    href="{{ route('buyer.browseProducts') }}"
                    class="inline-flex justify-center w-full px-6 py-3 mt-5 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 sm:w-auto">

                    Browse Products

                </a>

            </div>

        @endforelse

    </main>

</div>

@endsection