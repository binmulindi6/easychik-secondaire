<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/favicon.png') }}" />
    <title>easyChik | Carte de Service</title>
    {{-- <link rel="stylesheet" href="assets/css/security.css">
    <script src="/assets/js/htmltoimage.min.js"></script>
    <script src="/assets/js/screenshot.min.js"></script>
    <script src="/assets/js/jsbarcode.min.js"></script>
    <script src="/assets/js/jquery.min.js" ></script>
    <script src="/assets/js/qrcode.min.js" ></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="card-body">
    <div id="root" class="p-20">
        <div class="btn-container">
            <button id="btn-download">Telecharger La Carte </button>
        </div>


        <div id="card-back" class="card-container">
            <div class="header flex flex-col justify-center items-center p-5">
                <span class="text-10 font-bold uppercase">REPUBLIQUE DEMOCRATIQUE DU CONGO</span>
                <span class="text-10 font-bold uppercase">MINISTERE DE L'ENSEIGNAMENT PRIMAIRE, SECONDAIRE ET
                    TECHNIQUE</span>
                <span class="text-10 font-bold uppercase">PROVINCE DU SUD KIVU</span>
                {{-- <span class="text-10 font-bold uppercase">{{ env('ECOLE') ? env('ECOLE') : env('APP_NAME') }}</span> --}}

            </div>
            <div class="card-body">
                <div class="flex flex-col justify-center items-center p-10">
                    <span
                        class="text-20 font-semibold text-blue-700">{{ env('ECOLE') ? env('ECOLE') : env('APP_NAME') }}</span>
                        {{-- <span class="font-bold text-blue-700 text-3xl  py-1 px-4 rounded-md">{{ env('APP_NAME') }}</span> --}}
                    <span class="text-20 border-black border-b-8 w-10/12 font-semibold">CARTE DE SERVICE</span>
                    {{-- <span >eChik <span>SCHOOL MANAGEMENT SYSYTEM</span></span> --}}
                    <span class="text-10">
                        Les autoritées politico-adminitratives, policiers et militaires sont priés de porter leur
                        assistance en cas de nécessité.
                    </span>
                </div>
            </div>
            <div class="footer w-full">
                <svg id="barcode" class="{{ $eleve->matricule }} barcode" dd="{{ $eleve->matricule }}"></svg>
            </div>

        </div>

        <div id="card-front" class="card-container p-10">
            <div class="flex flex-row gap-5 items-center justify-between w-full border-b-8 border-black ">
                <img class="icons" src="{{ asset('storage/flag.png') }}" alt="flag">
                <div class="card-front-titles">
                    <span class="text-9 font-bold uppercase">REPUBLIQUE DEMOCRATIQUE DU CONGO</span>
                    <span class="text-9 font-bold uppercase text-blue-600">MINISTERE DE L'ENSEIGNAMENT PRIMAIRE,
                        SECONDAIRE ET TECHNIQUE</span>
                    <span class="text-9 font-bold uppercase text-blue-600">PROVINCE DU SUD KIVU</span>
                    <span class="text-9 font-bold uppercase">{{ env('ECOLE') ? env('ECOLE') : env('APP_NAME') }}</span>
                </div>
                <img class="icons" src="{{ asset('storage/armoirie.png') }}" alt="armoirie">
            </div>
            <div class="joker">
                <div class="nn"><span>MATRICULE : <span id="nn">{{ $eleve->matricule }}</span></span></div>
                <div class="card-front-body">
                    <div class="avatar-container">
                        <!-- <img id="qr-code" src="" alt=""> -->
                        @if ($eleve->sexe === 'M')
                            <img id="avatar" src="{{ asset('storage/avatar-boy.png') }}" alt="avatar" />
                        @else
                            <img id="avatar" src="{{ asset('storage/avatar-girl.png') }}" alt="avatar" />
                        @endif
                    </div>
                    <table class="identity">
                        <tr class="">
                            <td class=" uppercase text-12">MATRICULE : <span id="nom"
                                    class="font-bold">{{ $eleve->matricule }}</span> </td>
                        </tr>
                        <tr class="">
                            <td class=" uppercase text-12">NOM & PRENOM : <span id="nom"
                                    class="font-bold">{{ $eleve->nomComplet() }}</span> </td>
                        </tr>
                        {{-- <tr class="">
                            <td class="">PRENOM : <span id="prenom"
                                    class="></span> {{ $eleve->prenom }}</td>
                        </tr> --}}
                        <tr class="">
                            <td class=" uppercase text-12">SEXE : <span id="prenom" class="font-bold"></span>
                                @if ($eleve->sexe === 'M')
                                    Masculin
                                @else
                                    Feminin
                                @endif
                            </td>
                        </tr>
                        <tr class="">
                            <td class=" uppercase text-12">Fonction : <span id="prenom" class="font-bold"></span>
                                @foreach ($eleve->fonctions as $item)
                                {{$item->nom}} ,
                                @endforeach
                            </td>
                        </tr>
                        <tr class="">
                            <td class=" uppercase text-12">LIEU & DATE DE NAISS : <span id="naissance"
                                    class="font-bold">{{ $eleve->lieu_naissance . ' le ' . date_format(date_create($eleve->date_naissance), 'd/m/Y') }}</span>
                            </td>
                        </tr>
                        {{-- <tr class="">
                                <td class="">NATIONALITE : <span id="nationalite" class="></span> </td> 
                            </tr> --}}
                        {{-- <tr class="">
                                <td class="">PROFESSION : <span id="profession" class="></span></td>  --}}
                        </tr>
                        {{-- <tr class="">
                            <td class=" text-12">ADRESSE : <span id="adresse"
                                    class="font-bold">{{ $eleve->adresse }}</span> </td>
                        </tr> --}}
                    </table>

                </div>
                <hr id="line">
                <div class="card-front-footer">
                    <div>
                        <table>
                            <tr class="text-12">
                                <td>DATE DE DELIVRANCE : Le
                                    {{ date('d/m/Y') }}</td>
                            </tr>
                            <tr class="text-12">
                                <td>DATE D'EXPIRATION : Le
                                    {{ date_format(date_create('yesterday next year'), 'd/m/Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    {{-- <div class="qr-container">
                                <!-- <img id="qr-code" src="" alt=""> -->
                                <div id="qrcode"></div> 
                        </div> --}}
                </div>
            </div>
        </div>
</body>
{{-- <script src="/assets/js/security.js" ></script> --}}

</html>
