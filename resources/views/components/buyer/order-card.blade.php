@props([
    'orderId',
    'image',
    'product',
    'farmer',
    'location',
    'quantity',
    'acceptedPrice',
    'totalAmount',
    'status',
    'farmerPhone' => null,
    'date',
    'hasReview' => false,
])

@php
    $statusLower = strtolower(trim($status));
@endphp

{{-- Mobile Responsive: Smaller padding and spacing on mobile --}}
<div 
    x-data="{
        reviewModal: {{ $errors->any() && old('order_id') == $orderId ? 'true' : 'false' }},
        rating: {{ old('order_id') == $orderId ? (int) old('rating', 0) : 0 }}
    }"
    @keydown.escape.window="reviewModal = false"
    class="p-4 mb-5 transition bg-white border border-gray-200 shadow-sm sm:p-6 sm:mb-6 rounded-2xl hover:shadow-md">

    {{-- Mobile Responsive: Vertical mobile layout and horizontal desktop layout --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-12 xl:items-center xl:gap-8">

        {{-- Mobile Responsive: Product section takes three desktop columns --}}
        <div class="flex items-center gap-4 sm:gap-5 xl:col-span-3">

            {{-- Mobile Responsive: Smaller product image on mobile --}}
            <div class="flex items-center justify-center w-24 h-24 overflow-hidden bg-white border border-gray-200 sm:w-28 sm:h-28 rounded-xl shrink-0">

                <img
                    src="{{ asset($image) }}"
                    alt="{{ $product }}"
                    class="object-contain w-full h-full p-2"
                    onerror="this.src='{{ asset('image/product-placeholder.png') }}'">

            </div>

            <div class="min-w-0">

                {{-- Mobile Responsive: Smaller product heading on mobile --}}
                <h2 class="mt-1 text-xl font-bold text-gray-900 sm:text-2xl">
                    {{ $product }}
                </h2>

                <p class="mt-1 text-sm text-gray-500 sm:text-base">
                    by
                    <span class="font-medium text-green-700">
                        {{ $farmer }}
                    </span>
                </p>

                {{-- Mobile Responsive: Location wraps on narrow screens --}}
                <p class="mt-1 text-sm text-gray-500 break-words sm:text-base">
                    📍 {{ $location }}
                </p>

            </div>

        </div>

        {{-- Mobile Responsive: Quantity section takes two desktop columns --}}
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

            <p class="mt-2 text-sm text-gray-500 sm:text-base">
                Ordered on {{ $date }}
            </p>

        </div>

        {{-- Mobile Responsive: Status takes full tablet width and three desktop columns --}}
        <div class="pt-5 border-t border-gray-200 md:col-span-2 xl:col-span-3 xl:pt-0 xl:border-t-0">

            @if($statusLower === 'pending')

                <span
                    style="background:#FEF3C7;color:#D97706;"
                    class="inline-flex px-4 py-2 text-base font-semibold sm:px-5 sm:py-3 sm:text-base rounded-xl">

                    Pending

                </span>

                <p class="mt-3 text-base text-gray-500 sm:text-base">
                    Waiting for farmer confirmation
                </p>

            @elseif($statusLower === 'confirmed')

                <span
                    style="background:#DBEAFE;color:#1D4ED8;"
                    class="inline-flex px-4 py-2 text-base font-semibold sm:px-5 sm:py-3 sm:text-base rounded-xl">

                    Confirmed

                </span>

                <p class="mt-3 text-base text-gray-500 sm:text-base">
                    Farmer confirmed your order
                </p>

            @elseif($statusLower === 'ready_for_pickup')

                <span
                    style="background:#EDE9FE;color:#7C3AED;"
                    class="inline-flex px-4 py-2 text-base font-semibold rounded-lg sm:text-base">

                    Ready for Pickup

                </span>

                {{-- Mobile Responsive: Message wraps naturally on mobile --}}
                <p class="mt-2 text-base text-gray-500 sm:text-base">
                    Your order is ready for collection.<br>
                    Please contact the farmer to arrange pickup.
                </p>

                @if($farmerPhone)

                    {{-- Mobile Responsive: Contact button is full width on mobile --}}
                    <a
                        href="tel:{{ $farmerPhone }}"
                        class="inline-flex items-center justify-center w-full gap-2 px-5 py-2.5 mt-4 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 sm:w-auto">

                        <svg
                            class="w-5 h-5 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 5a2 2 0 0 1 2-2h3l2 5-2 1a16 16 0 0 0 7 7l1-2 5 2v3a2 2 0 0 1-2 2C10.16 21 3 13.84 3 5Z"/>
                        </svg>

                        {{ $farmerPhone }}

                    </a>

                @endif

                @elseif($statusLower === 'completed')

                    <span
                        style="background:#DCFCE7;color:#15803D;"
                        class="inline-flex px-4 py-2 text-base font-semibold sm:px-5 sm:py-3 sm:text-base rounded-xl">

                        Completed

                    </span>

                    <p class="mt-3 text-base text-gray-500 sm:text-base">
                        Order completed successfully
                    </p>

                @if($hasReview)

                    <div class="inline-flex items-center gap-2 px-4 py-2 mt-4 font-semibold text-green-700 bg-green-50 border border-green-200 rounded-lg">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"/>
                        </svg>

                        Review Submitted

                    </div>

                @else

                    <button
                        type="button"
                        @click="rating = 0; reviewModal = true"
                        class="inline-flex items-center justify-center w-full gap-2 px-5 py-2.5 mt-4 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 sm:w-auto">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.036 6.264a1 1 0 0 0 .95.69h6.587c.969 0 1.371 1.24.588 1.81l-5.33 3.872a1 1 0 0 0-.364 1.118l2.036 6.264c.3.921-.755 1.688-1.539 1.118l-5.33-3.872a1 1 0 0 0-1.175 0l-5.33 3.872c-.783.57-1.838-.197-1.539-1.118l2.036-6.264a1 1 0 0 0-.364-1.118l-5.33-3.872c-.783-.57-.38-1.81.588-1.81h6.587a1 1 0 0 0 .95-.69l2.036-6.264Z"/>
                        </svg>

                            Write Review

                    </button>

                @endif

                @elseif($statusLower === 'cancelled')
                    <span
                        style="background:#FEE2E2;color:#DC2626;"
                        class="inline-flex px-4 py-2 text-base font-semibold sm:px-5 sm:py-3 sm:text-base rounded-xl">

                        Cancelled

                    </span>

                    <p class="mt-3 text-base text-gray-500 sm:text-base">
                        This order was cancelled
                    </p>

                @endif

        </div>

    </div>

    @if($statusLower === 'completed' && !$hasReview)

        <div
            x-show="reviewModal"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="display: none;">

            {{-- Modal background --}}
            <div
                class="absolute inset-0 bg-black/50"
                @click="reviewModal = false">
            </div>

            {{-- Modal content --}}
            <div
                x-show="reviewModal"
                x-transition
                @click.stop
                class="relative z-10 w-full max-w-lg p-6 bg-white shadow-2xl sm:p-8 rounded-2xl">

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">
                            Review Your Order
                        </h2>

                        <p class="mt-1 text-gray-500">
                            Share your experience with {{ $farmer }}
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="reviewModal = false"
                        class="p-2 text-gray-400 rounded-lg hover:text-gray-700 hover:bg-gray-100">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                </div>

                <form method="POST" action="{{ route('buyer.orders.review', $orderId) }}" class="mt-6">
                    @csrf

                    <input type="hidden" name="order_id" value="{{ $orderId }}">

                    <input type="hidden" name="rating" :value="rating">

                    <div>
                        <label class="block font-semibold text-gray-800">
                            Product
                        </label>

                        <p class="mt-1 text-gray-600">
                            {{ $product }}
                        </p>
                    </div>

                    <div class="mt-5">
                        <label class="block font-semibold text-gray-800">
                            Your Rating
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="flex gap-2 mt-3">

                            <template x-for="star in 5" :key="star">

                                <button
                                    type="button"
                                    @click="rating = star"
                                    @mouseenter="$el.focus()"
                                    class="transition transform hover:scale-110"
                                    :aria-label="`${star} star rating`">

                                    <svg
                                        class="w-10 h-10"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        :class="star <= rating
                                            ? 'text-yellow-400'
                                            : 'text-gray-300'">

                                        <path d="M12 2.25l2.917 5.91 6.522.948-4.72 4.6 1.114 6.496L12 17.137l-5.833 3.067 1.114-6.496-4.72-4.6 6.522-.948L12 2.25Z"/>
                                    </svg>
                                </button>
                            </template>
                        </div>

                        <p
                            x-show="rating === 0"
                            class="mt-2 text-sm text-gray-500">
                            Select a rating from 1 to 5 stars
                        </p>

                        <p
                            x-show="rating > 0"
                            class="mt-2 text-sm font-medium text-green-700">
                            <span x-text="rating"></span> out of 5 stars selected
                        </p>

                        @error('rating')
                            @if(old('order_id') == $orderId)
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @endif
                        @enderror
                    </div>

                    <div class="mt-5">
                        <label
                            for="comment-{{ $orderId }}"
                            class="block font-semibold text-gray-800">

                            Feedback
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>

                        </label>

                        <textarea
                            id="comment-{{ $orderId }}"
                            name="comment"
                            rows="4"
                            maxlength="1000"
                            placeholder="Tell us about the product quality and your experience with the farmer..."
                            class="w-full px-4 py-3 mt-2 border-gray-300 resize-none rounded-xl focus:border-green-600 focus:ring-green-600">{{ old('order_id') == $orderId ? old('comment') : '' }}
                        </textarea>

                        @error('comment')
                            @if(old('order_id') == $orderId)
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @endif
                        @enderror
                    </div>

                    <div class="flex flex-col-reverse gap-3 mt-7 sm:flex-row sm:justify-end">

                        <button type="button" @click="reviewModal = false"
                            class="px-6 py-3 font-semibold text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-50">

                            Cancel

                        </button>

                        <button type="submit" :disabled="rating === 0"
                            class="px-6 py-3 font-semibold text-white bg-[#1F7A1F] rounded-xl hover:bg-green-800 disabled:cursor-not-allowed disabled:opacity-50">

                            Submit Review

                        </button>
                    </div>
                </form>
            </div>
        </div>

    @endif
</div>