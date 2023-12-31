<div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        
    <div class="flex flex-col sm:flex-row gap-5">
            @if (($pagename == "Employers/Create" || $pagename == "Employers" || $pagename == "Employers/Edit") && (Auth::user()->isDirecteur() || Auth::user()->isManager() || Auth::user()->isAdmin()) )
            <div class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
            @else
            <div class="btn-create items-center hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
            @endif
                @if ($pagename != "Employers/Create" && $pagename != "Employers" )
                    <a class="w-full" href="{{route('employers.create')}}">
                        <div>
                            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Employé</span>
                        </div>
                    </a>
                @else
                    <div>
                        <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Employé</span>
                    </div>
                @endif
            </div>

            <div class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
                @if ( $pagename != "Employers" && $pagename != "Employers/Create" && $pagename != "Employers/Edit")
                    <a href="{{route('employers.index')}}">
                        <div>
                            <i class="relative top-0 leading-normal text-orange-500 fa fa-solid fa-user text-size-sm"></i>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Employés</span>
                        </div>
                    </a>
                @else
                <div>
                    <i class="relative top-0 leading-normal text-orange-500 fa fa-solid fa-user text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Employés</span>
                </div>
                @endif
            </div>

            @if (!isset($link))
                @if (($pagename == "Fonctions/Create" || $pagename == "Fonctions" || $pagename == "Fonctions/Edit") && (Auth::user()->isDirecteur() || Auth::user()->isManager()))
                <div class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
                @else
                <div class="btn-create items-center hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
                @endif
                    @if ($pagename != "Fonctions/Create" && $pagename != "Employers" )
                        <a class="w-full" href="{{route('fonctions.create')}}">
                            <div>
                                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter une Fonction</span>
                            </div>
                        </a>
                    @else
                        <div>
                            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter une Fonction</span>
                        </div>
                    @endif
                </div>

                <div class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
                    @if ( $pagename != "Fonctions" && $pagename != "Fonctions/Create" && $pagename != "Fonctions/Edit")
                        <a href="{{route('fonctions.index')}}">
                            <div>
                                <i class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-briefcase text-size-sm"></i>
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Fonctions</span>
                            </div>
                        </a>
                    @else
                    <div>
                        <i class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-briefcase text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Fonctions</span>
                    </div>
                    @endif
                </div>
            @endif
    </div>

    <div class=" relative shadow-xl flex flex-wrap justify-end items-stretch w-72  max-h-12 transition-all rounded-lg ease">
        @if (!Auth::user()->isParent() && !str_contains($pagename, 'Import'))



        @if (str_contains($pagename, 'Employers'))
            <form class="w-full" action="{{ route('employers.search') }}" method="post">
        @endif
        @if (str_contains($pagename, 'Frequentations'))
            <form class="w-full" action="{{ route('frequentations.search') }}" method="post">
        @endif
        @csrf
        <button type="submit"
            class="text-sm  ease sm-max:text-size-xs leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
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
    @endif</div>

</div>
