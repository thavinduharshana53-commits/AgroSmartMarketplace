@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                Administrative Activity Logs
            </h1>

            <p class="mt-2 text-sm text-slate-500 sm:text-base">
                Monitor important administrative actions performed within the platform.
            </p>
        </div>

        <div class="inline-flex items-center self-start gap-2 px-4 py-2 text-sm font-semibold text-emerald-700 border border-emerald-200 bg-emerald-50 rounded-xl">

            {{ number_format($activities->total()) }}
            activities found

        </div>

    </div>

    {{-- Search and Filters --}}
    <div class="p-4 bg-white border shadow-sm border-slate-200 rounded-2xl sm:p-5">

        <form
            action="{{ route('admin.systemActivity') }}"
            method="GET"
            class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-12 xl:items-end">

            {{-- Search --}}
            <div class="xl:col-span-4">

                <label
                    for="activitySearch"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Search Activities

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
                        id="activitySearch"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search user, action"
                        class="w-full h-12 pl-12 pr-4 border border-slate-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                </div>

            </div>

            {{-- Module --}}
            <div class="xl:col-span-2">

                <label
                    for="moduleFilter"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Module

                </label>

                <select
                    id="moduleFilter"
                    name="module"
                    class="w-full h-12 px-4 bg-white border border-slate-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                    <option value="">
                        All Modules
                    </option>

                    @foreach($modules as $moduleOption)

                        <option
                            value="{{ $moduleOption }}"
                            @selected($module === $moduleOption)>

                            {{ $moduleOption }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Action --}}
            <div class="xl:col-span-2">

                <label
                    for="actionFilter"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Action

                </label>

                <select
                    id="actionFilter"
                    name="action"
                    class="w-full h-12 px-4 bg-white border border-slate-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

                    <option value="">
                        All Actions
                    </option>

                    @foreach($actions as $actionOption)

                        <option
                            value="{{ $actionOption }}"
                            @selected($action === $actionOption)>

                            {{ $actionOption }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Date --}}
            <div class="xl:col-span-2">

                <label
                    for="dateFilter"
                    class="block mb-2 text-sm font-semibold text-slate-700">

                    Date

                </label>

                <input
                    id="dateFilter"
                    type="date"
                    name="date"
                    value="{{ $date }}"
                    class="w-full h-12 px-4 border border-slate-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">

            </div>

            {{-- Filter Button --}}
            <div class="flex gap-3 md:col-span-2 xl:col-span-2">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center flex-1 h-12 px-5 font-semibold text-white transition bg-emerald-600 rounded-xl hover:bg-emerald-700">

                    Apply

                </button>

                @if(
                    $search !== '' ||
                    $module !== '' ||
                    $action !== '' ||
                    $date !== ''
                )

                    <a
                        href="{{ route('admin.systemActivity') }}"
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

    {{-- Activity Table --}}
    <div class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">

        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto lg:block">

            <table class="w-full text-left">

                <thead class="bg-slate-50">

                    <tr class="text-sm font-semibold text-slate-600">

                        <th class="px-6 py-4">
                            Administrator
                        </th>

                        <th class="px-6 py-4">
                            Module
                        </th>

                        <th class="px-6 py-4">
                            Action
                        </th>

                        <th class="px-6 py-4">
                            Description
                        </th>

                        <th class="px-6 py-4">
                            Date & Time
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($activities as $activity)

                        @php
                            $actionLower = strtolower($activity->action);

                            $actionClasses = match (true) {
                                str_contains($actionLower, 'removed'),
                                str_contains($actionLower, 'blocked')
                                    => 'bg-red-100 text-red-700',

                                str_contains($actionLower, 'restored'),
                                str_contains($actionLower, 'activated')
                                    => 'bg-emerald-100 text-emerald-700',

                                default
                                    => 'bg-blue-100 text-blue-700',
                            };
                        @endphp

                        <tr class="transition hover:bg-slate-50/70">

                            {{-- Administrator --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="flex items-center justify-center w-10 h-10 font-bold uppercase rounded-full text-emerald-700 bg-emerald-100 shrink-0">

                                        {{ strtoupper(substr($activity->user?->name ?? 'S', 0, 1)) }}

                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-semibold truncate text-slate-900">
                                            {{ $activity->user?->name ?? 'System' }}
                                        </p>

                                        <p class="mt-1 text-sm truncate text-slate-500">
                                            {{ $activity->user?->email ?? 'System activity' }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            {{-- Module --}}
                            <td class="px-6 py-5">

                                <span class="font-medium text-slate-700">
                                    {{ $activity->module }}
                                </span>

                            </td>

                            {{-- Action --}}
                            <td class="px-8  py-5">

                                <span class="inline-flex px-3 py-1.5 text-sm font-semibold rounded-full {{ $actionClasses }}">
                                    {{ $activity->action }}
                                </span>

                            </td>

                            {{-- Description --}}
                            <td class="max-w-md px-6 py-5">

                                <p class="text-s leading-6 text-slate-600">
                                    {{ $activity->description }}
                                </p>

                            </td>


                            {{-- Date --}}
                            <td class="px-6 py-5 whitespace-nowrap">

                                <p class="font-medium text-slate-700">
                                    {{ $activity->created_at->format('d M Y') }}
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $activity->created_at->format('h:i A') }}
                                </p>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="flex items-center justify-center w-14 h-14 mx-auto text-slate-400 bg-slate-100 rounded-full">

                                    <svg
                                        class="w-7 h-7"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4 6h16M4 12h16M4 18h10"/>

                                    </svg>

                                </div>

                                <h3 class="mt-4 text-lg font-bold text-slate-900">
                                    No activities found
                                </h3>

                                <p class="mt-2 text-slate-500">
                                    No system activities match the selected filters.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Mobile Activity Cards --}}
        <div class="divide-y divide-slate-200 lg:hidden">

            @forelse($activities as $activity)

                @php
                    $actionLower = strtolower($activity->action);

                    $mobileActionClasses = match (true) {
                        str_contains($actionLower, 'removed'),
                        str_contains($actionLower, 'blocked')
                            => 'bg-red-100 text-red-700',

                        str_contains($actionLower, 'restored'),
                        str_contains($actionLower, 'activated')
                            => 'bg-emerald-100 text-emerald-700',

                        default
                            => 'bg-blue-100 text-blue-700',
                    };
                @endphp

                <article class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div class="flex items-center min-w-0 gap-3">

                            <div class="flex items-center justify-center w-10 h-10 font-bold uppercase rounded-full text-emerald-700 bg-emerald-100 shrink-0">

                                {{ strtoupper(substr($activity->user?->name ?? 'S', 0, 1)) }}

                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold truncate text-slate-900">
                                    {{ $activity->user?->name ?? 'System' }}
                                </p>

                                <p class="text-sm truncate text-slate-500">
                                    {{ $activity->module }}
                                </p>

                            </div>

                        </div>

                        <span class="px-3 py-1 text-xs font-semibold rounded-full shrink-0 {{ $mobileActionClasses }}">
                            {{ $activity->action }}
                        </span>

                    </div>

                    <p class="mt-4 text-sm leading-6 text-slate-600">
                        {{ $activity->description }}
                    </p>

                    <div class="flex flex-wrap items-center justify-between gap-3 pt-4 mt-4 text-xs border-t border-slate-100 text-slate-500">

                        <span class="font-mono">
                            IP: {{ $activity->ip_address ?? 'N/A' }}
                        </span>

                        <span>
                            {{ $activity->created_at->format('d M Y, h:i A') }}
                        </span>

                    </div>

                </article>

            @empty

                <div class="px-5 py-14 text-center">

                    <h3 class="font-bold text-slate-900">
                        No activities found
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        No system activities match the selected filters.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- Pagination --}}
        @if($activities->hasPages())

            <div class="px-4 py-4 border-t border-slate-200 sm:px-6">
                {{ $activities->links() }}
            </div>

        @endif

    </div>

</div>

@endsection