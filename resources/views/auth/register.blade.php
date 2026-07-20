<x-guest-layout>

    <div
        class="flex items-center justify-center min-h-screen
               px-4 py-8 bg-[#F4F7F5] sm:px-6">

        <div
            class="w-full max-w-5xl overflow-hidden
                   bg-white border border-gray-200
                   shadow-2xl rounded-3xl">

            <div class="grid md:grid-cols-[0.9fr_1.1fr]">

              {{-- Left Promotional Panel --}}
                <div
                    class="relative hidden min-h-[650px] overflow-hidden
                        bg-gradient-to-br from-[#16833D] via-[#116B3A] to-[#073D30]
                        md:flex md:flex-col md:p-10 lg:p-12">

                    {{-- Decorative Background Shapes --}}
                    <div
                        class="absolute w-64 h-64 rounded-full
                            -top-24 -left-24 bg-green-300/15 blur-3xl">
                    </div>

                    <div
                        class="absolute w-72 h-72 rounded-full
                            -right-32 -bottom-28 bg-emerald-300/10 blur-3xl">
                    </div>

                    <div
                        class="absolute inset-0 opacity-[0.05]
                            bg-[radial-gradient(circle_at_center,white_1px,transparent_1px)]
                            bg-[size:24px_24px]">
                    </div>

                    {{-- Logo and System Name --}}
                    <a
                        href="{{ url('/') }}"
                        class="relative z-10 inline-flex items-center gap-4 self-start">

                        <div
                            class="flex items-center justify-center
                                w-16 h-16 bg-white/10 border border-white/20
                                rounded-2xl backdrop-blur-sm">

                            <img
                                src="{{ asset('image/products/v.png') }}"
                                alt="AgroSmart logo"
                                class="object-contain w-12 h-12">

                        </div>

                        <div>
                            <p class="text-2xl font-extrabold leading-tight text-white">
                                AgroSmart
                            </p>

                            <p
                                class="mt-1 text-xs font-semibold tracking-[0.22em]
                                    uppercase text-green-200">

                                Marketplace

                            </p>
                        </div>

                    </a>

                    {{-- Main Promotional Content --}}
                    <div
                        class="relative z-10 flex flex-col justify-center
                            flex-1 py-10">

                        {{-- Badge --}}
                        <div
                            class="inline-flex items-center self-start gap-2
                                px-4 py-2 text-xs font-bold text-green-100
                                border border-white/20 rounded-full
                                bg-white/10 backdrop-blur-sm">

                            <span
                                class="w-2 h-2 bg-green-300 rounded-full
                                    shadow-[0_0_10px_rgba(134,239,172,0.8)]">
                            </span>

                            Sri Lanka’s smart marketplace

                        </div>

                        {{-- Heading --}}
                        <h1
                            class="mt-7 text-3xl font-extrabold
                                leading-tight tracking-tight text-white
                                lg:text-4xl">

                            Grow connections.

                            <span class="block mt-2 text-green-300">
                                Create opportunities.
                            </span>

                        </h1>

                        {{-- Description --}}
                        <p
                            class="max-w-md mt-5 text-sm
                                leading-7 text-green-50/90 lg:text-base">

                            Join AgroSmart and connect with trusted farmers and
                            buyers through a smarter agricultural marketplace.

                        </p>

                        {{-- Feature List --}}
                        <div class="grid gap-4 mt-8">

                            <div class="flex items-center gap-3">

                                <span
                                    class="flex items-center justify-center
                                        w-8 h-8 text-sm font-bold text-[#075C35]
                                        bg-green-300 rounded-full shrink-0">

                                    ✓

                                </span>

                                <span class="text-s font-medium text-white/95">
                                    Direct product offers and negotiations
                                </span>

                            </div>

                            <div class="flex items-center gap-3">

                                <span
                                    class="flex items-center justify-center
                                        w-8 h-8 text-sm font-bold text-[#075C35]
                                        bg-green-300 rounded-full shrink-0">

                                    ✓

                                </span>

                                <span class="text-s font-medium text-white/95">
                                    Smart pricing and demand insights
                                </span>

                            </div>

                            <div class="flex items-center gap-3">

                                <span
                                    class="flex items-center justify-center
                                        w-8 h-8 text-sm font-bold text-[#075C35]
                                        bg-green-300 rounded-full shrink-0">

                                    ✓

                                </span>

                                <span class="text-s font-medium text-white/95">
                                    Location-based product discovery
                                </span>

                            </div>

                        </div>

                    </div>

                    {{-- Bottom Trust Message --}}
                    <div
                        class="relative z-10 pt-5 text-xs
                            border-t border-white/15 text-green-100/80">

                        Connecting Sri Lankan farmers and buyers through technology.

                    </div>

                </div>

                {{-- Registration Form Panel --}}
                <div class="p-6 bg-white sm:p-8 lg:p-10">

                    {{-- Mobile Logo --}}
                    <div class="mb-6 text-center md:hidden">

                        <a
                            href="{{ url('/') }}"
                            class="inline-flex justify-center">

                            <img
                                src="{{ asset('image/products/v.png') }}"
                                alt="AgroSmart Marketplace"
                                class="object-contain h-20">

                        </a>

                    </div>

                    {{-- Form Heading --}}
                    <div class="flex items-start justify-between gap-4">

                        <div>

                            <h2
                                class="text-2xl font-extrabold
                                       text-gray-900 sm:text-3xl">

                                Create Account

                            </h2>

                            <p class="mt-2 text-s text-gray-500">

                                Join AgroSmart as a farmer or buyer.

                            </p>

                        </div>

                        <a
                            href="{{ url('/') }}"
                            class="hidden text-s font-semibold
                                   text-[#16833D] hover:underline sm:block">

                            Back to Home

                        </a>

                    </div>

                    <x-validation-errors
                        class="p-4 mt-5 mb-0 text-sm
                               border border-red-200
                               bg-red-50 rounded-xl"/>

                    <form
                        method="POST"
                        action="{{ route('register') }}"
                        class="mt-7">

                        @csrf

                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            {{-- Name --}}
                            <div>

                                <label
                                    for="name"
                                    class="block mb-2 text-base
                                           font-bold text-gray-700">

                                    Full Name

                                </label>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Enter your full name"
                                    class="block w-full h-12 px-4
                                           text-s bg-white border
                                           border-gray-300 rounded-xl
                                           placeholder:text-gray-400
                                           focus:border-[#16833D]
                                           focus:ring-2 focus:ring-green-100">

                            </div>

                            {{-- Email --}}
                            <div>

                                <label
                                    for="email"
                                    class="block mb-2 text-base
                                           font-bold text-gray-700">

                                    Email Address

                                </label>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="Enter your email"
                                    class="block w-full h-12 px-4
                                           text-s bg-white border
                                           border-gray-300 rounded-xl
                                           placeholder:text-gray-400
                                           focus:border-[#16833D]
                                           focus:ring-2 focus:ring-green-100">

                            </div>

                            {{-- Role --}}
                            <div>

                                <label
                                    for="role"
                                    class="block mb-2 text-base
                                           font-bold text-gray-700">

                                    Register As

                                </label>

                                <select
                                    id="role"
                                    name="role"
                                    required
                                    class="block w-full h-12 px-4
                                           text-s bg-white border
                                           border-gray-300 rounded-xl
                                           focus:border-[#16833D]
                                           focus:ring-2 focus:ring-green-100">

                                    <option
                                        value=""
                                        disabled
                                        @selected(old('role') === null)>

                                        Select Role

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

                                </select>

                            </div>

                            {{-- District --}}
                            <div>

                                <label
                                    for="district"
                                    class="block mb-2 text-base
                                           font-bold text-gray-700">

                                    District

                                </label>

                                <select
                                    id="district"
                                    name="district"
                                    required
                                    class="block w-full h-12 px-4
                                           text-s bg-white border
                                           border-gray-300 rounded-xl
                                           focus:border-[#16833D]
                                           focus:ring-2 focus:ring-green-100">

                                    <option
                                        value=""
                                        disabled
                                        @selected(old('district') === null)>

                                        Select District

                                    </option>

                                    @foreach([
                                        'Colombo',
                                        'Gampaha',
                                        'Kalutara',
                                        'Kandy',
                                        'Galle',
                                        'Matara',
                                        'Kurunegala',
                                        'Anuradhapura',
                                        'Badulla',
                                        'Ratnapura',
                                    ] as $district)

                                        <option
                                            value="{{ $district }}"
                                            @selected(old('district') === $district)>

                                            {{ $district }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            {{-- City --}}
                            <div>

                                <label
                                    for="city"
                                    class="block mb-2 text-base
                                           font-bold text-gray-700">

                                    City

                                </label>

                                <input
                                    id="city"
                                    type="text"
                                    name="city"
                                    value="{{ old('city') }}"
                                    required
                                    placeholder="Enter your city"
                                    class="block w-full h-12 px-4
                                           text-s bg-white border
                                           border-gray-300 rounded-xl
                                           placeholder:text-gray-400
                                           focus:border-[#16833D]
                                           focus:ring-2 focus:ring-green-100">

                            </div>

                            {{-- Contact Number --}}
                            <div>

                                <label
                                    for="contact_number"
                                    class="block mb-2 text-base
                                           font-bold text-gray-700">

                                    Contact Number

                                </label>

                                <input
                                    id="contact_number"
                                    type="tel"
                                    name="contact_number"
                                    value="{{ old('contact_number') }}"
                                    inputmode="numeric"
                                    maxlength="10"
                                    placeholder="07XXXXXXXX"
                                    class="block w-full h-12 px-4
                                           text-s bg-white border
                                           border-gray-300 rounded-xl
                                           placeholder:text-gray-400
                                           focus:border-[#16833D]
                                           focus:ring-2 focus:ring-green-100">

                            </div>

                            {{-- Password --}}
                            <div>

                                <label
                                    for="password"
                                    class="block mb-2 text-base
                                           font-bold text-gray-700">

                                    Password

                                </label>

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Create a password"
                                    class="block w-full h-12 px-4
                                           text-s bg-white border
                                           border-gray-300 rounded-xl
                                           placeholder:text-gray-400
                                           focus:border-[#16833D]
                                           focus:ring-2 focus:ring-green-100">

                            </div>

                            {{-- Confirm Password --}}
                            <div>

                                <label
                                    for="password_confirmation"
                                    class="block mb-2 text-base
                                           font-bold text-gray-700">

                                    Confirm Password

                                </label>

                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Confirm your password"
                                    class="block w-full h-12 px-4
                                           text-s bg-white border
                                           border-gray-300 rounded-xl
                                           placeholder:text-gray-400
                                           focus:border-[#16833D]
                                           focus:ring-2 focus:ring-green-100">

                            </div>

                        </div>

                        {{-- Form Actions --}}
                        <div
                            class="flex flex-col-reverse gap-4 mt-7
                                   sm:flex-row sm:items-center
                                   sm:justify-between">

                            <p class="text-s text-center text-gray-500">

                                Already have an account?

                                <a
                                    href="{{ route('login') }}"
                                    class="font-bold text-[#16833D]
                                           hover:underline">

                                    Log In

                                </a>

                            </p>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center
                                       h-12 px-7 font-bold text-white
                                       bg-[#16833D] rounded-xl
                                       shadow-lg shadow-green-900/10
                                       transition hover:-translate-y-0.5
                                       hover:bg-green-800">

                                Create Account

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>