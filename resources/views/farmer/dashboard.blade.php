@extends('layouts.farmer')

@section('content')

<div class="min-h-screen p-2 bg-white">

    <div>
        <h1 class="text-3xl font-bold text-gray-900">
            Welcome Back, {{ Auth::user()->name }}! 🧑‍🌾
        </h1>

        <p class="mt-2 text-lg text-gray-500">
            Manage your products, buyer offers and customer feedback.
        </p>
    </div>

    {{-- Dashboard statistics --}}
    <div class="grid grid-cols-1 gap-6 mt-8 sm:grid-cols-2 xl:grid-cols-4">

        <x-farmer.stat-card
            title="Total Products"
            :value="$totalProducts"
            bg="bg-white"
            iconBg="bg-[#DDF5D8]">

            <x-slot name="icon">
                <svg
                    class="w-6 h-6 text-[#1F7A1F]"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M20.59 13.41 11 3H4v7l9.59 9.59a2 2 0 0 0 2.82 0l4.18-4.18a2 2 0 0 0 0-2.82Z"/>

                    <circle cx="7.5" cy="7.5" r="1"/>
                </svg>
            </x-slot>

        </x-farmer.stat-card>

        <x-farmer.stat-card
            title="Pending Offers"
            :value="$pendingOffers"
            bg="bg-white"
            iconBg="bg-[#FEEDC8]">

            <x-slot name="icon">
                <svg
                    class="w-6 h-6 text-[#FE8802]"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    viewBox="0 0 24 24">

                    <circle cx="12" cy="12" r="9"/>

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 7v5l3 2"/>
                </svg>
            </x-slot>

        </x-farmer.stat-card>

        <x-farmer.stat-card
            title="Completed Orders"
            :value="$completedOrders"
            bg="bg-white"
            iconBg="bg-[#E0EBFD]">

            <x-slot name="icon">
                <svg
                    class="w-6 h-6 text-[#0839FD]"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 7V6a3 3 0 0 1 6 0v1"/>

                    <rect
                        x="4"
                        y="7"
                        width="16"
                        height="13"
                        rx="3"/>

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 12h16"/>
                </svg>
            </x-slot>

        </x-farmer.stat-card>

        <x-farmer.stat-card
            title="Farmer Rating"
            :value="number_format((float) $averageRating, 1).' / 5'"
            bg="bg-white"
            iconBg="bg-[#FEF3C7]">

            <x-slot name="icon">
                <svg
                    class="w-6 h-6 text-yellow-500"
                    viewBox="0 0 24 24"
                    fill="currentColor">

                    <path d="M12 2.25l2.917 5.91 6.522.948-4.72 4.6 1.114 6.496L12 17.137l-5.833 3.067 1.114-6.496-4.72-4.6 6.522-.948L12 2.25Z"/>
                </svg>
            </x-slot>

        </x-farmer.stat-card>

    </div>

    {{-- Quick actions --}}
    <div class="grid grid-cols-1 gap-6 mt-10 md:grid-cols-2">

        <a
            href="{{ route('farmer.publishProducts') }}"
            class="p-8 transition bg-[#F8F5EC] shadow-sm rounded-2xl hover:shadow-md">

            <h2 class="mt-5 text-2xl font-bold text-green-700">
                Publish Product
            </h2>

            <p class="mt-3 text-gray-600">
                Add new agricultural products and publish them for buyers.
            </p>

        </a>

        <a
            href="{{ route('farmer.manageOffers') }}"
            class="p-8 transition bg-[#F8F5EC] shadow-sm rounded-2xl hover:shadow-md">

            <h2 class="mt-5 text-2xl font-bold text-green-700">
                Manage Offers
            </h2>

            <p class="mt-3 text-gray-600">
                View buyer offers and accept or reject negotiations.
            </p>

        </a>

    </div>

    {{-- Recent Buyer Reviews --}}
    <section class="mt-10">

            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Recent Buyer Reviews
                </h2>

                <p class="mt-1 text-gray-500">
                    Feedback received from your completed orders.
                </p>
            </div>

        @if($recentReviews->isNotEmpty())

            <div class="grid grid-cols-1 gap-5 mt-6 lg:grid-cols-2">

                @foreach($recentReviews as $review)

                    <article class="p-6 transition bg-white border border-gray-200 shadow-sm rounded-2xl hover:shadow-md">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex items-center gap-3 min-w-0">

                                <div class="flex items-center justify-center w-12 h-12 font-bold text-green-700 uppercase bg-green-100 rounded-full shrink-0">
                                    {{ mb_substr($review->buyer->name, 0, 1) }}
                                </div>

                                <div class="min-w-0">
                                    <h3 class="font-bold text-gray-900 truncate">
                                        {{ $review->buyer->name }}
                                    </h3>

                                    <p class="text-sm text-gray-500 truncate">
                                        {{ $review->product->product_name }}
                                    </p>
                                </div>

                            </div>

                            <p class="text-sm text-gray-400 whitespace-nowrap">
                                {{ $review->created_at->format('d M Y') }}
                            </p>

                        </div>

                        <div class="flex items-center gap-1 mt-4">

                            @for($star = 1; $star <= 5; $star++)

                                <svg
                                    class="w-6 h-6 {{ $star <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                    viewBox="0 0 24 24"
                                    fill="currentColor">

                                    <path d="M12 2.25l2.917 5.91 6.522.948-4.72 4.6 1.114 6.496L12 17.137l-5.833 3.067 1.114-6.496-4.72-4.6 6.522-.948L12 2.25Z"/>
                                </svg>

                            @endfor

                            <span class="ml-2 font-bold text-gray-700">
                                {{ $review->rating }}.0
                            </span>

                        </div>

                        @if($review->commennt)

                            <p class="mt-4 leading-relaxed text-gray-600 break-words">
                                “{{ $review->commennt }}”
                            </p>

                        @else

                            <p class="mt-4 italic text-gray-400">
                                No written feedback was provided.
                            </p>

                        @endif

                    </article>

                @endforeach

            </div>

        @else

            <div class="p-10 mt-6 text-center border-2 border-gray-200 border-dashed bg-gray-50 rounded-2xl">


                <h3 class="mt-4 text-xl font-bold text-gray-800">
                    No reviews yet
                </h3>

                <p class="mt-2 text-gray-500">
                    Buyer reviews from completed orders will appear here.
                </p>

            </div>

        @endif

    </section>

</div>

@endsection