@extends('layouts.farmer')

@section('content')

<div class="min-h-screen p-2">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-900">
                Edit Product
            </h1>

            <p class="mt-2 text-lg text-gray-500">
                Update your published product information.
            </p>

        </div>

        <a
            href="{{ route('farmer.products.myProducts') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-3 font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m15 18-6-6 6-6"/>

            </svg>

            Back to My Products

        </a>

    </div>

    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="p-5 mt-6 text-red-700 border border-red-200 bg-red-50 rounded-xl">

            <p class="font-bold">
                Please correct the following errors:
            </p>

            <ul class="mt-2 ml-5 text-sm list-disc">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- Edit Form --}}
    <form
        action="{{ route('farmer.products.update', ['product' => $product->product_id]) }}"
        method="POST"
        enctype="multipart/form-data"
        class="p-6 mt-8 bg-white border border-gray-200 shadow-sm sm:p-8 rounded-2xl">

        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- Product Name --}}
            <div>

                <label
                    for="product_name"
                    class="block font-semibold text-gray-700">

                    Product Name
                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    id="product_name"
                    name="product_name"
                    value="{{ old('product_name', $product->product_name) }}"
                    required
                    class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">

                @error('product_name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Category --}}
            <div>

                <label
                    for="category"
                    class="block font-semibold text-gray-700">

                    Category
                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    id="category"
                    name="category"
                    value="{{ old('category', $product->category) }}"
                    required
                    class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">

                @error('category')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Quantity --}}
            <div>

                <label
                    for="quantity"
                    class="block font-semibold text-gray-700">

                    Total Quantity
                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    value="{{ old('quantity', $product->quantity) }}"
                    min="0.01"
                    step="0.01"
                    required
                    class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">

                @error('quantity')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Unit --}}
            <div>

                <label
                    for="unit"
                    class="block font-semibold text-gray-700">

                    Unit
                    <span class="text-red-500">*</span>

                </label>

                <select
                    id="unit"
                    name="unit"
                    required
                    class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">

                    <option
                        value="kg"
                        @selected(old('unit', $product->unit) === 'kg')>

                        Kilogram (kg)

                    </option>

                    <option
                        value="g"
                        @selected(old('unit', $product->unit) === 'g')>

                        Gram (g)

                    </option>

                    <option
                        value="ton"
                        @selected(old('unit', $product->unit) === 'ton')>

                        Ton

                    </option>

                    <option
                        value="unit"
                        @selected(old('unit', $product->unit) === 'unit')>

                        Unit

                    </option>

                </select>

                @error('unit')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Listed Price --}}
            <div>

                <label
                    for="price"
                    class="block font-semibold text-gray-700">

                    Price Per kg
                    <span class="text-red-500">*</span>

                </label>

                <div class="relative mt-2">

                    <span class="absolute text-gray-500 -translate-y-1/2 left-4 top-1/2">
                        Rs.
                    </span>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        min="0.01"
                        step="0.01"
                        required
                        class="w-full py-3 pl-12 pr-4 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">

                </div>

                @error('price')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Minimum Price --}}
            <div>

                <label
                    for="minimum_price"
                    class="block font-semibold text-gray-700">

                    Minimum Price
                    <span class="text-red-500">*</span>

                </label>

                <div class="relative mt-2">

                    <span class="absolute text-gray-500 -translate-y-1/2 left-4 top-1/2">
                        Rs.
                    </span>

                    <input
                        type="number"
                        id="minimum_price"
                        name="minimum_price"
                        value="{{ old('minimum_price', $product->minimum_price) }}"
                        min="0.01"
                        step="0.01"
                        required
                        class="w-full py-3 pl-12 pr-4 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">

                </div>

                <p class="mt-2 text-sm text-gray-500">
                    Minimum price cannot be higher than the listed price.
                </p>

                @error('minimum_price')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- District --}}
            <div>

                <label
                    for="district"
                    class="block font-semibold text-gray-700">

                    District
                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    id="district"
                    name="district"
                    value="{{ old('district', $product->district) }}"
                    required
                    class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">

                @error('district')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- City --}}
            <div>

                <label
                    for="city"
                    class="block font-semibold text-gray-700">

                    City
                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="text"
                    id="city"
                    name="city"
                    value="{{ old('city', $product->city) }}"
                    required
                    class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-lg focus:border-green-600 focus:ring-green-600">

                @error('city')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

        {{-- Product Image --}}
        <div class="mt-6">

            <label
                for="product_image"
                class="block font-semibold text-gray-700">

                Product Image

            </label>

            <div class="flex flex-col gap-5 mt-3 sm:flex-row sm:items-center">

                <div class="flex items-center justify-center w-32 h-32 overflow-hidden bg-gray-50 border border-gray-200 rounded-xl shrink-0">

                    <img
                        src="{{ $product->product_image
                            ? asset('storage/'.$product->product_image)
                            : asset('image/product-placeholder.png') }}"
                        alt="{{ $product->product_name }}"
                        class="object-contain w-full h-full p-2">

                </div>

                <div class="w-full">

                    <input
                        type="file"
                        id="product_image"
                        name="product_image"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg">

                    <p class="mt-2 text-sm text-gray-500">
                        Leave empty to keep the existing image. Maximum size: 2 MB.
                    </p>

                    @error('product_image')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>

        {{-- Description --}}
        <div class="mt-6">

            <label
                for="description"
                class="block font-semibold text-gray-700">

                Product Description
                <span class="text-red-500">*</span>

            </label>

            <textarea
                id="description"
                name="description"
                rows="5"
                maxlength="2000"
                required
                class="w-full px-4 py-3 mt-2 border border-gray-300 resize-none rounded-lg focus:border-green-600 focus:ring-green-600">{{ old('description', $product->description) }}</textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 pt-6 mt-8 border-t border-gray-200 sm:flex-row sm:justify-end">

            <a
                href="{{ route('farmer.products.myProducts') }}"
                class="px-6 py-3 font-semibold text-center text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">

                Cancel

            </a>

            <button
                type="submit"
                class="px-6 py-3 font-semibold text-white bg-[#1F7A1F] rounded-lg hover:bg-green-800">

                Update Product

            </button>

        </div>

    </form>

</div>

@endsection