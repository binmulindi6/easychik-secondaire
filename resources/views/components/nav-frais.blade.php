<div class="flex flex-row justify-between">
    <div class="flex flex-row gap-4">
        @if (str_contains($pagename, 'Frais'))
            @if (str_contains($pagename,'Frais'))
            <div
                class="my-btn  btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class="my-btn btn-create items-center flex  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif

                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Frais</span>
            
        </div>

        <div
            class="my-btn btn-display flex justify-center items-center gap-1 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @if ($pagename != 'Frais' && $pagename != 'Frais / Create' && $pagename != 'Frais / Show')
                <a href="{{ route('users.index') }}">

                        <i class="relative top-0 leading-normal text-black fa fa-solid fa-money-bill text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Frais</span>
                    
                </a>
            @else
                {{-- <div class="h-full w-full bg-red-500"> --}}
                    <i class="relative top-0 leading-normal text-black fa fa-solid fa-money-bill text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Frais</span>
                {{-- </div> --}}
            @endif
        </div>
        @else
            @if (str_contains($pagename,'Paiemenent'))
            <div
                class="my-btn items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class="my-btn items-center flex  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif
        @if ($pagename !== "Paiements / Create")
        <a href="{{ route('paiements.create') }}">
        @else
        <a>    
        @endif
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Enregistrer un Paiement</span>
        </a>
            
        </div>

        <div
            class="my-btn btn-display flex justify-center items-center gap-1 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @if ($pagename != 'Paiements' && $pagename != 'Paiements / Create' && $pagename != 'Paiements / Show')
                <a href="{{ route('paiements.index') }}">

                        <i class="relative top-0 leading-normal text-black fa fa-solid fa-money-bill text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Paiements</span>
                    
                </a>
            @else
                {{-- <div class="h-full w-full bg-red-500"> --}}
                    <i class="relative top-0 leading-normal text-black fa fa-solid fa-money-bill text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Paiements</span>
                {{-- </div> --}}
            @endif
        </div>
        @endif

    </div>
        @if ($pagename === 'Paiements / Facture')
        <span
            class="justify-end min-w-30 cursor-pointer z-30 text-center px-3 py-1  bg-gray-300 hover:bg-white rounded-xl">
            <span id="joker-print" class="z-30 flex items-center gap-2 justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700">
                <i class="fa fa-solid fa-print text-blue-500"></i>
                <span class="mr-2">Imprimer</span>
            </span>
        </span>
        @endif

        {{-- @if (!Auth::user()->isParent()) --}}
        @if (str_contains($pagename, 'Paiements'))
            <div
                class="relative shadow-xl justify-end flex flex-wrap items-stretch max-h-12 transition-all rounded-lg  ease sm-max:text-size-xs sm-max:w-full">
                
                <form class="w-full" action="{{ route('paiements.search') }}" method="post">
                    @csrf
                    <button type="submit"
                        class="text-sm  ease sm-max:text-size-xs leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent pb-2 px-2 text-center font-normal text-slate-500 transition-all">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                    @if (isset($search))
                        <input type="text" name="search" value="{{ $search }}"
                            class="pl-9 text-sm focus:shadow-primary-outline  ease sm-max:text-size-xs w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                            placeholder="Search..." />
                    @else
                        <input type="text" name="search"
                            class="pl-9 text-sm w-full focus:shadow-primary-outline  ease sm-max:text-size-xs leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                            placeholder="Search..." />
                    @endif
                </form>
            </div>
        @endif

</div>
