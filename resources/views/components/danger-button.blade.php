<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-full border border-rose-200 bg-rose-50 px-4 py-2.5 text-sm font-semibold text-rose-800 transition duration-200 hover:-translate-y-0.5 hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
