@extends('layouts.farmer')

@section('content')

<div
    x-data="smartPricing(
        @js(route('farmer.smart-pricing.suggest')),
        @js(csrf_token())
    )"
    class="min-h-screen bg-[#F8F5EC]">
    <main class="p-8">

        <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">
            Publish Product
        </h1>

        <p class="mt-2 text-gray-600">
            Publish a wholesale agricultural lot for buyers to submit offers.
        </p>
        </div>

        <div class="p-10 bg-white shadow-sm rounded-3xl">

            <form method="POST" action="{{ route('farmer.products.store') }}" enctype="multipart/form-data"
                id="publishProductForm">
                @csrf

                <div class="grid gap-8 md:grid-cols-2">

                    <div>
                        <label class="font-semibold text-gray-700">
                            Product Name
                        </label>

                        <input
                            type="text"
                            name="product_name"
                            placeholder="Enter product name"
                            required
                            class="w-full px-5 mt-3 border border-gray-300 outline-none h-14 rounded-2xl">
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">
                            Category
                        </label>

                        <select
                            name="category"
                            required
                            class="w-full px-5 mt-3 text-gray-700 bg-white border border-gray-300 outline-none h-14 rounded-2xl">

                            <option value="" disabled selected>
                                Select Category
                            </option>

                            <option value="Vegetables">Vegetables</option>
                            <option value="Fruits">Fruits</option>
                            <option value="Rice">Rice</option>
                            <option value="Spices">Spices</option>

                        </select>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">
                        Total Quantity (kg)
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            step="0.01"
                            min="0.01"
                            placeholder="Enter total wholesale quantity"
                            required
                            class="w-full px-5 mt-3 border border-gray-300 outline-none h-14 rounded-2xl">
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">
                        Price Per kg (LKR)
                        </label>

                        <input
                            id="productPrice"
                            type="number"
                            name="price"
                            step="0.01"
                            min="0.01"
                            placeholder="Enter listed price per kg"
                            required
                            class="w-full px-5 mt-3 border border-gray-300 outline-none h-14 rounded-2xl">
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">
                            Minimum Price Per kg (LKR)
                        </label>

                        <input
                            type="number"
                            name="minimum_price"
                            step="0.01"
                            min="0.01"
                            placeholder="Enter minimum acceptable price per kg"
                            required
                            class="w-full px-5 mt-3 border border-gray-300 outline-none h-14 rounded-2xl">
                    </div>


                    <div>
                        <label class="font-semibold text-gray-700">
                            District
                        </label>


                        <select
                            name="district"
                            required
                            class="w-full px-5 mt-3 text-gray-700 bg-white border border-gray-300 outline-none h-14 rounded-2xl">

                            <option value="" disabled selected>
                                Select District
                            </option>

                            <option value="Colombo">Colombo</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Kalutara">Kalutara</option>
                            <option value="Kandy">Kandy</option>
                            <option value="Matale">Matale</option>
                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                            <option value="Galle">Galle</option>
                            <option value="Matara">Matara</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kilinochchi">Kilinochchi</option>
                            <option value="Mannar">Mannar</option>
                            <option value="Vavuniya">Vavuniya</option>
                            <option value="Mullaitivu">Mullaitivu</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Ampara">Ampara</option>
                            <option value="Trincomalee">Trincomalee</option>
                            <option value="Kurunegala">Kurunegala</option>
                            <option value="Puttalam">Puttalam</option>
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Polonnaruwa">Polonnaruwa</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Monaragala">Monaragala</option>
                            <option value="Ratnapura">Ratnapura</option>
                            <option value="Kegalle">Kegalle</option>

                        </select>
                    </div>

                    <x-farmer.smart-pricing-card />

                    <div>
                        <label class="font-semibold text-gray-700">
                            City
                        </label>

                        <input
                            type="text"
                            name="city"
                            placeholder="Enter city"
                            required
                            class="w-full px-5 mt-3 border border-gray-300 outline-none h-14 rounded-2xl">
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">
                            Product Image
                        </label>

                        <input
                            type="file"
                            name="product_image"
                            accept="image/*"
                            required
                            class="w-full p-4 mt-3 bg-white border border-gray-300 rounded-2xl">
                    </div>

                </div>

                <div class="mt-8">
                    <label class="font-semibold text-gray-700">
                        Product Description
                    </label>

                    <textarea
                        rows="5"
                        name="description"
                        placeholder="Enter product quality and wholesale details"
                        required
                        class="w-full p-5 mt-3 border border-gray-300 outline-none rounded-2xl"></textarea>
                </div>

                <div class="flex gap-5 mt-10">

                    <button
                        type="submit"
                        class="px-10 font-semibold text-white transition bg-[#1F7A1F] h-14 rounded-2xl hover:bg-green-800">
                        Publish Product
                    </button>

                    <button
                        type="reset"
                        class="px-10 font-semibold text-[#1F7A1F] transition bg-white border border-[#1F7A1F] h-14 rounded-2xl hover:bg-green-50">
                        Cancel
                    </button>

                </div>

            </form>

        </div>
  </main>
</div>

@endsection