@extends('layouts.admin')

@section('content')

<div 
    x-data="{
        removeModal: false,
        removeProductName: '',
        removeAction: '',

        openRemove(name, action) {
            this.removeProductName = name;
            this.removeAction = action;
            this.removeModal = true;

            this.$nextTick(() => {
                this.$refs.removalReason?.focus();
            });
        },

        closeRemove() {
            this.removeModal = false;
            this.removeProductName = '';
            this.removeAction = '';

            if (this.$refs.removalReason) {
                this.$refs.removalReason.value = '';
            }
        }
    }"
    class="space-y-6">

    {{-- Page Heading --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                Product Management
            </h1>

            <p class="mt-2 text-sm text-slate-500 sm:text-base">
                Monitor and manage agricultural product listings.
            </p>
        </div>

        <div class="inline-flex self-start px-4 py-2 text-sm font-semibold
                    text-emerald-700 border border-emerald-200
                    bg-emerald-50 rounded-xl">

            {{ number_format($products->total()) }} products found

        </div>

    </div>

    {{-- Search and Filters --}}
    <section class="p-4 bg-white border shadow-sm border-slate-200
                    rounded-2xl sm:p-5">

        <form
            action="{{ route('admin.productManage') }}"
            method="GET"
            class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-12 xl:items-end">

            {{-- Search --}}
            <div class="xl:col-span-4">

                <label
                    for="productSearch"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Search Products

                </label>

                <div class="relative">

                    <svg
                        class="absolute w-5 h-5 -translate-y-1/2
                               pointer-events-none left-4 top-1/2 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <circle cx="11" cy="11" r="7"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M20 20l-3.5-3.5"/>
                    </svg>

                    <input
                        id="productSearch"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Product, farmer or location..."
                        class="w-full h-12 pl-12 pr-4 bg-white border
                               border-slate-300 rounded-xl
                               focus:border-emerald-500
                               focus:ring-2 focus:ring-emerald-100">

                </div>

            </div>

            {{-- Availability --}}
            <div class="xl:col-span-2">

                <label
                    for="availabilityFilter"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Availability

                </label>

                <select
                    id="availabilityFilter"
                    name="availability"
                    class="w-full h-12 px-4 bg-white border
                           border-slate-300 rounded-xl
                           focus:border-emerald-500
                           focus:ring-2 focus:ring-emerald-100">

                    <option value="">
                        All Statuses
                    </option>

                    @foreach($availabilityOptions as $option)

                        <option
                            value="{{ $option }}"
                            @selected($availability === $option)>

                            {{ $option }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Demand --}}
            <div class="xl:col-span-2">

                <label
                    for="demandFilter"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Demand Level

                </label>

                <select
                    id="demandFilter"
                    name="demand"
                    class="w-full h-12 px-4 bg-white border
                           border-slate-300 rounded-xl
                           focus:border-emerald-500
                           focus:ring-2 focus:ring-emerald-100">

                    <option value="">
                        All Demand
                    </option>

                    <option
                        value="High Demand"
                        @selected($demand === 'High Demand')>

                        High Demand

                    </option>

                    <option
                        value="Low Demand"
                        @selected($demand === 'Low Demand')>

                        Low Demand

                    </option>

                </select>

            </div>

            {{-- Moderation --}}
            <div class="xl:col-span-2">

                <label
                    for="moderationFilter"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Listing Status

                </label>

                <select
                    id="moderationFilter"
                    name="moderation"
                    class="w-full h-12 px-4 bg-white border
                           border-slate-300 rounded-xl
                           focus:border-emerald-500
                           focus:ring-2 focus:ring-emerald-100">

                    <option value="">
                        All Listings
                    </option>

                    <option
                        value="active"
                        @selected($moderation === 'active')>

                        Active

                    </option>

                    <option
                        value="removed"
                        @selected($moderation === 'removed')>

                        Removed

                    </option>

                </select>

            </div>

            {{-- Filter Actions --}}
            <div class="flex gap-3 md:col-span-2 xl:col-span-2">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center flex-1
                           h-12 px-5 font-semibold text-white
                           bg-emerald-600 rounded-xl hover:bg-emerald-700">

                    Apply

                </button>

                @if(
                    $search !== '' ||
                    $availability !== '' ||
                    $moderation !== '' ||
                    $demand !== ''
                )

                    <a
                        href="{{ route('admin.productManage') }}"
                        class="inline-flex items-center justify-center h-12
                               px-5 font-semibold border border-slate-300
                               text-slate-700 rounded-xl hover:bg-slate-50">

                        Clear

                    </a>

                @endif

            </div>

        </form>

    </section>

    {{-- Desktop Table --}}
    <section class="hidden overflow-hidden bg-white border shadow-sm
                    border-slate-200 rounded-2xl lg:block">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-slate-50">

                    <tr class="text-base font-semibold text-slate-600">

                        <th class="px-5 py-4">
                            Product
                        </th>

                        <th class="px-5 py-4">
                            Farmer
                        </th>

                        <th class="px-5 py-4">
                            Price & Total Quantity
                        </th>

                        <th class="px-5 py-4">
                            Location
                        </th>

                        <th class="px-5 py-4">
                            Demand
                        </th>

                        <th class="px-5 py-4">
                            Availability
                        </th>

                        <th class="px-5 py-4">
                            Listing
                        </th>

                        <th class="px-5 py-4 text-right">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($products as $product)

                        @php
                            $availabilityLower = strtolower(
                                trim((string) $product->availability_status)
                            );

                            $isRemoved = strtolower(
                                trim((string) $product->moderation_status)
                            ) === 'removed';

                            $availabilityClass = match ($availabilityLower) {
                                'available' =>
                                    'text-emerald-700 bg-emerald-100',

                                'reserved' =>
                                    'text-violet-700 bg-violet-100',

                                'sold out' =>
                                    'text-red-700 bg-red-100',

                                default =>
                                    'text-amber-700 bg-amber-100',
                            };
                        @endphp

                        <tr class="transition hover:bg-slate-50
                                   {{ $isRemoved ? 'bg-red-50/30' : '' }}">

                            {{-- Product --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-14 h-14 overflow-hidden bg-white
                                                border border-slate-200 rounded-xl shrink-0">

                                        <img
                                            src="{{ $product->product_image
                                                ? asset('storage/'.$product->product_image)
                                                : asset('image/product-placeholder.png') }}"
                                            alt="{{ $product->product_name }}"
                                            class="object-cover w-full h-full">

                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-bold text-lg truncate text-slate-900">
                                            {{ $product->product_name }}
                                        </p>

                                        <p class="mt-1 text-s text-slate-500">
                                            {{ $product->category }}
                                        </p>

                                        <p class="mt-1 text-sm text-slate-400">
                                            ID: {{ $product->product_id }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            {{-- Farmer --}}
                            <td class="px-5 py-4">

                                <p class="font-semibold  text-lg  text-slate-800">
                                    {{ $product->farmer?->name ?? 'Unknown farmer' }}
                                </p>

                                <p class="mt-1 text-s text-slate-500">
                                    {{ $product->farmer?->email ?? 'No email' }}
                                </p>

                            </td>

                            {{-- Price and Quantity --}}
                            <td class="px-5 py-4">

                                <p class="font-bold text-lg text-emerald-700 whitespace-nowrap">
                                    Rs. {{ number_format((float) $product->price, 2) }} / kg
                                </p>

                                <p class="mt-1 text-base text-slate-500 whitespace-nowrap">
                                    {{ number_format((float) $product->quantity, 2) }}
                                    {{ $product->unit ?? 'kg' }}
                                </p>

                            </td>

                            {{-- Location --}}
                            <td class="px-5 py-4  text-lg  text-slate-600">

                                <p>
                                    {{ $product->city }}
                                </p>

                                <p class="mt-1  text-base text-slate-400">
                                    {{ $product->district }}
                                </p>

                            </td>

                            {{-- Demand --}}
                            <td class="px-5 py-4">

                                <span
                                    class="inline-flex px-3 py-2 text-sm
                                           font-semibold rounded-full whitespace-nowrap
                                           {{ $product->demand_level === 'High Demand'
                                                ? 'text-emerald-700 bg-emerald-100'
                                                : 'text-red-700 bg-red-100' }}">

                                    {{ $product->demand_level }}

                                </span>

                            </td>

                            {{-- Availability --}}
                            <td class="px-5 py-4">

                                <span
                                    class="inline-flex px-3 py-2 text-sm
                                           font-semibold rounded-full whitespace-nowrap
                                           {{ $availabilityClass }}">

                                    {{ $product->availability_status }}

                                </span>

                            </td>

                            {{-- Moderation --}}
                            <td class="px-5 py-4">

                                <span
                                    class="inline-flex items-center gap-2 px-3 py-2
                                           text-sm font-semibold rounded-full
                                           {{ $isRemoved
                                                ? 'text-red-700 bg-red-100'
                                                : 'text-emerald-700 bg-emerald-100' }}">

                                    <span
                                        class="w-2 h-2 rounded-full
                                               {{ $isRemoved
                                                    ? 'bg-red-500'
                                                    : 'bg-emerald-500' }}">
                                    </span>

                                    {{ $isRemoved ? 'Removed' : 'Active' }}

                                </span>

                                @if($isRemoved && $product->removal_reason)

                                    <p
                                        title="{{ $product->removal_reason }}"
                                        class="mt-2 text-sm text-red-500">

                                        {{ \Illuminate\Support\Str::limit(
                                            $product->removal_reason,
                                            30
                                        ) }}

                                    </p>

                                @endif

                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4">

                               @if($isRemoved)
                                    <form action="{{ route('admin.productManage.restore',$product) }}" method="POST"
                                        onsubmit="return confirm(
                                            'Are you sure you want to restore this product listing?'
                                        )">

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center
                                                px-4 py-2 text-sm font-semibold
                                                text-emerald-700 transition border
                                                border-emerald-300 rounded-lg
                                                hover:bg-emerald-50">

                                            Restore

                                        </button>

                                    </form>

                                @else

                                    <button
                                        type="button"
                                        data-name="{{ $product->product_name }}"
                                        data-action="{{ route('admin.productManage.remove',$product) }}"
                                        @click="openRemove($el.dataset.name,$el.dataset.action)"
                                        class="inline-flex items-center justify-center
                                            px-4 py-2 text-sm font-semibold
                                            text-red-600 transition border
                                            border-red-300 rounded-lg
                                            hover:bg-red-50">

                                        Remove

                                    </button>

                                @endif
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-6 py-16 text-center">

                                <p class="font-semibold text-slate-600">
                                    No products found
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    Try changing the search or filter options.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    {{-- Mobile Product Cards --}}
    <section class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:hidden">

        @forelse($products as $product)

            @php
                $isRemoved = strtolower(
                    trim((string) $product->moderation_status)
                ) === 'removed';

                $isAvailable = strtolower(
                    trim((string) $product->availability_status)
                ) === 'available';
            @endphp

            <article class="overflow-hidden bg-white border shadow-sm
                            border-slate-200 rounded-2xl">

                <div class="relative h-44 bg-slate-100">

                    <img
                        src="{{ $product->product_image
                            ? asset('storage/'.$product->product_image)
                            : asset('image/product-placeholder.png') }}"
                        alt="{{ $product->product_name }}"
                        class="object-cover w-full h-full">

                    <div class="absolute flex justify-between gap-2
                                top-3 left-3 right-3">

                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full
                                   {{ $product->demand_level === 'High Demand'
                                        ? 'text-white bg-emerald-600'
                                        : 'text-white bg-red-500' }}">

                            {{ $product->demand_level }}

                        </span>

                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full
                                   {{ $isRemoved
                                        ? 'text-white bg-red-600'
                                        : 'text-white bg-slate-800' }}">

                            {{ $isRemoved ? 'Removed' : 'Active Listing' }}

                        </span>

                    </div>

                </div>

                <div class="p-5">

                    <h2 class="text-xl font-bold text-slate-900">
                        {{ $product->product_name }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $product->category }}
                        · by
                        <span class="font-semibold text-slate-700">
                            {{ $product->farmer?->name ?? 'Unknown farmer' }}
                        </span>
                    </p>

                    <p class="mt-3 text-sm text-slate-500">
                        📍 {{ $product->city }}, {{ $product->district }}
                    </p>

                    <div class="grid grid-cols-2 gap-4 pt-4 mt-4
                                border-t border-slate-100">

                        <div>
                            <p class="text-xs font-semibold text-slate-400">
                                Price
                            </p>

                            <p class="mt-1 font-bold text-emerald-700">
                                Rs. {{ number_format((float) $product->price, 2) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-400">
                                Quantity
                            </p>

                            <p class="mt-1 font-bold text-slate-800">
                                {{ number_format((float) $product->quantity, 2) }}
                                {{ $product->unit ?? 'kg' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-400">
                                Availability
                            </p>

                            <p class="mt-1 text-sm font-semibold
                                      {{ $isAvailable
                                            ? 'text-emerald-700'
                                            : 'text-red-600' }}">

                                {{ $product->availability_status }}

                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-slate-400">
                                Published
                            </p>

                            <p class="mt-1 text-sm text-slate-700">
                                {{ $product->created_at?->format('d M Y') }}
                            </p>
                        </div>

                    </div>

                    @if($isRemoved && $product->removal_reason)

                        <div class="p-3 mt-4 text-sm text-red-700
                                    border border-red-200 bg-red-50 rounded-xl">

                            <strong>Removal reason:</strong>

                            {{ $product->removal_reason }}

                        </div>

                    @endif

                    @if($isRemoved)
                        <form
                            action="{{ route('admin.productManage.restore', $product)}}"method="POST"
                             onsubmit="return confirm(
                                'Are you sure you want to restore this product listing?'
                            )">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="w-full px-4 py-3 text-sm font-semibold
                                    text-emerald-700 transition border
                                    border-emerald-300 rounded-xl
                                    hover:bg-emerald-50">

                                Restore Product
                            </button>
                        </form>

                    @else

                        <button
                            type="button"
                            data-name="{{ $product->product_name }}"
                            data-action="{{ route('admin.productManage.remove', $product) }}"
                            @click="openRemove(
                                $el.dataset.name,
                                $el.dataset.action
                            )"
                            class="w-full px-4 py-3 text-sm font-semibold
                                text-red-600 transition border
                                border-red-300 rounded-xl
                                hover:bg-red-50">

                            Remove Product

                        </button>
                    @endif
                </div>

            </article>

        @empty

            <div class="p-10 text-center bg-white border
                        border-slate-200 rounded-2xl md:col-span-2">

                <p class="font-semibold text-slate-600">
                    No products found
                </p>

            </div>

        @endforelse

    </section>

    {{-- Pagination --}}
    @if($products->hasPages())

        <div class="p-4 bg-white border border-slate-200 rounded-2xl">
            {{ $products->links() }}
        </div>

    @endif

     <x-admin.remove-product-modal />

</div>

@endsection