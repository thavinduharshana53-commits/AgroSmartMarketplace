<div
    x-cloak
    x-show="offerModalOpen"
    x-transition.opacity
    {{-- Mobile Responsive: Smaller overlay padding on mobile --}}
    class="fixed inset-0 z-[999] flex items-center justify-center bg-black/40 px-2 py-3 sm:px-4">

    <!-- Modal Box -->
    <div
        @click.away="offerModalOpen = false"
        x-transition
        {{-- Mobile Responsive: Uses more available screen height on mobile --}}
        class="w-full max-w-[460px] max-h-[95vh] sm:max-h-[90vh] overflow-y-auto bg-white shadow-2xl rounded-xl sm:rounded-2xl">

        <!-- Inner Padding -->
        {{-- Mobile Responsive: Smaller inner padding on mobile --}}
        <div class="p-4 sm:p-5">

            <!-- Header -->
            <div class="flex items-start justify-between gap-3 mb-3">

                <div>
                    {{-- Mobile Responsive: Smaller modal heading on mobile --}}
                    <h2 class="text-xl font-bold text-gray-900 sm:text-2xl">
                        Submit Offer
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 sm:text-base">
                        Enter your offer details for this product.
                    </p>
                </div>

                <button
                    type="button"
                    @click="offerModalOpen = false"
                    class="text-gray-500 hover:text-gray-900 shrink-0">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                </button>

            </div>

            <!-- Product Summary -->
            <div class="p-3 mb-4 border border-gray-200 rounded-xl">

                <div class="flex gap-3">

                    {{-- Mobile Responsive: Smaller product image on mobile --}}
                    <img
                        :src="selectedProduct.image"
                        :alt="selectedProduct.name"
                        class="object-cover w-20 h-20 rounded-lg sm:w-28 sm:h-24 shrink-0">

                    <div class="flex-1 min-w-0">

                        <h3 class="text-lg font-bold text-gray-900 truncate sm:text-xl"
                            x-text="selectedProduct.name">
                        </h3>

                        <p class="mt-1 text-sm font-medium text-gray-500 sm:text-base">
                            by
                            <span x-text="selectedProduct.farmer"></span>
                        </p>

                        <p class="flex items-center gap-1 mt-1 text-sm text-gray-500 sm:text-base">
                            📍
                            <span class="truncate"
                                x-text="selectedProduct.location">
                            </span>
                        </p>

                        <span class="inline-flex items-center px-2 py-1 mt-2 text-xs font-medium rounded-lg sm:text-sm"
                            :class="selectedProduct.badge === 'Low Demand' ? 'text-red-700 bg-red-100' : 'text-green-700 bg-green-100'">

                            <span x-text="selectedProduct.badge"></span>

                        </span>

                    </div>

                </div>

                {{-- Mobile Responsive: Summary details stack on mobile --}}
                <div class="grid grid-cols-1 gap-3 pt-3 mt-3 border-t border-gray-200 sm:grid-cols-3">

                    <div>
                        <p class="text-sm text-gray-500 sm:text-base">
                            Price per kg
                        </p>

                        <h4 class="mt-1 text-lg font-bold text-[#1F7A1F] sm:text-xl whitespace-nowrap">
                            Rs.
                            <span x-text="selectedProduct.price"></span>
                        </h4>
                    </div>

                    {{-- Mobile Responsive: Top border on mobile and left border on larger screens --}}
                    <div class="pt-3 border-t border-gray-200 sm:pt-0 sm:pl-3 sm:border-t-0 sm:border-l">

                        <p class="text-sm text-gray-500 sm:text-base">
                            Minimum Price
                        </p>

                        <h4 class="mt-1 text-lg font-bold text-[#1F7A1F] text-base whitespace-nowrap">
                            Rs.
                            <span x-text="selectedProduct.minimumPrice"></span> / kg
                        </h4>

                    </div>

                    {{-- Mobile Responsive: Top border on mobile and left border on larger screens --}}
                    <div class="pt-3 border-t border-gray-200 sm:pt-0 sm:pl-3 sm:border-t-0 sm:border-l">

                        <p class="text-sm text-gray-500 sm:text-base">
                            Total Quantity
                        </p>

                        <h4 class="mt-1 text-lg font-bold text-[#1F7A1F] sm:text-xl whitespace-nowrap">
                            <span x-text="selectedProduct.quantity"></span>
                            kg
                        </h4>

                    </div>

                </div>

            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('buyer.offers.store') }}">
                 @csrf

                <input
                    type="hidden"
                    name="product_id"
                    :value="selectedProduct.id">

                <!-- Offer Price -->
                <div>

                    <label class="block mb-1 text-base font-semibold text-gray-800">
                        Your Offer Price per kg
                    </label>

                    <input
                        type="number"
                        name="offer_price"
                        step="0.01"
                        min="0.01"
                        required
                        placeholder="Enter your price per kg"
                        class="w-full px-4 py-2.5 border border-green-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-600">

                </div>

                <!-- Quantity -->
                <div class="mt-3">

                    <label class="block mb-1 text-base font-semibold text-gray-800">
                        Total Quantity
                    </label>

                    <input
                        type="number"
                        name="quantity"
                        :value="selectedProduct.quantity"
                        readonly
                        required
                        class="w-full px-4 py-2.5 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">

                    <p class="mt-1 text-sm text-gray-500">
                        This offer applies to the complete wholesale lot.
                    </p>

                </div>

                <!-- Optional Note -->
                <div class="mt-3">

                    <label class="block mb-1 text-base font-semibold text-gray-800">
                        Optional Note
                        <span class="text-gray-400">
                            (Optional)
                        </span>
                    </label>

                    <textarea
                        name="note"
                        rows="3"
                        placeholder="Write your message or negotiation note..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-green-500 focus:border-green-600"></textarea>

                </div>

                <!-- Info -->
                <div class="flex items-start gap-2 mt-2 text-sm text-gray-500">

                    <span class="flex items-center justify-center w-4 h-4 text-[10px] text-green-700 border border-green-700 rounded-full shrink-0">
                        i
                    </span>

                    <span>
                        Offers below the minimum price may be rejected.
                    </span>

                </div>

                <!-- Buttons -->
                {{-- Mobile Responsive: Buttons stack vertically on mobile --}}
                <div class="flex flex-col-reverse gap-3 mt-5 sm:flex-row sm:justify-end">

                    <button
                        type="button"
                        @click="offerModalOpen = false"
                        class="w-full px-6 py-2.5 font-semibold text-[#1F7A1F] border border-[#1F7A1F] rounded-lg hover:bg-green-50 sm:w-auto sm:px-8">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="w-full px-6 py-2.5 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 sm:w-auto sm:px-8">

                        Submit Offer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>