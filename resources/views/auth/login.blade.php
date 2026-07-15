<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroSmart</title>
     <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>

<body>

    <x-guest-layout>
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
            <div style="background:#E8F4D8 ; color:#1F7A1F; padding:8px; margin-bottom:16px; border-radius:8px; font-weight:600;">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-base font-lg text-s">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg">
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-base font-lg">Password</label>
                    <input id="password" type="password" name="password" required
                        class="block w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg">
                </div>

                <div class="mt-4">
                    <label for="role" class="block text-base font-lg">Login As</label>
                    <select id="role" name="role" class="block px-4 py-3 mt-1 w-full border-gray-300 rounded-lg shadow-sm" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="farmer">Farmer</option>
                        <option value="buyer">Buyer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="mt-3">
                    @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                    @endif
                </div>

                <button type="submit" class="block w-full bg-[#1F7A1F] text-white px-4 py-3 mt-[20px] rounded-lg text-xl">
                    Log In 
                </button>

                <p class="mt-4 text-center text-gray-600">
                    Don't have an account?
                    <a href="/register" class="font-semibold text-[#1F7A1F] hover:underline">
                        Sign Up
                    </a>
                </p>
            </form>
        </x-authentication-card>
    </x-guest-layout>

</body>

</html>