<div class="relative w-full">

    <div
        class="relative flex flex-col flex-auto min-w-0 p-4  overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-auto max-w-full px-3">
                <div
                    class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-size-base h-19 w-19 rounded-xl">
                    <img src="{{ $data->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png') }}"
                        alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                </div>
            </div>
            <div class="flex-none w-auto max-w-full px-3 my-auto">
                <div class="h-full">
                    <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                        {{ $data->matricule }}
                    </p>
                    <h5 class="mb-1 dark:text-white">{{ $data->nom . ' ' . $data->prenom }}</h5>
                    <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                        {{ $data->sexe === 'M' ? 'Masculim' : 'Feminim' }}
                    </p>
                    <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                        {{ $data->classe(false) === null ? null : $data->classe(false) }}
                    </p>
                </div>
            </div>
            @if (isset($eleves) && isset($index))
                <div class="px-3 mx-auto mt-4 sm:my-auto sm:mr-0  md:flex-none">
                    <div class="relative
                right-0">
                    </div>
                    <ul class="relative flex flex-wrap gap-2  list-none " role="tablist">
                        <li
                            class="btn-identity cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                            <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                role="tab" aria-selected="false">
                                <i class="fa fa-solid fa-id-card"></i>
                                <span class="ml-2">Identité Complete</span>
                            </a>
                        </li>
                        <li
                            class="btn-next cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                            <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                                href="{{ route('eleves.show', $eleves->count() === $index + 1 ? $eleves[0]->id : $eleves[$index + 1]->id) }}"
                                role="tab" aria-selected="false" title="Eleve Suivant">
                                <span class="mr-2">Suivant</span>
                                <i class="fa fa-solid fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>