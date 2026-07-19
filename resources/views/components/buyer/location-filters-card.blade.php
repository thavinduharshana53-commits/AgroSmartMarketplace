<form
    action="{{ route('buyer.browseProducts') }}"
    method="GET"
    class="flex flex-col gap-4 lg:flex-row lg:items-end">

    @if($search !== '')
        <input
            type="hidden"
            name="search"
            value="{{ $search }}">
    @endif

    {{-- District --}}
    <div class="w-full lg:flex-1">

        <label
            for="districtFilter"
            class="block mb-2 text-sm font-semibold text-gray-700">

            District

        </label>

        <select
            id="districtFilter"
            name="district"
            onchange="
                const citySelect =
                    document.getElementById('cityFilter');

                if (citySelect) {
                    citySelect.value = '';
                }

                this.form.submit();
            "
            class="w-full h-12 px-4 text-base bg-white border border-gray-300 rounded-lg outline-none focus:border-[#1F7A1F] focus:ring-2 focus:ring-green-100">

            <option value="">
                All Districts
            </option>

            @foreach($districts as $districtOption)

                <option
                    value="{{ $districtOption }}"
                    @selected($district === $districtOption)>

                    {{ $districtOption }}

                </option>

            @endforeach

        </select>

    </div>

    {{-- City --}}
    <div class="w-full lg:flex-1">

        <label
            for="cityFilter"
            class="block mb-2 text-sm font-semibold text-gray-700">

            City

        </label>

        <select
            id="cityFilter"
            name="city"
            class="w-full h-12 px-4 text-base bg-white border border-gray-300 rounded-lg outline-none focus:border-[#1F7A1F] focus:ring-2 focus:ring-green-100">

            <option value="">
                All Cities
            </option>

            @foreach($cities as $cityOption)

                <option
                    value="{{ $cityOption }}"
                    @selected($city === $cityOption)>

                    {{ $cityOption }}

                </option>

            @endforeach

        </select>

    </div>

    {{-- Actions --}}
    <div class="grid w-full grid-cols-1 gap-3 sm:grid-cols-2 lg:flex lg:w-auto lg:shrink-0">

        <button
            type="submit"
            class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-semibold text-white transition bg-[#1F7A1F] rounded-lg hover:bg-green-800 whitespace-nowrap">

            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 5h16M7 12h10M10 19h4"/>

            </svg>

            Apply Filters

        </button>

        @if($district !== '' || $city !== '')

            <a
                href="{{ route('buyer.browseProducts', array_filter([
                    'search' => $search,
                ])) }}"
                class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-semibold text-gray-700 transition bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 whitespace-nowrap">

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 6l12 12M18 6 6 18"/>

                </svg>

                Clear

            </a>

        @endif

    </div>

</form>