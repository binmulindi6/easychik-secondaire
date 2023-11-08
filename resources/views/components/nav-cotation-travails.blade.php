<div class="flex flex-row justify-between gap-4 sm-max:flex-col sm-max:gap-4 z-10">
    <div class="flex flex-row gap-4 sm-max:justify-center">

        @if (str_contains('Cotations Evaluations', $pagename) || str_contains('Cotations Evaluations / Search', $pagename))
            <div
                class="btn-display items-center flex justify-center gap-2 bg-white rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif
        @if ($pagename != 'Cotations Evaluations')
            @if (isset($classe))
                <a href="{{ route('cotations.evaluations.classe',$classe->id) }}">
                @else
                <a href="{{ route('cotations.index') }}">
            @endif
            <div>
                <i class="relative top-0 leading-normal text-blue-500 fa fa-regular fa-clipboard text-size-sm"></i>
                <span
                    class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Evaluations</span>
            </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-blue-500 fa fa-regular fa-clipboard text-size-sm"></i>
                <span
                    class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Evaluations</span>
            </div>
        @endif
    </div>


    @if (str_contains('Cotations Examens', $pagename) || str_contains('Cotations Examens / Search', $pagename))
        <div
            class="btn-display items-center flex justify-center gap-2 bg-white rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @else
            <div
                class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @endif
    @if ($pagename != 'Cotations Examens')
        @if (isset($classe))
            <a href="{{ route('cotations.examens.classe',$classe->id) }}">
            @else
            <a href="{{ route('cotations.examens') }}">
        @endif
        <div>
            <i class="relative top-0 leading-normal text-black fa fa-solid fa-clipboard text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Examens</span>
        </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-black fa fa-solid fa-clipboard text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Examens</span>
        </div>
    @endif
</div>



</div>

<div
    class="relative shadow-xl justify-end flex flex-wrap items-stretch max-h-12 transition-all rounded-lg  ease sm-max:text-size-xs sm-max:w-full">
    @if (isset($eleves) && isset($evaluation))
        <form class="w-full" action="{{ route('cotations.evaluations.eleves.search', $evaluation) }}" method="post">
    @endif
    @if (isset($eleves) && isset($examen))
        <form class="w-full" action="{{ route('cotations.examens.eleves.search', $examen) }}" method="post">
    @endif
    @if (str_contains($pagename, 'Evaluations'))
        <form class="w-full" action="{{ route('cotations.evaluations.search') }}" method="post">
    @endif
    @if (str_contains($pagename, 'Examens'))
        <form class="w-full" action="{{ route('cotations.examens.search') }}" method="post">
    @endif
    @csrf
    @if (isset($classe))
        <input type="hidden" name="classe_id" value="{{$classe->id}}">
    @endif
    <button type="submit"
        class="text-sm  ease sm-max:text-size-xs  leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
        <i class="text-black fa fa-solid fa-search" aria-hidden="true"></i>
    </button>
    @if (isset($search))
        <input type="text" name="search" value="{{ $search }}"
            class="pl-9 text-sm focus:shadow-primary-outline  ease sm-max:text-size-xs  w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
            placeholder="Search..." />
    @else
        <input type="text" name="search"
            class="pl-9 text-sm w-full focus:shadow-primary-outline  ease sm-max:text-size-xs  leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
            placeholder="Search..." />
    @endif
    </form>
</div>

</div>
