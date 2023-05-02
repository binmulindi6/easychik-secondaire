<div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
    <div class="flex flex-wrap -mx-3">
      <div class="flex-none w-auto max-w-full px-3">
        <div class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-size-base h-19 w-19 rounded-xl">
          @if (Auth::user()->parrain_id === null)
            <img src="{{ $data->employer->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
          @else
            <img src="{{ $data->parrain->sexe === 'M' ? asset('storage/avatar-boy.png') : asset('storage/avatar-girl.png') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
          @endif
        </div>
      </div>
      <div class="flex-none w-auto max-w-full px-3 my-auto">
        <div class="h-full">
          @if (Auth::user()->parrain_id === null)
          
            <h5 class="mb-1 dark:text-white">{{$data->employer->nomComplet()}}</h5>
            @foreach ($data->employer->fonctions as $fonction)
              <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">{{$fonction->nom}}</p>
              {{-- <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">{{$data->employer->fonctions[0]->nom}}</p> --}}
              @endforeach
              @if ($data->isEnseignant())
                  @if ($data->classe())
                      <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-size-sm">{{$data->classe->nomComplet()}}</p>
                  @else
                      
                  @endif
              @endif
            @else
              <h5 class="mb-1 dark:text-white">{{$data->parrain->nomComplet()}}</h5>
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
                    <span class="ml-2">Identité Complete</span>
                </a>
            {{-- </li>
            <li class="z-30 flex-auto text-center">
              <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg bg-inherit text-slate-700" nav-link href="javascript:;" role="tab" aria-selected="false">
                <i class="ni ni-email-83"></i>
                <span class="ml-2">Messages</span>
              </a>
            </li>
            <li class="z-30 flex-auto text-center">
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