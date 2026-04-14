<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-full border border-emerald-900/10 bg-emerald-950 px-5 py-3 text-sm font-semibold text-white shadow-[0_14px_30px_-18px_rgba(17,24,39,0.9)] transition duration-200 hover:-translate-y-0.5 hover:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 active:translate-y-0']) }}>
    {{ $slot }}
</button>
