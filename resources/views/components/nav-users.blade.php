<div class="flex flex-row gap-4">
    @if ($pagename == 'Utilisateurs/Create' || $pagename == 'Utilisateurs' || $pagename == 'Utilisateurs/Edit')
        <div
            class=" btn-create flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @else
            <div
                class="btn-create hidden flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @endif
    @if ($pagename != 'Utilisateurs/Create' && $pagename != 'Utilisateurs')
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
    class="btn-display flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @if ($pagename != 'Utilisateurs' && $pagename != 'Utilisateurs/Create' && $pagename != 'Utilisateurs/Edit')
        <a href="{{ route('users.index') }}">
            <div>
                <i class="relative top-0 leading-normal text-orange-500 ni ni-single-02 text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Utilisateurs</span>
            </div>
        </a>
    @else
        <div>
            <i class="relative top-0 leading-normal text-orange-500 ni ni-single-02 text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Utilisateurs</span>
        </div>
    @endif
</div>

</div>
