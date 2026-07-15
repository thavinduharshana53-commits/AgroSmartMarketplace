@props([
    'offerId',
    'image',
    'product',
    'buyer',
    'offerPrice',
    'minimumPrice',
    'counterPrice' => null,
    'quantity',
    'status',
    'rejectedBy' => null,
    'acceptedBy' => null,
    'date',
])

@php
    $statusLower = strtolower(trim($status));
@endphp

<div
    x-data="{ counterModal:false }"
    class="p-8 transition bg-white border border-gray-200 shadow-sm rounded-2xl hover:shadow-md">

    <div class="flex flex-wrap items-center justify-between gap-8 xl:flex-nowrap">

        <div class="flex items-center gap-4 shrink-0">
            <img
                src="{{ asset($image) }}"
                alt="{{ $product }}"
                class="object-cover border w-24 h-24 rounded-xl">
        </div>

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                    {{ $product }}
            </h2>

            <p class="mt-1 text-gray-500">
                Buyer :
                <span class="font-semibold text-gray-800">
                        {{ $buyer }}
                </span>
            </p>
        </div>


        <div>
            <p class="text-base text-gray-500">{{ $buyer }}'s Offered Price</p>
            <h3 class="text-2xl font-bold text-green-700">
                Rs. {{ number_format($offerPrice, 2) }} / kg
            </h3>
        </div>

       <div>

            @if($statusLower === 'accepted' && $acceptedBy === 'buyer' && $counterPrice)

                <p class="text-base text-gray-500">
                    Accepted Counter Price
                </p>

                <h3
                    style="color:#7C3AED;"
                    class="text-2xl font-bold">
                    Rs. {{ number_format((float) $counterPrice, 2) }}
                </h3>

            @elseif($statusLower === 'rejected' && $rejectedBy === 'buyer' && $counterPrice)

                <p class="text-base text-gray-500">
                    Rejected Counter Price
                </p>

                <h3 class="text-2xl font-bold text-red-600">
                    Rs. {{ number_format((float) $counterPrice, 2) }}
                </h3>

            @elseif($statusLower === 'countered' && $counterPrice)

                <p class="text-base text-gray-500">
                    Your Counter Price
                </p>

                <h3
                    style="color:#7C3AED;"
                    class="text-2xl font-bold">
                    Rs. {{ number_format((float) $counterPrice, 2) }} / kg
                </h3>

            @else

                <p class="text-base text-gray-500">
                    Your Minimum Price
                </p>

                <h3 class="text-2xl font-bold text-gray-900">
                    Rs. {{ number_format((float) $minimumPrice, 2) }} / kg
                </h3>

            @endif
                </div>

                    <div>
                        <p class="text-base text-gray-500">Total Quantity</p>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ number_format($quantity, 2) }} kg
                        </h3>
                    </div>

                    <div>
                        <p class="text-base text-gray-500">Submitted</p>
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $date }}
                        </h3>
                    </div>

                <div>

            @if($statusLower === 'countered')
                <span style="background:#DBEAFE; color:#1D4ED8;"
                    class="px-5 py-3 font-semibold rounded-xl">
                    Countered
                </span>

            @elseif($statusLower === 'accepted')
              
                @if($acceptedBy === 'buyer')
                    <span class="px-5 py-3 font-semibold text-green-700 bg-green-100 rounded-xl">
                    Accepted
                    </span>

                    <p class="mt-4 text-base text-gray-500 whitespace-nowrap">
                        {{ $buyer }} accepted the <br> your counter offer
                    </p>
                    
                @else
                    <span class="px-5 py-3 font-semibold text-green-700 bg-green-100 rounded-xl">
                    Accepted
                    </span>
                @endif



            @elseif($statusLower === 'rejected')

                @if($rejectedBy === 'buyer')
                    <span class="px-5 py-3 font-semibold text-red-700 bg-red-100 rounded-xl">
                        Rejected
                    </span>

                    <p class="mt-4 text-base text-gray-500 whitespace-nowrap">
                        {{ $buyer }} rejected the <br> your counter offer
                    </p>
                    
                @else
                    <span class="px-5 py-3 font-semibold text-red-700 bg-red-100 rounded-xl">
                        Rejected
                    </span>
                @endif

            
            @elseif($statusLower === 'pending')
                <span class="px-5 py-3 font-semibold text-yellow-700 bg-yellow-100 rounded-xl">
                    Pending
                </span>
            @endif

        </div>

    </div>

    @if($statusLower === 'pending')

        <div class="flex justify-end gap-3 pt-5 mt-5 border-t">

            <button
                type="button"
                @click="counterModal = true"
                class="px-6 py-3 border border-[#1F7A1F] text-[#1F7A1F] rounded-lg hover:bg-green-50 font-semibold">
                Counter Offer
            </button>

            <form action="{{ route('farmer.offers.accept', $offerId) }}" method="POST">
                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="px-6 py-3 bg-[#1F7A1F] text-white rounded-lg hover:bg-green-800 font-semibold">
                    Accept
                </button>
            </form>

            <form action="{{ route('farmer.offers.reject', $offerId) }}" method="POST">
                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="px-6 py-3 font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Reject
                </button>
            </form>

        </div>

    @endif

    {{-- Counter Offer Modal --}}
    <div
        x-show="counterModal"
        x-cloak
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/40">

        <div
            @click.away="counterModal = false"
            x-transition
            class="w-80 max-w-lg p-6 bg-white shadow-xl rounded-2xl">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">
                    Counter Offer
                </h2>

                <button
                    type="button"
                    @click="counterModal = false"
                    class="text-2xl text-gray-500 hover:text-gray-900">
                    ×
                </button>
            </div>

            <form action="{{ route('farmer.offers.counter', $offerId) }}" method="POST">
                @csrf
                @method('PATCH')

                <div>
                    <label class="font-semibold text-gray-700">
                        Counter Price
                    </label>

                    <input
                        type="number"
                        name="counter_price"
                        step="0.01"
                        min="1"
                        required
                        placeholder="Enter counter price"
                        class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-[#1F7A1F]">
                </div>

                <div class="mt-5">
                    <label class="font-semibold text-gray-700">
                        Counter Note
                    </label>

                    <textarea
                        name="counter_note"
                        rows="4"
                        placeholder="Write your message..."
                        class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg outline-none resize-none focus:ring-2 focus:ring-[#1F7A1F]"></textarea>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button
                        type="button"
                        @click="counterModal = false"
                        class="px-6 py-3 font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="px-6 py-3 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800">
                        Send Counter Offer
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>