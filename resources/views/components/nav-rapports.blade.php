<div class="flex flex-row justify-between">
    <div class="flex flex-row gap-4">

        @if (!str_contains($pagename, 'Rapports / Annuel'))
            <div
                class="my-btn btn-display flex justify-center items-center gap-1 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
                <a href="{{ route('rapports.annuel') }}">
                    <i class="relative top-0 leading-normal text-black fa fa-solid fa-list text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Rapport Annuel</span>

                </a>
            @else
                <div
                    class="my-btn btn-display flex justify-center items-center gap-1 bg-white rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
                    {{-- <div class="h-full w-full bg-red-500"> --}}
                    <i class="relative top-0 leading-normal text-black fa fa-solid fa-list text-size-sm"></i>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Rapport Annuel</span>
                    {{-- </div> --}}
        @endif
    </div>

    @if (!str_contains($pagename, 'Rapports / Periodique'))
        <div
            class="my-btn btn-display flex justify-center items-center gap-1 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            <a href="{{ route('rapports.index') }}">

                <i class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-list text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Rapport Periodique</span>

            </a>
            @else
        <div 
                class="my-btn btn-display flex justify-center items-center gap-1 bg-white rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
                {{-- <div class="h-full w-full bg-red-500"> --}}
                <i class="relative top-0 leading-normal text-black fa fa-solid fa-list text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Rapport Periodique</span>
                {{-- </div> --}}
    @endif
</div>

</div>
{{-- @if ($pagename === 'Paiements / Facture') --}}
<div class="flex flex-row gap-5 justify-end ">
    <span class="min-w-30 cursor-pointer z-10 text-center px-3 py-1  bg-gray-300 hover:bg-white rounded-xl">
        <span id="btn-export"
            class="z-10 flex items-center gap-2 justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700">
            <i class="fa fa-solid fa-download text-blue-500"></i>
            <span class="mr-2">Exporter ce Rapport</span>
        </span>
    </span>
    <span class="min-w-30 cursor-pointer z-10 text-center px-3 py-1  bg-gray-300 hover:bg-white rounded-xl">
        <span id="joker-print"
            class="z-10 flex items-center gap-2 justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700">
            <i class="fa fa-solid fa-print text-blue-500"></i>
            <span class="mr-2">Imprimer ce Rapport</span>
        </span>
    </span>
</div>
{{-- @endif --}}
</div>
