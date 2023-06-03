@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">

        <x-nav-employers :link="$link" :pagename="$page_name"> </x-nav-employers>
    @if (isset($items))
        @if ($page_name == 'Employers/Edit' || $page_name == 'Employers/Create')
            <div class="display hidden container p-5 bg-white rounded-5 shadow-2xl">
            @else
                <div class="display container p-5 bg-white rounded-5 shadow-2xl">
        @endif

        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
           @if (isset($link))
           <h6>Choisir un Employé</h6>
           @else
           <h6>Employé</h6>
           @endif
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Matricule </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Nom, Prenom </th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Date de Naissance</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Sexe</th>
                        {{-- <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Formation</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Diplome</th>
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Niveau d'etude</th> --}}
                        <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Fonction</th>
                        {{-- <th
                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Action</th> --}}
                    </thead>
                    <tbody>
                        
                        @foreach ($items as $item)

                        @if ($item->user === null)
                            
                            <tr class="">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    <a class="hover:text-blue-500" href="{{route('users.create.employer', $item->id)}}"> 
                                        {{$item->matricule }}
                                    </a>
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    <a class="hover:text-blue-500" href="{{route('users.create.employer', $item->id)}}"> 
                                        {{$item->nom . ' ' . $item->prenom }}
                                    </a>
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->date_naissance }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->sexe }}</td>
                                {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->formation }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->diplome }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    {{ $item->niveau_etude }}</td> --}}
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent">
                                    @foreach ($item->fonctions as $fonction)
                                        {{ $fonction->nom . ' ' }}
                                    @endforeach
                                </td>
                                {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent   text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a title="modifier" href="{{ route('employers.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
                                        <form class="delete-form" action="{{ route('employers.destroy', $item->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="effacer"><i
                                                    class="text-red-500 fa fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td> --}}
                            </tr>
                        
                        @endif

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
