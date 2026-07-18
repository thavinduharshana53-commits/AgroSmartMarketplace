@extends('layouts.farmer')

@section('content')

<div class="min-h-screen p-4 bg-white sm:p-6">

    {{-- Page Heading --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-900">
            Demand Analysis
        </h1>

        <p class="mt-2 text-gray-500">
            Monitor buyer activity and product demand during the last 30 days.
        </p>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 gap-5 mt-8 sm:grid-cols-2 xl:grid-cols-4">

        {{-- High Demand --}}
        <div class="p-6 border shadow-lg bg-gray-50 rounded-2xl">
            <p class="text-base font-semibold text-gray-500">
                High Demand Products
            </p>

            <h2 class="mt-2 text-3xl font-bold text-green-700">
                {{ $highDemandCount }}
            </h2>
        </div>

        {{-- Low Demand --}}
        <div class="p-6 border  shadow-lg  bg-gray-50 rounded-2xl">
            <p class="text-base font-semibold  text-gray-500">
                Low Demand Products
            </p>

            <h2 class="mt-2 text-3xl font-bold text-red-600">
                {{ $lowDemandCount }}
            </h2>
        </div>

        {{-- Total Activities --}}
        <div class="p-6 border  shadow-lg  bg-gray-50 rounded-2xl">
            <p class="text-base font-semibold text-gray-500">
                Buyer Activities
            </p>

            <h2 class="mt-2 text-3xl font-bold text-blue-700">
                {{ $totalActivities }}
            </h2>

            <p class="mt-1 text-base text-gray-500">
                Last 30 days
            </p>
        </div>

        {{-- Top Product --}}
        <div class="p-6 border  shadow-lg   bg-gray-50 rounded-2xl">
            <p class="text-base font-semibold  text-gray-500">
                Top Demand Product
            </p>

            <h2 class="mt-2 text-xl font-bold text-gray-900">
                {{ $topProduct?->product_name ?? 'No activity yet' }}
            </h2>

            @if($topProduct)
                <p class="mt-1 font-semibold text-yellow-700">
                    Score: {{ $topProduct->demand_score }}
                </p>
            @endif
        </div>

    </div>

    {{-- Demand Score Chart --}}
    <div class="p-6 mt-10 bg-white border border-gray-200 shadow-sm rounded-2xl">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Product Demand Comparison
            </h2>

            <p class="mt-1 text-gray-500">
                Demand scores calculated from buyer activities during the last 30 days.
            </p>
        </div>

        @if($products->isNotEmpty())

            <div class="relative mt-6 h-80">
                <canvas id="demandScoreChart"></canvas>
            </div>

        @else

            <div class="py-12 mt-6 text-center text-gray-500">
                No product demand data is available.
            </div>

        @endif

    </div>

    {{-- Product Statistics --}}
    <div class="mt-10">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Product Demand Statistics
            </h2>

            <p class="mt-1 text-gray-500">
                Search, view, offer and completed-order activity for each product.
            </p>
        </div>

        <div class="mt-5 overflow-x-auto bg-white border border-gray-200 shadow-sm rounded-2xl">

           <table class="w-full min-w-[1250px] text-left">

                <thead class="text-base text-gray-600 bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Product</th>
                        <th class="px-6 py-4 font-semibold text-center">Searches</th>
                        <th class="px-6 py-4 font-semibold text-center">Views</th>
                        <th class="px-6 py-4 font-semibold text-center">Offers</th>
                        <th class="px-6 py-4 font-semibold text-center">Orders</th>
                        <th class="px-6 py-4 font-semibold text-center">Score</th>
                        <th class="px-6 py-4 font-semibold">Demand Level</th>
                        <th class="px-6 py-4 font-semibold">Recommended Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($products as $product)

                        <tr class="transition hover:bg-gray-50">

                            <td class="px-4 py-5">
                                <div class="flex items-center gap-4">

                                    <img
                                        src="{{ $product->product_image
                                            ? asset('storage/'.$product->product_image)
                                            : asset('image/product-placeholder.png') }}"
                                        alt="{{ $product->product_name }}"
                                        class="object-cover w-14 h-14 border border-gray-200 rounded-xl">

                                    <div>
                                        <p class="font-bold text-base text-gray-900">
                                            {{ $product->product_name }}
                                        </p>

                                        <p class="mt-1 text-base text-gray-500">
                                            {{ $product->category }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td class="px-4 py-5 font-text-base font-semibold text-center">
                                {{ $product->search_count }}
                            </td>

                            <td class="px-4 py-5  text-base font-semibold text-center">
                                {{ $product->view_count }}
                            </td>

                            <td class="px-4 py-5 text-base font-semibold text-center">
                                {{ $product->offer_count }}
                            </td>

                            <td class="px-4 py-5 text-base font-semibold text-center">
                                {{ $product->order_count }}
                            </td>

                            <td class="px-4 py-5 text-base text-center">
                                <span class="text-lg font-bold text-gray-900">
                                    {{ $product->demand_score }}
                                </span>
                            </td>

                            <td class="px-4 py-5">

                                @if($product->demand_level === 'High Demand')

                                    <span class="inline-flex px-3 py-2 text-base font-semibold text-green-700 bg-green-100 rounded-lg">
                                        High Demand
                                    </span>

                                @else

                                    <span class="inline-flex px-3 py-2 text-base font-semibold text-red-700 bg-red-100 rounded-lg">
                                        Low Demand
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-5">
                                @php
                                    $availability = strtolower(
                                        trim($product->availability_status)
                                    );

                                    $isHighDemand =
                                        $product->demand_level === 'High Demand';
                                @endphp

                                @if($isHighDemand && $availability === 'available')

                                    <div class="p-3 text-sm text-green-700 border border-green-200 bg-green-50 rounded-xl">
                                        <p class="font-semibold">
                                            Strong buyer interest
                                        </p>

                                        <p class="mt-1">
                                            Review your selling price and maintain sufficient stock.
                                        </p>
                                    </div>

                                @elseif($isHighDemand && $availability === 'reserved')

                                    <div class="p-3 text-sm text-purple-700 border border-purple-200 bg-purple-50 rounded-xl">
                                        <p class="font-semibold">
                                            Product currently reserved
                                        </p>

                                        <p class="mt-1">
                                            Prepare the product carefully and consider publishing a similar lot.
                                        </p>
                                    </div>

                                @elseif($isHighDemand && $availability === 'sold out')

                                    <div class="p-3 text-sm text-green-700 border border-green-200 bg-green-50 rounded-xl">
                                        <p class="font-semibold">
                                            Strong demand confirmed
                                        </p>

                                        <p class="mt-1">
                                            Consider publishing another similar product lot.
                                        </p>
                                    </div>

                                @elseif(!$isHighDemand && $availability === 'available')

                                    <div class="p-3 text-sm text-orange-700 border border-orange-200 bg-orange-50 rounded-xl">
                                        <p class="font-semibold">
                                            Buyer interest is currently low
                                        </p>

                                        <p class="mt-1">
                                            Review the price, description and product visibility.
                                        </p>
                                    </div>

                                @else

                                    <div class="p-3 text-sm text-gray-600 border border-gray-200 bg-gray-50 rounded-xl">
                                        <p class="font-semibold">
                                            Product is no longer active
                                        </p>

                                        <p class="mt-1">
                                            Use these results when pricing your next product lot.
                                        </p>
                                    </div>

                                @endif
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                You have not published any products yet.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@if($products->isNotEmpty())

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const chartElement = document.getElementById('demandScoreChart');

            if (!chartElement || typeof Chart === 'undefined') {
                return;
            }

            const productNames = {{ Illuminate\Support\Js::from(
                $products->pluck('product_name')->values()
            ) }};

            const demandScores = {{ Illuminate\Support\Js::from(
                $products->pluck('demand_score')->values()
            ) }};

            const demandLevels = {{ Illuminate\Support\Js::from(
                $products->pluck('demand_level')->values()
            ) }};

            const barColors = demandLevels.map(function (level) {
                return level === 'High Demand' ? '#15803D' : '#EF4444';});

            new Chart(chartElement, {
                type: 'bar',

                data: {
                    labels: productNames,

                    datasets: [
                        {
                            label: 'Demand Score',
                            data: demandScores,
                            backgroundColor: barColors,
                            borderColor: barColors,
                            borderWidth: 1,
                            borderRadius: 8,
                            maxBarThickness: 65,
                        }
                    ]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            display: false,
                        },

                        tooltip: {
                            callbacks: {
                                afterLabel: function (context) {
                                    return demandLevels[context.dataIndex];
                                }
                            }
                        }
                    },

                    scales: {
                        x: {
                            grid: {
                                display: false,
                            },

                            ticks: {
                                color: '#4B5563',
                                font: {
                                    size: 13,
                                    weight: '600',
                                }
                            }
                        },

                        y: {
                            beginAtZero: true,

                            ticks: {
                                precision: 0,
                                color: '#6B7280',
                            },

                            title: {
                                display: true,
                                text: 'Demand Score',
                                color: '#4B5563',
                            },

                            grid: {
                                color: '#E5E7EB',
                            }
                        }
                    }
                }
            });

        });
    </script>

@endif

@endsection