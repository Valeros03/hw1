function mouseEntered(event){

        
        let likeButton = event.currentTarget.querySelector("a.like-button");
        likeButton.classList.remove("hidden");

}


function mouseLeave(event){

        let likeButton = event.currentTarget.querySelector("a.like-button");
        likeButton.classList.add("hidden");
    
}


function toggleLike(event) {
    const button = event.currentTarget;
    const icon = button.querySelector('img');

    const songSpan = button.parentElement.parentElement.parentElement;
    console.log(songSpan);
    const songId = songSpan.dataset.id;
    
    if (button.classList.contains('liked')) {
        icon.src = "https://img.icons8.com/?size=100&id=1501&format=png&color=737373"; 
        button.classList.remove('liked');
        songSpan.addEventListener("mouseenter", mouseEntered);
        songSpan.addEventListener("mouseleave", mouseLeave);
        fetch('dislike.php?id=' + encodeURIComponent(songId));
        
    } else {
        icon.src = "https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2";
        button.classList.add('liked');
        songSpan.removeEventListener("mouseenter", mouseEntered);
        songSpan.removeEventListener("mouseleave", mouseLeave);
        fetch('like.php?id=' + encodeURIComponent(songId));
    }
}

const songs = document.querySelectorAll('.song');

for(let song of songs){

    const like = song.querySelector('a.like-button');
    if(!like.classList.contains('liked')){
        song.addEventListener("mouseenter", mouseEntered);
        song.addEventListener("mouseleave", mouseLeave);
    }
    
    like.addEventListener('click', toggleLike);

}