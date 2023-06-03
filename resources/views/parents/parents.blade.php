@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">

        <x-nav-users :pagename="$page_name"> </x-nav-users>
        @if ($page_name == 'Parents')
                <div class="frm-create hidden container p-5 bg-white rounded-5 shadow-2xl">
                @else
                    <div class="frm-create container p-5 bg-white rounded-5 shadow-2xl">
        @endif
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
            @if (isset($self))
                <p class="font-bold text-base">Modifier un Parent</p>
                <form method="PUT" action="{{ route('parents.update',$self->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    <!-- Name -->

                    <div class=" flex justify-between gap-4">
                        <!-- Name -->
                            <div class="w-full">
                                <x-label for="nom" :value="__('Nom')" />
                
                                <x-input id="matricule" class="block mt-1 w-full" type="text" name="nom" :value="$self->nom" required autofocus />
                            </div>
                            <div class=" w-full">
                                <x-label for="prenom" :value="__('Prenom')" />
                
                                <x-input id="matricule" class="block mt-1 w-full" type="text" name="prenom" :value="$self->prenom" required />
                            </div>
                        </div>
                        <!-- Email Address -->
                        <div class="mt-4 w-full">
                            <x-label for="email" :value="__('Email')" />
            
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$self->email()" required  readonly/>
                        </div>
            
                        <!-- Password -->
                        <div class=" flex justify-between gap-4">
                            <div class="mt-4 w-full">
                                <x-label for="password" :value="__('Nouveau Mot de Passe')" />
                
                                <x-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />
                            </div>
                
                            <!-- Confirm Password -->
                            <div class="mt-4 w-full">
                                <x-label for="password_confirmation" :value="__('Confirmer le Nouveau Mot de Passe')" />
                
                                <x-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" required />
                            </div>
                        </div>
    
                        <div class="mt-4 w-full">
                            <x-label for="prenom" :value="__('Telephone')" />
            
                            <x-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="$self->telephone" required />
                        </div>
                        
                        <div class="flex gap-10">
                            <div class="mt-4">
                                <x-button>Enregister</x-button>
                            </div>
                            <div class="mt-4">
                                <x-button-annuler type='reset' class="bg-red-500"></x-button-annuler>
                            </div>
                        </div>
                </form>
            @else
                <p class="font-bold text-base">Ajouter un Parent</p>
                <form method="POST" action="{{ route('parents.store') }}">
                    @csrf
                    <div class=" flex justify-between gap-4">
                    <!-- Name -->
                        <div class="w-full">
                            <x-label for="nom" :value="__('Nom')" />
            
                            <x-input id="matricule" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
                        </div>
                        <div class=" w-full">
                            <x-label for="prenom" :value="__('Prenom')" />
            
                            <x-input id="matricule" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required />
                        </div>
                    </div>
                    <!-- Email Address -->
                    <div class="mt-4 w-full">
                        <x-label for="email" :value="__('Email')" />
        
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>
        
                    <!-- Password -->
                    <div class=" flex justify-between gap-4">
                        <div class="mt-4 w-full">
                            <x-label for="password" :value="__('Mot de Passe')" />
            
                            <x-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                        </div>
            
                        <!-- Confirm Password -->
                        <div class="mt-4 w-full">
                            <x-label for="password_confirmation" :value="__('Confirmer le Mot de Passe')" />
            
                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required />
                        </div>
                    </div>

                    <div class="mt-4 w-full">
                        <x-label for="prenom" :value="__('Telephone')" />
        
                        <x-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required />
                    </div>
                    
                    <div class="flex gap-10">
                        <div class="mt-4">
                            <x-button>ajouter</x-button>
                        </div>
                        <div class="mt-4">
                            <x-button-annuler type='reset' class="bg-red-500"></x-button-annuler>
                        </div>
                    </div>
                </form>
            @endif
            
         </div>

        @if (isset($items))
            @if ($page_name === 'Parents / Create' || $page_name === 'Parents / Edit')
                <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
                @else
                    <div class="display container p-5 bg-white rounded-5 shadow-2xl">
            @endif

            <div class="pl-5 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Parents</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Nom </th>
                            <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Email </th>
                            <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Telephone</th>
                            <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Eleves</th>
                            @if(Auth::user()->isSecretaire())
                                <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Satut</th>
                            @endif
                            <th
                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Action</th>
                            
                        </thead>
                        <tbody>

                            @foreach ($items as $item)
                                <tr class="">
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        {{ $item->nom . ' ' . $item->prenom }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        {{ $item->email() }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        {{ $item->telephone }}</td>
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        @if (count($item->eleves) <= 0)
                                            <a class="text-blue-500 underline " href="{{ route('eleve-parent.link',$item->id) }}">
                                                assigner à un eleve
                                            </a>
                                        @else
                                            {{-- {{count($item->eleves)}} --}}
                                            <ul>
                                                @foreach ($item->eleves as $eleve)
                                                    <li>
                                                        <a class="text-blue-500 underline " href="{{route('eleves.show', $eleve->id)}}">
                                                        {{$eleve->nomComplet()}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                    </td>
                                    @if(Auth::user()->isSecretaire() || Auth::user()->isAdmin())
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                        @if ($item->is_active() == '0')
                                            <form action="{{ route('parents.statut', $item->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="statut" value="{{ $item->is_active() }}">
                                                <button type="submit"
                                                    title="Active"class="bg-gradient-to-tl cursor-pointer from-red-500 to-pink-400 px-3.6 text-xss rounded-1.8 py-2.2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                    Desactive
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('parents.statut', $item->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="statut" value="{{ $item->is_active() }}">
                                                <button type="submit"
                                                    title="Desactive"class="bg-gradient-to-tl cursor-pointer from-emerald-500 to-teal-400 px-3.6 text-xss rounded-1.8 py-2.2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                    Active
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    @endif
                                    <td
                                        class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                        <div class="flex justify-center gap-4 align-middle">
                                            @if(Auth::user()->isSecretaire())
                                                <a title="assigner ce parent à un eleve" href="{{ route('eleve-parent.link',$item->id) }}"><i
                                                    class="text-green-500 font-semibold fa fa-solid fa-plus"></i></a>
                                                <a title="modifier" href="{{ route('parents.edit', $item->id) }}"><i
                                                        class="fa fa-solid fa-pen"></i></a>
                                                <form class="delete-form" action="{{ route('parents.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="effacer"><i
                                                            class="text-red-500 fa fa-solid fa-trash"></i></button>
                                            @endif
                                            @if(Auth::user()->isDirecteur())
                                                <a title="Ecrire au parent" href="{{ route('messages.to',$item->user->id) }}"><i
                                                    class="text-green-500 font-semibold fa fa-solid fa-message"></i></a>
                                            @endif
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

    </div>
    @endif
    </div>
    </div>

@endsection
