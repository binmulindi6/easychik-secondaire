<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte</title>
    {{-- <link rel="stylesheet" href="assets/css/security.css">
    <script src="/assets/js/htmltoimage.min.js"></script>
    <script src="/assets/js/screenshot.min.js"></script>
    <script src="/assets/js/jsbarcode.min.js"></script>
    <script src="/assets/js/jquery.min.js" ></script>
    <script src="/assets/js/qrcode.min.js" ></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="root">
        <div class="btn-container">
            <button id="btn-download">Telecharger La Carte </button>
        </div>


        <div id="card-back" class="card-container">
            <div class="container header">
                <span class="min">REPUBLIQUE DEMOCRATIQUE DU CONGO</span>
                <span class="min">PROVINCE DU SUD KIVU</span>
                <span class="min">MINISTERE DE L'ENSEIGNAMENT PRIMAIRE, SECONDAIRE ET TECHNIQUE</span>
                <span class="min">CARTE D'ELEVE</span>

            </div>
            <div class="container card-body">
                <!-- <div class="images">
                        <img src="/assets/img/bike.png" alt="">
                        <img src="/assets/img/tricyle.png" alt="">
                    </div> -->
                <div class="text">
                    <span id="division">S.A.S <span id="sud-kivu">SCHOOL ADMINISTRATION SYSYTEM</span></span>
                    <span class="text-2">
                        Les autoritées politico-adminitratives, policiers et militaires sont priés de porter leur
                        assistance en cas de nécessité.
                    </span>
                </div>
            </div>
            <div class="container footer">
                <svg id="barcode" class="{{$eleve->matricule}} barcode" dd="{{$eleve->matricule}}"></svg>
                {{-- <svg class="barcode" jsbarcode-format="farmacode"  jsbarcode-textmargin="0"
                    jsbarcode-fontoptions="bold">
                </svg> --}}
                {{-- </svg> --}}
            </div>

        </div>

        <div id="card-front" class="card-container">
            <div class="card-front-header">
                <img class="icons" src="{{ asset('storage/flag.png') }}" alt="flag">
                <div class="card-front-titles">
                    <span class="rep">REPUBLIQUE DEMOCRATIQUE DU CONGO</span>
                    <span class="prov">PROVINCE DU SUD-KIVU</span>
                    <span class="front-min">MINISTERE DE L'ENSEIGNAMENT PRIMAIRE, SECONDAIRE ET TECHNIQUE</span>
                    <span class="carte">CARTE D'ELEVE</span>
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
                        <tr class="identity-data">
                            <td class="identity-title">NOM & POST-NOM : <span id="nom"
                                    class="identity-data-content">{{ $eleve->nom }}</span> </td>
                        </tr>
                        <tr class="identity-data">
                            <td class="identity-title">PRENOM : <span id="prenom"
                                    class="identity-data-content"></span> {{ $eleve->prenom }}</td>
                        </tr>
                        <tr class="identity-data">
                            <td class="identity-title">SEXE : <span id="prenom" class="identity-data-content"></span>
                                {{ $eleve->sexe }}</td>
                        </tr>
                        <tr class="identity-data">
                            <td class="identity-title">LIEU ET DATE DE NAISSANCE : <br> <span id="naissance"
                                    class="identity-data-content">{{ $eleve->lieu_naissance . ' le ' . $eleve->date_naissance }}</span>
                            </td>
                        </tr>
                        {{-- <tr class="identity-data">
                                <td class="identity-title">NATIONALITE : <span id="nationalite" class="identity-data-content"></span> </td> 
                            </tr> --}}
                        {{-- <tr class="identity-data">
                                <td class="identity-title">PROFESSION : <span id="profession" class="identity-data-content"></span></td>  --}}
                        </tr>
                        <tr class="identity-data">
                            <td class="identity-title">ADRESSE ACTUELLE : <span id="adresse"
                                    class="identity-data-content">{{ $eleve->adresse }}</span> </td>
                        </tr>
                    </table>

                </div>
                <hr id="line">
                <div class="card-front-footer">
                    <div>
                        <table>
                            <tr class="dates-content">
                                <td>DATE DE DELIVRANCE : </td>
                                <td id="date-delivrance" class="identity-data-content"></td>
                            </tr>
                            <tr class="dates-content">
                                <td>DATE D'EXPIRATION : </td>
                                <td id="date-expiration" class="identity-data-content"></td>
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
