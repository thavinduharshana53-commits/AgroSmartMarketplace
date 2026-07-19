@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Page Heading  -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
            Dashboard Overview
        </h1>

        <p class="mt-2 text-sm text-slate-500 sm:text-base">
            Monitor users, products and marketplace activities.
        </p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

        <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-base font-semibold text-slate-500">
                        Total Buyers
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalBuyers) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12
                            text-blue-600 bg-blue-100 rounded-xl">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <circle cx="12" cy="7" r="4"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                    </svg>

                </div>

            </div>

            <a
                href="{{ route('admin.userManage') }}"
                class="inline-flex items-center gap-2 mt-5
                       text-base font-bold text-blue-600 hover:text-blue-800">

                Manage buyers
                <span>→</span>
            </a>

        </div>

        <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-base font-semibold text-slate-500">
                        Total Farmers
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalFarmers) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12
                            text-emerald-600 bg-emerald-100 rounded-xl">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 21v-9M7 17c-2-1-3-3-3-5
                               4 0 7 2 8 5M17 17c2-1 3-3 3-5
                               -4 0-7 2-8 5M8 8c0-3 2-5 4-6
                               2 1 4 3 4 6-1 2-2 3-4 4
                               -2-1-3-2-4-4Z"/>
                    </svg>

                </div>

            </div>

            <a
                href="{{ route('admin.userManage') }}"
                class="inline-flex items-center gap-2 mt-5
                       text-base font-bold text-emerald-600
                       hover:text-emerald-800">

                Manage farmers
                <span>→</span>
            </a>

        </div>

        <!-- Products -->
        <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-base font-semibold text-slate-500">
                        Total Products
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalProducts) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12
                            text-amber-600 bg-amber-100 rounded-xl">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4
                               a2 2 0 0 0-2 0l-7 4A2 2 0 0 0
                               3 8v8a2 2 0 0 0 1 1.73l7 4
                               a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>

                        <path d="m3.3 7 8.7 5 8.7-5M12 22V12"/>
                    </svg>

                </div>

            </div>

            <a
                href="#"
                class="inline-flex items-center gap-2 mt-5
                       text-base font-bold text-amber-600
                       hover:text-amber-800">

                Monitor products
                <span>→</span>
            </a>

        </div>

        <!-- Completed Orders -->
        <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-base font-semibold text-slate-500">
                        Completed Orders
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($completedOrders) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12
                            text-violet-600 bg-violet-100 rounded-xl">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="9"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m8 12 3 3 5-6"/>
                    </svg>

                </div>

            </div>

            <a
                href="#"
                class="inline-flex items-center gap-2 mt-5
                       text-base font-bold text-violet-600
                       hover:text-violet-800">

                View reports
                <span>→</span>
            </a>

        </div>

    </div>

    <!-- Recent Data -->
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

        <!-- Recent Users -->
        <section class="overflow-hidden bg-white border shadow-sm
                        border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between px-5 py-5
                        border-b border-slate-200 sm:px-6">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Recent Users
                    </h2>

                    <p class="mt-1 text-s text-slate-500">
                        Recently registered buyers and farmers.
                    </p>
                </div>

                <a
                    href="{{ route('admin.userManage') }}"
                    class="text-base font-bold text-emerald-600
                           hover:text-emerald-800">

                    View all
                </a>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($recentUsers as $user)

                    <div class="flex items-center gap-4 px-5 py-4 sm:px-6">

                        <div class="flex items-center justify-center w-12 h-12
                                    font-bold rounded-full shrink-0
                                    {{ $user->role === 'farmer'
                                        ? 'text-emerald-700 bg-emerald-100'
                                        : 'text-blue-700 bg-blue-100' }}">

                            {{ strtoupper(substr($user->name, 0, 1)) }}

                        </div>

                        <div class="flex-1 min-w-0">

                            <p class="font-semibold text-lg truncate text-slate-900">
                                {{ $user->name }}
                            </p>

                            <p class="text-s truncate text-slate-500">
                                {{ $user->email }}
                            </p>

                        </div>

                        <div class="text-right">

                            <span class="inline-flex px-3 py-3 text-sm
                                         font-semibold capitalize rounded-full
                                         {{ $user->role === 'farmer'
                                            ? 'text-emerald-700 bg-emerald-100'
                                            : 'text-blue-700 bg-blue-100' }}">

                                {{ $user->role }}

                            </span>

                            <p class="mt-2 text-sm text-slate-400">
                                {{ $user->created_at?->format('d M Y') }}
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-12 text-center">

                        <p class="font-medium text-slate-500">
                            No users found.
                        </p>

                    </div>

                @endforelse

            </div>

        </section>

        <!-- Recent Products -->
        <section class="overflow-hidden bg-white border shadow-sm
                        border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between px-5 py-5
                        border-b border-slate-200 sm:px-6">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Recent Products
                    </h2>

                    <p class="mt-1 text-s text-slate-500">
                        Recently published marketplace products.
                    </p>
                </div>

                <a
                    href="#"
                    class="text-base font-bold text-emerald-600
                           hover:text-emerald-800">

                    View all
                </a>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($recentProducts as $product)

                    @php
                        $isAvailable =
                            strtolower($product->availability_status)
                            === 'available';
                    @endphp

                    <div class="flex items-center gap-4 px-5 py-4 sm:px-6">

                        <div class="w-12 h-12 overflow-hidden bg-slate-100
                                    border border-slate-200 rounded-xl shrink-0">

                            <img
                                src="{{ $product->product_image
                                    ? asset('storage/'.$product->product_image)
                                    : asset('image/product-placeholder.png') }}"
                                alt="{{ $product->product_name }}"
                                class="object-cover w-full h-full">

                        </div>

                        <div class="flex-1 min-w-0">

                            <p class="font-semibold text-lg  truncate text-slate-900">
                                {{ $product->product_name }}
                            </p>

                            <p class="text-s truncate text-slate-500">
                                by {{ $product->farmer?->name ?? 'Unknown farmer' }}
                            </p>

                        </div>

                        <div class="text-right">

                            <span class="inline-flex px-3 py-1 text-sm
                                         font-semibold rounded-full
                                         {{ $isAvailable
                                            ? 'text-emerald-700 bg-emerald-100'
                                            : 'text-red-700 bg-red-100' }}">

                                {{ $isAvailable ? 'Available' : 'Sold Out' }}

                            </span>

                            <p class="mt-2 text-sm text-slate-400">
                                {{ $product->created_at?->format('d M Y') }}
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-12 text-center">

                        <p class="font-medium text-slate-500">
                            No products found.
                        </p>

                    </div>

                @endforelse

            </div>

        </section>

    </div>

</div>

@endsection