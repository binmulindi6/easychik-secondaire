<div class="flex flex-row gap-4">
    
    @if (Auth::user()->isAdmin())
        
    
    @if (str_contains($pagename,'Utilisateurs'))
        <div
            class=" btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @else
            <div
                class="btn-create items-center hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @endif
    @if ($pagename === 'Utilisateurs / Edit')
        <a class="w-full" href="{{ route('users.create') }}">
            <div>
                <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Utilisateur</span>
            </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajouter un Utilisateur</span>
        </div>
    @endif
    </div>

    <div
        class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if ($pagename != 'Utilisateurs' && $pagename != 'Utilisateurs / Create' && $pagename != 'Utilisateurs / Edit')
            <a href="{{ route('users.index') }}">
                <div>
                    <i class="relative top-0 leading-normal text-black fa fa-solid fa-user text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Utilisateurs</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-black fa fa-solid fa-user text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Utilisateurs</span>
            </div>
        @endif
    </div>

    @if (str_contains($pagename,'Encadrements'))
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
        @if (!str_contains($pagename,'Encadrements'))
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
    @if (str_contains($pagename,'Parents'))
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

    <div
        class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if (!str_contains($pagename,'Parents'))
            <a href="{{ route('parents.index') }}">
                <div>
                    <i class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-user text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Parents</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-user text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Parents</span>
            </div>
        @endif
    </div>

</div>
