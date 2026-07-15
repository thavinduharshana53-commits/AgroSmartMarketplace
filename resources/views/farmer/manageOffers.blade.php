@extends('layouts.farmer')

@section('content')

<div class="min-h-screen">
    <main class="p-8">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                Buyer Offers
            </h1>

            <p class="mt-2 text-gray-600">
                View, accept, reject, or negotiate offers from buyers.
            </p>
        </div>

        <div class="space-y-5">

             @forelse($offers as $offer)
                <x-farmer.offer-card
                    :offerId="$offer->offer_id"
                    :image="'storage/'.$offer->product->product_image"
                    :product="$offer->product->product_name"
                    :buyer="$offer->buyer->name"
                    :offerPrice="$offer->offer_price"
                    :minimumPrice="$offer->product->minimum_price"
                    :counterPrice="$offer->counter_price"
                    :quantity="$offer->quantity"
                    :status="$offer->status"
                    :rejectedBy="$offer->rejected_by"
                    :acceptedBy="$offer->accepted_by"
                    :date="$offer->created_at->format('d M Y')"
                />

                @empty
                    <div class="p-12 text-center bg-white border border-gray-200 shadow-sm rounded-2xl">
                        <h2 class="text-xl font-bold text-gray-900">
                            No Offers found
                        </h2>
                    </div>
                @endforelse


        </div>

    </main>
</div>

@endsection