@props([
    'productId',
    'offerId',
    'image',
    'product',
    'farmer',
    'location',
    'offerPrice',
    'minimumPrice',
    'counterPrice' => null,
    'counterNote' => null,
    'quantity',
    'unit' => 'kg',
    'status',
    'rejectedBy' => null,
    'acceptedBy' => null,
])

@php
    $statusLower = strtolower(trim($status));
@endphp

{{-- Mobile Responsive: Smaller padding and spacing on mobile --}}
<div class="p-4 mb-5 transition bg-white border border-gray-200 shadow-sm sm:p-6 sm:mb-6 rounded-2xl hover:shadow-md">

    {{-- Mobile Responsive: Vertical layout on mobile and horizontal layout on desktop --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-12 xl:items-center xl:gap-8">

        {{-- Mobile Responsive: Product section uses four columns on desktop --}}
        <div class="flex items-center gap-4 sm:gap-6 xl:col-span-4">

            {{-- Mobile Responsive: Smaller product image on mobile --}}
            <div class="flex items-center justify-center w-24 h-24 overflow-hidden bg-white border border-gray-200 sm:w-32 sm:h-32 rounded-xl shrink-0">

                <img
                    src="{{ asset($image) }}"
                    alt="{{ $product }}"
                    class="object-contain w-full h-full p-2 sm:p-3"
                    onerror="this.src='{{ asset('image/product-placeholder.png') }}'">

            </div>

            <div class="min-w-0">

                {{-- Mobile Responsive: Smaller product name on mobile --}}
                <h2 class="text-xl font-bold text-gray-900 sm:text-2xl">
                    {{ $product }}
                </h2>

                <p class="mt-1 text-base text-gray-500 sm:text-xl">
                    by
                    <span class="font-medium text-green-700">
                        {{ $farmer }}
                    </span>
                </p>

                <div class="flex items-start gap-2 mt-2 text-sm text-gray-500 sm:mt-3 sm:text-base">

                    <svg
                        class="w-5 h-5 mt-0.5 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 21s7-4.35 7-11a7 7 0 1 0-14 0c0 6.65 7 11 7 11Z"/>

                        <circle cx="12" cy="10" r="2.5"/>
                    </svg>

                    {{-- Mobile Responsive: Location can wrap on narrow screens --}}
                    <span class="break-words">
                        {{ $location }}
                    </span>

                </div>

            </div>

        </div>

        {{-- Mobile Responsive: Price section uses five columns on desktop --}}
        <div class="xl:col-span-5">

            <p class="text-base text-gray-500 sm:text-lg">
                Your Offered Price
            </p>

            <h3 class="mt-1 text-lg font-bold text-gray-900 sm:text-xl whitespace-nowrap">
                Rs. {{ number_format((float) $offerPrice, 2) }} / {{ $unit }}
            </h3>

            {{-- Mobile Responsive: Price details stack on small screens --}}
            <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2 sm:gap-6 sm:mt-5">

                <div>

                    <p class="text-base text-gray-500 sm:text-lg">
                        Total Quantity
                    </p>

                    <p class="mt-1 text-lg font-bold text-gray-900 sm:text-xl whitespace-nowrap">
                        {{ number_format((float) $quantity, 0) }} {{ $unit }}
                    </p>

                </div>

                <div>

                    @if($statusLower === 'accepted' && $acceptedBy === 'buyer' && $counterPrice)

                        <p class="text-base text-gray-500 sm:text-lg">
                            Accepted Counter Price
                        </p>

                        <p style="color:#7C3AED;"
                            class="mt-1 text-lg font-bold sm:text-xl whitespace-nowrap">

                            Rs. {{ number_format((float) $counterPrice, 2) }} / {{ $unit }}

                        </p>

                    @elseif($statusLower === 'rejected' && $rejectedBy === 'buyer' && $counterPrice)

                        <p class="text-base text-gray-500 sm:text-lg">
                            Rejected Counter Price
                        </p>

                        <p class="mt-1 text-lg font-bold text-red-600 sm:text-xl whitespace-nowrap">
                            Rs. {{ number_format((float) $counterPrice, 2) }} / {{ $unit }}
                        </p>

                    @elseif($statusLower === 'countered' && $counterPrice)

                        <p class="text-base text-gray-500 sm:text-lg">
                            Farmer's Counter Price
                        </p>

                        <p
                            style="color:#7C3AED;"
                            class="mt-1 text-lg font-bold sm:text-xl whitespace-nowrap">

                            Rs. {{ number_format((float) $counterPrice, 2) }} / {{ $unit }}

                        </p>

                    @else

                        <p class="text-base text-gray-500 sm:text-lg">
                            Farmer's Minimum Price
                        </p>

                        <p class="mt-1 text-lg font-bold text-green-700 sm:text-xl whitespace-nowrap">
                            Rs. {{ number_format((float) $minimumPrice, 2) }} / {{ $unit }}
                        </p>

                    @endif

                </div>

            </div>

        </div>

        {{-- Mobile Responsive: Status takes full tablet width and three desktop columns --}}
        <div class="pt-5 border-t border-gray-200 md:col-span-2 xl:col-span-3 xl:pt-0 xl:border-t-0">

            @if($statusLower === 'pending')

                <span
                    style="background:#FEF3C7;color:#D97706;"
                    class="inline-flex px-4 py-2 text-sm font-semibold rounded-xl sm:px-5 sm:py-3 sm:text-base">

                    Pending

                </span>

                {{-- Mobile Responsive: Status message can wrap --}}
                <p class="mt-3 text-sm text-gray-500 mb-3 sm:text-base">
                    Waiting for farmer response
                </p>

                {{-- Mobile Responsive: Full-width action button on mobile --}}
               <a
                    href="{{ route('buyer.products.show', ['product' => $productId]) }}"
                    class="flex-1 px-4 py-2.5 text-sm sm:text-base font-semibold text-green-700 border border-green-600 rounded-lg hover:bg-green-50 whitespace-nowrap sm:flex-none sm:px-5">

                    View Details
                </a>

            @elseif($statusLower === 'accepted')

                <span
                    style="background:#DCFCE7;color:#15803D;"
                    class="inline-flex px-4 py-2 text-sm font-semibold rounded-xl sm:px-5 sm:py-3 sm:text-base">

                    Accepted

                </span>

                @if($acceptedBy === 'buyer')

                    <p class="mt-3 text-sm text-gray-500 sm:text-base">
                        You accepted the farmer's counter offer
                    </p>

                @elseif($acceptedBy === 'farmer')

                    <p class="mt-3 text-sm text-gray-500 sm:text-base">
                        Farmer accepted your offer
                    </p>

                @else

                    <p class="mt-3 text-sm text-gray-500 sm:text-base">
                        Offer accepted
                    </p>

                @endif

                {{-- Mobile Responsive: Action buttons wrap and share available width --}}
                <div class="flex gap-3 mt-4">

                    <a
                        href="{{ route('buyer.products.show', ['product' => $productId]) }}"
                        class="flex-1 px-4 py-2.5 text-sm sm:text-base font-semibold text-green-700 border border-green-600 rounded-lg hover:bg-green-50 whitespace-nowrap sm:flex-none sm:px-5">

                        View Details
                    </a>

                    <a
                        href="{{ route('buyer.orders') }}"
                        class="flex-1 px-4 py-2.5 text-sm sm:text-base font-semibold text-center text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 whitespace-nowrap sm:flex-none sm:px-5">

                        View Order

                    </a>

                </div>

            @elseif($statusLower === 'countered')

                <span
                    style="background:#EDE9FE;color:#7C3AED;"
                    class="inline-flex px-4 py-2 text-sm font-semibold rounded-xl sm:px-5 sm:py-3 sm:text-base">

                    Counter Offer

                </span>

                <p class="mt-3 text-sm text-gray-500 sm:text-base">
                    Farmer proposed a new price
                </p>

                {{-- Mobile Responsive: Forms and buttons share the mobile width --}}
                <div class="flex flex-wrap gap-3 mt-4">

                    <form action="{{ route('buyer.counter.accept', $offerId) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            onclick="return confirm('Do you want to accept this counter offer?')"
                            style="background:#7C3AED;"
                            class="w-full px-4 py-2.5 text-sm sm:text-base font-semibold text-white rounded-lg hover:opacity-90 whitespace-nowrap sm:px-5">

                            Accept Counter

                        </button>

                    </form>

                    <form action="{{ route('buyer.counter.reject', $offerId) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            onclick="return confirm('Do you want to reject this counter offer?')"
                            style="color:#7C3AED;border-color:#7C3AED;"
                            class="w-full px-4 py-2.5 text-sm sm:text-base font-semibold border rounded-lg hover:bg-purple-50 sm:px-5">

                            Reject

                        </button>

                    </form>

                </div>

            @elseif($statusLower === 'rejected')

                <span style="background:#FEE2E2;color:#DC2626;"
                    class="inline-flex px-4 py-2 text-sm font-semibold rounded-xl sm:px-5 sm:py-3 sm:text-base">

                    Rejected

                </span>

                @if($rejectedBy === 'buyer')

                    <p class="mt-3 text-sm text-gray-500 sm:text-base">
                        You rejected the farmer's counter offer
                    </p>

                @elseif($rejectedBy === 'system')

                    <p class="mt-3 mb-2 text-sm text-gray-500 sm:text-base">
                        Another offer was accepted for this product
                    </p>

                @elseif($rejectedBy === 'farmer')

                    <p class="mt-3 text-sm text-gray-500 sm:text-base">
                        Farmer rejected your offer
                    </p>

                @else

                    <p class="mt-3 text-sm text-gray-500 sm:text-base">
                        Offer rejected
                    </p>

                @endif

                {{-- Mobile Responsive: Full-width action button on mobile --}}
                <a
                    href="{{ route('buyer.products.show', ['product' => $productId]) }}"
                    class="w-full px-5 py-2.5 mt-4 text-sm sm:text-base font-semibold text-green-700 border border-green-600 rounded-lg hover:bg-green-50 sm:w-auto">

                    View Details

                </a>

            @endif

        </div>

    </div>

    @if($statusLower === 'countered' && $counterNote)

        {{-- Mobile Responsive: Smaller counter note padding on mobile --}}
        <div
            style="background:#F5F3FF;border-color:#DDD6FE;"
            class="p-4 mt-5 border sm:p-5 sm:mt-6 rounded-xl">

            <p class="text-sm font-semibold text-gray-700 sm:text-base">
                Farmer's Counter Note
            </p>

            <p class="mt-1 text-sm text-gray-600 break-words sm:text-base">
                {{ $counterNote }}
            </p>

        </div>

    @endif

</div>