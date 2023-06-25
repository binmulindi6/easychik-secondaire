<div
    class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
    <div class="flex flex-wrap items-center">
        <div class="flex-none w-auto max-w-full px-3">
            <div
                class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-size-base h-19 w-19 shadow-xs rounded-xl">
                <a href="{{ route('classes.show', $data->id) }}">
                    <i class="text-10 fa-solid fa-chalkboard text-blue-900  "></i>
                </a>
            </div>
        </div>
        <div class="flex-none w-auto max-w-full px-3 my-auto">
            <div class="h-full flex flex-col">
                <span class="font-bold text-5 uppercase dark:text-white">{{ $data->nomComplet() }}</span>
                <span class="uppercase text-3 font-semibold dark:text-white">Nombre d'élèves :
                    {{ count($data->eleves()) }}</span>
                <span class="uppercase text-3 font-semibold dark:text-white">Filles :
                    {{ count($data->filles()) }}</span>
                <span class="uppercase text-3 font-semibold dark:text-white">Garçons :
                    {{ count($data->garcons()) }}</span>
            </div>
        </div>
        <div class="w-full max-w-full px-3 mx-auto mt-2">
            <div class="relative  right-0">
                <ul class="relative flex flex-wrap p-1 list-none rounded-xl" nav-pills role="tablist">
                    @if (isset($print))
                        @if ($print !== false)
                            <li id="btn-export"
                                class=" cursor-pointer z-10 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a class="z-10 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-file-export"></i>
                                    <span class="ml-2">Exporter la liste </span>
                                </a>
                            </li>
                            <li id="joker-print"
                                class=" cursor-pointer z-10 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                                <a class="z-10 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                    role="tab" aria-selected="false">
                                    <i class="fa fa-solid fa-print"></i>
                                    <span class="ml-2">Imprimer la liste </span>
                                </a>
                            </li>
                        @endif
                    @else
                        <li
                            class=" w-20 cursor-pointer z-10 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                            <a href="{{ route('classes.eleves', $data->id) }}"
                                class="z-10 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                nav-link href="javascript:;" role="tab" aria-selected="false">
                                <i class="fa fa-solid fa-chalkboard-user"></i>
                                <span class="ml-2">Eleves</span>
                            </a>
                        </li>
                        <li
                            class=" w-20 cursor-pointer z-10 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                            <a href="{{ route('classes.paiements', $data->id) }}"
                                class="z-10 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                nav-link href="javascript:;" role="tab" aria-selected="false">
                                <i class="fa fa-solid fa-money-bill"></i>
                                <span class="ml-2">Fiche de Paies</span>
                            </a>
                        </li>
                        <li
                            class=" w-20 cursor-pointer z-10 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                            <a href="{{ route('classes.cours', $data->id) }}"
                                class="z-10 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                nav-link href="javascript:;" role="tab" aria-selected="false">
                                <i class="fa fa-solid fa-book"></i>
                                <span class="ml-2">Cours</span>
                            </a>
                        </li>
                    @endif

                    {{-- </li>
            
            <li class="z-10 flex-auto text-center">
              <a class="z-10 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700" nav-link href="javascript:;" role="tab" aria-selected="false">
                <i class="ni ni-settings-gear-65"></i>
                <span class="ml-2">Settings</span>
              </a>
            </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>
