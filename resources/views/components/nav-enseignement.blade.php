<div class="flex flex-col sm:flex-row items-center justify-between gap-4">

    <div class="flex flex-col sm:flex-row items-center  gap-5">

        @if ($pagename == 'Cours/Create' || $pagename == 'Cours' || $pagename == 'Cours/Edit')
            <div
                class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class="btn-create items-center hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif
        @if ($pagename != 'Cours/Create' && $pagename != 'Cours')
            <a class="w-full" href="{{ route('cours.create') }}">
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Cours</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Cours</span>
            </div>
        @endif
    </div>

    <div
        class="cours btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if ($pagename != 'Cours' && $pagename != 'Cours/Create' && $pagename != 'Cours/Edit')
            <a href="{{ route('cours.index') }}">
                <div>
                    <i class="relative top-0 leading-normal text-blacksolid fa fa-solid fa-book text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Cours</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-black fa fa-solid fa-book text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Cours</span>
            </div>
        @endif
    </div>

    @if ($pagename == 'Categories Cours/Create' || $pagename == 'Categories Cours' || $pagename == 'Categories Cours/Edit')
        <div
            class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @else
            <div
                class="btn-create items-center hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @endif
    @if ($pagename != 'Categories Cours/Create' && $pagename != 'Categories Cours')
        <a class="w-full" href="{{ route('categorie-cours.create') }}">
            <div>
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter une Categorie des
                    Cours</span>
            </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter une Categorie des Cours</span>
        </div>
    @endif
</div>

<div
    class="categorie-cours btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @if ($pagename != 'Categories Cours' && $pagename != 'Categories Cours/Create' && $pagename != 'Categories Cours/Edit')
        <a href="{{ route('categorie-cours.index') }}">
            <div>
                <i class="relative top-0 leading-normal text-red-500 fa fa-solid fa-book text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Categories des Cours</span>
            </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-red-500 fa fa-solid fa-book text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Categories des Cours</span>
        </div>
    @endif
</div>

@if ($pagename == 'Enseignements / Create' || $pagename == 'Enseignements'  || $pagename == 'Enseignements / Edit')
    <div
        class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @else
        <div
            class="btn-create items-center hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
@endif
@if ($pagename != 'Enseignements / Create' && $pagename != 'Enseignements' )
    <a class="w-full" href="{{ route('enseignements.create') }}">
        <div>
            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Enseignements</span>
        </div>
    </a>
@else
    <div>
        <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Enseignements</span>
    </div>
@endif
</div>

<div
    class="categorie-cours btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @if ($pagename != 'Enseignements'  && $pagename != 'Enseignements / Create' && $pagename != 'Enseignements / Edit')
        <a href="{{ route('enseignements.index') }}">
            <div>
                <i class="relative top-0 leading-normal text-red-500 fa fa-solid fa-book text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Enseignements</span>
            </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-red-500 fa fa-solid fa-book text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Enseignements</span>
        </div>
    @endif
</div>



</div>

<div
    class="relative shadow-xl justify-end flex flex-col sm:flex-row gap-4  items-stretch transition-all rounded-lg  ease sm-max:text-size-xs sm-max:w-full px-4">
    @if (!Auth::user()->isParent() && !str_contains($pagename, 'Import'))
        @if (str_contains($pagename, 'Cours'))
            <form class="w-full" action="{{ route('cours.search') }}" method="post">
        @endif
        @csrf
        <button type="submit"
            class="text-sm  ease sm-max:text-size-xs leading-5.6 absolute z-50 -ml-px flex h-15 items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
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
    @endif
</div>


</div>

<script>
    const page_name = "{{ $pagename }}";

    const btn_classes = document.querySelector('.classes');
    const btn_categorie_cours = document.querySelector('.categorie-cours');
    const btn_cours = document.querySelector('.cours');

    switch (page_name) {
        case "Classes":
            btn_classes.classList.remove("bg-slate-100");
            btn_classes.classList.add("bg-white", "true");
            break;
        case "Categories Cours":
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
