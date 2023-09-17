<div class="flex flex-col items-center sm:flex-row justify-between gap-4 w-full">
            
    <div class="flex flex-col sm:flex-row gap-5">
        @if ((str_contains('Classes',$pagename) || $pagename === "Classes / Edit" || $pagename === "Classes / Create") && !Auth::user()->isSecretaire())
            <div class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
            @else
            <div class="btn-create items-center hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
            @endif
                @if ($pagename != "Classes / Create" && $pagename != "Classes" )
                    <a class="w-full" href="{{route('classes.create')}}">
                        <div>
                            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter une Classe</span>
                        </div>
                    </a>
                @else
                    <div>
                        <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter une Classe</span>
                    </div>
                @endif
            </div>

            <div class=" classes btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
                @if ( $pagename != "Classes" && $pagename != "Classes / Create")
                    <a href="{{route('classes.index')}}">
                        <div>
                            <i class="relative top-0 leading-normal text-orange-500 fa fa-solid fa-chalkboard text-size-sm"></i>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Classes</span>
                        </div>
                    </a>
                @else
                <div>
                    <i class="relative top-0 leading-normal text-orange-500 fa fa-solid fa-chalkboard text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Classes</span>
                </div>
                @endif
            </div>
            @if (str_contains('Niveaux',$pagename) && !Auth::user()->isSecretaire())
            <div class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
            @else
            <div class="btn-create items-center hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
            @endif
                @if ($pagename != "Niveaux / Create" && $pagename != "Niveaux" )
                    <a class="w-full" href="{{route('niveaux.create')}}">
                        <div>
                            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Niveau</span>
                        </div>
                    </a>
                @else
                    <div>
                        <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Niveau</span>
                    </div>
                @endif
            </div>
            @if (!Auth::user()->isSecretaire())
                
            <div class=" btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30" >
                @if ( !str_contains("Niveaux",$pagename))
                    <a href="{{route('niveaux.index')}}">
                        <div>
                            <i class="relative top-0 leading-normal text-slate-800 fa fa-solid fa-line-chart text-size-sm"></i>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Niveaux</span>
                        </div>
                    </a>
                @else
                <div>
                    <i class="relative top-0 leading-normal text-slate-800 fa fa-solid fa-line-chart text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Niveaux</span>
                </div>
                @endif
            </div>
            @endif

    </div>

    <div class="relative shadow-xl flex flex-wrap items-stretch w-72  max-h-12 transition-all rounded-lg ease">
        <span class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
          <i class="fas fa-search" aria-hidden="true"></i>
        </span>
        <input type="text" class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Rechercher..." />
    </div>


</div>

<script>
    const page_name = "{{ $pagename }}";

    const btn_classes = document.querySelector('.classes');
    const btn_categorie_cours = document.querySelector('.niveaux');
    const btn_cours = document.querySelector('.cours');

    switch (page_name) {
        case "Classes":
        btn_classes.classList.remove("bg-slate-100");
        btn_classes.classList.add("bg-white", "true");
            break;
        case "Niveaux":
        btn_categorie_cours.classList.remove("bg-slate-100");
        btn_categorie_cours.classList.add("bg-white", "true");
            break;
        case "Cours":
        btn_cours.classList.remove("bg-slate-100");
        btn_cours.classList.add("bg-white", "true");
            break;
    
        /*default:
            break;*/
    }


</script>