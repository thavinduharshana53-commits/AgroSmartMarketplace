<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BuyerDashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="m-0 overflow-hidden bg-white text-[#111827]">

     <!-- Mobile Responsive: Controls the mobile sidebar  -->
    <div
        x-data="{ mobileSidebarOpen: false }"
        class="h-screen bg-[#F9FAFB]">

        {{-- Mobile Responsive: Sidebar slides in and out on mobile --}}
        <aside
            :class="mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed top-0 left-0 z-50 flex flex-col w-[242px] h-screen bg-white border-r border-gray-200 transition-transform duration-300 lg:translate-x-0">

            <!-- logo -->
            <div class="flex items-center h-[80px] px-5 pt-4 pb-3 border-b border-gray-100">
                <div class="flex items-center gap-3">

                    <img
                        src="{{ asset('image/logo.png') }}"
                        alt="AgroSmart Logo"
                        class="object-contain w-14 h-14">

                    <div class="leading-tight">
                        <h1 class="text-2xl font-bold text-[#15803D] leading-none">
                            AgroSmart
                        </h1>

                        <p class="mt-1 text-[17px] text-gray-700 leading-none">
                            Marketplace
                        </p>
                    </div>
                </div>
            </div>

            <!-- navigations -->
            <nav class="flex-1 px-5 py-4 space-y-2 overflow-y-auto">

                <a href="{{ route('buyer.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 text-base font-semibold rounded-lg
                    {{ request()->routeIs('buyer.dashboard') ? 'text-white bg-[#1F7A1F]' : 'text-gray-800 hover:bg-green-50 hover:text-[#1F7A1F]' }}">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10v10h14V10"/>
                    </svg>

                    <span>Dashboard</span>
                </a>

                <a href="{{ route('buyer.browseProducts') }}" class="flex items-center gap-3 px-4 py-3 text-base font-semibold rounded-lg
                   {{ request()->routeIs('buyer.browseProducts') ? 'text-white bg-[#1F7A1F]' : 'text-gray-800 hover:bg-green-50 hover:text-[#1F7A1F]' }}">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 7h12a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2Z"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 7V6a3 3 0 0 1 6 0v1"/>
                    </svg>

                    <span>Browse Products</span>
                </a>

                <a href="{{ route('buyer.myOffers') }}" 
                   class="flex items-center gap-3 px-4 py-3 text-base font-semibold rounded-lg
                    {{ request()->routeIs('buyer.myOffers') ? 'text-white bg-[#1F7A1F]' : 'text-gray-800 hover:bg-green-50 hover:text-[#1F7A1F]' }}">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M20.59 13.41 11 3H4v7l9.59 9.59a2 2 0 0 0 2.82 0l4.18-4.18a2 2 0 0 0 0-2.82Z"/>

                        <circle cx="7.5" cy="7.5" r="1"/>
                    </svg>

                    <span>My Offers</span>
                </a>

                <a href="{{ route('buyer.orders') }}"
                    class="flex items-center gap-3 px-4 py-3 text-base font-semibold rounded-lg
                    {{ request()->routeIs('buyer.orders') ? 'text-white bg-[#1F7A1F]' : 'text-gray-800 hover:bg-green-50 hover:text-[#1F7A1F]' }}">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 8.5 12 3 3 8.5l9 5.5 9-5.5Z"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 8.5v7L12 21l9-5.5v-7"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 14v7"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 14 3 8.5"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 14l9-5.5"/>
                    </svg>

                    <span>Orders</span>
                </a>

            </nav>

            <!-- Bottom Promo -->
            <div class="hidden p-5 sm:block">
                <div class="p-4 bg-[#F0F9F1] rounded-xl">

                    <h3 class="text-lg font-bold text-gray-800">
                        Buy Smart, Grow Better
                    </h3>

                    <p class="mt-2 text-base leading-5 text-gray-500">
                        Get the best quality agricultural products from trusted farmers.
                    </p>

                    <div class="mt-3 text-4xl text-right">
                        🌱
                    </div>

                </div>
            </div>

        </aside>

         <!-- Mobile Responsive: Dark overlay displayed behind the sidebar -->
        <div
            x-cloak
            x-show="mobileSidebarOpen"
            x-transition.opacity
            @click="mobileSidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/40 lg:hidden">
        </div>

        <!-- Mobile Responsive: Removes the fixed sidebar margin on mobile -->
        <main class="min-h-screen ml-0 lg:ml-[240px]">

            <!-- Mobile Responsive: Uses smaller padding and gaps on mobile -->
            <header class="h-[80px] px-4 sm:px-6 lg:px-8 bg-white border-b border-gray-200 flex justify-between items-center gap-3">

                <!-- Mobile Responsive: Opens and closes the sidebar -->
                <button type="button"
                    @click="mobileSidebarOpen = !mobileSidebarOpen"
                    class="flex items-center justify-center w-10 h-10 text-gray-700 rounded-lg hover:bg-gray-100 shrink-0">

                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            d="M4 6h16"/>

                        <path
                            stroke-linecap="round"
                            d="M4 12h16"/>

                        <path
                            stroke-linecap="round"
                            d="M4 18h16"/>
                    </svg>

                </button>

            @if(request()->routeIs('buyer.browseProducts'))
            {{-- Mobile Responsive: Search is hidden on small screens --}}
            <form action="{{ route('buyer.browseProducts') }}" method="GET" class="relative w-80">


                {{-- Preserve selected location filters --}}
                @if(request('district'))
                    <input
                        type="hidden"
                        name="district"
                        value="{{ request('district') }}">
                @endif

                @if(request('city'))
                    <input
                        type="hidden"
                        name="city"
                        value="{{ request('city') }}">
                @endif

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search products, crops or farmers..."
                    class="w-full h-12 pl-5 pr-12 text-base bg-[#F9FAFB] border border-gray-200 rounded-lg focus:border-[#1F7A1F] focus:ring-[#1F7A1F]">

                @if(request('search'))

                    {{-- Clear Search --}}
                    <a href="{{ route('buyer.browseProducts') }}" title="Clear search"
                        aria-label="Clear search"
                        class="absolute inset-y-0 right-0 flex items-center justify-center w-12 text-gray-500 hover:text-red-600">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            d="M6 6l12 12M18 6 6 18"/>

                        </svg>
                    </a>
                @else

                    {{-- Submit Search --}}
                    <button type="submit" title="Search" aria-label="Search"
                        class="absolute inset-y-0 right-0 flex items-center justify-center w-12 text-gray-700 hover:text-green-700">

                        <svg
                            class="w-5 h-5"
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

                    </button>

                @endif

            </form>

            @endif

                <!-- Mobile Responsive: Uses smaller gaps on mobile -->
                <div class="flex items-center gap-1 sm:gap-3 lg:gap-4">

                    <!-- Mobile Responsive: Location is hidden on mobile and tablet -->
                    <button type="button"
                        class="items-center hidden gap-3 px-3 py-3 text-base font-semibold text-gray-900 bg-white border border-gray-200 rounded-lg xl:flex">

                        <svg class="w-5 h-5 text-[#1F7A1F]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 21s7-4.35 7-11a7 7 0 1 0-14 0c0 6.65 7 11 7 11Z"/>

                            <circle cx="12" cy="10" r="2.5"/>
                        </svg>

                        <span>
                            {{ Auth::user()->city }}, Sri Lanka
                        </span>

                        <svg class="w-2.5 h-2.5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m6 9 6 6 6-6"/>
                        </svg>

                    </button>

                    <!-- Notification -->
                    <!-- <button type="button"
                        class="relative flex items-center justify-center w-10 h-10 text-gray-900 rounded-full hover:bg-gray-100 shrink-0">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>

                        <span class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-[#1F7A1F] rounded-full -top-1 -right-1">
                            0
                        </span>

                    </button> -->

                    <!-- Profile -->
                    <div
                        x-data="{ open: false }"
                        class="relative">

                        <button type="button"
                            @click="open = !open"
                            class="flex items-center gap-2 px-1 py-2 rounded-lg sm:gap-3 sm:px-2 hover:bg-gray-100">

                            <div class="flex items-center justify-center w-[42px] h-[42px] text-white bg-[#04912F] rounded-full shrink-0">

                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">

                                    <path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5Z"/>

                                    <path d="M4 22c0-4.42 3.58-8 8-8s8 3.58 8 8H4Z"/>
                                </svg>

                            </div>

                            <!-- Mobile Responsive: Profile name is hidden on small screens -->
                            <div class="hidden leading-tight text-left sm:block">
                                <p class="text-lg font-bold text-black">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text- base font-regular text-gray-400">
                                    {{ Auth::user()->role }}
                                </p>
                            </div>

                            <!-- Mobile Responsive: Arrow is hidden on small screens -->
                            <svg class="hidden w-5 h-5 ml-2 text-black sm:block" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m6 9 6 6 6-6"/>
                            </svg>

                        </button>

                        <!-- Dropdown -->
                        <div
                            x-cloak
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute right-0 z-50 mt-3 overflow-hidden bg-white border border-gray-200 shadow-lg w-52 rounded-xl">

                            <!-- <a href="#"
                                class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 hover:bg-gray-50">

                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="8" r="4"/>

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 21a8 8 0 0 1 16 0"/>
                                </svg>

                                Profile
                            </a> -->

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                    class="flex items-center w-full gap-3 px-4 py-3 text-base font-medium text-red-600 hover:bg-red-50">

                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16 17l5-5-5-5"/>

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 12H9"/>
                                    </svg>

                                    Logout
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </header>

            <!-- Mobile Responsive: Uses smaller content padding on mobile -->
            <div class="h-[calc(100vh-80px)] bg-white overflow-y-auto px-3 py-3 sm:px-5 lg:px-8">
                @yield('content')
            </div>

        </main>

    </div>

    @if(session('success'))

        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#1F7A1F',
                timer: 3500,
                showConfirmButton: false
            });
        </script>

    @endif

</body>

</html>