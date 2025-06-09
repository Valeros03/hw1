function onModalClick() {
    document.body.classList.remove('no-scroll');
    modalView.classList.add('hidden');
    artistInfo.innerHTML = '';
}


function onThumbnailClick() {
    
    document.body.classList.add('no-scroll');
    modalView.classList.remove('hidden');

}

const modalView = document.querySelector('#modal-view');
const button  = document.querySelector('#open-modale');

button.addEventListener('click', onThumbnailClick);
modalView.addEventListener('click', onModalClick);

