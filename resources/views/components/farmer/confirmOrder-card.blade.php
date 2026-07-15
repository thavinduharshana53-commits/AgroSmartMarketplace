@props([
    'orderId',
    'image',
    'product',
    'buyer',
    'quantity',
    'acceptedPrice',
    'totalAmount',
    'status',
    'date',
])

@php
    $statusLower = strtolower(trim($status));
@endphp

{{-- Mobile Responsive: Removes horizontal scrolling and uses smaller padding on mobile --}}
<div class="p-4 transition bg-white border border-gray-200 shadow-sm sm:p-6 rounded-2xl hover:shadow-md">

    {{-- Mobile Responsive: Vertical mobile layout and horizontal desktop layout --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-12 xl:items-center xl:gap-8">

        {{-- Mobile Responsive: Product section takes three desktop columns --}}
        <div class="flex items-center gap-4 sm:gap-5 xl:col-span-3">

            {{-- Mobile Responsive: Smaller image on mobile --}}
            <div class="flex items-center justify-center w-24 h-24 overflow-hidden bg-white border border-gray-200 sm:w-28 sm:h-28 rounded-xl shrink-0">

                <img
                    src="{{ asset($image) }}"
                    alt="{{ $product }}"
                    class="object-contain w-full h-full p-2"
                    onerror="this.src='{{ asset('image/product-placeholder.png') }}'">

            </div>

            <div class="min-w-0">

                {{-- Mobile Responsive: Smaller heading on mobile --}}
                <h2 class="mt-1 text-xl font-bold text-gray-900 sm:text-2xl">
                    {{ $product }}
                </h2>

                <p class="mt-1 text-sm text-gray-500 sm:text-base">
                    Buyer:
                    <span class="font-semibold text-gray-800">
                        {{ $buyer }}
                    </span>
                </p>

            </div>

        </div>

        {{-- Mobile Responsive: Quantity takes two desktop columns --}}
        <div class="xl:col-span-2">

            <p class="text-sm text-gray-500 sm:text-base">
                Total Quantity
            </p>

            <h3 class="mt-1 text-xl font-bold text-gray-900 sm:text-2xl whitespace-nowrap">
                {{ number_format((float) $quantity, 2) }} kg
            </h3>

        </div>

        {{-- Mobile Responsive: Accepted price takes two desktop columns --}}
        <div class="xl:col-span-2">

            <p class="text-sm text-gray-500 sm:text-base">
                Accepted Price
            </p>

            <h3 class="mt-1 text-xl font-bold text-green-700 sm:text-2xl whitespace-nowrap">
                Rs. {{ number_format((float) $acceptedPrice, 2) }} / kg
            </h3>

        </div>

        {{-- Mobile Responsive: Total amount takes two desktop columns --}}
        <div class="xl:col-span-2">

            <p class="text-sm text-gray-500 sm:text-base">
                Total Amount
            </p>

            <h3 class="mt-1 text-xl font-bold text-gray-900 sm:text-2xl whitespace-nowrap">
                Rs. {{ number_format((float) $totalAmount, 2) }}
            </h3>

            <p class="mt-2 text-sm text-gray-500">
                Created on {{ $date }}
            </p>

        </div>

        {{-- Mobile Responsive: Status takes full tablet width and three desktop columns --}}
        <div class="pt-5 border-t border-gray-200 md:col-span-2 xl:col-span-3 xl:pt-0 xl:border-t-0">

            @if($statusLower === 'pending')

                <span
                    style="background:#FEF3C7;color:#D97706;"
                    class="inline-flex px-4 py-2 text-sm font-semibold sm:px-5 sm:py-3 sm:text-base rounded-xl">

                    Pending

                </span>

                <p class="mt-3 text-sm text-gray-500 sm:text-base">
                    Waiting for your confirmation
                </p>

                {{-- Mobile Responsive: Action forms share the available mobile width --}}
                <div class="flex flex-wrap gap-2 mt-4">

                    <form action="{{ route('farmer.orders.status', $orderId) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="order_status"
                            value="confirmed">

                        <button
                            type="submit"
                            class="w-full px-4 py-2.5 text-sm sm:text-base font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 sm:px-5">

                            Confirm

                        </button>

                    </form>

                    <form action="{{ route('farmer.orders.status', $orderId) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="order_status"
                            value="cancelled">

                        <button
                            type="submit"
                            onclick="return confirm('Do you want to cancel this order?')"
                            class="w-full px-4 py-2.5 text-sm sm:text-base font-semibold text-red-600 border border-red-500 rounded-lg hover:bg-red-50 sm:px-5">

                            Cancel

                        </button>

                    </form>

                </div>

            @elseif($statusLower === 'confirmed')

                <span
                    style="background:#DBEAFE;color:#1D4ED8;"
                    class="inline-flex px-4 py-2 text-sm font-semibold rounded-lg sm:text-base">

                    Confirmed

                </span>

                <p class="mt-2 text-sm text-gray-500 sm:text-base">
                    Prepare the wholesale lot for collection.
                </p>

                {{-- Mobile Responsive: Action forms share available width --}}
                <div class="flex flex-wrap gap-2 mt-3">

                    <form action="{{ route('farmer.orders.status', $orderId) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="order_status"
                            value="ready_for_pickup">

                        <button
                            type="submit"
                            class="w-full px-4 py-2 text-sm font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 whitespace-nowrap sm:text-base">

                            Ready for Pickup

                        </button>

                    </form>

                    <form action="{{ route('farmer.orders.status', $orderId) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        @method('PATCH')

                        <input
                            type="hidden"
                            name="order_status"
                            value="cancelled">

                        <button
                            type="submit"
                            onclick="return confirm('Do you want to cancel this order?')"
                            class="w-full px-4 py-2 text-sm font-semibold text-red-700 border border-red-600 rounded-lg hover:bg-red-50 sm:text-base">

                            Cancel

                        </button>

                    </form>

                </div>

            @elseif($statusLower === 'ready_for_pickup')

                <span
                    style="background:#EDE9FE;color:#7C3AED;"
                    class="inline-flex px-4 py-2 text-sm font-semibold rounded-lg sm:text-base">

                    Ready for Pickup

                </span>

                {{-- Mobile Responsive: Text wraps naturally without a fixed line break --}}
                <p class="mt-2 text-sm text-gray-500 sm:text-base">
                    Complete the order after handing it to the buyer.
                </p>

                <form action="{{ route('farmer.orders.status', $orderId) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="order_status"
                        value="completed">

                    {{-- Mobile Responsive: Full-width button on mobile --}}
                    <button
                        type="submit"
                        onclick="return confirm('Has the buyer received this order?')"
                        class="w-full px-4 py-2.5 text-sm sm:text-base font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 whitespace-nowrap sm:w-auto">

                        Complete Order

                    </button>

                </form>

            @elseif($statusLower === 'completed')

                <span
                    style="background:#DCFCE7;color:#15803D;"
                    class="inline-flex px-4 py-2 text-sm font-semibold sm:px-5 sm:py-3 sm:text-base rounded-xl">

                    Completed

                </span>

                <p class="mt-3 text-sm text-gray-500 sm:text-base">
                    Order completed successfully
                </p>

            @elseif($statusLower === 'cancelled')

                <span
                    style="background:#FEE2E2;color:#DC2626;"
                    class="inline-flex px-4 py-2 text-sm font-semibold sm:px-5 sm:py-3 sm:text-base rounded-xl">

                    Cancelled

                </span>

                <p class="mt-3 text-sm text-gray-500 sm:text-base">
                    This order was cancelled
                </p>

            @endif

        </div>

    </div>

</div>