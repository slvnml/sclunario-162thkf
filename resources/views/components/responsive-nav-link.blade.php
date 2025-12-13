@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-pink-500 text-start text-base font-medium text-white bg-pink-900 bg-opacity-50 focus:outline-none focus:text-white focus:bg-pink-900 focus:border-pink-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 hover:border-pink-500 focus:outline-none focus:text-white focus:bg-gray-700 focus:border-pink-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
