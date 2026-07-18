@extends('layouts.buyer')

@section('content')

@php
    $statusLower = strtolower(
        trim($product->availability_status)
    );

    $isAvailable = $statusLower === 'available';
    $isReserved = $statusLower === 'reserved';
    $isSoldOut = $statusLower === 'sold out';
@endphp

<div class="min-h-screen p-2">

    {{-- Back Button --}}
    <a
        href="{{ route('buyer.browseProducts') }}"
        class="inline-flex items-center gap-2 font-semibold text-green-700 hover:text-green-900">

        <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m15 18-6-6 6-6"/>

        </svg>

        Back to Browse Products

    </a>

    <div class="grid grid-cols-1 gap-8 mt-6 lg:grid-cols-2">

        {{-- Product Image --}}
        <div class="relative flex items-center justify-center overflow-hidden bg-white border border-gray-200 shadow-sm min-h-96 rounded-2xl">

            <img
                src="{{ $product->product_image
                    ? asset('storage/'.$product->product_image)
                    : asset('image/product-placeholder.png') }}"
                alt="{{ $product->product_name }}"
                class="object-contain w-full h-full max-h-[520px] p-6"
                onerror="this.src='{{ asset('image/product-placeholder.png') }}'">

            <div class="absolute flex items-center gap-3 top-5 left-5 right-5">

                {{-- Demand Badge --}}
                @if(strtolower(trim($product->demand_level)) === 'high demand')

                    <span class="px-4 py-2 font-semibold text-white bg-green-700 rounded-full">
                        High Demand
                    </span>

                @else

                    <span class="px-4 py-2 font-semibold text-white bg-red-500 rounded-full">
                        Low Demand
                    </span>

                @endif

                {{-- Availability Badge --}}
                @if($isAvailable)

                    <span class="px-4 py-2 font-semibold text-white bg-green-600 rounded-full">
                        Available
                    </span>

                @elseif($isReserved)

                    <span class="px-4 py-2 font-semibold text-white bg-purple-600 rounded-full">
                        Reserved
                    </span>

                @elseif($isSoldOut)

                    <span class="px-4 py-2 font-semibold text-white bg-red-600 rounded-full">
                        Sold Out
                    </span>

                @endif

            </div>

        </div>

        {{-- Product Details --}}
        <div class="p-6 bg-white border border-gray-200 shadow-sm sm:p-8 rounded-2xl">

            <p class="font-semibold text-green-700">
                {{ $product->category }}
            </p>

            <h1 class="mt-2 text-4xl font-bold text-gray-900">
                {{ $product->product_name }}
            </h1>

            <p class="mt-3 text-lg text-gray-500">

                Published by

                <span class="font-semibold text-green-700">
                    {{ $product->farmer->name }}
                </span>

            </p>

            {{-- Price and Quantity --}}
            <div class="grid grid-cols-1 gap-5 mt-8 sm:grid-cols-2">

                <div class="p-5 bg-green-50 rounded-xl">

                    <p class="text-gray-500">
                        Price Per kg
                    </p>

                    <h2 class="mt-1 text-3xl font-bold text-green-700">
                        Rs. {{ number_format((float) $product->price, 2) }}
                    </h2>

                </div>

                <div class="p-5 bg-gray-50 rounded-xl">

                    <p class="text-gray-500">
                        Total Quantity
                    </p>

                    <h2 class="mt-1 text-3xl font-bold text-gray-900">
                        {{ number_format((float) $product->quantity, 2) }}
                        {{ $product->unit }}
                    </h2>

                    <p class="text-gray-500">
                        Complete wholesale lot
                    </p>

                </div>

            </div>

            {{-- Location --}}
            <div class="flex items-start gap-3 p-5 mt-6 border border-gray-200 rounded-xl">

                <svg
                    class="w-6 h-6 text-green-700 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 21s6-5.2 6-11a6 6 0 1 0-12 0c0 5.8 6 11 6 11Z"/>

                    <circle cx="12" cy="10" r="2"/>

                </svg>

                <div>

                    <p class="font-semibold text-gray-900">
                        Product Location
                    </p>

                    <p class="text-gray-500">
                        {{ $product->city }}, {{ $product->district }}
                    </p>

                </div>

            </div>

            {{-- Description --}}
            <div class="mt-7">

                <h2 class="text-xl font-bold text-gray-900">
                    Product Description
                </h2>

                <p class="mt-3 leading-relaxed text-gray-600 whitespace-pre-line">
                    {{ $product->description }}
                </p>

            </div>

            {{-- Status Message --}}
            @if($isAvailable)

                <div class="p-4 mt-7 text-green-700 border border-green-200 bg-green-50 rounded-xl">
                    This product is currently available for price offers.
                </div>

            @elseif($isReserved)

                <div class="p-4 mt-7 text-purple-700 border border-purple-200 bg-purple-50 rounded-xl">
                    An order is currently in progress for this product.
                </div>

            @elseif($isSoldOut)

                <div class="p-4 mt-7 text-red-700 border border-red-200 bg-red-50 rounded-xl">
                    This product has already been sold.
                </div>

            @endif

            <p class="mt-6 text-base text-black">
                Published on {{ $product->created_at->format('d M Y') }}
            </p>

        </div>

    </div>

</div>

@endsection