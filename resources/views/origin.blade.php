{{-- <p>{{ $order }}</p> --}}

<script defer>
    const order = "{{ $order }}";
    if (order === 'year') {
        alert("VEUILLEZ CREER UNE ANNEE SCOLAIRE POUR CONTINUER UTILISER L'APPLICATION");
        window.location.replace("{{route('annee-scolaires.create')}}");
    }
    if (order === 'semestre') {
        alert("VEUILLEZ CREER 2 SEMESTRES POUR L'ANNEE SCOLAIRE EN COURS POUR CONTINUER UTILISER L'APPLICATION");
        window.location.replace("{{route('trimestres.create')}}");
    }
    if (order === 'periode') {
        alert("VEUILLEZ CREER 2 PERIODES POUR L'ANNEE SCOLAIRE EN COURS POUR CONTINUER UTILISER L'APPLICATION");
        window.location.replace("{{route('periodes.create')}}");
    }
    if (order === 'Eleves') {
        alert("VEUILLEZ AJOUTER DES ELEVES POUR POUVOIR AJOUTER DES PARENTS");
        window.location.replace("{{route('eleves.create')}}");
    }
</script>
