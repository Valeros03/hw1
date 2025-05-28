const mainContent = document.querySelector('#content-show');
const searchingContent = document.querySelector('#search-show');

function onMouseOver(event){

    let playButton = event.currentTarget.querySelector('button.play-over');
    playButton.classList.remove('hidden');


}

function onMouseLeft(event){

    let playButton = event.currentTarget.querySelector('button.play-over');
    playButton.classList.add('hidden');


}

function showDropDown(event){

    event.stopPropagation();
    dropDown.classList.remove('hidden');
}

function hideDropDown(){

    dropDown.classList.add('hidden');

}




const elementList = document.querySelectorAll('div.element-show');

for(let element of elementList){
    element.addEventListener('mouseenter', onMouseOver);
    element.addEventListener('mouseleave', onMouseLeft);
}







