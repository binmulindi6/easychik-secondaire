@extends('layouts.admin')

@section('content')

    <div class="w-full p-5 flex flex-col gap-5  overflow-scroll">

        @if (isset($search))
            @if (isset($parent))
                <x-nav-eleves :search="$search" :pagename="$page_name" :parent="$parent"></x-nav-eleves>
            @else
                <x-nav-eleves :search="$search" :pagename="$page_name" ></x-nav-eleves>
            @endif
        @else
             @if (isset($parent))
                <x-nav-eleves :pagename="$page_name" :parent="$parent"></x-nav-eleves>
            @else
                <x-nav-eleves :pagename="$page_name" ></x-nav-eleves>
            @endif
        @endif

    <div class="flex flex-col gap-4  justify-center items-center w-full p-5 bg-white rounded-xl overflow-scroll">
        <span class="font-semibold text-5">Importer les Eleves </span>
        <form action="{{route('import.excel.post')}}" method="post" enctype="multipart/form-data" class="flex flex-row gap-2 justify-center items-center">
            @csrf
    
            <x-input type="file" name="excel_file"></x-input>
            <x-button>Importer</x-button>
        </form>
        <div class="flex flex-col w-full gap-3 justify-center items-center">
            @if (!isset($data))
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500"> 🚨 : {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="flex flex-col w-full gap-3 justify-center items-center">
                        <div class="alert alert-danger">
                            <ul>
                                    <li class="text-blue-500 font-semibold"> 💡 : Assurez vous que le fichier Excel à Téléverser respecte le format suivant :</li>
                            </ul>
                        </div>
                @endif
            @endif
                    <div class="p-0  overflow-scroll">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500 border-collapse">
                            <thead class="align-bottom">
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xxs border-solid  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nom et Post-Nom </th>
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xxs border-solid  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Prenom </th>
                                <th
                                    class="px-1 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xxs border-solid  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Sexe </th>
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xxs border-solid  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Lieu de Naissance </th>
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xxs border-solid  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Date de Naissance </th>
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xxs border-solid  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nom du Pere </th>
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xxs border-solid  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Nom de la Mere </th>
                                <th
                                    class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border border-gray-200 shadow-none text-xxs border-solid  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Adresse </th>
                            </thead>
                            <tbody>
                                @if (isset($data))
                                    @foreach ($data as $item)
                                        <tr class=" rounded-2xl hover:bg-slate-100">
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item["nom"] }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item["prenom"] }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item["sexe"] }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item["lieu"] }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item["date"] }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item["pere"] }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item["mere"] }}</td>
                                            <td
                                                class="p-1 text-size-sm text-center align-middle bg-transparent border-b  shadow-transparent ">
                                                {{ $item["adresse"] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if(isset($data))
                        <form action="{{route('import.excel.eleves.store')}}" method="post" class="justify-end">
                            @csrf
                            <input type="hidden" name="checked" value="true" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            <x-button> Enregistrer </x-button>
                        </form>
                    @endif
        </div>
            
        
    </div>

@endsection