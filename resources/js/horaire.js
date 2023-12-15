import axios from "axios";

//put loader here

// document.addEventListener('DOMContentLoaded', function () {
//     // Set the browser zoom level to 90%
//     document.body.style.zoom = '90%';
//     console.log(document.body.style.zoom)
// });

const selectTrigger = document.querySelectorAll(".select-trigger");
selectTrigger &&
selectTrigger.forEach((btnAff) => {
    btnAff.addEventListener("change", (e) => {
        e.preventDefault();
        
        const id = btnAff.id;
        const frm = document.getElementById("frm" + id);
            const link = frm.action;
            const classe = document.getElementById("classe" + id).value;
            const cours = btnAff.value;
            const token = document.getElementById("token" + id).value;
            const jour = document.getElementById("jour" + id).value;
            const heure = document.getElementById("heure" + id).value;
            const user = document.getElementById("user" + id).value;
            const err = document.getElementById("err" + id);
            
            //btns
            const btnReour = document.querySelector('.btn-horaire-retour')
            const btnTerminer = document.querySelector('.btn-horaire-terminer')
            
            // console.log('user: '+user)
            console.log(cours, jour, heure);
            if (!cours.includes("une") || !cours.includes("option") || !user) {
                axios
                    .post(link, {
                        _token: token,
                        cours: cours,
                        classe: classe,
                        jour: jour,
                        heure: heure,
                        user: user,
                    })
                    .then((e) => {
                        // console.log(e)
                        if (e.data === "succes") {
                            err.innerHTML = "";
                            btnReour.classList.add('hidden')
                            btnTerminer.classList.remove('hidden')
                            // document.getElementById('err' + id).classList.toggle('hidden');
                        } else {
                            // console.log( e.data)
                            err.innerHTML = e.data;
                        }
                    })
                    .catch((e) => {
                        console.log(e);
                        err.innerHTML =
                            "Une erreur s'est produite reessayer plus tard";
                    });
            } else {
                // console.log(Number(value) <= Number(max));
                err.innerHTML = "Veuillez choisir un cours";
            }

            e.preventDefault();
        });
    });

    
const heureTrigger = document.querySelectorAll(".heure-trigger");

heureTrigger &&
    heureTrigger.forEach((btnAff) => {
        btnAff.addEventListener("change", (e) => {
            e.preventDefault();

            const id = btnAff.id.split("-")[1];
            const frm = document.getElementById("frmH" + id);
            const link = frm.action;
            const token = document.getElementById("token" + id).value;
            const debut = document.getElementById("debut-" + id).value;
            const fin = document.getElementById("fin-" + id).value;
            const user = document.getElementById("user" + id).value;
            const err = document.getElementById("errH" + id);

            //btns
            const btnReour = document.querySelector(".btn-horaire-retour");
            const btnTerminer = document.querySelector(".btn-horaire-terminer");

            // console.log('user: '+user)
            console.log(debut, fin, id);
            axios
                .post(link, {
                    _token: token,
                    heure: id,
                    debut: debut,
                    fin: fin,
                    user: user,
                })
                .then((e) => {
                    // console.log(e)
                    if (e.data === "succes") {
                        err.innerHTML = "";
                        btnReour.classList.add("hidden");
                        btnTerminer.classList.remove("hidden");
                        // document.getElementById('err' + id).classList.toggle('hidden');
                    } else {
                        // console.log( e.data)
                        err.innerHTML = e.data;
                    }
                })
                .catch((e) => {
                    console.log(e);
                    err.innerHTML =
                        "Une erreur s'est produite reessayer plus tard";
                });

            e.preventDefault();
        });
    });
