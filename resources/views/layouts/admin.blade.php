<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>AgroSmart Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="m-0 overflow-hidden bg-[#F8FAFC] text-slate-900">

<div
    x-data="{ mobileSidebarOpen: false }"
    class="min-h-screen">

    {{-- Sidebar --}}
    <aside
        :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 flex w-[260px] flex-col
               bg-[#0F172A] text-white shadow-2xl
               transition-transform duration-300 lg:translate-x-0">

        {{-- Logo --}}
        <div class="flex items-center h-[80px] px-5 pt-4 pb-3 border-b border-gray-100">

            <div class="flex items-center gap-3">
                <img
                    src="{{ asset('image/products/v.png') }}"
                    alt="AgroSmart Logo"
                    class="object-contain w-14 h-14">

                <div class="leading-tight">

                    <h1 class="text-2xl font-bold leading-none text-white">
                        AgroSmart
                    </h1>

                    <p class="mt-1 text-sm text-white leading-none">
                        Administration 
                    </p>
                </div>
            </div>

            {{-- Mobile Close Button --}}
            <button
                type="button"
                @click="mobileSidebarOpen = false"
                class="p-2 ml-auto text-slate-300 rounded-lg
                       hover:text-white hover:bg-white/10 lg:hidden">

                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 6l12 12M18 6 6 18"/>
                </svg>

            </button>

        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

            {{-- Dashboard --}}
            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3.5 rounded-xl
                       font-semibold transition
                       {{ request()->routeIs('admin.dashboard')
                            ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-950/30'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>

                Dashboard
            </a>

            {{-- User Management --}}
            <a
                href="{{ route('admin.userManage')}}"
                class="flex items-center gap-3 px-4 py-3.5
                       font-semibold transition rounded-xl
                       {{ request()->routeIs('admin.userManage')
                            ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-950/30'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>

                    <circle cx="9" cy="7" r="4"/>

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 8v6M16 11h6"/>
                </svg>

                User Management
            </a>

            {{-- Product Management --}}
            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3.5
                       font-semibold transition rounded-xl
                       text-slate-300 hover:bg-slate-800 hover:text-white">

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>

                    <path d="m3.3 7 8.7 5 8.7-5M12 22V12"/>
                </svg>

                Product Management
            </a>

            {{-- System Activities --}}
            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3.5
                       font-semibold transition rounded-xl
                       text-slate-300 hover:bg-slate-800 hover:text-white">

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 19V9M10 19V5M16 19v-7M22 19V3"/>
                </svg>

                System Activities
            </a>

            {{-- Reports --}}
            <a
                href="#"
                class="flex items-center gap-3 px-4 py-3.5
                       font-semibold transition rounded-xl
                       text-slate-300 hover:bg-slate-800 hover:text-white">

                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/>

                    <path d="M14 2v6h6M8 13h8M8 17h8M8 9h2"/>
                </svg>

                Reports
            </a>

        </nav>

    </aside>

    {{-- Mobile Sidebar Overlay --}}
    <div
        x-cloak
        x-show="mobileSidebarOpen"
        @click="mobileSidebarOpen = false"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden">
    </div>

    {{-- Main Section --}}
    <main class="min-h-screen transition-all duration-300 lg:ml-[260px]">

        {{-- Header --}}
        <header class="sticky top-0 z-30 flex items-center justify-between
                       h-20 px-4 bg-white border-b border-slate-200
                       sm:px-6 lg:px-8">

            <div class="flex items-center gap-4">

                {{-- Mobile Menu --}}
                <button
                    type="button"
                    @click="mobileSidebarOpen = true"
                    class="p-2 text-slate-600 rounded-lg
                           hover:text-slate-900 hover:bg-slate-100 lg:hidden">

                    <svg
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                </button>

                <div>
                    <h2 class="text-lg font-bold text-slate-900 sm:text-xl">
                        Admin Console
                    </h2>

                    <p class="hidden text-s text-slate-500 sm:block">
                        Manage and monitor the AgroSmart platform
                    </p>
                </div>

            </div>

            <div class="flex items-center gap-3 sm:gap-5">

                {{-- Notification --}}
                <button
                    type="button"
                    class="relative flex items-center justify-center w-11 h-11
                           text-slate-600 border border-slate-200 rounded-xl
                           hover:text-emerald-700 hover:bg-emerald-50">

                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 21h4"/>
                    </svg>

                </button>

                {{-- Profile Dropdown --}}
                <div
                    x-data="{ open: false }"
                    class="relative">

                    <button
                        type="button"
                        @click="open = !open"
                        class="flex items-center gap-3 p-1 rounded-xl
                               hover:bg-slate-100">

                        <div class="flex items-center justify-center w-11 h-11
                                    font-bold text-white bg-[#059669] rounded-xl">

                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                        </div>

                        <div class="hidden text-left sm:block">

                            <p class="text-s font-bold text-slate-900">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-sm font-medium text-slate-500">
                                Administrator
                            </p>

                        </div>

                        <svg
                            class="hidden w-4 h-4 text-slate-500 sm:block"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m6 9 6 6 6-6"/>
                        </svg>

                    </button>

                    {{-- Dropdown --}}
                    <div
                        x-cloak
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 z-50 mt-3 overflow-hidden
                               bg-white border shadow-xl w-56
                               border-slate-200 rounded-xl">


                        <form
                            method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <button
                                type="submit"
                                class="flex items-center w-full gap-3 px-4 py-3
                                       text-base font-semibold text-red-600
                                       hover:bg-red-50">

                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                    <path d="M16 17l5-5-5-5M21 12H9"/>
                                </svg>

                                Logout
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </header>

        {{-- Page Content --}}
        <div class="h-[calc(100vh-80px)] overflow-y-auto
                    bg-[#F8FAFC] p-4 sm:p-6 lg:p-8">

            @yield('content')

        </div>

    </main>

</div>

@if(session('success'))

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: @json(session('success')),
            confirmButtonColor: '#059669',
            timer: 3500,
            showConfirmButton: false
        });
    </script>

@endif

@if(session('error'))

    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: @json(session('error')),
            confirmButtonColor: '#DC2626'
        });
    </script>

@endif

</body>
</html>