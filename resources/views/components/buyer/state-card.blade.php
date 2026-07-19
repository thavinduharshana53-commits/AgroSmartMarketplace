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
            "relative flex items-center w-full min-h-20 gap-5 p-6
            overflow-hidden transition duration-300 border border-transparent
            shadow-sm rounded-2xl hover:-translate-y-1 hover:shadow-md {$bg}"
    ]) }}>

    {{-- Decorative circle --}}
    <div class="absolute w-24 h-2 rounded-full pointer-events-none -right-8 -top-8 bg-white/40"></div>

    {{-- Icon --}}
    <div
        class="relative z-10 flex items-center justify-center w-14 h-14 rounded-full shrink-0 {{ $iconBg }} {{ $iconColor }}">

        {{ $icon }}

    </div>

    {{-- Card Details --}}
    <div class="relative z-10 flex flex-col min-w-0">

        <p class="text-base font-semibold text-gray-700">
            {{ $title }}
        </p>

        <h3 class="mt-1 text-3xl font-bold leading-none text-gray-900">
            {{ is_numeric($value) ? number_format((int) $value) : $value }}
        </h3>

        <a
            href="{{ $link }}"
            class="inline-flex items-center gap-2 mt-4 text-sm font-bold text-[#1F7A1F] transition hover:text-green-900 group">

            <span>
                {{ $linkText }}
            </span>

            <svg
                class="w-4 h-4 transition-transform group-hover:translate-x-1"
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