@props([
    'productId',
    'image',
    'badge',
    'name',
    'farmer',
    'location',
    'price',
    'minimumPrice',
    'quantity',
    'availabilityStatus' => 'Available',
])

@php
    $statusLower = strtolower(
        trim($availabilityStatus)
    );

    $isAvailable = $statusLower === 'available';
    $isReserved = $statusLower === 'reserved';
    $isSoldOut = $statusLower === 'sold out';
@endphp

<div class="flex flex-col w-full h-full overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">

    {{-- Product Image --}}
    <div class="relative overflow-hidden bg-white h-44 sm:h-48 rounded-t-lg">

        <img
            src="{{ asset($image) }}"
            alt="{{ $name }}"
            class="object-cover w-full h-full"
            onerror="this.src='{{ asset('image/product-placeholder.png') }}'">

        {{-- Dark overlay for unavailable products --}}
        @if(!$isAvailable)

            <div class="absolute inset-0 bg-black/10"></div>

        @endif

        {{-- Product Badges --}}
        <div class="absolute z-10 flex items-start justify-between gap-2 top-3 left-3 right-3">

            {{-- Demand Badge --}}
            @if(strtolower(trim($badge)) === 'high demand')

                <span
                    style="background:#1F7A1F;"
                    class="px-2 py-1 text-xs font-semibold text-white rounded-full sm:px-3 sm:text-sm whitespace-nowrap">

                    High Demand

                </span>

            @else

                <span
                    style="background:#EF4444;"
                    class="px-2 py-1 text-xs font-semibold text-white rounded-full sm:px-3 sm:text-sm whitespace-nowrap">

                    Low Demand

                </span>

            @endif

            {{-- Availability Badge --}}
            @if($isAvailable)

                <span
                    style="background:#16A34A;"
                    class="px-2 py-1 text-xs font-semibold text-white rounded-full sm:px-3 sm:text-sm whitespace-nowrap">

                    Available

                </span>

            @elseif($isReserved)

                <span
                    style="background:#7C3AED;"
                    class="px-2 py-1 text-xs font-semibold text-white rounded-full sm:px-3 sm:text-sm whitespace-nowrap">

                    Reserved

                </span>

            @elseif($isSoldOut)

                <span
                    style="background:#DC2626;"
                    class="px-2 py-1 text-xs font-semibold text-white rounded-full sm:px-3 sm:text-sm whitespace-nowrap">

                    Sold Out

                </span>

            @endif

        </div>

    </div>

    {{-- Product Information --}}
    <div class="flex flex-col flex-1 p-4">

        <h3 class="text-lg font-bold text-gray-900 sm:text-xl">
            {{ $name }}
        </h3>

        <p class="text-sm text-gray-500 sm:text-base">

            by

            <span class="font-semibold text-gray-700">
                {{ $farmer }}
            </span>

        </p>

        <p class="mt-2 text-sm text-gray-500 truncate sm:text-base">
            📍 {{ $location }}
        </p>

        {{-- Price and Quantity --}}
        <div class="flex items-end justify-between gap-2 mt-3">

            <div class="min-w-0">

                <p class="text-sm text-gray-500 sm:text-base lg:text-lg">
                    Price Per kg
                </p>

                <h4 class="text-lg font-bold text-[#1F7A1F] sm:text-xl whitespace-nowrap">
                    Rs. {{ number_format((float) $price, 2) }}
                </h4>

            </div>

            <div class="min-w-0 text-right">

                <p class="text-sm text-gray-500 sm:text-base lg:text-lg">
                    Total Quantity
                </p>

                <p class="text-lg font-bold text-gray-900 sm:text-xl whitespace-nowrap">
                    {{ number_format((float) $quantity, 2) }} kg
                </p>

            </div>

        </div>

        {{-- Product Status Message --}}
        @if($isReserved)

            <div class="p-3 mt-4 text-sm font-medium text-purple-700 bg-purple-50 border border-purple-200 rounded-lg">

                An order is currently in progress for this product.

            </div>

        @elseif($isSoldOut)

            <div class="p-3 mt-4 text-sm font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg">

                This product has already been sold.

            </div>

        @endif

        {{-- Product Actions --}}
        <div class="grid grid-cols-2 gap-2 pt-3 mt-auto">

            <button
                type="button"
                class="px-2 py-2 text-sm font-bold text-[#1F7A1F] border border-[#1F7A1F] rounded-lg hover:bg-green-50 sm:text-base whitespace-nowrap">

                View Details

            </button>

            @if($isAvailable)

                <button
                    type="button"
                    @click="
                        selectedProduct = {
                            id: @js($productId),
                            image: @js(asset($image)),
                            name: @js($name),
                            farmer: @js($farmer),
                            location: @js($location),
                            badge: @js($badge),
                            price: @js($price),
                            minimumPrice: @js($minimumPrice ?? 0),
                            quantity: @js($quantity)
                        };

                        offerModalOpen = true;
                    "
                    class="px-2 py-2 text-sm font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 sm:text-base whitespace-nowrap">

                    Submit Offer

                </button>

            @elseif($isReserved)

                <button
                    type="button"
                    disabled
                    class="px-2 py-2 text-sm font-semibold text-purple-700 bg-purple-100 rounded-lg cursor-not-allowed sm:text-base whitespace-nowrap">

                    Reserved

                </button>

            @elseif($isSoldOut)

                <button
                    type="button"
                    disabled
                    class="px-2 py-2 text-sm font-semibold text-red-700 bg-red-100 rounded-lg cursor-not-allowed sm:text-base whitespace-nowrap">

                    Sold Out

                </button>

            @else

                <button
                    type="button"
                    disabled
                    class="px-2 py-2 text-sm font-semibold text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed sm:text-base whitespace-nowrap">

                    Unavailable

                </button>

            @endif

        </div>

    </div>

</div>