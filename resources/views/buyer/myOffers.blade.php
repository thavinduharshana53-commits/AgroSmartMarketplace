@extends('layouts.buyer')

@section('content')

<div class="min-h-screen">

    {{-- Mobile Responsive: Smaller page padding on mobile --}}
    <main class="p-2 sm:p-4 lg:p-8">

        {{-- Page Header --}}
        {{-- Mobile Responsive: Smaller bottom spacing on mobile --}}
        <div class="mb-5 sm:mb-6">

            {{-- Mobile Responsive: Smaller heading on mobile --}}
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                My Offers
            </h1>

            {{-- Mobile Responsive: Smaller description on mobile --}}
            <p class="mt-2 text-sm text-gray-600 sm:text-base">
                Manage your offers and track their status with farmers.
            </p>

        </div>

        @forelse($offers as $offer)

            <x-buyer.my-offer-card
                :offerId="$offer->offer_id"
                :image="$offer->product->product_image
                    ? 'storage/'.$offer->product->product_image
                    : 'image/product-placeholder.png'"
                :product="$offer->product->product_name"
                :farmer="$offer->product->farmer->name"
                :location="$offer->product->city.', '.$offer->product->district"
                :offerPrice="$offer->offer_price"
                :minimumPrice="$offer->product->minimum_price"
                :counterPrice="$offer->counter_price"
                :counterNote="$offer->counter_note"
                :quantity="$offer->quantity"
                :unit="$offer->product->unit ?? 'kg'"
                :status="$offer->status"
                :rejectedBy="$offer->rejected_by"
                :acceptedBy="$offer->accepted_by"
            />

        @empty

            {{-- Mobile Responsive: Responsive empty-state padding --}}
            <div class="px-4 py-10 text-center bg-white border border-gray-200 shadow-sm sm:px-6 sm:py-12 rounded-2xl">

                <h2 class="text-lg font-bold text-gray-900 sm:text-xl">
                    No offers found
                </h2>

                <p class="mt-2 text-sm text-gray-500 sm:text-base">
                    You have not submitted any product offers yet.
                </p>

                {{-- Mobile Responsive: Full-width button on small mobile screens --}}
                <a
                    href="{{ route('buyer.browseProducts') }}"
                    class="inline-flex justify-center w-full px-6 py-3 mt-5 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800 sm:w-auto">

                    Browse Products

                </a>

            </div>

        @endforelse

    </main>

</div>

@endsection