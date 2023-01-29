// /// deletebtn

// const btnDelete = document.querySelectorAll(".fa-trash");

// btnDelete.forEach((btn) => {
//     btn.onclick = Delete;
//     //btn.addEventListener("click", Delete, false);
// });

// console.log(btnDelete);
// //btnDelete.addEventListener("click", Delete, false);

// function Delete(event) {
//     if (!confirm("Voulez-vous vraiment suprimer cet element?")) {
//         event.preventDefault();
//     }
// }

const formDelete = document.querySelectorAll(".delete-form");

formDelete.forEach((btn) => {
    //btn.onclick = Delete;
    btn.addEventListener("submit", Delete, false);
});

console.log(formDelete);
//btnDelete.addEventListener("click", Delete, false);

function Delete(event) {
    if (!confirm("Voulez-vous vraiment suprimer cet element?")) {
        event.preventDefault();
    }
}
