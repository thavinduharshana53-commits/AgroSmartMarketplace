<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Login | AgroSmart Marketplace</title>

    <link
        rel="icon"
        href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">

    <main
        x-data="{ showPassword: false }"
        class="relative flex items-center justify-center min-h-screen
               px-4 py-10 overflow-hidden sm:px-6">

        {{-- Background Image --}}
        <div class="absolute inset-0">

            <img
                src="{{ asset('image/products/hero-farmer.png') }}"
                alt="Sri Lankan farmer holding fresh agricultural products"
                class="object-cover object-center w-full h-full
                       brightness-[0.60] contrast-[1.05] saturate-[1.05]">

            {{-- Background Overlay --}}
            <div
                class="absolute inset-0
                       bg-gradient-to-b
                       from-emerald-950/45
                       via-slate-950/35
                       to-slate-950/70">
            </div>

        </div>

        {{-- Back to Home --}}
        <a
            href="{{ url('/') }}"
            class="absolute z-20 inline-flex items-center gap-2
                   px-4 py-2 text-sm font-semibold text-white transition
                   border rounded-full left-4 top-4 sm:left-8 sm:top-7
                   bg-black/20 border-white/30 backdrop-blur-md
                   hover:bg-white hover:text-[#16833D]">

            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15 19l-7-7 7-7"/>

            </svg>

            Back to Home

        </a>

        {{-- Login Container --}}
        <section
            class="relative z-10 w-full max-w-md px-6 py-7
                   bg-white/95 border border-white/70
                   shadow-2xl shadow-slate-950/30
                   backdrop-blur-xl rounded-3xl sm:px-9 sm:py-8">

            {{-- Logo --}}
            <div class="text-center">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex justify-center">

                    <img
                        src="{{ asset('image/logo.png') }}"
                        alt="AgroSmart Marketplace"
                        class="object-contain w-auto h-20 sm:h-24">

                </a>

                <h1
                    class="mt-4 text-3xl font-extrabold tracking-tight
                           text-slate-900">

                    Welcome Back

                </h1>

                <p class="mt-2 text-s leading-6 text-slate-500">

                    Sign in to continue to your AgroSmart account.

                </p>

            </div>

            {{-- Validation Errors --}}
            <x-validation-errors
                class="p-4 mt-5 mb-0 text-sm
                       border border-red-200
                       bg-red-50 rounded-xl"/>

            {{-- Session Status --}}
            @if (session('status'))

                <div
                    class="p-4 mt-5 text-sm font-semibold
                           text-green-800 border border-green-200
                           bg-green-50 rounded-xl">

                    {{ session('status') }}

                </div>

            @endif

            {{-- Login Form --}}
            <form
                method="POST"
                action="{{ route('login') }}"
                class="mt-6">

                @csrf

                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="block mb-2 text-s font-bold text-slate-700">

                        Email Address

                    </label>

                    <div class="relative">

                        <div
                            class="absolute inset-y-0 left-0
                                   flex items-center pl-4
                                   pointer-events-none text-slate-400">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 7l9 6 9-6M5 5h14
                                       a2 2 0 0 1 2 2v10
                                       a2 2 0 0 1-2 2H5
                                       a2 2 0 0 1-2-2V7
                                       a2 2 0 0 1 2-2Z"/>

                            </svg>

                        </div>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                            autofocus
                            placeholder="Enter your email address"
                            class="block w-full h-12 py-3 pl-12 pr-4
                                   text-s bg-white border border-slate-300
                                   rounded-xl placeholder:text-slate-400
                                   focus:border-[#16833D]
                                   focus:ring-2 focus:ring-green-100">

                    </div>

                </div>

                {{-- Password --}}
                <div class="mt-5">

                    <label
                        for="password"
                        class="block mb-2 text-s font-bold text-slate-700">

                        Password

                    </label>

                    <div class="relative">

                        <div
                            class="absolute inset-y-0 left-0
                                   flex items-center pl-4
                                   pointer-events-none text-slate-400">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <rect
                                    x="4"
                                    y="10"
                                    width="16"
                                    height="10"
                                    rx="2"/>

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 10V7a4 4 0 0 1 8 0v3"/>

                            </svg>

                        </div>

                        <input
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            autocomplete="current-password"
                            required
                            placeholder="Enter your password"
                            class="block w-full h-12 py-3 pl-12 pr-12
                                   text-s bg-white border border-slate-300
                                   rounded-xl placeholder:text-slate-400
                                   focus:border-[#16833D]
                                   focus:ring-2 focus:ring-green-100">

                        {{-- Password Visibility --}}
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0
                                   flex items-center justify-center w-12
                                   transition text-slate-400
                                   hover:text-[#16833D]"
                            :aria-label="showPassword
                                ? 'Hide password'
                                : 'Show password'">

                            {{-- Show Password Icon --}}
                            <svg
                                x-show="!showPassword"
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2 12s3.5-6 10-6
                                       10 6 10 6-3.5 6-10 6
                                       S2 12 2 12Z"/>

                                <circle cx="12" cy="12" r="3"/>

                            </svg>

                            {{-- Hide Password Icon --}}
                            <svg
                                x-cloak
                                x-show="showPassword"
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 3l18 18M10.6 10.6
                                       a2 2 0 0 0 2.8 2.8
                                       M9.9 4.2A10.7 10.7 0 0 1 12 4
                                       c6.5 0 10 8 10 8
                                       a17.5 17.5 0 0 1-2.1 3.1
                                       M6.6 6.6C3.6 8.5 2 12 2 12
                                       s3.5 8 10 8
                                       c1.5 0 2.8-.4 4-.9"/>

                            </svg>

                        </button>

                    </div>

                </div>

                {{-- Login Role --}}
                <div class="mt-5">

                    <label
                        for="role"
                        class="block mb-2 text-s font-bold text-slate-700">

                        Login As

                    </label>

                    <select
                        id="role"
                        name="role"
                        required
                        class="block w-full h-12 px-4 py-3
                               text-base bg-white border border-slate-300
                               rounded-xl focus:border-[#16833D]
                               focus:ring-2 focus:ring-green-100">

                        <option
                            value=""
                            disabled
                            @selected(old('role') === null)>

                            Select your account role

                        </option>

                        <option
                            value="farmer"
                            @selected(old('role') === 'farmer')>

                            Farmer

                        </option>

                        <option
                            value="buyer"
                            @selected(old('role') === 'buyer')>

                            Buyer

                        </option>

                        <option
                            value="admin"
                            @selected(old('role') === 'admin')>

                            Administrator

                        </option>

                    </select>

                </div>

                <!-- {{-- Remember and Forgot Password --}}
                <div
                    class="flex flex-wrap items-center
                           justify-between gap-3 mt-5">

                    <label
                        for="remember_me"
                        class="inline-flex items-center gap-2 cursor-pointer">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 text-[#16833D]
                                   border-slate-300 rounded
                                   focus:ring-[#16833D]">

                        <span class="text-sm text-slate-600">
                            Remember me
                        </span>

                    </label> -->

                    <!-- @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm font-semibold text-[#16833D]
                                   hover:text-green-800 hover:underline">

                            Forgot password?

                        </a>

                    @endif

                </div> -->

                {{-- Login Button --}}
                <button
                    type="submit"
                    class="inline-flex items-center justify-center
                           w-full h-12 gap-2 mt-6
                           text-base font-bold text-white
                           bg-[#16833D] rounded-xl
                           shadow-lg shadow-green-900/10
                           transition hover:-translate-y-0.5
                           hover:bg-[#106B31]
                           focus:ring-4 focus:ring-green-100">

                    Sign In

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12h14M13 6l6 6-6 6"/>

                    </svg>

                </button>

                {{-- Registration Link --}}
                <p class="mt-6 text-s text-center text-slate-500">

                    Don’t have an AgroSmart account?

                    <a
                        href="{{ route('register') }}"
                        class="font-bold text-[#16833D]
                               hover:text-green-800 hover:underline">

                        Create Account

                    </a>

                </p>

            </form>

        </section>

    </main>

</body>

</html>