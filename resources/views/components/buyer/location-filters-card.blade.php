@props([
    'search' => '',
    'district' => '',
    'city' => '',
    'districts' => [],
    'cities' => [],
])

<div class="p-5  mt-6 bg-white border border-gray-200 shadow-sm rounded-xl">

    <form action="{{ route('buyer.browseProducts') }}" method="GET" class = "flex gap-5">

            {{-- Preserve Search Keyword --}}
            @if($search !== '')
                <input type="hidden" name="search" value="{{ $search }}">
            @endif

            {{-- District Filter --}}
            <div>

                <label for="districtFilter"
                    class="block mb-2 text-base font-semibold text-gray-700">

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
                    class="w-64 h-12 px-4 text-base bg-white border border-gray-300 rounded-lg outline-none focus:border-[#1F7A1F] focus:ring-2 focus:ring-green-100">

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

            {{-- City Filter --}}
            <div>

                <label
                    for="cityFilter"
                    class="block mb-2 text-base font-semibold text-gray-700">

                    City

                </label>

                <select
                    id="cityFilter"
                    name="city"
                    class="w-64 h-12 px-4 text-base bg-white border border-gray-300 rounded-lg outline-none focus:border-[#1F7A1F] focus:ring-2 focus:ring-green-100">

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

            {{-- Filter Actions --}}
            <div class="flex flex-col gap-3 sm:flex-row md:col-span-2 xl:col-span-1 xl:self-end">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center h-12 px-6 font-semibold text-white bg-[#1F7A1F] rounded-lg transition hover:bg-green-800 whitespace-nowrap">

                    Apply Filters

                </button>

                @if($district !== '' || $city !== '')

                    <a
                        href="{{ route('buyer.browseProducts', array_filter([
                            'search' => $search,
                        ])) }}"
                        class="inline-flex items-center justify-center h-12 px-6 font-semibold text-gray-700 transition border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 whitespace-nowrap">

                        Clear Filters

                    </a>

                @endif

            </div>
    </form>

    {{-- Selected Location Message --}}
    @if($district !== '' || $city !== '')

        <div class="flex items-center gap-2 mt-4 text-base text-green-700">

            <span aria-hidden="true">
                📍
            </span>

            <span>
                Showing products in

                <strong>
                    {{ $city !== '' ? $city.', ' : '' }}
                    {{ $district !== '' ? $district : 'all districts' }}
                </strong>
            </span>

        </div>

    @endif

</div>