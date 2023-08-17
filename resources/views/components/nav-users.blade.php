<div class="flex flex-row justify-between gap-4">
    <div class="flex flex-row gap-4">

        @if ((Auth::user()->isAdmin() || Auth::user()->isDirecteur()) && !str_contains($pagename, 'Parents'))

            @if (str_contains($pagename, 'Utilisateurs'))
                <div
                    class="items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
                @else
                    <div
                        class="items-center hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @endif
            @if ($pagename === 'Utilisateurs')
                <a class="w-full" href="{{ route('employers.link') }}">
                    <div>
                        <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un
                            Utilisateur</span>
                    </div>
                </a>
            @else
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Utilisateur</span>
                </div>
            @endif
    </div>

    @if ($pagename != 'Utilisateurs' && $pagename != 'Utilisateurs / Create' && $pagename != 'Utilisateurs / Edit')
        <div
            class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            <a href="{{ route('users.index') }}">
                <div>
                    <i class="relative top-0 leading-normal text-black fa fa-solid fa-user text-size-sm"></i>
                    @if ($pagename === 'Enseignants')
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Enseignants</span>
                    @else
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Utilisateurs</span>
                    @endif
                </div>
            </a>
        @else
            <div
                class="btn-display items-center flex justify-center gap-2 bg-white rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
                <div>
                    <i class="relative top-0 leading-normal text-black fa fa-solid fa-user text-size-sm"></i>
                    @if ($pagename === 'Enseignants')
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Enseignants</span>
                    @else
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Utilisateurs</span>
                    @endif
                </div>
    @endif
</div>

@if (!Auth::user()->isAdmin())
    @if (str_contains($pagename, 'Encadrements'))
        <div
            class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @else
            <div
                class="btn-create items-center hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @endif
    @if ($pagename === 'Encadrements / Edit')
        <a class="w-full" href="{{ route('encadrements.create') }}">
            <div>
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Encadrements</span>
            </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Encadrements</span>
        </div>
    @endif
    </div>

    <div
        class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if (!str_contains($pagename, 'Encadrements'))
            <a href="{{ route('encadrements.index') }}">
                <div>
                    <i class="relative top-0 leading-normal text-orange-500 fa fa-solid fa-user text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Encadrements</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-orange-500 fa fa-solid fa-user text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Encadrements</span>
            </div>
        @endif
    </div>
@endif
@endif

@if (!Auth::user()->isAdmin())
    @if (!str_contains($pagename, 'Enseignants') && !str_contains($pagename, 'Encadrements'))

        @if (str_contains($pagename, 'Parents'))
            <div
                class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class="btn-create items-center hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif

        @if ($pagename === 'Parents / Edit')
            <a class="w-full" href="{{ route('parents.create') }}">
                <div>
                    <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Parent</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Parent</span>
            </div>
        @endif
        </div>

        <div @if (!str_contains($pagename, 'Parents')) class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        <a href="{{ route('parents.index') }}">
            <div>
                <i class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-user text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Parents</span>
            </div>
        </a>
        @else
        <div
            class="btn-display items-center flex justify-center gap-2 bg-white rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
                <div>
                    <i class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-user text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Parents</span>
                </div> @endif
            </div>
    @endif
@endif

</div>


<div class=" relative shadow-xl flex flex-wrap justify-end items-stretch w-72  max-h-12 transition-all rounded-lg ease">
    @if (!Auth::user()->isParent() && !str_contains($pagename, 'Import'))
        @if (str_contains($pagename, 'Enseignants'))
            <form class="w-full" action="{{ route('users.search.enseignant') }}" method="post">
        @endif
        @if (str_contains($pagename, 'Users'))
            <form class="w-full" action="{{ route('users.search') }}" method="post">
        @endif
        @if (str_contains($pagename, 'Encadrements'))
            <form class="w-full" action="{{ route('encadrements.search') }}" method="post">
        @endif
        @if (str_contains($pagename, 'Parents'))
            <form class="w-full" action="{{ route('parents.search') }}" method="post">
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
                placeholder="Rechercher..." />
        @endif
        </form>
    @endif
</div>

</div>
