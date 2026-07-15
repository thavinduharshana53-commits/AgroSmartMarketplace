@extends('layouts.buyer')

@section('content')
<div x-data="{
                offerModalOpen: false,
                selectedProduct: {}
            }">
    <!-- Welcome Section -->
    <section class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Welcome Back, {{Auth::user()->name}}! 👤 
        </h1>

        <p class="mt-2 text-base text-gray-500">
            Find the best agricultural products from trusted farmers.
        </p>
    </section>

    <!-- stat-card -->

    <div class="flex gap-4">
        <x-buyer.state-card
        title="Current Offers"
        value="0"
        linkText="View all offers"
        bg="bg-[#F4FAF1]"
        iconBg="bg-[#DDF5D8]">

            <x-slot name="icon">
                <svg class="w-6 h-6 text-[#1F7A1F]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41 11 3H4v7l9.59 9.59a2 2 0 0 0 2.82 0l4.18-4.18a2 2 0 0 0 0-2.82Z" />
                    <circle cx="7.5" cy="7.5" r="1"/>
                </svg>
            </x-slot>

        </x-buyer.state-card>

        <x-buyer.state-card
        title="Pending Offers"
        value="0"
        linkText="View all offers"
        bg="bg-[#FFF7E8]"
        iconBg="bg-[#FEEDC8]">
            <x-slot name="icon">
                <svg class="w-6 h-6 text-[#FE8802]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
                </svg>
            </x-slot>
        </x-buyer.state-card>

        <x-buyer.state-card
            title="Confirmed Orders"
            value="0"
            linkText="View all Orders"
            bg="bg-[#EEF5FF]"
            iconBg="bg-[#E0EBFD]">
            <x-slot name="icon">
                <svg class="w-6 h-6 text-[#0839FD]" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 7V6a3 3 0 0 1 6 0v1" />
                    <rect x="4" y="7" width="16" height="13" rx="3" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 12h16" />
                </svg>
            </x-slot>
        </x-buyer.state-card>

        <x-buyer.state-card
            title="Completed Orders"
            value="0"
            linkText="View all Orders"
            bg="bg-[#F7F0FF]"
            iconBg="bg-[#EADDFC]">
            <x-slot name="icon">
                <svg class="w-6 h-6 text-[#760AD8]" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="9" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 12l2.5 2.5L16 9" />
                </svg>
            </x-slot>
        </x-buyer.state-card>
    </div>

    <section class="p-6 mt-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

        <div class="flex items-center justify-between mb-5">
            <h2 class="text-2xl font-bold text-gray-900">
                Demand Insights
            </h2>

            <a href="#" class="text-base font-semibold text-[#1F7A1F]">
                View full report →
            </a>
        </div>

        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">

            <!-- High Demand Chart -->
            <x-buyer.demand-chart
                title="High Demand Products"
                titleColor="text-[#1F7A1F]"
                lineColor="#15803D"
                areaColor="#BBF7D0"
                linePath="M5 95 L35 60 L55 35 L80 95 L105 70 L130 45 L155 65 L180 35 L205 50 L230 40 L255 15 L270 45 L290 45 L300 95"
                areaPath="M5 95 L35 60 L55 35 L80 95 L105 70 L130 45 L155 65 L180 35 L205 50 L230 40 L255 15 L270 45 L290 45 L300 95 L300 120 L5 120 Z">
                <x-slot name="points">
                    <circle cx="5" cy="95" r="3" fill="#15803D" />
                    <circle cx="35" cy="60" r="3" fill="#15803D" />
                    <circle cx="55" cy="35" r="3" fill="#15803D" />
                    <circle cx="80" cy="95" r="3" fill="#15803D" />
                    <circle cx="105" cy="70" r="3" fill="#15803D" />
                    <circle cx="130" cy="45" r="3" fill="#15803D" />
                    <circle cx="155" cy="65" r="3" fill="#15803D" />
                    <circle cx="180" cy="35" r="3" fill="#15803D" />
                    <circle cx="205" cy="50" r="3" fill="#15803D" />
                    <circle cx="230" cy="40" r="3" fill="#15803D" />
                    <circle cx="255" cy="15" r="3" fill="#15803D" />
                    <circle cx="270" cy="45" r="3" fill="#15803D" />
                    <circle cx="290" cy="45" r="3" fill="#15803D" />
                    <circle cx="300" cy="95" r="3" fill="#15803D" />
                </x-slot>
            </x-buyer.demand-chart>

            <!-- Low Demand Chart -->
            <x-buyer.demand-chart
                title="Low Demand Products"
                titleColor="text-red-500"
                lineColor="#EF4444"
                areaColor="#FECACA"
                linePath="M5 80 L25 65 L45 85 L65 60 L85 35 L105 70 L125 55 L145 65 L165 60 L185 85 L205 95 L225 65 L245 35 L265 60 L285 75 L300 90"
                areaPath="M5 80 L25 65 L45 85 L65 60 L85 35 L105 70 L125 55 L145 65 L165 60 L185 85 L205 95 L225 65 L245 35 L265 60 L285 75 L300 90 L300 120 L5 120 Z">
                <x-slot name="points">
                    <circle cx="5" cy="80" r="3" fill="#EF4444" />
                    <circle cx="25" cy="65" r="3" fill="#EF4444" />
                    <circle cx="45" cy="85" r="3" fill="#EF4444" />
                    <circle cx="65" cy="60" r="3" fill="#EF4444" />
                    <circle cx="85" cy="35" r="3" fill="#EF4444" />
                    <circle cx="105" cy="70" r="3" fill="#EF4444" />
                    <circle cx="125" cy="55" r="3" fill="#EF4444" />
                    <circle cx="145" cy="65" r="3" fill="#EF4444" />
                    <circle cx="165" cy="60" r="3" fill="#EF4444" />
                    <circle cx="185" cy="85" r="3" fill="#EF4444" />
                    <circle cx="205" cy="95" r="3" fill="#EF4444" />
                    <circle cx="225" cy="65" r="3" fill="#EF4444" />
                    <circle cx="245" cy="35" r="3" fill="#EF4444" />
                    <circle cx="265" cy="60" r="3" fill="#EF4444" />
                    <circle cx="285" cy="75" r="3" fill="#EF4444" />
                    <circle cx="300" cy="90" r="3" fill="#EF4444" />
                </x-slot>
            </x-buyer.demand-chart>

        </div>

    </section>

    <!-- Recommended nearby Products -->
    <section class="p-6 mt-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

        <div class="flex items-center justify-between mb-5">
            <h2 class="text-2xl font-bold text-gray-900">
                Recommended Nearby Products
            </h2>

            <a href="#" class="text-sm font-semibold text-[#1F7A1F]">
                View full products →
            </a>
        </div>
     <div class="grid grid-cols-1 gap-6 p-6 mt-6 bg-white border border-gray-200 shadow-sm md:grid-cols-2 xl:grid-cols-4 rounded-2xl">
            @foreach($products as $product)
                <x-buyer.product-card
                        :product-id="$product->product_id"
                        :image="$product->product_image ? 'storage/' . $product->product_image : 'image/products/default.png'"
                        :badge="$product->demand_level"
                        :name="$product->product_name"
                        :farmer="$product->farmer->name"
                        :location="$product->city"
                        :price="$product->price"
                        :minimum-price="$product->minimum_price"
                        :quantity="$product->quantity"
                        :availabilityStatus="$product->availability_status">

                </x-buyer.product-card>
            @endforeach
    </section>    
    <x-buyer.submit_offers />
</div>
@endsection