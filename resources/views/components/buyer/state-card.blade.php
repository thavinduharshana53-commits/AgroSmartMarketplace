@props([
    'title',
    'value' => 0,
    'bg' => 'bg-white',
    'iconBg' => 'bg-green-100',
    'iconColor' => 'text-green-700',
    'link' => '#',
    'linkText' => 'View details',
])

<div
    {{ $attributes->merge([
        'class' =>
            "relative flex items-center w-full min-h-32 gap-4 p-4
            overflow-hidden transition duration-300 border border-transparent
            shadow-sm sm:min-h-36 sm:gap-5 sm:p-5 lg:p-6
            rounded-xl sm:rounded-2xl
            hover:-translate-y-1 hover:shadow-md {$bg}"
    ]) }}>

    {{-- Decorative Circle --}}
    <div
        class="absolute w-20 h-20 rounded-full pointer-events-none
               sm:w-24 sm:h-24 -right-7 -top-7 bg-white/40">
    </div>

    {{-- Icon --}}
    <div
        class="relative z-10 flex items-center justify-center
               w-12 h-12 rounded-full shrink-0
               sm:w-14 sm:h-14
               {{ $iconBg }} {{ $iconColor }}">

        {{ $icon }}

    </div>

    {{-- Card Details --}}
    <div class="relative z-10 flex flex-col flex-1 min-w-0">

        <p class="text-sm font-semibold text-gray-700 sm:text-base">
            {{ $title }}
        </p>

        <h3 class="mt-1 text-2xl font-bold leading-none text-gray-900 sm:text-3xl">
            {{ is_numeric($value)
                ? number_format((int) $value)
                : $value }}
        </h3>

        <a
            href="{{ $link }}"
            class="inline-flex items-center self-start gap-2 mt-3
                   text-xs font-bold text-[#1F7A1F]
                   transition sm:mt-4 sm:text-sm
                   hover:text-green-900 group">

            <span class="leading-5 break-words">
                {{ $linkText }}
            </span>

            <svg
                class="w-4 h-4 transition-transform shrink-0 group-hover:translate-x-1"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 12h14M13 6l6 6-6 6"/>

            </svg>

        </a>

    </div>

</div>