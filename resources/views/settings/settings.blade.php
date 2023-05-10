@extends('layouts.admin')
@section('content')
    <div class=" container flex flex-col justify-between gap-5 h-full">

        <div class="frm-identity flex flex-col justify-center items-center  gap-5 shadow-2xl relative bg-white rounded-5 p-5  w-full h-full">
            {{-- <div class="w-full bg-zinc-600/40 p-5 rounded-t-5 flex items-center justify-between">
                 <div class="h-30 w-30 absolute bottom-20 rounded-full bg-white">
                </div> t-semibold text-2xl">Parametres</span>
                <img src="{{asset('storage/shape1.svg')}}" class="h-40" alt="" srcset="">
            </div> --}}
            <div class="w-full">
                <div class="flex flex-row justify-between items-center pr-5">
                    <div>
                        <span class="font-semibold text-6 block text-slate-900">Parametres</span>
                        <span class="text-4 block ">Configurer le systeme suivant le besoin</span>
                    </div>
                    <i class="relative top-0 leading-normal text-slate-900 text-16 fa fa-solid fa-cog fa-spin"></i>
                </div>
                <hr class="h-px mb-0  bg-black/40 " />
            </div>
            <div class="flex flex-col gap-2 justify-center w-full">
                <div class="flex flex-col gap-1 pb-2 border-b">
                    <form action="{{route('settings.store')}}" method="post" class="flex items-center justify-between gap-2 w-full">
                        @csrf
                        <span class="font-semibold text-4 text-slate-700">Annee Scolaire en Cours</span>
                        <div class="w-30 md:w-40  h-10 flex flex-row justify-end items-center gap-2">
                            <x-select :submitOnChage="true" :val="$current" :collection="$annees" class="block mt-1 w-full" name='annee' required></x-select>
                            {{-- <x-button>choisir</x-button> --}}
                        </div>
                    </form>
                    <span class="text-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia tenetur iure facere adipisci quasi dicta illo necessitatibus, molestias, a laudantium sint reprehenderit dolores animi consequuntur nihil aut at ipsum numquam?</span>
                </div>
                <div class="flex flex-col gap-1 pb-2 border-b">
                    <form ction="{{ route('logout') }} method="post" class="flex items-center justify-between gap-2 w-full">
                        @csrf
                        <span class="font-semibold text-4 text-slate-700">Se Seconnecter</span>
                        <div class="w-30 md:w-40  h-10 flex flex-row justify-end items-center gap-2">
                            {{-- <x-select :submitOnChage="true" :val="$current" :collection="$annees" class="block mt-1 w-full" name='annee' required></x-select> --}}
                            <button type="submit"
                                class="p-0 w-30 md:w-40  bg-red-500  hover:bg-red-600 rounded-2 py-2 text-white font-semibold transition-all text-size-sm ease-nav-brand ">
                                <i fixed-plugin-button-nav class=" text-black fa fa-right-from-bracket"
                                    title="logout"></i>
                                <span class="hidden sm:inline">Deconnexion</span>
                            </button title="deconnexio">
                        </div>
                    </form>
                    <span class="text-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia tenetur iure facere adipisci quasi dicta illo necessitatibus, molestias, a laudantium sint reprehenderit dolores animi consequuntur nihil aut at ipsum numquam?</span>
                </div>
            </div>

    </div>
@endsection
