<div
    class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-auto max-w-full px-3">
            <div
                class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-size-base h-19 w-19 rounded-xl">
                @if (Auth::user()->parrain_id === null)
                    <img src="{{ $self->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png') }}"
                        alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                @else
                    <img src="{{ $data->parrain->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png') }}"
                        alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                @endif
            </div>
        </div>
        <div class="flex-none w-auto max-w-full px-3 my-auto">
            <div class="h-full">
                @if (Auth::user()->parrain_id === null)

                    <p class="mb-0 font-semibold text-4 leading-normal dark:text-white dark:opacity-60">
                        {{ $self->matricule }}</p>
                    <h5 class="mb-0 dark:text-white">{{ $self->nomComplet() }}</h5>
                    <p class="mb-0 font-semibold text-4 leading-normal dark:text-white dark:opacity-60">
                        {{ $self->sexe === 'M' ? 'Masculin' : 'Feminin' }}
                    </p>
                    @foreach ($self->fonctions as $fonction)
                        <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-90 text-size-sm uppercase">
                            {{ $fonction->nom }}</p>
                        {{-- <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">{{$data->employer->fonctions[0]->nom}}</p> --}}
                    @endforeach
                    @if ($self->isEnseignant())
                        @if ($self->classe())
                            <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                                <a class="hover:text-blue-700 " href="{{ route('classes.show', $self->classe->id) }}">
                                    {{ $self->classe->nomComplet() }}
                                </a>
                            </p>
                        @else
                        @endif
                    @endif
                @else
                    <h5 class="mb-1 dark:text-white">{{ $data->parrain->nomComplet() }}</h5>
                @endif
            </div>
        </div>
        <div class="px-3 mx-auto mt-4 sm:my-auto sm:mr-0  md:flex-none">
            <div class="relativeright-0">
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

                {{-- <li class="z-30 flex-auto text-center">
                <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                nav-link href="javascript:;" role="tab" aria-selected="false">
                <i class="ni ni-email-83"></i>
                            <span class="ml-2">Messages</span>
                        </a>
                      </li>
                      <li class="z-30 flex-auto text-center">
                        <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                        nav-link href="javascript:;" role="tab" aria-selected="false">
                        <i class="ni ni-settings-gear-65"></i>
                        <span class="ml-2">Settings</span>
                      </a>
                    </li> --}}

                <li id="{{ route('employers.carte', $self->id) }}"
                    class="btn-carte cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                    <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                        role="tab" aria-selected="false">
                        <i class="fa fa-solid fa-id-card"></i>
                        <span class="ml-2">Carte de Service</span>
                    </a>
                </li>
                <li
                    class="btn-next cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                    <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                        href="{{ route('employers.show', $employers->count() === $index + 1 ? $employers[0]->id : $employers[$index + 1]->id) }}"
                        role="tab" aria-selected="false" title="Eleve Suivant">
                        <span class="mr-2">Suivant</span>
                        <i class="fa fa-solid fa-arrow-right"></i>
                    </a>
                </li>
        </div>
    </div>
</div>
