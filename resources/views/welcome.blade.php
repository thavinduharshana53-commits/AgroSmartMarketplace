<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>AgroSmart Marketplace</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F8F5EC] text-gray-800">

    <!-- NAVBAR -->
    {{-- Mobile Responsive: Controls the mobile navigation menu --}}
    <nav
        x-data="{ mobileMenuOpen: false }"
        class="relative z-50 bg-white shadow-sm">

        {{-- Mobile Responsive: Adds horizontal padding on smaller screens --}}
        <div class="flex items-center justify-between px-4 py-3 mx-auto sm:px-6 sm:py-4 max-w-7xl">

            <div class="flex items-center gap-2 sm:gap-3">

                {{-- Mobile Responsive: Smaller logo on mobile --}}
                <img
                    src="/image/logo.png"
                    alt="AgroSmart Logo"
                    class="object-contain w-11 h-11 sm:w-14 sm:h-14">

                <div>
                    {{-- Mobile Responsive: Smaller brand name on mobile --}}
                    <h1 class="text-xl font-bold text-green-700 sm:text-3xl">
                        AgroSmart
                    </h1>

                    <p class="text-[10px] sm:text-sm tracking-widest">
                        MARKETPLACE
                    </p>
                </div>

            </div>

            {{-- Mobile Responsive: Desktop navigation is only shown on large screens --}}
            <div class="items-center hidden gap-8 font-medium lg:flex">

                <a href="#" class="hover:text-green-700">
                    Home
                </a>

                <a href="#how-it-works" class="hover:text-green-700">
                    How It Works
                </a>

                <a href="#why" class="hover:text-green-700">
                    About
                </a>

                <a href="#c" class="hover:text-green-700">
                    Contact
                </a>

            </div>

            {{-- Mobile Responsive: Authentication buttons are hidden inside mobile menu --}}
            <div class="items-center hidden gap-3 lg:flex">

                <a
                    href="/login"
                    class="px-5 py-2 border border-green-700 rounded-lg hover:bg-green-50">

                    Log In

                </a>

                <a
                    href="/register"
                    class="px-5 py-2 text-white bg-green-700 rounded-lg hover:bg-green-800">

                    Create Account

                </a>

            </div>

            {{-- Mobile Responsive: Mobile hamburger button --}}
            <button
                type="button"
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="flex items-center justify-center w-10 h-10 text-green-800 border border-green-200 rounded-lg lg:hidden">

                <svg
                    x-show="!mobileMenuOpen"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round" d="M4 6h16"/>
                    <path stroke-linecap="round" d="M4 12h16"/>
                    <path stroke-linecap="round" d="M4 18h16"/>
                </svg>

                <svg
                    x-cloak
                    x-show="mobileMenuOpen"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>

        {{-- Mobile Responsive: Dropdown navigation for mobile --}}
        <div
            x-cloak
            x-show="mobileMenuOpen"
            x-transition
            @click.away="mobileMenuOpen = false"
            class="absolute left-0 right-0 px-4 pb-5 bg-white border-t border-gray-100 shadow-lg lg:hidden">

            <div class="flex flex-col gap-1 pt-3">

                <a
                    href="#"
                    @click="mobileMenuOpen = false"
                    class="px-4 py-3 font-medium rounded-lg hover:bg-green-50 hover:text-green-700">

                    Home

                </a>

                <a
                    href="#how-it-works"
                    @click="mobileMenuOpen = false"
                    class="px-4 py-3 font-medium rounded-lg hover:bg-green-50 hover:text-green-700">

                    How It Works

                </a>

                <a
                    href="#why"
                    @click="mobileMenuOpen = false"
                    class="px-4 py-3 font-medium rounded-lg hover:bg-green-50 hover:text-green-700">

                    About

                </a>

                <a
                    href="#c"
                    @click="mobileMenuOpen = false"
                    class="px-4 py-3 font-medium rounded-lg hover:bg-green-50 hover:text-green-700">

                    Contact

                </a>

            </div>

            <div class="grid grid-cols-2 gap-3 pt-4 mt-3 border-t border-gray-100">

                <a
                    href="/login"
                    class="px-4 py-2.5 font-semibold text-center text-green-700 border border-green-700 rounded-lg hover:bg-green-50">

                    Log In

                </a>

                <a
                    href="/register"
                    class="px-4 py-2.5 font-semibold text-center text-white bg-green-700 rounded-lg hover:bg-green-800">

                    Create Account

                </a>

            </div>

        </div>

    </nav>

    <!-- HERO SECTION -->
    {{-- Mobile Responsive: Smaller minimum height on mobile --}}
    <section class="relative min-h-[650px] overflow-hidden sm:min-h-screen">

        <img
            src="image/products/hero-farmer.png"
            alt="Sri Lankan Farmer"
            class="absolute inset-0 object-cover w-full h-full">

        <div class="absolute inset-0">

            {{-- Mobile Responsive: Stronger full-width overlay on mobile --}}
            <div class="w-full md:w-[55%] h-full bg-gradient-to-r from-white/95 via-white/90 md:via-white/88 to-white/40 md:to-transparent">
            </div>

        </div>

        {{-- Mobile Responsive: Responsive hero padding --}}
        <div class="relative z-10 px-4 mx-auto pt-16 sm:px-6 sm:pt-20 lg:pt-[50px] max-w-7xl">

            <div class="max-w-2xl mt-8 ">

                {{-- Mobile Responsive: Smaller hero heading on mobile --}}
                <div class="text-2xl font-bold text-green-950 sm:text-4xl lg:text-5xl">

                    Fresh Agricultural Products Directly from

                    <span class="text-green-600">
                        Sri Lankan Farmers
                    </span>

                </div>

                {{-- Mobile Responsive: Smaller paragraph and hidden manual break on mobile --}}
                <p class="mt-5 text-base leading-relaxed text-gray-700 sm:mt-6 sm:text-lg lg:text-xl">

                    Connect buyers and farmers through a smart digital marketplace

                    <br class="hidden sm:block">

                    with fair pricing, demand insights and direct product offers.

                </p>

                {{-- Mobile Responsive: Hero buttons stack vertically on mobile --}}
                <div class="flex flex-col gap-3 mt-8 sm:flex-row sm:gap-4 sm:mt-12 lg:mt-14">

                    <a
                        href="#"
                        class="w-full px-6 py-3 font-semibold text-center text-white bg-green-700 sm:w-auto sm:px-8 sm:py-4 hover:bg-green-800 rounded-xl">

                        Browse Products

                    </a>

                    <a
                        href="/login"
                        class="w-full px-6 py-3 font-semibold text-center text-green-700 bg-white border border-green-700 sm:w-auto sm:px-8 sm:py-4 rounded-xl">

                        Become a Farmer Seller

                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- HOW IT WORKS -->
    {{-- Mobile Responsive: Smaller section padding on mobile --}}
    <section
        class="py-14 sm:py-20 bg-[#F8F5EC] overflow-hidden"
        id="how-it-works">

        <div class="px-4 mx-auto sm:px-6 max-w-7xl">

            <div class="text-center">

                {{-- Mobile Responsive: Smaller section heading on mobile --}}
                <h2 class="text-3xl font-bold text-center text-green-700 sm:text-4xl">
                    How It Works
                </h2>

                <div class="flex items-center justify-center gap-3 mt-3">
                    <div class="w-12 sm:w-14 h-[2px] bg-green-700"></div>
                    <span class="text-lg text-green-700">🌿</span>
                    <div class="w-12 sm:w-14 h-[2px] bg-green-700"></div>
                </div>

            </div>

            {{-- Mobile Responsive: Cards stack on mobile and form three columns on desktop --}}
            <div class="grid grid-cols-1 gap-5 mt-10 lg:grid-cols-3 lg:mt-14">

                <!-- CARD 1 -->
                <div class="bg-[#FFF8EE] border border-[#EFE2CC] rounded-3xl px-4 py-5 sm:px-6 sm:py-3 shadow-sm flex flex-col sm:flex-row items-center min-h-[170px] hover:shadow-lg duration-300">

                    <div class="shrink-0">
                        {{-- Mobile Responsive: Smaller card image on mobile --}}
                        <img
                            src="/image/products/farmer.png"
                            alt="Farmer"
                            class="object-contain w-32 h-32 sm:w-40 sm:h-40">
                    </div>

                    <div class="flex-1 text-center sm:text-left">

                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-3 text-base font-bold text-white bg-green-700 rounded-full sm:w-12 sm:h-12 sm:mx-0 sm:mb-4 sm:text-lg">
                            01
                        </div>

                        <h3 class="text-lg font-bold leading-snug text-gray-900 sm:text-xl">
                            Farmers Publish Products
                        </h3>

                        <p class="mt-2 text-sm leading-relaxed text-gray-600 sm:mt-3">
                            Farmers add their products, prices and available quantities.
                        </p>

                    </div>

                </div>

                <!-- CARD 2 -->
                <div class="bg-[#FFF8EE] border border-[#EFE2CC] rounded-3xl px-4 py-5 sm:px-6 sm:py-3 shadow-sm flex flex-col sm:flex-row items-center min-h-[170px] hover:shadow-lg duration-300">

                    <div class="shrink-0">
                        <img
                            src="/image/products/buyer.png"
                            alt="Buyer"
                            class="object-contain w-32 h-32 sm:w-40 sm:h-40">
                    </div>

                    <div class="flex-1 text-center sm:text-left">

                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-3 text-base font-bold text-white bg-green-700 rounded-full sm:w-12 sm:h-12 sm:mx-0 sm:mb-4 sm:text-lg">
                            02
                        </div>

                        <h3 class="text-lg font-bold leading-snug text-gray-900 sm:text-xl">
                            Buyers Submit Offers
                        </h3>

                        <p class="mt-2 text-sm leading-relaxed text-gray-600 sm:mt-3">
                            Buyers browse products and submit their best offers.
                        </p>

                    </div>

                </div>

                <!-- CARD 3 -->
                <div class="bg-[#FFF8EE] border border-[#EFE2CC] rounded-3xl px-4 py-5 sm:px-6 sm:py-3 shadow-sm flex flex-col sm:flex-row items-center min-h-[170px] hover:shadow-lg duration-300">

                    <div class="shrink-0">
                        <img
                            src="/image/products/deal.png"
                            alt="Marketplace Deal"
                            class="object-contain w-32 h-32 sm:w-40 sm:h-40">
                    </div>

                    <div class="flex-1 text-center sm:text-left">

                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-3 text-base font-bold text-white bg-green-700 rounded-full sm:w-12 sm:h-12 sm:mx-0 sm:mb-4 sm:text-lg">
                            03
                        </div>

                        <h3 class="text-lg font-bold leading-snug text-gray-900 sm:text-xl">
                            Smart Marketplace
                        </h3>

                        <p class="mt-2 text-sm leading-relaxed text-gray-600 sm:mt-3">
                            Farmers review offers and close deals. Everyone wins!
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CATEGORIES -->
    {{-- Mobile Responsive: Smaller section padding on mobile --}}
    <section class="pb-16 sm:pb-24">

        <div class="px-4 mx-auto sm:px-6 max-w-7xl">

            <h2 class="text-3xl font-bold text-center text-green-700 sm:text-4xl">
                Explore Categories
            </h2>

            <div class="flex items-center justify-center gap-3 mt-3">
                <div class="w-12 sm:w-14 h-[2px] bg-green-700"></div>
                <span class="text-lg text-green-700">🌿</span>
                <div class="w-12 sm:w-14 h-[2px] bg-green-700"></div>
            </div>

            {{-- Mobile Responsive: One, two and five column responsive category grid --}}
            <div class="grid grid-cols-1 gap-5 mt-10 sm:grid-cols-2 sm:mt-14 lg:grid-cols-5 lg:mt-16 lg:gap-6">

                <div class="overflow-hidden bg-white shadow-sm rounded-2xl">
                    <img src="image/products/v.jpeg" alt="Vegetables" class="object-cover w-full h-48">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">Vegetables</h3>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm rounded-2xl">
                    <img src="image/products/f.png" alt="Fruits" class="object-cover w-full h-48">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">Fruits</h3>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm rounded-2xl">
                    <img src="image/products/r.jpeg" alt="Rice and Grains" class="object-cover w-full h-48">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">Rice & Grains</h3>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm rounded-2xl">
                    <img src="image/products/s.png" alt="Spices" class="object-cover w-full h-48">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">Spices</h3>
                    </div>
                </div>

                <div class="overflow-hidden bg-white shadow-sm rounded-2xl sm:col-span-2 lg:col-span-1">
                    <img src="image/products/l.jpeg" alt="Leafy Vegetables" class="object-cover w-full h-48">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">Leafy Vegetables</h3>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- WHY AGROSMART -->
    <section class="bg-[#F8F5EC]" id="why">

        <div class="px-4 mx-auto sm:px-6 max-w-7xl">

            <div class="text-center">

                <h2 class="text-3xl font-bold text-center text-green-700 sm:text-4xl">
                    Why AgroSmart?
                </h2>

                <div class="flex items-center justify-center gap-2 mt-2">
                    <div class="w-10 h-[2px] bg-green-700"></div>
                    <span class="text-green-700">🌿</span>
                    <div class="w-10 h-[2px] bg-green-700"></div>
                </div>

            </div>

            {{-- Mobile Responsive: Features stack on mobile and form five columns on desktop --}}
            <div class="grid grid-cols-1 mt-10 mb-10 bg-[#FFF8EE] border border-[#EFE2CC] rounded-2xl shadow-sm sm:grid-cols-2 xl:grid-cols-5">

                <div class="flex items-start gap-3 p-5 sm:p-6 border-b sm:border-r xl:border-b-0 border-[#EFE2CC]">
                    <svg class="w-8 h-8 mt-1 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-6 0v4m6 0H7"/>
                    </svg>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Direct Connection</h3>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600">No middlemen, connect directly with farmers.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-5 sm:p-6 border-b xl:border-b-0 xl:border-r border-[#EFE2CC]">
                    <svg class="w-8 h-8 mt-1 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5a2 2 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Better Prices</h3>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600">Fair prices for both farmers and buyers.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-5 sm:p-6 border-b sm:border-r xl:border-b-0 border-[#EFE2CC]">
                    <svg class="w-8 h-8 mt-1 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Easy Search</h3>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600">Find the right products quickly and easily.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-5 sm:p-6 border-b xl:border-b-0 xl:border-r border-[#EFE2CC]">
                    <svg class="w-8 h-8 mt-1 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-4 4 4 6-6"/>
                    </svg>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Demand Insights</h3>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600">Smart data to help you make better decisions.</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-5 sm:p-6 sm:col-span-2 xl:col-span-1">
                    <svg class="w-8 h-8 mt-1 text-green-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 4v5c0 5-3.5 9-7 10-3.5-1-7-5-7-10V7l7-4z"/>
                    </svg>
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Secure & Trusted</h3>
                        <p class="mt-1 text-sm leading-relaxed text-gray-600">Safe transactions and trusted marketplace.</p>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- FARMER CTA SECTION -->
    <section class="bg-[#E8F0DD]">

        <div class="mx-auto max-w-7xl">

            {{-- Mobile Responsive: CTA sections stack on mobile --}}
            <div class="grid items-center grid-cols-1 py-8 md:grid-cols-3 md:py-0">

                <div class="bg-[#E8F0DD] flex items-center justify-center">
                    <img
                        src="/image/products/pp.png"
                        alt="Farmer"
                        class="w-full h-[160px] sm:h-[180px] object-contain">
                </div>

                <div class="px-5 text-center sm:px-8">

                    <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                        Are you a Farmer?
                    </h2>

                    <p class="mt-4 text-base leading-relaxed text-gray-700 sm:text-lg">
                        Join AgroSmart Marketplace and reach thousands
                        of buyers. Grow your business with us.
                    </p>

                </div>

                {{-- Mobile Responsive: Adds spacing above CTA button on mobile --}}
                <div class="px-4 mt-6 text-center md:px-0 md:mt-0">

                    <a
                        href="/register"
                        class="inline-flex items-center justify-center w-full gap-3 px-6 py-3 text-base font-semibold text-white duration-300 bg-green-700 shadow-md sm:w-auto sm:px-8 sm:py-4 sm:text-lg hover:bg-green-800 rounded-xl">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16
                                c2.5 0 4.847.655 6.879 1.804M15 11
                                a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>

                        Register as a Farmer

                    </a>

                    <p class="mt-4 text-gray-700">
                        It’s free and easy!
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    {{-- Mobile Responsive: Smaller footer padding on mobile --}}
    <footer class="bg-gradient-to-r from-[#014d1f] to-[#016b2d] text-white pt-10 sm:pt-14 pb-6">

        <div class="px-4 mx-auto sm:px-6 max-w-7xl">

            {{-- Mobile Responsive: Responsive footer columns --}}
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-5">

                <div class="sm:col-span-2 lg:col-span-1">

                    <div class="flex items-center gap-3">

                        <img
                            src="/image/products/v.png"
                            alt="AgroSmart Logo"
                            class="w-14">

                        <div>
                            <h2 class="text-2xl font-bold sm:text-3xl">
                                AgroSmart
                            </h2>

                            <p class="text-xs sm:text-sm tracking-[4px] text-gray-200">
                                MARKETPLACE
                            </p>
                        </div>

                    </div>

                    <p class="mt-6 leading-relaxed text-gray-200">
                        Empowering Sri Lankan farmers and connecting them
                        with buyers for a better tomorrow.
                    </p>

                    <div class="flex gap-4 mt-6">

                        <a href="#" class="flex items-center justify-center duration-300 border rounded-full w-11 h-11 border-white/40 hover:bg-white hover:text-green-700">
                            <span class="font-bold">f</span>
                        </a>

                        <a href="#" class="flex items-center justify-center duration-300 border rounded-full w-11 h-11 border-white/40 hover:bg-white hover:text-green-700">
                            <span class="font-bold">◎</span>
                        </a>

                        <a href="#" class="flex items-center justify-center duration-300 border rounded-full w-11 h-11 border-white/40 hover:bg-white hover:text-green-700">
                            <span class="font-bold">◉</span>
                        </a>

                    </div>

                </div>

                <div>
                    <h3 class="mb-5 text-lg font-bold sm:text-xl">QUICK LINKS</h3>
                    <ul class="space-y-3 text-gray-200">
                        <li><a href="#how-it-works" class="hover:text-white">How It Works</a></li>
                        <li><a href="#why" class="hover:text-white">About Us</a></li>
                        <li><a href="#c" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">FAQs</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="mb-5 text-lg font-bold sm:text-xl">FOR FARMERS</h3>
                    <ul class="space-y-3 text-gray-200">
                        <li>Farmer Registration</li>
                        <li>Add Products</li>
                        <li>My Products</li>
                        <li>My Offers</li>
                    </ul>
                </div>

                <div>
                    <h3 class="mb-5 text-lg font-bold sm:text-xl">FOR BUYERS</h3>
                    <ul class="space-y-3 text-gray-200">
                        <li>Buyer Registration</li>
                        <li>Browse Products</li>
                        <li>My Offers</li>
                        <li>Add Review & Feedback</li>
                    </ul>
                </div>

                <div id="c">

                    <h3 class="mb-5 text-lg font-bold sm:text-xl">
                        CONTACT US
                    </h3>

                    <div class="space-y-5 text-gray-200">

                        <div class="flex gap-3">
                            <span>📞</span>
                            <p>+94 75 202 5500</p>
                        </div>

                        <div class="flex gap-3">
                            <span>✉️</span>
                            <p class="break-all">agrosmart@gmail.com</p>
                        </div>

                        <div class="flex gap-3">
                            <span>📍</span>
                            <p>
                                No. 123, Kandy Road,
                                Mawathagama, Sri Lanka
                            </p>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Mobile Responsive: Footer bottom content stacks on mobile --}}
            <div class="flex flex-col items-center justify-between gap-4 pt-6 mt-10 text-sm text-center text-gray-200 border-t md:flex-row md:text-left border-white/20">

                <p>
                    © 2026 AgroSmart Marketplace. All rights reserved.
                </p>

                <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                    <a href="#" class="hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-white">Terms & Conditions</a>
                </div>

            </div>

        </div>

    </footer>

</body>

</html>