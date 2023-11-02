import axios from "axios";

const popUp = document.querySelector("#pop-up");
const btnPopUp = document.querySelector("#btn-pop-up");
const btnClosePopUp = document.querySelectorAll(".btn-close-pop-up");
const btnSave = document.querySelector("#btn-save");
const profileInput = document.querySelector("#profile-image-input");
const profileImage = document.querySelector("#profile-image");

const oldUrl = profileImage && profileImage.src

btnPopUp &&
    // popUp &&
    btnPopUp.addEventListener("click", () => {
        popUp && popUp.classList.toggle("hidden");
    });
btnClosePopUp &&
    popUp &&
    // btnSave &&
    btnClosePopUp.forEach(btn => {
        btn.addEventListener("click", () => {
            popUp && popUp.classList.toggle("hidden");
            btnSave && btnSave.classList.add("hidden");
            profileImage.src = oldUrl
        });
    })

profileInput &&
    profileImage &&
    profileInput.addEventListener("change", (e) => {
        if (e.target.files.length > 0) {
            btnSave && btnSave.classList.remove("hidden");
            profileImage.src = URL.createObjectURL(e.target.files[0]);
        }                       
    });

// How to Preview an image before uploading in JavaScript ?


