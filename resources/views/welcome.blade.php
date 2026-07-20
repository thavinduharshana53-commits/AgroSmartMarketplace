<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="AgroSmart connects Sri Lankan farmers and buyers through smart pricing, location matching and direct wholesale offers.">
    <title>AgroSmart Marketplace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FAFAF7] text-slate-900 antialiased">

    {{-- Navigation --}}
    <nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur">
        <div class="flex items-center justify-between h-20 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <a href="#home" class="flex items-center gap-3">
                <img src="{{ asset('image/logo.png') }}" alt="AgroSmart" class="object-contain w-14 h-14">
                <div>
                    <p class="text-3xl font-extrabold leading-none text-[#16833D]">AgroSmart</p>
                    <p class="mt-1 text-[10px] font-semibold tracking-[0.24em] text-slate-600">MARKETPLACE</p>
                </div>
            </a>

            <div class="items-center hidden gap-8 text-lg font-semibold lg:flex">
                <a href="#home" class="transition hover:text-[#16833D]">Home</a>
                <a href="#workflow" class="transition hover:text-[#16833D]">How It Works</a>
                <a href="#features" class="transition hover:text-[#16833D]">Smart Features</a>
                <a href="#roles" class="transition hover:text-[#16833D]">For You</a>
                <a href="#contact" class="transition hover:text-[#16833D]">Contact</a>
            </div>

            <div class="items-center hidden gap-3 lg:flex">
                <a href="{{ route('login') }}" class="px-5 py-2.5 text-lg font-semibold text-[#16833D] border border-[#16833D] rounded-xl transition hover:bg-green-50">Log In</a>
                <a href="{{ route('register') }}" class="px-5 py-2.5 font-semibold text-lg text-white bg-[#16833D] rounded-xl shadow-sm transition hover:bg-[#106B31]">Create Account</a>
            </div>

            <button type="button" @click="open = !open" aria-label="Toggle navigation" class="grid w-11 h-11 border rounded-xl place-items-center border-slate-200 lg:hidden">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-cloak x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 6l12 12M18 6 6 18"/></svg>
            </button>
        </div>

        <div x-cloak x-show="open" x-transition @click.outside="open = false" class="px-4 pb-5 bg-white border-t border-slate-100 lg:hidden">
            <div class="flex flex-col py-3 font-semibold">
                <a @click="open=false" href="#workflow" class="px-3 py-3 rounded-lg hover:bg-green-50">How It Works</a>
                <a @click="open=false" href="#features" class="px-3 py-3 rounded-lg hover:bg-green-50">Smart Features</a>
                <a @click="open=false" href="#roles" class="px-3 py-3 rounded-lg hover:bg-green-50">For Farmers & Buyers</a>
                <a @click="open=false" href="#contact" class="px-3 py-3 rounded-lg hover:bg-green-50">Contact</a>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('login') }}" class="px-4 py-3 font-semibold text-center text-[#16833D] border border-[#16833D] rounded-xl">Log In</a>
                <a href="{{ route('register') }}" class="px-4 py-3 font-semibold text-center text-white bg-[#16833D] rounded-xl">Create Account</a>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <header id="home" class="relative min-h-[680px] overflow-hidden lg:min-h-[760px]">
        <img src="{{ asset('image/products/hero-farmer.png') }}" alt="Sri Lankan farmer carrying fresh vegetables" class="absolute inset-0 object-cover object-center w-full h-full
          brightness-[0.88] contrast-[1.05] saturate-[1.05]">
        {{-- Desktop: Gradient only covers the text area --}}
        <div  class="absolute inset-0 hidden md:block
           bg-[linear-gradient(90deg,rgba(248,250,252,0.98)_0%,rgba(248,250,252,0.95)_38%,rgba(248,250,252,0.72)_53%,rgba(15,23,42,0.06)_72%,rgba(15,23,42,0.12)_100%)]"></div>
        {{-- Mobile: Light overlay improves text readability --}}
        <div class="absolute inset-0 md:hidden bg-slate-50/85"></div>
        <div class="relative flex items-center min-h-[680px] px-4 mx-auto max-w-7xl sm:px-6 lg:min-h-[760px] lg:px-8">
            <div class="max-w-3xl py-20 sm:-translate-y-6 lg:-translate-y-12">
                <div class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-[#16833D] border border-green-200 rounded-full bg-green-50/90">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                    Sri Lanka's smart agricultural marketplace
                </div>

                <h1 class="mt-7 text-4xl font-extrabold leading-[1.08] tracking-tight text-slate-950 sm:text-5xl lg:text-7xl">
                    Fresh produce.
                    <span class="block text-[#16833D]">Fairer opportunities.</span>
                </h1>

                <p class="max-w-2xl mt-6 text-lg leading-8 text-slate-600 sm:text-xl">
                    Connect directly with trusted farmers, negotiate wholesale offers, <br>discover nearby products and make better decisions using smart market insights.
                </p>

                <div class="flex flex-col gap-3 mt-9 sm:flex-row">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-7 py-4 font-bold text-white bg-[#16833D] rounded-xl shadow-lg shadow-green-900/10 transition hover:-translate-y-0.5 hover:bg-[#106B31]">
                        Start on AgroSmart
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                    <a href="#workflow" class="inline-flex items-center justify-center px-7 py-4 font-bold text-[#16833D] bg-white border border-green-200 rounded-xl transition hover:bg-green-50">See How It Works</a>
                </div>

                <div class="flex flex-wrap gap-x-7 gap-y-3 mt-9 text-s font-semibold text-slate-600">
                    <span class="flex items-center gap-2"><span class="text-green-600">✓</span> Direct farmer connection</span>
                    <span class="flex items-center gap-2"><span class="text-green-600">✓</span> Smart price guidance</span>
                    <span class="flex items-center gap-2"><span class="text-green-600">✓</span> Location-based discovery</span>
                </div>
            </div>
        </div>
    </header>

    {{-- Value strip --}}
    <section class="relative z-10 px-4 -mt-10 sm:px-6 lg:px-8">
        <div class="grid max-w-6xl text-lg grid-cols-2 mx-auto overflow-hidden bg-white border shadow-xl border-slate-200 rounded-2xl lg:grid-cols-4 shadow-slate-900/5">
            @foreach([
                ['Direct Offers', 'Buyers and farmers negotiate fairly'],
                ['Smart Pricing', 'Market-informed price recommendations'],
                ['Nearby Products', 'Discover produce by district and city'],
                ['Order Tracking', 'Follow every order from deal to pickup'],
            ] as [$title, $copy])
                <div class="p-5 border-b border-r sm:p-6 border-slate-100 lg:border-b-0 last:border-r-0">
                    <p class="font-extrabold text-[#16833D]">{{ $title }}</p>
                    <p class="mt-1 text-base leading-6 text-slate-500">{{ $copy }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Workflow --}}
    <section id="workflow" class="px-4 py-24 sm:px-6 lg:px-8 lg:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="max-w-2xl mx-auto text-center">
                <p class="text-sm font-extrabold tracking-[0.18em] text-[#16833D] uppercase">A complete digital journey</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-5xl">From farm listing to completed order</h2>
                <p class="mt-5 text-lg leading-8 text-slate-600">AgroSmart brings product discovery, price negotiation, fulfilment and feedback into one simple workflow.</p>
            </div>

            <div class="grid gap-5 mt-14 md:grid-cols-2 xl:grid-cols-5">
                @php
                    $steps = [
                        ['01', 'Publish', 'Farmers list fresh products, quantity and minimum price.'],
                        ['02', 'Discover', 'Buyers search and filter products by location.'],
                        ['03', 'Negotiate', 'Buyers submit offers and farmers accept, reject or counter.'],
                        ['04', 'Fulfil', 'Orders move through confirmation, pickup and completion.'],
                        ['05', 'Review', 'Buyers review completed orders and build farmer trust.'],
                    ];
                @endphp

                @foreach($steps as [$number, $title, $copy])
                    <article class="relative p-6 bg-white border border-slate-200 rounded-2xl hover:border-green-300 hover:shadow-lg transition">
                        <span class="grid w-12 h-12 text-sm font-extrabold text-white bg-[#16833D] rounded-xl place-items-center">{{ $number }}</span>
                        <h3 class="mt-6 text-xl font-extrabold">{{ $title }}</h3>
                        <p class="mt-3 text-base leading-6 text-slate-600">{{ $copy }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Smart features --}}
    <section id="features" class="px-4 py-24 bg-[#0B2417] text-white sm:px-6 lg:px-8 lg:py-28">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-10 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
                <div>
                    <p class="text-sm font-extrabold tracking-[0.18em] text-green-300 uppercase">Built for smarter trade</p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-5xl">More than a product listing website</h2>
                </div>
                <p class="text-lg leading-8 text-green-50/70">Every feature supports a real decision in the agricultural marketplace—from choosing the right selling price to locating nearby supply and tracking demand.</p>
            </div>

            @php
                $features = [
                    ['Smart Price Recommendations', 'Uses completed-order history, marketplace prices and demand levels to suggest a practical price range.'],
                    ['Demand Analysis', 'Tracks searches, views, offers and completed orders to identify high- and low-demand products.'],
                    ['Location-Based Matching', 'Connects buyers with products available in their preferred district and city.'],
                    ['Offer Negotiation', 'Supports direct acceptance, rejection and counter-offers with transparent pricing.'],
                    ['Order Status Tracking', 'Tracks pending, confirmed, ready-for-pickup, completed and cancelled orders.'],
                    ['Trusted Reviews', 'Allows verified buyers to review completed orders and strengthen farmer credibility.'],
                ];
            @endphp

            <div class="grid gap-5 mt-14 md:grid-cols-2 xl:grid-cols-3">
                @foreach($features as $index => [$title, $copy])
                    <article class="p-7 border bg-white/[0.06] border-white/10 rounded-2xl transition hover:bg-white/[0.1]">
                        <div class="flex items-center justify-between">
                            <span class="grid w-11 h-11 font-extrabold text-green-950 bg-green-300 rounded-xl place-items-center">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <!-- <svg class="w-6 h-6 text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg> -->
                        </div>
                        <h3 class="mt-7 text-xl font-extrabold">{{ $title }}</h3>
                        <p class="mt-3 text-base leading-7 text-green-50/65">{{ $copy }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Role pathways --}}
    <section id="roles" class="px-4 py-24 sm:px-6 lg:px-8 lg:py-32">
        <div class="mx-auto max-w-7xl">
            <div class="max-w-2xl mx-auto text-center">
                <p class="text-sm font-extrabold tracking-[0.18em] text-[#16833D] uppercase">One marketplace, two opportunities</p>
                <h2 class="mt-3 text-3xl font-extrabold sm:text-5xl">Choose how you use AgroSmart</h2>
            </div>

            <div class="grid gap-6 mt-14 lg:grid-cols-2">
                <article class="relative p-8 overflow-hidden text-white bg-[#16833D] rounded-3xl sm:p-10">
                    <div class="relative z-10 max-w-lg">
                        <span class="inline-flex px-3 py-1 text-base font-bold text-green-900 bg-green-200 rounded-full">For Farmers</span>
                        <h3 class="mt-6 text-3xl font-extrabold">Sell with better information and direct buyer access.</h3>
                        <ul class="mt-7 space-y-3 text-lg text-green-50/90">
                            <li>✓ Publish and manage wholesale products</li>
                            <li>✓ Receive smart price recommendations</li>
                            <li>✓ Negotiate and manage buyer offers</li>
                            <li>✓ View demand insights and reviews</li>
                        </ul>
                        <a href="{{ route('register') }}" class="inline-flex px-6 py-3 mt-8 font-bold text-[#16833D] bg-white rounded-xl">Register as a Farmer</a>
                    </div>
                    <div class="absolute w-56 h-56 rounded-full -right-16 -bottom-16 bg-white/10"></div>
                </article>

                <article class="relative p-8 overflow-hidden bg-[#EEF6EA] border border-green-100 rounded-3xl sm:p-10">
                    <div class="relative z-10 max-w-lg">
                        <span class="inline-flex px-3 py-1 text-base font-bold text-[#16833D] bg-white rounded-full">For Buyers</span>
                        <h3 class="mt-6 text-3xl font-extrabold">Find fresh wholesale products and negotiate confidently.</h3>
                        <ul class="mt-7 space-y-3 text-lg  text-slate-700">
                            <li>✓ Search products and nearby farmers</li>
                            <li>✓ Submit and track product offers</li>
                            <li>✓ Accept or reject farmer counter-offers</li>
                            <li>✓ Track orders and leave verified reviews</li>
                        </ul>
                        <a href="{{ route('register') }}" class="inline-flex px-6 py-3 mt-8 font-bold text-white bg-[#16833D] rounded-xl">Register as a Buyer</a>
                    </div>
                    <div class="absolute w-56 h-56 bg-green-200 rounded-full -right-16 -bottom-16 opacity-50"></div>
                </article>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="px-4 pb-24 sm:px-6 lg:px-8">
        <div class="max-w-7xl px-6 py-12 mx-auto text-center text-white bg-gradient-to-r from-[#0B3D22] to-[#16833D] rounded-3xl sm:px-10 sm:py-16">
            <p class="text-sm font-bold tracking-[0.18em] text-green-200 uppercase">Grow through better connections</p>
            <h2 class="max-w-3xl mx-auto mt-4 text-3xl font-extrabold sm:text-5xl">Ready to join Sri Lanka's smarter agricultural marketplace?</h2>
            <p class="max-w-2xl mx-auto mt-5 text-lg leading-8 text-green-50/75">Create your account and begin selling, discovering and negotiating fresh agricultural products.</p>
            <div class="flex flex-col justify-center gap-3 mt-8 sm:flex-row">
                <a href="{{ route('register') }}" class="px-7 py-4 font-bold text-[#16833D] bg-white rounded-xl">Create Account</a>
                <a href="{{ route('login') }}" class="px-7 py-4 font-bold text-white border rounded-xl border-white/40 hover:bg-white/10">Log In</a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer id="contact" class="px-4 pt-16 pb-8 text-white bg-[#071A10] sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-10 pb-12 border-b md:grid-cols-2 lg:grid-cols-4 border-white/10">
                <div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('image/logo.png') }}" alt="AgroSmart" class="object-contain w-12 h-12 brightness-0 invert">
                        <div><p class="text-2xl font-extrabold">AgroSmart</p><p class="text-[10px] tracking-[0.24em] text-green-200">MARKETPLACE</p></div>
                    </div>
                    <p class="mt-5 leading-7 text-white/60">Connecting Sri Lankan farmers and buyers through transparent, data-informed agricultural trade.</p>
                </div>

                <div>
                    <h3 class="font-extrabold">Platform</h3>
                    <div class="flex flex-col mt-5 space-y-3 text-white/60">
                        <a href="#workflow" class="hover:text-white">How It Works</a>
                        <a href="#features" class="hover:text-white">Smart Features</a>
                        <a href="#roles" class="hover:text-white">For Farmers & Buyers</a>
                    </div>
                </div>

                <div>
                    <h3 class="font-extrabold">Account</h3>
                    <div class="flex flex-col mt-5 space-y-3 text-white/60">
                        <a href="{{ route('register') }}" class="hover:text-white">Create Account</a>
                        <a href="{{ route('login') }}" class="hover:text-white">Log In</a>
                        <a href="{{ route('register') }}" class="hover:text-white">Join as a Farmer</a>
                    </div>
                </div>

                <div>
                    <h3 class="font-extrabold">Contact</h3>
                    <div class="mt-5 space-y-3 text-white/60">
                        <p>+94 75 202 5500</p>
                        <p>agrosmart@gmail.com</p>
                        <p>Mawathagama, Sri Lanka</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col justify-between gap-4 pt-7 text-sm text-white/45 sm:flex-row">
                <p>© {{ date('Y') }} AgroSmart Marketplace. All rights reserved.</p>
                <p>Built for smarter agricultural connections.</p>
            </div>
        </div>
    </footer>

</body>
</html>

