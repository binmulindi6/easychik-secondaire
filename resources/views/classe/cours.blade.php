@extends('layouts.admin')

@section('content')
    <div class="container flex flex-col justify-between gap-5">
        <x-back :link="route('classes.show', $classe->id)"></x-back>
       <x-classe-profile-header :data="$classe" :print="true"></x-classe-profile-header>
        
    @if (isset($items))
        @if ($page_name == 'Eleves/Edit' || $page_name == 'Eleves/Create')
            <div
                class="display container p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
            @else
                <div
                    class="display container  p-4  relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
        @endif

        {{-- <div class=" flex justify-between pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Eleves</h6>
        </div> --}}
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="pt-5 overflow-x-auto">
                <table id="printable" class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <caption class="font-bold text-center uppercase align-middle bg-transparent shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                         liste des Cours 
                    </caption>
                    <caption class="font-bold pb-4 text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xl border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                         classe de {{ $classe->nomComplet()}}
                    </caption>
                    <thead class="align-bottom">
                        <th
                            class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Intitulé </th>
                        <th
                            class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Categorie</th>
                        <th
                            class="px-1 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Max Periode </th>
                        <th
                            class="px-4 py-1 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Max Trimestre </th>
                        {{-- <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Nom du Pere </th>
                        <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Nom de la Mere </th> --}}
                        {{-- <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Adresse </th> --}}
                        {{-- <th
                            class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Classe </th> --}}
                        {{-- @if ( Auth::user()->isAdmin() || !Auth::user()->isEnseignant() || !Auth::user()->isParent() || !isset($parent) || $parent === null)
                            <th class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"
                                colspan="2">action</th>
                        @endif --}}
                    </thead>
                    <tbody>

                        @foreach ($items as $item)
                            <tr class=" rounded-2xl hover:bg-slate-100">
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  ">
                                    {{$item->nom}}
                                </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->categorie_cours->nom }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->max_periode }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->max_examen }}</td>
                                {{-- <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->nom_pere }}</td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                    {{ $item->classe->niveau->nom . ' ' . $item->classe->nom }} </td>
                                <td
                                    class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent  text-blue-500 underline">
                                    <div class="flex justify-center gap-4 align-middle">
                                        <a title="Modifier" href="{{ route('cours.edit', $item->id) }}"><i
                                                class="fa fa-solid fa-pen"></i></a>
                                        <form class="delete-form" action="{{ route('cours.destroy', $item->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Effacer" type="submit"><i
                                                    class="text-red-500 fa fa-solid fa-trash"></i></button>
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
