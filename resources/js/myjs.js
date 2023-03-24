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

const frm = document.querySelector(".frm-create");
const display = document.querySelector(".display");
//eleves

//Show Eleve

const btnIdentity = document.querySelector(".btn-identity");
const frmIdentity = document.querySelector(".frm-identity");
//console.log(btnIdentity);
// console.log(frm)
(display !== null && frm !== null) && btnCreate.forEach((btn) => {
    btn.addEventListener("click", function () {
        if (frm.getAttribute("hidden") == true) {
            display.setAttribute("hidden", "true");
            frm.classList.toggle("hidden");
        } else {
            frm.classList.remove("hidden");
            display.classList.add("hidden");
            console.log(11);
        }
    });
});

(display !== null && frm !== null) && btnDispaly.forEach((btn) => {
    btn.addEventListener("click", function () {
        if (frm.getAttribute("hidden") == false) {
            frm.setAttribute("hidden", "true");
            display.classList.toggle("hidden");
            //console.log(11);
        } else {
            frm.classList.add("hidden");
            display.classList.remove("hidden");
            console.log(11);
        }
    });
});

/*btn_create_eleve.addEventListener("click", function (){

    if(form_add_eleve.getAttribute("hidden") == true){
        display_eleves.setAttribute("hidden", "true");
        form_add_eleve.classList.toggle("hidden");
    }else{
        form_add_eleve.classList.remove("hidden");
        display_eleves.classList.add("hidden");
        console.log(11);
    }

});

btn_show_eleves.addEventListener("click", function (){

    if(form_add_eleve.getAttribute("hidden") == false){
        form_add_eleve.setAttribute("hidden", "true");
        display_eleves.classList.toggle("hidden");
    }else{
        form_add_eleve.classList.add("hidden");
        display_eleves.classList.remove("hidden");
    }

});


//frequentations

btn_create_frequentations.addEventListener("click", function (){
    console.log(10);
    if(frm_frequentations.getAttribute("hidden") == true){
        display_frequentations.setAttribute("hidden", "true");
        frm_frequentations.classList.toggle("hidden");
    }else{
        frm_frequentations.classList.remove("hidden");
        display_frequentations.classList.add("hidden");
    }

});

btn_show_frequentations.addEventListener("click", function (){

    if(frm_frequentations.getAttribute("hidden") == false){
        frm_frequentations.setAttribute("hidden", "true");
        display_frequentations.classList.toggle("hidden");
    }else{
        frm_frequentations.classList.add("hidden");
        display_frequentations.classList.remove("hidden");
    }

});*/

if (btnIdentity !== null) {
    btnIdentity.addEventListener("click", () => {
       frmIdentity !== null && frmIdentity.classList.toggle("hidden");
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

    // var printContents = printable.innerHTML;
	// var originalContents = document.body.innerHTML;

			// document.body.innerHTML = printContents;

			window.print();

			// document.body.innerHTML = originalContents;
    // window.print()
})

// printable bullentin



