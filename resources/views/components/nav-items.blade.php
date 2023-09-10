<div class="flex flex-row justify-between gap-4">

    <div class="flex  gap-5">
        @if (
            $pagename == 'Articles / Create' ||
                $pagename == 'Articles' ||
                $pagename == 'Articles / Edit' ||
                $pagename == 'Articles / Link')
            <div
                class=" btn-create flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class="btn-create hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif
        @if ($pagename != 'Articles / Create' && $pagename != 'Articles')
            <a class="w-full" href="{{ route('articles.create') }}">
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Article</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Article</span>
            </div>
        @endif
    </div>

    <div
        class=" cours btn-display flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if ($pagename != 'Articles' && $pagename != 'Articles / Create' && $pagename != 'Articles / Edit')
            <a href="{{ route('articles.index') }}">
                <div>
                    <i class="fa fa-solid fa-boxes-stacked text-black"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Stock</span>
                </div>
            </a>
        @else
            <div>
                <i class="fa fa-solid fa-boxes-stacked text-black"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Stock</span>
            </div>
        @endif
    </div>

    {{-- <div class="flex  gap-5"> --}}
        @if (
            $pagename == 'Entrées / Create' ||
                $pagename == 'Entrées' ||
                $pagename == 'Entrées / Edit' ||
                $pagename == 'Entrées / Link')
            <div
                class="flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class=" hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif

            <a class="w-full" href="{{ route('articles.link') }}">
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Enregister une Entrée</span>
                </div>
            </a>

    </div>

    <div
        class=" categorie-cours flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if ($pagename != 'Entrées' && $pagename != 'Entrées / Create' && $pagename != 'Entrées / Edit')
            <a href="{{ route('entrees.index') }}">
                <div>
                    <i class="fa fa-solid fa-boxes-stacked text-blue-900"></i>
                    <i class="fa fa-solid fa-arrow-left text-blue-900"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Entrées</span>
                </div>
            </a>
        @else
            <div>
                <i class="fa fa-solid fa-boxes-stacked text-blue-900"></i>
                <i class="fa fa-solid fa-arrow-left text-blue-900"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Entrées</span>
            </div>
        @endif
    </div>

    {{-- <div class="flex  gap-5"> --}}
        @if (
            $pagename == 'Sorties / Create' ||
                $pagename == 'Sorties' ||
                $pagename == 'Sorties / Edit' ||
                $pagename == 'Sorties / Link')
            <div
                class=" flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class=" hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif

            <a class="w-full" href="{{ route('articles.link.sortie') }}">
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Enregister une Sortie</span>
                </div>
            </a>
    </div>

    <div
        class=" cours flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if ($pagename != 'Sorties' && $pagename != 'Sorties / Create' && $pagename != 'Sorties / Edit')
            <a href="{{ route('sorties.index') }}">
                <div>
                    <i class="fa fa-solid fa-boxes-stacked text-red-500"></i>
                    <i class="fa fa-solid fa-arrow-right text-red-500"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Sorties</span>
                </div>
            </a>
        @else
            <div>
                <i class="fa fa-solid fa-boxes-stacked text-red-500"></i>
                <i class="fa fa-solid fa-arrow-right text-red-500"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Sorties</span>
            </div>
        @endif
    </div>

</div>

<div class="relative shadow-xl justify-end flex flex-wrap items-stretch max-h-12 transition-all rounded-lg ease">
    <form class="" action="{{ route('articles.search') }}" method="post">
        @csrf
        <button type="submit"
            class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
            <i class="fas fa-search" aria-hidden="true"></i>
        </button>
        @if (isset($search))
            <input type="text" name="search" value="{{ $search }}"
                class="pl-9 text-sm focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                placeholder="Search..." />
        @else
            <input type="text" name="search"
                class="pl-9 text-sm focus:shadow-primary-outline ease w-full leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                placeholder="Search..." />
        @endif
    </form>
</div>


</div>

<script>
    const page_name = "{{ $pagename }}";

    const btn_classes = document.querySelector('.classes');
    const btn_categorie_cours = document.querySelector('.categorie-cours');
    const btn_cours = document.querySelector('.cours');

    switch (page_name) {
        case "Articles":
            btn_cours.classList.remove("bg-slate-100");
            btn_cours.classList.add("bg-white", "true");
            break;
        case "Entrées":
            btn_categorie_cours.classList.remove("bg-slate-100");
            btn_categorie_cours.classList.add("bg-white", "true");
            break;
        case "Sorties":
            btn_classes.classList.remove("bg-slate-100");
            btn_classes.classList.add("bg-white", "true");
            break;

            /*default:
                break;*/
    }
</script>
