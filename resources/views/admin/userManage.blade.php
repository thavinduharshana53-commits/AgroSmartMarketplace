@extends('layouts.admin')

@section('content')

<div class="space-y-6">

    {{-- Page Heading --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">
                User Management
            </h1>

            <p class="mt-2 text-s text-slate-500 sm:text-base">
                View and manage registered buyers and farmers.
            </p>
        </div>

        <div class="inline-flex self-start px-4 py-2 text-s font-semibold
                    border border-emerald-200 bg-emerald-50
                    text-emerald-700 rounded-xl">

            {{ number_format($users->total()) }} users found

        </div>

    </div>

    {{-- Search and Filters --}}
    <section class="p-4 bg-white border shadow-sm
                    border-slate-200 rounded-2xl sm:p-5">

        <form
            action="{{ route('admin.userManage') }}"
            method="GET"
            class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-12 xl:items-end">

            {{-- Search --}}
            <div class="xl:col-span-5">

                <label
                    for="userSearch"
                    class="block mb-2 text-base font-semibold text-slate-700">

                    Search Users

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
                        id="userSearch"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search name, email or location..."
                        class="w-full h-12 pl-12 pr-4 bg-white
                               border border-slate-300 rounded-xl
                               focus:border-emerald-500
                               focus:ring-2 focus:ring-emerald-100">

                </div>

            </div>

            {{-- Role --}}
            <div class="xl:col-span-2">

                <label
                    for="roleFilter"
                    class="block mb-2 text-base font-semibold text-slate-700">

                    User Role

                </label>

                <select
                    id="roleFilter"
                    name="role"
                    class="w-full h-12 px-4 bg-white border
                           border-slate-300 rounded-xl
                           focus:border-emerald-500
                           focus:ring-2 focus:ring-emerald-100">

                    <option value="">All Roles</option>

                    <option
                        value="buyer"
                        @selected($role === 'buyer')>

                        Buyers

                    </option>

                    <option
                        value="farmer"
                        @selected($role === 'farmer')>

                        Farmers

                    </option>

                </select>

            </div>

            {{-- Status --}}
            <div class="xl:col-span-2">

                <label
                    for="statusFilter"
                    class="block mb-2 text-base font-semibold text-slate-700">

                    Account Status

                </label>

                <select
                    id="statusFilter"
                    name="status"
                    class="w-full h-12 px-4 bg-white border
                           border-slate-300 rounded-xl
                           focus:border-emerald-500
                           focus:ring-2 focus:ring-emerald-100">

                    <option value="">All Statuses</option>

                    <option
                        value="active"
                        @selected($status === 'active')>

                        Active

                    </option>

                    <option
                        value="blocked"
                        @selected($status === 'blocked')>

                        Blocked

                    </option>

                </select>

            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 md:col-span-2 xl:col-span-3">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center
                           flex-1 h-12 px-5 font-semibold text-white
                           bg-emerald-600 rounded-xl
                           hover:bg-emerald-700">

                    Apply Filters

                </button>

                @if($search !== '' || $role !== '' || $status !== '')

                    <a
                        href="{{ route('admin.userManage') }}"
                        class="inline-flex items-center justify-center
                               h-12 px-5 font-semibold border
                               border-slate-300 text-slate-700 rounded-xl
                               hover:bg-slate-50">

                        Clear

                    </a>

                @endif

            </div>

        </form>

    </section>

    {{-- Desktop User Table --}}
    <section class="hidden overflow-hidden bg-white border shadow-sm
                    border-slate-200 rounded-2xl lg:block">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-slate-50">

                    <tr class="text-base font-semibold text-slate-600">

                        <th class="px-6 py-4">
                            User
                        </th>

                        <th class="px-6 py-4">
                            Role
                        </th>

                        <th class="px-6 py-4">
                            Location
                        </th>

                        <th class="px-6 py-4">
                            Contact
                        </th>

                        <th class="px-6 py-4">
                            Registered
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($users as $user)

                        @php
                            $isActive =
                                strtolower($user->account_status)
                                === 'active';
                        @endphp

                        <tr class="transition hover:bg-slate-50">

                            {{-- User --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex items-center justify-center
                                                w-11 h-11 font-bold rounded-full shrink-0
                                                {{ $user->role === 'farmer'
                                                    ? 'text-emerald-700 bg-emerald-100'
                                                    : 'text-blue-700 bg-blue-100' }}">

                                        {{ strtoupper(substr($user->name, 0, 1)) }}

                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-semibold text-lg  text-slate-900">
                                            {{ $user->name }}
                                        </p>

                                        <p class="text-sm text-slate-500">
                                            {{ $user->email }}
                                        </p>

                                    </div>

                                </div>

                            </td>

                            {{-- Role --}}
                            <td class="px-6 py-4">

                                <span class="inline-flex px-3 py-1 text-s
                                             font-semibold capitalize rounded-full
                                             {{ $user->role === 'farmer'
                                                ? 'text-emerald-700 bg-emerald-100'
                                                : 'text-blue-700 bg-blue-100' }}">

                                    {{ $user->role }}

                                </span>

                            </td>

                            {{-- Location --}}
                            <td class="px-6 py-4 text-base text-slate-600">

                                <p>
                                    {{ $user->city ?: 'Not provided' }}
                                </p>

                                <p class="text-s text-slate-400">
                                    {{ $user->district ?: 'No district' }}
                                </p>

                            </td>

                            {{-- Contact --}}
                            <td class="px-6 py-4 text-base text-slate-600">

                                {{ $user->contact_number ?: 'Not provided' }}

                            </td>

                            {{-- Registered Date --}}
                            <td class="px-6 py-4 text-base text-slate-600">

                                {{ $user->created_at?->format('d M Y') }}

                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">

                                <span class="inline-flex items-center gap-2
                                             px-3 py-1 text-sm font-semibold rounded-full
                                             {{ $isActive
                                                ? 'text-emerald-700 bg-emerald-100'
                                                : 'text-red-700 bg-red-100' }}">

                                    <span class="w-2 h-2 rounded-full
                                                 {{ $isActive
                                                    ? 'bg-emerald-500'
                                                    : 'bg-red-500' }}">
                                    </span>

                                    {{ $isActive ? 'Active' : 'Blocked' }}

                                </span>

                            </td>

                            {{-- Action placeholder --}}
                            <td class="px-6 py-4 text-right">

                               <form action="{{ route('admin.userManage.status', $user) }}" method="POST"
                                    onsubmit="return confirm(
                                        '{{ $isActive
                                            ? 'Are you sure you want to block this account?'
                                            : 'Are you sure you want to activate this account?' }}'
                                    )">

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="account_status"
                                        value="{{ $isActive ? 'blocked' : 'active' }}">

                                    <button
                                        type="submit"
                                        class="px-4 py-2 text-sm font-semibold transition border rounded-lg
                                            {{ $isActive
                                                    ? 'text-red-600 border-red-300 hover:bg-red-50'
                                                    : 'text-emerald-700 border-emerald-300 hover:bg-emerald-50' }}">

                                        {{ $isActive ? 'Block' : 'Activate' }}

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="7"
                                class="px-6 py-16 text-center">

                                <p class="font-semibold text-slate-600">
                                    No users found
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    Try changing the current search or filters.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    {{-- Mobile User Cards --}}
    <section class="grid grid-cols-1 gap-4 lg:hidden">

        @forelse($users as $user)

            @php
                $isActive =
                    strtolower($user->account_status)
                    === 'active';
            @endphp

            <article class="p-5 bg-white border shadow-sm
                            border-slate-200 rounded-2xl">

                <div class="flex items-start gap-3">

                    <div class="flex items-center justify-center w-12 h-12
                                font-bold rounded-full shrink-0
                                {{ $user->role === 'farmer'
                                    ? 'text-emerald-700 bg-emerald-100'
                                    : 'text-blue-700 bg-blue-100' }}">

                        {{ strtoupper(substr($user->name, 0, 1)) }}

                    </div>

                    <div class="flex-1 min-w-0">

                        <p class="font-bold truncate text-slate-900">
                            {{ $user->name }}
                        </p>

                        <p class="text-sm truncate text-slate-500">
                            {{ $user->email }}
                        </p>

                    </div>

                    <span class="px-3 py-1 text-xs font-semibold
                                 capitalize rounded-full
                                 {{ $user->role === 'farmer'
                                    ? 'text-emerald-700 bg-emerald-100'
                                    : 'text-blue-700 bg-blue-100' }}">

                        {{ $user->role }}

                    </span>

                </div>

                <dl class="grid grid-cols-2 gap-4 pt-4 mt-4
                           border-t border-slate-100">

                    <div>
                        <dt class="text-xs font-semibold text-slate-400">
                            Location
                        </dt>

                        <dd class="mt-1 text-sm text-slate-700">
                            {{ $user->city ?: 'Not provided' }},
                            {{ $user->district ?: 'No district' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold text-slate-400">
                            Registered
                        </dt>

                        <dd class="mt-1 text-sm text-slate-700">
                            {{ $user->created_at?->format('d M Y') }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold text-slate-400">
                            Contact
                        </dt>

                        <dd class="mt-1 text-sm text-slate-700">
                            {{ $user->contact_number ?: 'Not provided' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold text-slate-400">
                            Status
                        </dt>

                        <dd class="mt-1">

                            <span class="inline-flex px-3 py-1 text-xs
                                         font-semibold rounded-full
                                         {{ $isActive
                                            ? 'text-emerald-700 bg-emerald-100'
                                            : 'text-red-700 bg-red-100' }}">

                                {{ $isActive ? 'Active' : 'Blocked' }}

                            </span>

                        </dd>
                    </div>

                </dl>

                <form action="{{ route('admin.userManage.status', $user) }}" method="POST"
                    class="mt-5"
                    onsubmit="return confirm(
                        '{{ $isActive
                            ? 'Are you sure you want to block this account?'
                            : 'Are you sure you want to activate this account?' }}'
                    )">

                    @csrf
                    @method('PATCH')

                    <input
                        type="hidden"
                        name="account_status"
                        value="{{ $isActive ? 'blocked' : 'active' }}">

                    <button
                        type="submit"
                        class="w-full px-4 py-3 text-sm font-semibold transition border rounded-xl
                            {{ $isActive
                                    ? 'text-red-600 border-red-300 hover:bg-red-50'
                                    : 'text-emerald-700 border-emerald-300 hover:bg-emerald-50' }}">

                        {{ $isActive ? 'Block Account' : 'Activate Account' }}

                    </button>

                </form>

            </article>

        @empty

            <div class="p-10 text-center bg-white border
                        border-slate-200 rounded-2xl">

                <p class="font-semibold text-slate-600">
                    No users found
                </p>

            </div>

        @endforelse

    </section>

    {{-- Pagination --}}
    @if($users->hasPages())

        <div class="p-4 bg-white border border-slate-200 rounded-2xl">
            {{ $users->links() }}
        </div>

    @endif

</div>

@endsection