import { createPopper } from "@popperjs/core";

const profile = document.querySelector("#profile");
const profile_popper = document.querySelector("#profile-popper");
const notify = document.querySelector("#notify");
const notify_popper = document.querySelector("#notify-popper");

profile && profile_popper && createPopper(profile, profile_popper, {
    placement: "bottom",
});

// console.log(1211212);

profile && profile.addEventListener("click", () => {
    notify_popper.classList.add("opacity-0");
    profile_popper.classList.toggle("opacity-0");
    profile_popper.classList.toggle("z-20");
    notify_popper.classList.remove("z-20");
});

notify && notify_popper && createPopper(notify, notify_popper, {
    placement: "bottom",
});

notify && notify.addEventListener("click", () => {
    profile_popper.classList.add("opacity-0");
    notify_popper.classList.toggle("opacity-0");
    notify_popper.classList.toggle("z-20");
    profile_popper.classList.remove("z-20");
});
