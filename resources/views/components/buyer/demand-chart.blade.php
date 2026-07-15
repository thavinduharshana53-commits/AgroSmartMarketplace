<div class="p-4 bg-white border border-gray-200 rounded-xl">
    <h3 class="mb-3 text-base font-bold text-center {{ $titleColor }}">
        {{ $title }}
    </h3>

    <div class="relative h-[170px]">

        <!-- Y axis labels -->
        <div class="absolute left-0 top-6 bottom-8 flex flex-col justify-between text-[12px] text-gray-700">
            <span>High</span>
            <span>Medium</span>
            <span>Low</span>
        </div>

        <!-- Grid lines -->
        <div class="absolute right-0 flex flex-col justify-between top-6 bottom-8 left-10">
            <span class="border-t border-gray-100"></span>
            <span class="border-t border-gray-100"></span>
            <span class="border-t border-gray-100"></span>
        </div>

        <!-- Chart -->
        <svg class="absolute top-6 bottom-8 left-10 right-0 w-[calc(100%-40px)] h-[120px]"
            viewBox="0 0 300 120" fill="none">

            <path
                d="{{ $areaPath }}"
                fill="{{ $areaColor }}"
                opacity="0.45" />

            <path
                d="{{ $linePath }}"
                stroke="{{ $lineColor }}"
                stroke-width="2.5"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round" />

            {!! $points !!}
        </svg>

        <!-- X axis labels -->
        <div class="absolute bottom-0 left-10 right-0 flex justify-between text-[12px] text-gray-700">
            <span>May 1</span>
            <span>May 8</span>
            <span>May 15</span>
            <span>May 22</span>
            <span>May 29</span>
        </div>
    </div>
</div>