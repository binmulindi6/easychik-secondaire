import { createPopper } from '@popperjs/core';


const profile = document.querySelector('#profile');
const profile_popper = document.querySelector('#profile-popper');
const notify = document.querySelector('#notify');
const notify_popper = document.querySelector('#notify-popper');


createPopper(profile, profile_popper, {
  placement: 'bottom',
});

profile.addEventListener('click', () => {
  notify_popper.classList.add('opacity-0');
  profile_popper.classList.toggle('opacity-0');
})




createPopper(notify, notify_popper, {
  placement: 'bottom',
});

notify.addEventListener('click', () => {
  profile_popper.classList.add('opacity-0');
  notify_popper.classList.toggle('opacity-0');

})
