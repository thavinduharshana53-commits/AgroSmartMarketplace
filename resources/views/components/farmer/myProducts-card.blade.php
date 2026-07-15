@props([
    'productId',
    'image',
    'product',
    'category',
    'quantity',
    'unit' => 'kg',
    'price',
    'minimumPrice',
    'location',
    'availability',
    'demandLevel',
    'date',
])

@php
    $availabilityLower = strtolower(trim($availability));
    $demandLower = strtolower(trim($demandLevel));
@endphp

<div
    class="p-6 transition bg-white border border-gray-200 shadow-sm sm:p-8 rounded-2xl hover:shadow-md">

    {{-- Product Information Row --}}
    <div class="flex flex-wrap items-center justify-between gap-8 xl:flex-nowrap">

        {{-- Product Image --}}
        <div class="flex items-center gap-4 shrink-0">

            <div class="flex items-center justify-center w-24 h-24 overflow-hidden bg-white border border-gray-200 rounded-xl">

                <img
                    src="{{ asset($image) }}"
                    alt="{{ $product }}"
                    class="object-contain w-full h-full p-2"
                    onerror="this.src='{{ asset('image/product-placeholder.png') }}'">

            </div>

        </div>

        {{-- Product Name and Category --}}
        <div class="w-full xl:w-52">

            <h2 class="text-2xl font-bold text-gray-900">
                {{ $product }}
            </h2>

            <p class="mt-1 text-gray-500">
                Category:
                <span class="font-semibold text-green-700">
                    {{ $category }}
                </span>
            </p>

            <p class="mt-1 text-gray-500">
                📍 {{ $location }}
            </p>

        </div>

        {{-- Quantity --}}
        <div>

            <p class="text-base text-gray-500">
                Total Quantity
            </p>

            <h3 class="mt-1 text-2xl font-bold text-gray-900 whitespace-nowrap">
                {{ number_format((float) $quantity, 2) }}
                {{ $unit }}
            </h3>

        </div>

        {{-- Listed Price --}}
        <div>

            <p class="text-base text-gray-500">
                Price Per kg
            </p>

            <h3 class="mt-1 text-2xl font-bold text-green-700 whitespace-nowrap">
                Rs. {{ number_format((float) $price, 2) }}
              
            </h3>

        </div>

        {{-- Minimum Price --}}
        <div>

            <p class="text-base text-gray-500">
                Minimum Price
            </p>

            <h3 class="mt-1 text-2xl font-bold text-gray-900 whitespace-nowrap">
                Rs. {{ number_format((float) $minimumPrice, 2) }}
                / {{ $unit }}
            </h3>

        </div>

        {{-- Published Date --}}
        <div>

            <p class="text-base text-gray-500">
                Published
            </p>

            <h3 class="mt-1 text-lg font-semibold text-gray-900 whitespace-nowrap">
                {{ $date }}
            </h3>

        </div>

        {{-- Product Availability Status --}}
        <div class="min-w-36">

            @if($availabilityLower === 'available')

                <span
                    style="background:#DCFCE7;color:#15803D;"
                    class="inline-flex items-center gap-2 px-5 py-3 font-semibold rounded-xl">

                    <span class="w-2 h-2 bg-green-600 rounded-full"></span>

                    Available

                </span>

            @elseif($availabilityLower === 'reserved')

                <span
                    style="background:#EDE9FE;color:#7C3AED;"
                    class="inline-flex items-center gap-2 px-5 py-3 font-semibold rounded-xl">

                    <span class="w-2 h-2 bg-purple-600 rounded-full"></span>

                    Reserved

                </span>

            @elseif($availabilityLower === 'sold out')

                <span
                    style="background:#FEE2E2;color:#DC2626;"
                    class="inline-flex items-center gap-2 px-5 py-3 font-semibold rounded-xl">

                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>

                    Sold Out

                </span>

            @endif

            {{-- Demand Level --}}
            @if($demandLower === 'high demand')

                <p class="mt-3 font-semibold text-red-600">
                    High Demand
                </p>

            @else

                <p class="mt-3 font-semibold text-blue-600">
                    Low Demand
                </p>

            @endif

        </div>

    </div>

    {{-- Product Actions --}}
    @if($availabilityLower === 'available')

        <div class="flex flex-wrap justify-end gap-3 pt-5 mt-6 border-t border-gray-200">

            <a
                href="{{ route('farmer.products.editProducts', [
                    'product' => $productId
                ]) }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold text-[#1F7A1F] border border-[#1F7A1F] rounded-lg hover:bg-green-50">

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 0 1 2.828 0l1.172 1.172a2 2 0 0 1 0 2.828L13 15l-4 1 1-4Z"/>

                </svg>

                Edit Product

            </a>

        </div>

    @elseif($availabilityLower === 'reserved')

        <div class="pt-5 mt-6 border-t border-gray-200">

            <p class="flex items-center justify-end gap-2 font-medium text-purple-700">

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <circle cx="12" cy="12" r="9"/>

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 7v5l3 2"/>

                </svg>

                An order is currently in progress

            </p>
        </div>

    @elseif($availabilityLower === 'sold out')

        <div class="pt-5 mt-6 border-t border-gray-200">

            <p class="flex items-center justify-end gap-2 font-medium text-green-700">

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"/>

                </svg>

                Product sold successfully

            </p>

        </div>

    @endif
</div>