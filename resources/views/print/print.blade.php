<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="theme-color" content="#1171EF">
    <link rel="icon" href="{{ asset('storage/favicon.png') }}" />
    <title> {{ config('app.name', 'easyChik') }} - {{ 'Print' }} </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="p-2 gap-4 flex flex-col justify-center items-center min-w-screen w-full">
    <div class="flex flex-row justify-center gap-4 items-center w-full">
        <div class="flex justify-center items-center">
            <img class="h-20" src="{{ asset('storage/flag.png') }}" alt="flag">
        </div>
        <div class="flex flex-col gap-0 justify-center items-center">
            @if (isset($ecole) && $ecole->nom !== null)
                <span
                    class="uppercase text-center font-bold">{{$ecole->pays}}</span>
                <span class="uppercase text-center ">PROVINCE DU(DE) {{$ecole->province}}</span>
                <span class="uppercase text-center ">{{$ecole->ministere}}</span>
                <span class="uppercase text-center font-bold">{{$ecole->nom}}</span>
                <span class="uppercase text-center font-bold">{{$ecole->abbreviation}}</span>
                <span class="uppercase text-center font-bold">{{$ecole->bp}}</span>
            @else
                <span
                    class="uppercase text-center font-bold">REPUBLIQUE DEMOCRATIQUE DU CONGO</span>
                <span class="uppercase text-center ">PROVINCE DU SUD KIVU</span>
                <span class="">DIVISION PROVINCIALE DE LA SANTE</span>
                <span class="">BUREAU DE L'ENSEIGNEMENT DES SCIENCES DE SANTE</span>
                <span class="uppercase text-center ">ZONE DE SANTE RURALE DE LEMERA</span>
                <span class="uppercase text-center font-bold">INSTITUT TECHNIQUE MEDICAL DE LEMERA</span>
                <span class="uppercase text-center font-bold">"I.T.M.LEMERA" B.P : 263 BUKAVU</span>
            @endif
        </div>
        <div class="flex justify-center items-center">
            <img class="h-20" src="{{ asset('storage/armoirie.png') }}" alt="armoirie">
        </div>
    </div>
    <div class="h-1 bg-black border-4 border-slate-900 w-full"> </div>
    <div id="root" class="w-full">

    </div>
    <div class="flex flex-row mt-10 justify-center gap-4 items-center w-full">

        <div class="flex flex-col gap-2 justify-center items-center h-20">
            <span class="font-bold">Fait à {{ $ecole->ville }} le {{ date('d/m/Y') }}</span>
            <span class="font-bold">Pour {{ $ecole->abbreviation }}</span>
        </div>
    </div>
    <script>
        window.addEventListener("afterprint", (e) => {
            window.close();
        });
    </script>
</body>

</html>
