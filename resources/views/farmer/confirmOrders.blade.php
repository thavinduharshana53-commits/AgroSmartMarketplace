@extends('layouts.farmer')

@section('content')

<div class="min-h-screen">
    <main class="p-8">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                Order Management
            </h1>

            <p class="mt-2 text-gray-600">
                View and manage your confirmed wholesale orders.
            </p>
        </div>

        <div class="space-y-5">

            @forelse($orders as $order)

                <x-farmer.confirmOrder-card
                    :order-id="$order->order_id"
                    :image="$order->product->product_image
                        ? 'storage/'.$order->product->product_image
                        : 'image/product-placeholder.png'"
                    :product="$order->product->product_name"
                    :buyer="$order->buyer->name"
                    :quantity="$order->quantity"
                    :accepted-price="$order->accepted_price"
                    :total-amount="$order->total_amount"
                    :status="$order->order_status"
                    :date="$order->created_at->format('d M Y')"
                />

            @empty

                <div class="p-12 text-center bg-white border border-gray-200 shadow-sm rounded-2xl">
                    <h2 class="text-xl font-bold text-gray-900">
                        No orders found
                    </h2>

                    <p class="mt-2 text-gray-500">
                        Orders will appear here after an offer is accepted.
                    </p>

                    <a
                        href="{{ route('farmer.manageOffers') }}"
                        class="inline-flex px-6 py-3 mt-5 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800">
                        Manage Offers
                    </a>
                </div>

            @endforelse

        </div>

    </main>
</div>

@endsection