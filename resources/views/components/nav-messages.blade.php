<div class="flex flex-col sm:flex-row gap-2 sm:gap-4 z-10">
    
    {{-- @if (Auth::user()->isAdmin()) --}}
        
    
    @if (str_contains($pagename,'Messages'))
        <div
            class="my-btn  btn-create items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @else
            <div
                class="my-btn btn-create items-center hidden  justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
    @endif
    
            <i class="relative top-0 leading-normal text-green-500 fa fa-solid fa-plus text-size-sm"></i>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Rediger</span>
        
    </div>

    <div
        class="my-btn btn-display flex justify-center items-center gap-1 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if ($pagename != 'Messages' && $pagename != 'Messages / Compose' && $pagename != 'Messages / Show')
            <a href="{{ route('users.index') }}">

                    <i class="relative top-0 leading-normal text-black fa fa-solid fa-envelope text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Boite de Reception</span>
                
            </a>
        @else
            {{-- <div class="h-full w-full bg-red-500"> --}}
                <i class="relative top-0 leading-normal text-black fa fa-solid fa-envelope text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Boite de Reception</span>
            {{-- </div> --}}
        @endif
    </div>
    <div
        class="my-btn btn-display-sent flex justify-center items-center gap-1 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @if (!str_contains($pagename,'Messages'))
            <a href="{{ route('encadrements.index') }}">
            
                    <i class="relative top-0 leading-normal text-orange-500 fa fa-solid fa-envelope text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Boite d'envoie</span>
                
            </a>
        @else
        
                <i class="relative top-0 leading-normal text-orange-500 fa fa-solid fa-envelope text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Boite d'envoie</span>
            
        @endif
    </div>
</div>