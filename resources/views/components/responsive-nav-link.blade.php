@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-2xl border border-emerald-900/10 bg-emerald-950 px-4 py-3 text-start text-sm font-medium text-white transition duration-200'
            : 'block w-full rounded-2xl border border-transparent px-4 py-3 text-start text-sm font-medium text-slate-600 transition duration-200 hover:border-stone-200 hover:bg-white hover:text-slate-950';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
