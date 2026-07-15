<div class="flex items-center w-full gap-6 p-7 mt-5 border border-gray-200 shadow-lg rounded-2xl {{ $bg }}">
    <!-- Icon -->
    <div class="flex items-center justify-center w-12 h-12 rounded-full {{ $iconBg }}">
        {{ $icon }}
    </div>

    <!-- Text -->
    <div>
        <p class="text-lg font-semibold text-gray-800">
            {{ $title }}
        </p>

        <h3 class="mt-1 text-2xl font-bold leading-none text-gray-900">
            {{ $value }}
        </h3>

    </div>
</div>