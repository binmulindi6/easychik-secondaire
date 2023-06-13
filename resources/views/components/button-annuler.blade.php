@if (isset($back))
<button type='reset' onclick="javascript:history.go(-1)" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-redr-700 active:bg-redr-900 focus:outline-none focus:border-redr-900 focus:ring ring-redr-300 disabled:opacity-25 transition ease-in-out duration-150']) }}    >
    Annuler
</button>
@else
    <button type='reset' {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-redr-700 active:bg-redr-900 focus:outline-none focus:border-redr-900 focus:ring ring-redr-300 disabled:opacity-25 transition ease-in-out duration-150']) }}    >
        Annuler
    </button>
@endif

