import axios from "axios";

// const queryString = window.location;
// const link = queryString.origin;
// const link2 = link === "http://sas.test" ? link : link+"/sas/public"

const terminal = document.querySelector('#my-terminal');

        /*  DISPALY SCROLL BAR ALWAYS DOWN */
        if(terminal) 
        terminal.scrollTop = terminal.scrollHeight
        // console.log(10)

const btn_create_eleve = document.querySelector("[btn-create-eleves]");
const btn_show_eleves = document.querySelector("[btn-display-eleves]");
const form_add_eleve = document.querySelector("[frm-create-eleves]");
const display_eleves = document.querySelector("[display-eleves]");

const btn_create_frequentations = document.querySelector(
    "[btn-create-frequentations]"
);
const btn_show_frequentations = document.querySelector(
    "[btn-display-frequentations]"
);
const frm_frequentations = document.querySelector(
    "[frm-create-frequentations]"
);
const display_frequentations = document.querySelector(
    "[display-frequentations]"
);

const btnCreate = document.querySelectorAll(".btn-create");
const btnDispaly = document.querySelectorAll(".btn-display");
const btnDispalySent = document.querySelectorAll(".btn-display-sent");

const frm = document.querySelector(".frm-create");
const display = document.querySelector(".display");
const displaySent = document.querySelector(".display-sent");
const show = document.querySelector(".show");
//eleves

const myBtn = document.querySelectorAll(".my-btn");

//Show Eleve

const btnIdentity = document.querySelectorAll(".btn-identity");
const frmIdentity = document.querySelectorAll(".frm-identity");
// console.log(btnIdentity);

const btnEdit = document.querySelector('.btn-edit');
const btnSave = document.querySelector('.btn-save');

const btnEdit1 = document.querySelector('.btn-edit1');
const btnSave1 = document.querySelector('.btn-save1');

// console.log(myBtn)
///joker btn

///BTN Corriger
const btnCorriger = document.querySelectorAll('.btn-corriger');

///btn passation
const btnsPassation = document.querySelectorAll('.btn-passation');

    //btns
const btnReussite = document.querySelector('#btn-reussite')
const btnEchec = document.querySelector('#btn-echecs')
const btnNonClasses = document.querySelector('#btn-non-classes')
    //displays
const displayPassations = document.querySelectorAll('.display-passation')
const displayReuissite = document.querySelector('#display-reussite')
const displayEchec = document.querySelector('#display-echec')
const displayNonClasses = document.querySelector('#display-non-classes')

    //btns affecter
const btnAffecter = document.querySelectorAll('.btn-affecter')
///views
// const display

//carte
const btnCarte = document.querySelectorAll('.btn-carte')


myBtn !== null && myBtn.forEach((jokerBtn) => {
    jokerBtn.addEventListener('click', (e)=>{
        myBtn.forEach((btn) => {
            btn.classList.remove('bg-white');
            btn.classList.add('bg-slate-100');
        });
        const theBtn = e.target;
        theBtn.classList.add('bg-white');
        theBtn.classList.remove('bg-slate-100');
    });
});

////
(display !== null && frm !== null) && btnCreate.forEach((btn) => {
    btn.addEventListener("click", function () {
        if (frm.getAttribute("hidden") == true) {
            display.setAttribute("hidden", "true");
            frm.classList.toggle("hidden");
            displaySent.classList.add("hidden");
            show.classList.add("hidden");
        } else {
            frm.classList.remove("hidden");
            display.classList.add("hidden");
            displaySent.classList.add("hidden");
            show.classList.add("hidden");
        }
    });
});

(display !== null && frm !== null) && btnDispaly.forEach((btn) => {
    btn.addEventListener("click", function () {
        if (frm.getAttribute("hidden") == false) {
            frm.setAttribute("hidden", "true");
            display.classList.toggle("hidden");
            displaySent.classList.add("hidden");
            show.classList.add("hidden");
        } else {
            frm.classList.add("hidden");
            display.classList.remove("hidden");
            displaySent.classList.add("hidden");
            show.classList.add("hidden");
        }
    });
});

(display !== null && frm !== null && displaySent !== null) && btnDispalySent.forEach((btn) => {
    btn.addEventListener("click", function () {
        if (frm.getAttribute("hidden") == false) {
            frm.setAttribute("hidden", "true");
            display.classList.add("hidden");
            displaySent.classList.toggle("hidden");
            show.classList.add("hidden");
        } else {
            frm.classList.add("hidden");
            display.classList.add("hidden");
            displaySent.classList.remove("hidden");
            show.classList.add("hidden");
        }
    });
});



if (btnIdentity !== null && btnIdentity.length > 0 && frmIdentity !== null && frmIdentity.length > 0) {
    btnIdentity.forEach(btn => {
        btn.addEventListener("click", () => {
            frmIdentity.forEach( frm => {
                frm.classList.toggle("hidden");
            })
         });
    });
    
}


///ads

const btnShowFiche = document.getElementById('btn-show-fiche');
const ficheEvaluation = document.getElementById('fiche-evaluation');
const evaluations =  document.getElementById('evaluations');

btnShowFiche !== null && btnShowFiche.addEventListener('click', ()=>{
    ficheEvaluation.classList.toggle('hidden');
    evaluations.classList.toggle('hidden');
})


//joker print

const printable = document.getElementById('printable')
const btnJokerPrint = document.getElementById('joker-print')

btnJokerPrint !== null && btnJokerPrint.addEventListener('click', ()=>{
			window.print();
})





//BTN EDIT && SAVE
btnEdit !== null && btnEdit.addEventListener('click', ()=>{
    btnSave !== null && btnSave.classList.toggle('hidden');
})
btnEdit1 !== null && btnEdit1.addEventListener('click', ()=>{
    btnSave1 !== null && btnSave1.classList.toggle('hidden');
})

//handle Changes
const moyen = document.querySelector("#moyen-paiement");
const ref = document.querySelector("#reference");
// console.log(ref);
moyen !== null && moyen.addEventListener('change', () => {
    let value = moyen.value
    if (value === '2') {
        ref.classList.add('block')
        ref.classList.remove('hidden')
    }else{
        ref.classList.remove('block')
        ref.classList.add('hidden')

    }
})


btnCorriger && btnCorriger.forEach(btn => {
    btn.addEventListener('click', (e)=> {
        e.preventDefault();
        
        const id = btn.id;
        const value = document.getElementById('ev' + id).value;
        const max = document.getElementById('ev' + id).max;
        const token = document.getElementById('token' + id).value;
        const frm =  document.getElementById('frm' + id)
        const link  = frm.action;
        const err = document.getElementById('err' + id)

        err.innerHTML = ''
        // console.log(value, max)
        if (Number(value) <= Number(max)) {
            
            axios.put(link,
                {
                    "_token" : token,
                    'note_obtenu' : value,
                }
            ).then(e => {
                console.log(e)
                document.getElementById('tr' + id).classList.toggle('hidden');
            })
            .catch(e => {
                console.log(e)
                err.innerHTML = "Une erreur s'est produite reessayer plus tard"
            })

        } else {
            // console.log(Number(value) <= Number(max));
            err.innerHTML = "La note inserer est superieure a la note max"
        }
        
        e.preventDefault();
    })
})

btnsPassation && btnsPassation.forEach(btn1 => {
    btn1.addEventListener('click', () => {
        btnsPassation.forEach(btn2 => {
            btn2.classList.remove('bg-gray-300')
        })
        displayPassations && displayPassations.forEach(dsp => {
            dsp.classList.add('hidden')
        })
        btn1.classList.add('bg-gray-300')
    })
})

btnReussite && btnReussite.addEventListener('click', () => {
    displayReuissite.classList.remove('hidden')
})
btnEchec && btnEchec.addEventListener('click', () => {
    displayEchec.classList.remove('hidden')
})
btnNonClasses && btnNonClasses.addEventListener('click', () => {
    displayNonClasses.classList.remove('hidden')
})


///affecter

btnAffecter && btnAffecter.forEach(btnAff => {
    btnAff.addEventListener('click', (e)=> {
        e.preventDefault();
        
        const id = btnAff.id;
        const frm =  document.getElementById('frm' + id)
        const link  = frm.action;
        const classe = document.getElementById('classe' + id).value;
        const token = document.getElementById('token' + id).value;
        const eleve = document.getElementById('eleve' + id).value;
        const annee = document.getElementById('annee' + id).value;
        const err = document.getElementById('err' + id)


        console.log(link)
        if (!classe.includes('une') || !classe.includes('option')) {
            
            axios.post(link,
                {
                    "_token" : token,
                    "eleve_id" : eleve,
                    "classe_id" : classe,
                    "annee_scolaire_id" : annee
                }
            ).then(e => {
                console.log(e)
                if(e.data === 'succes'){
                document.getElementById('tr' + id).classList.toggle('hidden');
                }else{
                    err.innerHTML = e.data
                }
            })
            .catch(e => {
                console.log(e)
                err.innerHTML = "Une erreur s'est produite reessayer plus tard"
            })

        } else {
            // console.log(Number(value) <= Number(max));
            err.innerHTML = "Veuillez choisir la classe"
        }
        
        e.preventDefault();
    }
    )
})


//cartes

btnCarte && btnCarte.forEach(btn => {
    btn.addEventListener('click', ()=> {
        let newW = open(btn.id, 'Carte Eleve', '_blank');
        newW.focus()
    })
})