<div
    class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-auto max-w-full px-3">
            <div id="btn-pop-up"
                class="relative cursor-pointer hover:bg-slate-100  inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-size-base h-19 w-19 rounded-xl">
                @if (Auth::user()->parrain_id === null)
                    <img src="{{ $data->employer->avatar !== null ? asset('storage/' . $data->employer->avatar) : ($data->employer->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png')) }}"
                        alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                @else
                    <img src="{{ $data->parrain->avatar !== null ? asset('storage/' . $data->parrain->avatar) : ($data->parrain->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png')) }}"
                        alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                @endif
            </div>
        </div>
        <div class="flex-none w-auto max-w-full px-3 my-auto">
            <div class="h-full">
                @if (Auth::user()->parrain_id === null)

                    <h5 class="mb-1 dark:text-white">{{ $data->employer->nomComplet() }}</h5>
                    @if ($data->employer->fonctions)
                        @foreach ($data->employer->fonctions as $fonction)
                            <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                                {{ $fonction->nom }}</p>
                            {{-- <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">{{$data->employer->fonctions[0]->nom}}</p> --}}
                        @endforeach
                    @endif
                    @if ($data->isEnseignant())
                        @if ($data->classe())
                            <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">
                                {{ $data->classe->nomComplet() }}</p>
                        @else
                        @endif
                    @endif
                @else
                    <h5 class="mb-1 dark:text-white">{{ $data->parrain->nomComplet() }}</h5>
                @endif
            </div>
        </div>
        <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
            <div class="relative right-0">
                <ul class="relative flex flex-wrap p-1 list-none bg-gray-50 rounded-xl" nav-pills role="tablist">
                    <li
                        class="btn-identity cursor-pointer z-30 flex-auto text-center px-3 py-1 :bg-gray-100 hover:bg-gray-300 rounded-xl">
                        <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                            role="tab" aria-selected="false">
                            <i class="fa fa-solid fa-id-card"></i>
                            <span class="ml-2">Informations Compte</span>
                        </a>
                    {{-- </li>
                    <li class="z-30 flex-auto text-center">
                        <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700"
                            nav-link href="javascript:;" role="tab" aria-selected="false">
                            <i class="ni ni-email-83"></i>
                            <span class="ml-2">Messages</span>
                        </a>
                    </li> --}}
                    {{-- <li class="z-30 flex-auto text-center">
              <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-colors ease-in-out border-0 rounded-lg bg-inherit text-slate-700" nav-link href="javascript:;" role="tab" aria-selected="false">
                <i class="ni ni-settings-gear-65"></i>
                <span class="ml-2">Settings</span>
              </a>
            </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>


<div id="pop-up"
    class="fixed hidden flex top-0 left-0 gap-2  justify-center items-center w-screen h-screen bg-slate-500 bg-opacity-30 z-100">
    <div class=" bg-white rounded-5 shadow-2xl container p-5  w-10/12 lg:w-7/12">
        <div class="flex flex-row justify-center items-center">
            <div class="flex  justify-end w-6/12">
                <span class="font-bold text-base text-center"> Photo de Profile </span>
            </div>
            <div class="flex justify-end w-6/12 btn-close-pop-up">
                <span
                    class="fa fa-solid fa-close text-5 self-start text-red-700 hover:text-white px-3 py-2 cursor-pointer rounded-full flex justify-center items-center hover:bg-red-700"></span>
            </div>
        </div>

        <form method="POST" action="{{ route('employers.upload.profile') }}" enctype="multipart/form-data"
            class="p-2 gap-5 sm:gap-10 sm:p-5 flex sm:flex-row flex-col justify-center items-center">
            @method('POST')
            <div class="flex flex-col gap-2 md:p-5">
                @if (Auth::user()->isParent())
                    <img id="profile-image" class="h-60 w-60 sm:h-80 sm:w-80 rounded-xl p-2 sm:p-5 shadow-xs"
                        src="{{ $data->parrain->avatar !== null ? asset('storage/' . $data->parrain->avatar) : ($data->parrain->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png')) }}"
                        alt="profile-image">
                    <input type="hidden" name="parrain_id" value="{{ $data->parrain->id }}">
                @else
                    <img id="profile-image" class="h-60 w-60 sm:h-80 sm:w-80 rounded-xl p-2 sm:p-5 shadow-xs"
                        src="{{ $data->employer->avatar !== null ? asset('storage/' . $data->employer->avatar) : ($data->employer->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png')) }}"
                        alt="profile-image">
                    <input type="hidden" name="employer_id" value="{{ $data->employer->id }}">
                    <input type="hidden" name="back" value="{{ $data->employer->id }}">
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <x-button class="text-center  w-60 sm:w-80"><input type="file" name="image" placeholder="Modifier"
                        id="profile-image-input" accept="image/*"></x-button>
            </div>
            <div id="btn-save" class="hidden h-full flex flex-col gap-2">
                <x-button class="text-center">Enregistrer</x-button>
                <x-button-annuler class="btn-close-pop-up text-center">Anuller</x-button-annuler>
            </div>
            @csrf
        </form>
    </div>
</div>
