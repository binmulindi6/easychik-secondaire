<div class="flex flex-row justify-between gap-4 sm-max:flex-col sm-max:gap-4 z-10">
    <div class="flex flex-row gap-4 sm-max:justify-center">

        @if (str_contains('Horaires', $pagename))
            <div
                class="btn-display items-center flex justify-center gap-2 bg-white rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
            @else
                <div
                    class="btn-display items-center flex justify-center gap-2 bg-slate-100 rounded-3 cursor-pointer hover:bg-white px-4 py-2 min-h-10 min-w-30">
        @endif
        @if ($pagename != 'Horaires')
            <a href="{{ route('horaires.index') }}">
                <div>
                    <i class="relative top-0 leading-normal text-blue-500 fa fa-regular fa-calendar text-size-sm"></i>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Horaires</span>
                </div>
            </a>
        @else
            <div>
                <i class="relative top-0 leading-normal text-blue-500 fa fa-regular fa-calendar text-size-sm"></i>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none  ease sm-max:text-size-xs">Horaires</span>
            </div>
        @endif
    </div>
</div>
@if (isset($print))
<div class="flex flex-row gap-5 justify-end ">
    <span class="min-w-30 cursor-pointer z-10 text-center px-3 py-1  bg-gray-300 hover:bg-white rounded-xl">
        <span id="joker-print"
            class="z-10 flex items-center gap-2 justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700">
            <i class="fa fa-solid fa-print text-blue-500"></i>
            <span class="mr-2">Imprimer</span>
        </span>
    </span>
</div>
@endif
</div>
