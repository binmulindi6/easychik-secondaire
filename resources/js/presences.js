import axios from "axios";

const btnsPresence = document.querySelectorAll(".btn-presence");
const btnsPresenceEmployer = document.querySelectorAll(
    ".btn-presence-employer"
);

//Employer Presence
btnsPresenceEmployer &&
    btnsPresenceEmployer.forEach((btnPres) => {
        btnPres.addEventListener("click", (e) => {
            e.preventDefault();

            const lastId = document.getElementById("last-id").value;

            const id = btnPres.id;
            const frm = document.getElementById("frm" + id);
            const link = frm.action;
            const annee = document.getElementById("annee" + id).value;
            const token = document.getElementById("token" + id).value;
            const user = document.getElementById("user" + id).value;
            const date = document.getElementById("date" + id).value;
            const employer = btnPres.id;
            const typeId = btnPres.attributes.placeholder.value;
            const err = document.getElementById("err" + id);

            // console.log(employer)
            // console.log(link)
            // console.log(typeId)
            // console.log(annee)
            // console.log(user)
            // console.log(date)
            axios
                .post(link, {
                    _token: token,
                    annee_id: annee,
                    employer_id: employer,
                    date: date,
                    type_id: typeId,
                    user_id: user,
                })
                .then((e) => {
                    console.log(e);
                    if (e.data === "succes") {
                        document
                            .getElementById("tr" + id)
                            .classList.toggle("hidden");
                        if (lastId === employer) {
                            window.location.reload();
                        }
                    } else {
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

//Eleve Presences
btnsPresence &&
    btnsPresence.forEach((btnPres) => {
        btnPres.addEventListener("click", (e) => {
            e.preventDefault();

            const lastId = document.getElementById("last-id").value;

            const id = btnPres.id;
            const frm = document.getElementById("frm" + id);
            const link = frm.action;
            const freq = document.getElementById("freq" + id).value;
            const token = document.getElementById("token" + id).value;
            const user = document.getElementById("user" + id).value;
            const typeId = btnPres.attributes.placeholder.value;
            const err = document.getElementById("err" + id);
            const date = document.getElementById("date" + id).value;

            // console.log(link)
            // console.log(typeId)
            // console.log(freq)
            // console.log(user)
            axios
                .post(link, {
                    _token: token,
                    freq_id: freq,
                    type_id: typeId,
                    user_id: user,
                    date: date
                })
                .then((e) => {
                    console.log(e);
                    if (e.data === "succes") {
                        if (lastId === id) {
                            window.location.reload();
                        } else {
                            document
                                .getElementById("tr" + id)
                                .classList.toggle("hidden");
                        }
                    } else {
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
