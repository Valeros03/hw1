const songs = document.querySelectorAll("span.song");
console.log(songs);

function mouseEntered(event){

        event.currentTarget.classList.add("gray-focus");
        let likeButton = event.currentTarget.querySelector("a");
        likeButton.classList.remove("hidden");

}


function mouseLeave(event){

        event.currentTarget.classList.remove("gray-focus");
        let likeButton = event.currentTarget.querySelector("a");
        likeButton.classList.add("hidden");
    
}



for(let song of songs){

    song.addEventListener("mouseenter", mouseEntered);
    song.addEventListener("mouseleave", mouseLeave);
}