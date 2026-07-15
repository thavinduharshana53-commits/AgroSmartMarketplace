<div class="flex items-center w-full gap-3 p-5 rounded-xl {{ $bg }}">
    <!-- Icon -->
    <div class="flex items-center justify-center w-12 h-12 rounded-full {{ $iconBg }}">
        {{ $icon }}
    </div>

    <!-- Text -->
    <div>
        <p class="text-base font-semibold text-gray-800">
            {{ $title }}
        </p>

        <h3 class="mt-1 text-2xl font-bold leading-none text-gray-900">
            {{ $value }}
        </h3>

        <a href="{{ $link ?? '#' }}" class="inline-block mt-3 text-base font-semibold text-[#1F7A1F]">
            {{ $linkText }} →
        </a>
    </div>
</div>