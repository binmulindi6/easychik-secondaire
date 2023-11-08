<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/favicon.png') }}" />
    <title>easyChik | Printing Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="p-2 gap-4 flex flex-col justify-center items-center ">
    <div class="flex flex-row justify-center gap-4 items-center w-full">
        <div class="flex justify-center items-center">
            <img class="h-20" src="{{ asset('storage/flag.png') }}" alt="flag">
        </div>
        <div class="flex flex-col gap-0 justify-center items-center">
            <span class="font-bold">REPUBLIQUE DEMOCRATIQUE DU CONGO</span>
            <span class="">PROVINCE DU SUD KIVU</span>
            <span class="">DIVISION PROVINCIALE DE LA SANTE</span>
            <span class="">BUREAU DE L'ENSEIGNEMENT DES SCIENCES DE SANTE</span>
            <span class="">ZONE DE SANTE RURALE DE LEMERA</span>
            <span class="font-bold">INSTITUT TECHNIQUE MEDICAL DE LEMERA</span>
            <span class="font-bold">"I.T.M.LEMERA" B.P : 263 BUKAVU</span>
        </div>
        <div class="flex justify-center items-center">
            <img class="h-20" src="{{ asset('storage/armoirie.png') }}" alt="armoirie">
        </div>
    </div>
    <div class="h-1 bg-black border-4 border-slate-900 w-full"> </div>
    <div id="root">

    </div>
    <div class="flex flex-row mt-20 justify-center gap-4 items-center w-full">

        <div class="flex flex-col gap-2 justify-center items-center h-20">
            <span class="font-bold">Fait à {{env('ville')}} le {{date('d/m/Y h:m:d')}}</span>
            <span class="font-bold">Pour l'{{env('ecole')}}</span>
        </div>
    </div>
<script>
    window.addEventListener("afterprint", (e) => {
        window.close();
    });    
</script>
</body>

</html>

