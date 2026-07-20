@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                Sales and Orders Report
            </h1>

            <p class="mt-2 text-sm text-slate-500 sm:text-base">
                Monitor marketplace orders, completed sales and revenue.
            </p>
        </div>

        <div class="inline-flex items-center self-start gap-2 px-4 py-2 text-sm font-semibold border text-emerald-700 border-emerald-200 bg-emerald-50 rounded-xl">

            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

            {{ number_format($totalOrders) }}
            orders found

        </div>

    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">

        {{-- Total Orders --}}
        <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-semibold text-slate-500">
                        Total Orders
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-slate-900">
                        {{ number_format($totalOrders) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12 text-blue-600 bg-blue-100 rounded-xl">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 7h16v13H4zM8 7V5a4 4 0 0 1 8 0v2"/>

                    </svg>

                </div>

            </div>

        </div>

        {{-- Completed Orders --}}
        <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-semibold text-slate-500">
                        Completed
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-emerald-700">
                        {{ number_format($completedOrders) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12 rounded-xl text-emerald-600 bg-emerald-100">

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

        </div>

        {{-- Cancelled Orders --}}
        <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-semibold text-slate-500">
                        Cancelled
                    </p>

                    <h2 class="mt-2 text-2xl font-bold text-red-600">
                        {{ number_format($cancelledOrders) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12 text-red-600 bg-red-100 rounded-xl">

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
                            d="m9 9 6 6m0-6-6 6"/>

                    </svg>

                </div>

            </div>

        </div>

        {{-- Total Sales --}}
        <div class="p-5 border shadow-sm bg-emerald-50 border-emerald-200 rounded-2xl">

            <div class="flex items-center justify-between gap-3">

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-emerald-700">
                        Total Sales
                    </p>

                    <h2 class="mt-2 text-xl font-bold truncate text-emerald-800">
                        Rs. {{ number_format($totalSales, 2) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12 rounded-xl text-emerald-600 bg-emerald-100 shrink-0">

                    <span class="text-lg font-bold">
                        Rs
                    </span>

                </div>

            </div>

        </div>

        {{-- Average Order Value --}}
        <div class="p-5 bg-white border shadow-sm border-slate-200 rounded-2xl">

            <div class="flex items-center justify-between gap-3">

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-slate-500">
                        Average Sale
                    </p>

                    <h2 class="mt-2 text-xl font-bold truncate text-slate-900">
                        Rs. {{ number_format($averageOrderValue, 2) }}
                    </h2>
                </div>

                <div class="flex items-center justify-center w-12 h-12 text-purple-600 bg-purple-100 rounded-xl shrink-0">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 18V9m5 9V5m5 13v-7m5 7V3"/>

                    </svg>

                </div>

            </div>

        </div>

    </div>

    {{-- Search and Filters --}}
    <div class="p-4 bg-white border shadow-sm border-slate-200 rounded-2xl sm:p-5">

        <form
            action="{{ route('admin.reports') }}"
            method="GET"
            class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-12 xl:items-end">

            {{-- Search --}}
            <div class="xl:col-span-4">

                <label
                    for="reportSearch"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Search Orders

                </label>

                <div class="relative">

                    <svg
                        class="absolute w-5 h-5 -translate-y-1/2 pointer-events-none left-4 top-1/2 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <circle cx="11" cy="11" r="7"/>

                        <path
                            stroke-linecap="round"
                            d="m20 20-3.5-3.5"/>

                    </svg>

                    <input
                        id="reportSearch"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Order, product, buyer or farmer..."
                        class="w-full h-12 pl-12 pr-4 border border-slate-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                </div>

            </div>

            {{-- Status --}}
            <div class="xl:col-span-2">

                <label
                    for="statusFilter"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Order Status

                </label>

                <select
                    id="statusFilter"
                    name="status"
                    class="w-full h-12 px-4 bg-white border border-slate-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                    <option value="">
                        All Statuses
                    </option>

                    <option value="pending" @selected($status === 'pending')>
                        Pending
                    </option>

                    <option value="confirmed" @selected($status === 'confirmed')>
                        Confirmed
                    </option>

                    <option
                        value="ready_for_pickup"
                        @selected($status === 'ready_for_pickup')>

                        Ready for Pickup

                    </option>

                    <option value="completed" @selected($status === 'completed')>
                        Completed
                    </option>

                    <option value="cancelled" @selected($status === 'cancelled')>
                        Cancelled
                    </option>

                </select>

            </div>

            {{-- Date From --}}
            <div class="xl:col-span-2">

                <label
                    for="dateFrom"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Date From

                </label>

                <input
                    id="dateFrom"
                    type="date"
                    name="date_from"
                    value="{{ $dateFrom }}"
                    class="w-full h-12 px-4 border border-slate-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

            </div>

            {{-- Date To --}}
            <div class="xl:col-span-2">

                <label
                    for="dateTo"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Date To

                </label>

                <input
                    id="dateTo"
                    type="date"
                    name="date_to"
                    value="{{ $dateTo }}"
                    class="w-full h-12 px-4 border border-slate-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

            </div>

            {{-- Actions --}}
            <div class="flex gap-3 md:col-span-2 xl:col-span-2">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center flex-1 h-12 px-5 font-semibold text-white transition bg-emerald-600 rounded-xl hover:bg-emerald-700">

                    Apply

                </button>

                @if(
                    $search !== '' ||
                    $status !== '' ||
                    $dateFrom !== '' ||
                    $dateTo !== ''
                )

                    <a
                        href="{{ route('admin.reports') }}"
                        title="Clear filters"
                        class="inline-flex items-center justify-center w-12 h-12 transition border border-slate-300 text-slate-600 rounded-xl hover:bg-slate-50">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 6l12 12M18 6 6 18"/>

                        </svg>

                    </a>

                @endif

            </div>

        </form>

    </div>

    {{-- Orders Table --}}
    <div class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">

        {{-- Desktop --}}
        <div class="hidden overflow-x-auto lg:block">

            <table class="w-full text-left">

                <thead class="bg-slate-50">

                    <tr class="text-sm font-semibold text-slate-600">

                        <th class="px-5 py-4">Order</th>
                        <th class="px-5 py-4">Product</th>
                        <th class="px-5 py-4">Buyer</th>
                        <th class="px-5 py-4">Farmer</th>
                        <th class="px-5 py-4">Quantity</th>
                        <th class="px-5 py-4">Accepted Price</th>
                        <th class="px-5 py-4">Total Amount</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Date</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($orders as $order)

                        @php
                            $statusLower = strtolower($order->order_status);

                            $statusClasses = match ($statusLower) {
                                'pending'
                                    => 'bg-amber-100 text-amber-700',

                                'confirmed'
                                    => 'bg-blue-100 text-blue-700',

                                'ready_for_pickup'
                                    => 'bg-purple-100 text-purple-700',

                                'completed'
                                    => 'bg-emerald-100 text-emerald-700',

                                'cancelled'
                                    => 'bg-red-100 text-red-700',

                                default
                                    => 'bg-slate-100 text-slate-700',
                            };

                            $statusLabel = match ($statusLower) {
                                'ready_for_pickup' => 'Ready for Pickup',
                                default => ucfirst($statusLower),
                            };
                        @endphp

                        <tr class="transition hover:bg-slate-50/70">

                            <td class="px-5 py-5">
                                <span class="font-bold text-slate-900">
                                    #{{ str_pad($order->order_id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <td class="px-5 py-5">

                                <p class="font-semibold text-slate-900">
                                    {{ $order->product?->product_name ?? 'Unavailable Product' }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $order->product?->category ?? 'N/A' }}
                                </p>

                            </td>

                            <td class="px-5 py-5">

                                <p class="font-medium text-slate-800">
                                    {{ $order->buyer?->name ?? 'Unknown Buyer' }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $order->buyer?->email ?? 'N/A' }}
                                </p>

                            </td>

                            <td class="px-5 py-5">

                                <p class="font-medium text-slate-800">
                                    {{ $order->farmer?->name ?? 'Unknown Farmer' }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $order->farmer?->email ?? 'N/A' }}
                                </p>

                            </td>

                            <td class="px-5 py-5 font-medium whitespace-nowrap text-slate-700">
                                {{ number_format((float) $order->quantity, 2) }} kg
                            </td>

                            <td class="px-5 py-5 font-semibold whitespace-nowrap text-emerald-700">
                                Rs. {{ number_format((float) $order->accepted_price, 2) }}
                            </td>

                            <td class="px-5 py-5 font-bold whitespace-nowrap text-slate-900">
                                Rs. {{ number_format((float) $order->total_amount, 2) }}
                            </td>

                            <td class="px-5 py-5">

                                <span class="inline-flex px-3 py-1.5 text-sm font-semibold rounded-full whitespace-nowrap {{ $statusClasses }}">
                                    {{ $statusLabel }}
                                </span>

                            </td>

                            <td class="px-5 py-5 whitespace-nowrap">

                                <p class="font-medium text-slate-700">
                                    {{ $order->created_at->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $order->created_at->format('h:i A') }}
                                </p>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="px-6 py-16 text-center">

                                <h3 class="text-lg font-bold text-slate-900">
                                    No orders found
                                </h3>

                                <p class="mt-2 text-slate-500">
                                    No order records match the selected filters.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Mobile Cards --}}
        <div class="divide-y divide-slate-200 lg:hidden">

            @forelse($orders as $order)

                @php
                    $statusLower = strtolower($order->order_status);

                    $mobileStatusClasses = match ($statusLower) {
                        'pending'
                            => 'bg-amber-100 text-amber-700',

                        'confirmed'
                            => 'bg-blue-100 text-blue-700',

                        'ready_for_pickup'
                            => 'bg-purple-100 text-purple-700',

                        'completed'
                            => 'bg-emerald-100 text-emerald-700',

                        'cancelled'
                            => 'bg-red-100 text-red-700',

                        default
                            => 'bg-slate-100 text-slate-700',
                    };

                    $mobileStatusLabel = $statusLower === 'ready_for_pickup'
                        ? 'Ready for Pickup'
                        : ucfirst($statusLower);
                @endphp

                <article class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div>
                            <p class="text-sm font-semibold text-slate-500">
                                Order
                                #{{ str_pad($order->order_id, 4, '0', STR_PAD_LEFT) }}
                            </p>

                            <h3 class="mt-1 text-lg font-bold text-slate-900">
                                {{ $order->product?->product_name ?? 'Unavailable Product' }}
                            </h3>
                        </div>

                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $mobileStatusClasses }}">
                            {{ $mobileStatusLabel }}
                        </span>

                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-5 text-sm">

                        <div>
                            <p class="text-slate-500">Buyer</p>

                            <p class="mt-1 font-semibold text-slate-800">
                                {{ $order->buyer?->name ?? 'Unknown' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-slate-500">Farmer</p>

                            <p class="mt-1 font-semibold text-slate-800">
                                {{ $order->farmer?->name ?? 'Unknown' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-slate-500">Quantity</p>

                            <p class="mt-1 font-semibold text-slate-800">
                                {{ number_format((float) $order->quantity, 2) }} kg
                            </p>
                        </div>

                        <div>
                            <p class="text-slate-500">Accepted Price</p>

                            <p class="mt-1 font-semibold text-emerald-700">
                                Rs. {{ number_format((float) $order->accepted_price, 2) }}
                            </p>
                        </div>

                    </div>

                    <div class="flex items-end justify-between gap-4 pt-4 mt-5 border-t border-slate-100">

                        <div>
                            <p class="text-xs text-slate-500">
                                Total Amount
                            </p>

                            <p class="mt-1 text-lg font-bold text-slate-900">
                                Rs. {{ number_format((float) $order->total_amount, 2) }}
                            </p>
                        </div>

                        <p class="text-sm text-slate-500">
                            {{ $order->created_at->format('d M Y') }}
                        </p>

                    </div>

                </article>

            @empty

                <div class="px-5 py-14 text-center">

                    <h3 class="font-bold text-slate-900">
                        No orders found
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        No order records match the selected filters.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- Pagination --}}
        @if($orders->hasPages())

            <div class="px-4 py-4 border-t border-slate-200 sm:px-6">
                {{ $orders->links() }}
            </div>

        @endif

    </div>

</div>

@endsection