<div class="flex flex-row justify-between gap-4 sm-max:flex-col sm-max:gap-4 z-10">
    <div class="flex flex-row gap-4 sm-max:justify-center">
        @if (str_contains('Eleves', $pagename))
            <div
                class=" btn-create flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class="btn-create hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif
        @if ($pagename != 'Eleves/Create' && $pagename != 'Eleves')
            <a class="w-full" href="{{ route('eleves.create') }}">
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Ajouter un
                        Eleve</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Ajouter un
                    Eleve</span>
            </div>
        @endif
    </div>

    <div
        class="btn-display flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if ($pagename != 'Eleves' && $pagename != 'Eleves/Create' && $pagename != 'Eleves/Edit')
            <a href="{{ route('eleves.index') }}">
                <div>
                    <i class="relative top-0 leading-normal text-orange-500 ni ni-single-02 text-size-sm"></i>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Eleves</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-orange-500 ni ni-single-02 text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Eleves</span>
            </div>
        @endif
    </div>

    @if (str_contains('Frequentations', $pagename))
        <div
            class="btn-create  flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @else
            <div
                class="btn-create hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @endif
    @if ($pagename != 'Frequentations' && $pagename != 'Frequentations/Create')
        <a href="{{ route('frequentations.create') }}">
            <div>
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Ajouter une
                    Frequentation</span>
            </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Ajouter une
                Frequentation</span>
        </div>
    @endif
</div>

<div
    class="btn-display flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @if ($pagename != 'Frequentations' && $pagename != 'Frequentations/Create')
        <a href="{{ route('frequentations.index') }}">
            <div>
                <i class="relative top-0 leading-normal text-black ni ni-single-02 text-size-sm"></i>
                <span
                    class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Frequentations</span>
            </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-black ni ni-single-02 text-size-sm"></i>
            <span
                class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Frequentations</span>
        </div>
    @endif
</div>



</div>

<div
    class="relative shadow-xl justify-end flex flex-wrap items-stretch max-h-12 transition-all rounded-lg  ease sm-max:text-size-xs sm-max:w-full">
    @if (str_contains($pagename, 'Eleves'))
        <form class="w-full" action="{{ route('eleves.search') }}" method="post">
    @endif
    @if (str_contains($pagename, 'Frequentations'))
        <form class="w-full" action="{{ route('frequentations.search') }}" method="post">
    @endif
    @csrf
    <button type="submit"
        class="text-sm  ease sm-max:text-size-xs sm-max:text-size-xs leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
        <i class="fas fa-search" aria-hidden="true"></i>
    </button>
    @if (isset($search))
        <input type="text" name="search" value="{{ $search }}"
            class="pl-9 text-sm focus:shadow-primary-outline  ease sm-max:text-size-xs sm-max:text-size-xs w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
            placeholder="Search..." />
    @else
        <input type="text" name="search"
            class="pl-9 text-sm w-full focus:shadow-primary-outline  ease sm-max:text-size-xs sm-max:text-size-xs leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
            placeholder="Search..." />
    @endif
    </form>
</div>

</div>
