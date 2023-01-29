<p>{{ $order }}</p>

<script defer>
    const order = "{{ $order }}";
    if (order === 'year') {
        alert("VEUILLEZ CREER L/'ANNEE SCOLAIRE POUR UTILISER L'APPLICATION");
        window.location.replace('annee-scolaires/create');
    }
    if (order === 'trimestre') {
        alert("VEUILLEZ CREER DES TRIMESTRES POUR L'ANNEE SCOLAIRE EN COURS POUR UTILISER L'APPLICATION");
        window.location.replace('trimestres/create');
    }
    if (order === 'periode') {
        alert("VEUILLEZ CREER DES PERIODES POUR L'ANNEE SCOLAIRE POUR UTILISER L'APPLICATION");
        window.location.replace('annee-scolaires/create');
    }
</script>
