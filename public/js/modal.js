'use strict';

const popupView = document.getElementById('view_popup');
const popupModal = document.getElementById('popup_view');

popupView.addEventListener('click', () => {
    popupModal.classList.remove('fade');
    popupModal.style = 'display:block;background-color: rgb(128 128 128 / 40%);';
});

const closePopup = document.querySelectorAll('.close-popup');

for(let i = 0; i < closePopup.length; i++){
    closePopup[i].addEventListener('click', () => {
        popupModal.classList.add('fade');
        popupModal.style = 'display:none';
    });
}
