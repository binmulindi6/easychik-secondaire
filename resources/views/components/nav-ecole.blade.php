<div class="flex flex-row gap-4">
           
    <div class="flex gap-5">
        @if ($pagename == "Annees Scolaires/Create" || $pagename == "Annees Scolaires" || $pagename == "Annees Scolaires/Edit")
        <div class=" btn-create flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
        @else
        <div class=" btn-create hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
        @endif
            @if ($pagename != "Annees Scolaires" && $pagename != "Annees Scolaires/Create" )
                <a href="{{route('eleves.create')}}">
                    <div>
                        <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Nouvelle Annee Scolaire</span>
                    </div>
                </a>
            @else
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Nouvelle Annee Scolaire</span>
                </div>
            @endif
        </div>

        <div class=" btn-display flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" show-eleves>
            @if ( $pagename != "Annees Scolaires" && $pagename != "Annees Scolaires/Create" && $pagename != "Annees Scolaires/Edit")
                <a href="{{route('annee-scolaires.index')}}">
                    <div>
                        <i class="relative top-0 leading-normal text-orange-500 ni ni-calendar-grid-58 text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Annee Scolaires</span>
                    </div>
                </a>
            @else
            <div>
                <i class="relative top-0 leading-normal text-orange-500 ni ni-calendar-grid-58 text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Annee Scolaires</span>
            </div>
            @endif
        </div>

        @if ($pagename == "Trimestres/Create" || $pagename == "Trimestres" || $pagename == "Trimestres/Edit")
        <div class="btn-create  flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" create-frequentations>
        @else
        <div class="btn-create hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" create-frequentations>
        @endif
            @if ($pagename != "Trimestres" && $pagename != "Trimestres/Create" )
                <a href="{{route('trimestres.create')}}">
                    <div>
                        <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Trimestre</span>
                    </div>
                </a>
            @else
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Trimestre</span>
                </div>
            @endif
        </div>

        <div class="btn-display flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" show-frequentations>
            @if ($pagename != "Trimestres/Create" && $pagename != "Trimestres")
                <a href="{{route('trimestres.index')}}">
                    <div>
                        <i class="relative top-0 leading-normal text-blue-500 fa-duotone ni ni-calendar-grid-58-week text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Trimestres</span>
                    </div>
                </a>
            @else
                <div>
                    <i class="relative top-0 leading-normal text-blue-500 fa-duotone ni ni-calendar-grid-58-week text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Trimestres</span>
                </div>
            @endif
        </div>


        @if ($pagename == "Periodes/Create" || $pagename == "Periodes" || $pagename == "Periodes/Edit")
        <div class="btn-create  flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" create-frequentations>
        @else
        <div class="btn-create hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" create-frequentations>
        @endif
            @if ($pagename != "Periodes" && $pagename != "Periodes/Create" )
                <a href="{{route('periodes.create')}}">
                    <div>
                        <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter une Periode</span>
                    </div>
                </a>
            @else
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter une Periode</span>
                </div>
            @endif
        </div>

        <div class="btn-display flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" show-frequentations>
            @if ($pagename != "Periodes" && $pagename != "Periodes/Create")
                <a href="{{route('periodes.index')}}">
                    <div>
                        <i class="relative top-0 leading-normal text-black ni ni-calendar-grid-58-day text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Periodes</span>
                    </div>
                </a>
            @else
                <div>
                    <i class="relative top-0 leading-normal text-black ni ni-calendar-grid-58-day text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Periodes</span>
                </div>
            @endif
        </div>
    </div>

    @if (!str_contains($pagename, 'Ecole'))
        <div class="relative shadow-xl flex flex-wrap items-stretch w-72  max-h-12 transition-all rounded-lg ease">
            <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
            <i class="fas fa-search" aria-hidden="true"></i>
            </span>
            <input type="text" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Rechercher..." />
        </div>
    @endif

</div>
