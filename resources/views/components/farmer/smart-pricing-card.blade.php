<div class="p-5 mt-5 border border-green-200 bg-green-50 rounded-2xl">

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <h3 class="text-lg font-bold text-gray-900">
                Smart Price Recommendation
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                Get a suggested price range using demand and marketplace data.
            </p>
        </div>

        <button
            type="button"
            @click="getPriceSuggestion()"
            :disabled="pricingLoading"
            class="inline-flex items-center justify-center px-5 py-3 font-semibold text-white bg-green-700 rounded-lg hover:bg-green-800 disabled:cursor-not-allowed disabled:opacity-60">

            <span x-show="!pricingLoading">
                Get Suggested Price
            </span>

            <span x-show="pricingLoading" x-cloak>
                Calculating...
            </span>

        </button>

    </div>

    {{-- Error Message --}}
    <div
        x-show="pricingError"
        x-cloak
        class="p-3 mt-4 text-sm text-red-700 border border-red-200 bg-red-50 rounded-xl">

        <span x-text="pricingError"></span>

    </div>

    {{-- Pricing Result --}}
    <div
        x-show="pricingResult"
        x-cloak
        class="mt-5">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            <div class="p-4 bg-white border border-green-100 rounded-xl">
                <p class="text-sm text-gray-500">
                    Suggested Price
                </p>

                <p class="mt-1 text-xl font-bold text-green-700">
                    Rs.
                    <span
                        x-text="pricingResult
                            ? formatPrice(pricingResult.suggested_price)
                            : '0.00'">
                    </span>
                </p>
            </div>

            <div class="p-4 bg-white border border-green-100 rounded-xl">
                <p class="text-sm text-gray-500">
                    Suggested Minimum
                </p>

                <p class="mt-1 text-xl font-bold text-gray-900">
                    Rs.
                    <span
                        x-text="pricingResult
                            ? formatPrice(
                                pricingResult.minimum_suggested_price
                            )
                            : '0.00'">
                    </span>
                </p>
            </div>

            <div class="p-4 bg-white border border-green-100 rounded-xl">
                <p class="text-sm text-gray-500">
                    Suggested Maximum
                </p>

                <p class="mt-1 text-xl font-bold text-gray-900">
                    Rs.
                    <span
                        x-text="pricingResult
                            ? formatPrice(
                                pricingResult.maximum_suggested_price
                            )
                            : '0.00'">
                    </span>
                </p>
            </div>

        </div>

        <div class="flex flex-col justify-between gap-4 mt-4 sm:flex-row sm:items-center">

            <div class="text-sm text-gray-600">

                <p>
                    Demand:
                    <span
                        class="font-semibold"
                        x-text="pricingResult
                            ? pricingResult.demand_level
                            : ''">
                    </span>
                </p>

                <p class="mt-1">
                    Based on:
                    <span
                        class="font-semibold"
                        x-text="pricingResult
                            ? pricingResult.data_source
                            : ''">
                    </span>
                </p>

            </div>

            <button
                type="button"
                @click="applySuggestedPrice()"
                class="px-5 py-2.5 font-semibold text-green-700 bg-white border border-green-700 rounded-lg hover:bg-green-100">

                Use Suggested Price

            </button>

        </div>

    </div>

</div>