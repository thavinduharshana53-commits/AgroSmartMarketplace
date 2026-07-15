<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-8">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="grid md:grid-cols-2">

                <!-- Left Side -->
                <div class="hidden md:flex flex-col justify-center items-center bg-[#1F7A1F] text-white p-10">
                    <img src="{{ asset('image/products/v.png') }}" class="h-24 mb-6" alt="AgroSmart Logo">
                    <h1 class="text-3xl font-bold">AgroSmart Marketplace</h1>
                    <p class="mt-3 text-center text-green-100">
                        Join the agricultural marketplace
                    </p>
                </div>

                <!-- Form Side -->
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Create Account</h2>
                    <p class="text-sm text-gray-500 mb-6">Register as Farmer or Buyer</p>

                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div>
                                <x-label for="name" value="Name" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>

                            <div>
                                <x-label for="email" value="Email" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            </div>

                            <div>
                                <x-label for="role" value="Register As" />
                                <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="farmer">Farmer</option>
                                    <option value="buyer">Buyer</option>
                                </select>
                            </div>

                            <div>
                                <x-label for="district" value="District" />
                                <select id="district" name="district" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="" disabled selected>Select District</option>
                                    <option value="Colombo">Colombo</option>
                                    <option value="Gampaha">Gampaha</option>
                                    <option value="Kalutara">Kalutara</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Matara">Matara</option>
                                    <option value="Kurunegala">Kurunegala</option>
                                    <option value="Anuradhapura">Anuradhapura</option>
                                    <option value="Badulla">Badulla</option>
                                    <option value="Ratnapura">Ratnapura</option>
                                </select>
                            </div>

                            <div>
                                <x-label for="city" value="City" />
                                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
                            </div>

                            <div>
                                <x-label for="contact_number" value="Contact Number" />
                                <x-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="old('contact_number')" />
                            </div>

                            <div>
                                <x-label for="password" value="Password" />
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                            </div>

                            <div>
                                <x-label for="password_confirmation" value="Confirm Password" />
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                            </div>

                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('login') }}" class="text-sm text-green-600 hover:underline">
                                Already have an account? Log In
                            </a>

                            <button type="submit" class="bg-[#1F7A1F] hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold">
                           Create Account
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>