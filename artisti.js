let songsList;
let albumList;

let shownTracks;
let shownAlbum;

function mouseEntered(event){

        
        let likeButton = event.currentTarget.querySelector("a");
        likeButton.classList.remove("hidden");

}


function mouseLeave(event){

        let likeButton = event.currentTarget.querySelector("a");
        likeButton.classList.add("hidden");
    
}

function showLess(){


const songsGroup = document.querySelector("#songs");
const allSongs = songsGroup.querySelectorAll('.song');

    
    for (let i = 5; i < allSongs.length; i++) {
        songsGroup.removeChild(allSongs[i]);
    }

const mostraMeno = songsGroup.querySelector('.altro');
        if (mostraMeno) {
                songsGroup.removeChild(mostraMeno);
        }

        const mostraAltro = document.createElement('a');
        mostraAltro.addEventListener('click', showMore);
        mostraAltro.classList.add('altro');
        mostraAltro.textContent = "Mostra altro";
        songsGroup.appendChild(mostraAltro);

}

function showMore(){

        let size = songsList.length;
        const songsGroup = document.querySelector("#songs");
        for(let i = 5; i<size; i++){

                const song = songsList[i];
              
                const songSpan = document.createElement('span');
                songSpan.classList.add('song');

                songSpan.dataset.id = song.id;

                const firstHalf = document.createElement('div');
                const secondHalf = document.createElement('div');

                const number = document.createElement('span');
                number.classList.add('number');
                number.textContent = i+1;

                const icon = document.createElement('img');
                icon.src= song.album.images[0].url;
                icon.classList.add('song-icon');
                
                const name = document.createElement('span');
                name.textContent = song.name;

                firstHalf.appendChild(number);
                firstHalf.appendChild(icon);
                firstHalf.appendChild(name);

                const likeButton = document.createElement('a');
                const likeIcon = document.createElement('img');
                
                if(!song.liked){
                        likeIcon.src="https://img.icons8.com/?size=100&id=1501&format=png&color=737373";
                        likeButton.classList.add('hidden');
                        songSpan.addEventListener("mouseenter", mouseEntered);
                        songSpan.addEventListener("mouseleave", mouseLeave);

                }else{
                        likeIcon.src="https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2";
                        likeButton.classList.add('liked');       
                }
                
                
                
                likeButton.addEventListener('click', toggleLike);
                likeButton.appendChild(likeIcon);

                const durata = document.createElement('span');
                const duration_ms = song.duration_ms;
                const totalSec = Math.floor(duration_ms / 1000);
                const min = Math.floor(totalSec / 60);
                const sec = totalSec % 60;
                const paddedSec = (sec < 10 ? '0' : '') + sec;
                durata.textContent = min + ':' + paddedSec;

                secondHalf.appendChild(likeButton);
                secondHalf.appendChild(durata);

                songSpan.appendChild(firstHalf);
                songSpan.appendChild(secondHalf);

                songsGroup.appendChild(songSpan);

        }

        const mostraAltro = songsGroup.querySelector('.altro');
        if (mostraAltro) {
                songsGroup.removeChild(mostraAltro);
        }

         const  mostraMeno = document.createElement('a');
                mostraMeno.addEventListener('click', showLess);
                mostraMeno.classList.add('altro');
                mostraMeno.textContent = "Mostra meno";
                songsGroup.appendChild(mostraMeno);

}

function toggleLike(event) {
    const button = event.currentTarget;
    const icon = button.querySelector('img');

    const songSpan = button.parentElement.parentElement;
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

function onResponse(response) {
   
    return response.json();
}

function getSongs(json){

        songsList = json.tracks;
        let size = songsList.length;     
        if(size > 5){
                shownTracks = 5;
        }else{
                shownTracks = size;
        }

        const songsGroup = document.querySelector("#songs");
        for(let i = 0; i<shownTracks; i++){
                
                const song = songsList[i];
              
                const songSpan = document.createElement('span');
                songSpan.classList.add('song');

                songSpan.dataset.id = song.id;

                const firstHalf = document.createElement('div');
                const secondHalf = document.createElement('div');

                const number = document.createElement('span');
                number.classList.add('number');
                number.textContent = i+1;

                const icon = document.createElement('img');
                icon.src= song.album.images[0].url;
                icon.classList.add('song-icon');
                
                const name = document.createElement('span');
                name.textContent = song.name;

                firstHalf.appendChild(number);
                firstHalf.appendChild(icon);
                firstHalf.appendChild(name);

                const likeButton = document.createElement('a');
                const likeIcon = document.createElement('img');
                
                if(!song.liked){
                        likeIcon.src="https://img.icons8.com/?size=100&id=1501&format=png&color=737373";
                        likeButton.classList.add('hidden');
                        songSpan.addEventListener("mouseenter", mouseEntered);
                        songSpan.addEventListener("mouseleave", mouseLeave);

                }else{
                        likeIcon.src="https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2";
                        likeButton.classList.add('liked');       
                }
                
                
                
                likeButton.addEventListener('click', toggleLike);
                likeButton.appendChild(likeIcon);

                const durata = document.createElement('span');
                const duration_ms = song.duration_ms;
                const totalSec = Math.floor(duration_ms / 1000);
                const min = Math.floor(totalSec / 60);
                const sec = totalSec % 60;
                const paddedSec = (sec < 10 ? '0' : '') + sec;
                durata.textContent = min + ':' + paddedSec;

                secondHalf.appendChild(likeButton);
                secondHalf.appendChild(durata);

                songSpan.appendChild(firstHalf);
                songSpan.appendChild(secondHalf);

                songsGroup.appendChild(songSpan);
                
        }



        if(size > 5){
                const mostraAltro = document.createElement('a');
                mostraAltro.addEventListener('click', showMore);
                mostraAltro.classList.add('altro');
                mostraAltro.textContent = "Mostra altro";
                songsGroup.appendChild(mostraAltro);
        }

}



function getAlbum(json){

        albumList = json.items;
        let size = albumList.length;     
        if(size > 5){
                shownAlbum = 6;
        }else{
                shownAlbum = size;
        }

        for(let i = 0; i<shownAlbum; i++){


        const playButton = document.createElement('button');
        playButton.classList.add('icon-button');
        playButton.classList.add('play-over');
        playButton.classList.add('hidden');

        const imagePlay = document.createElement('img');
        imagePlay.src = 'https://img.icons8.com/?size=100&id=36067&format=png&color=40C057';
        imagePlay.classList.add('icon-image');

        playButton.appendChild(imagePlay);
     
        const track_data = albumList[i]
       
        const title = track_data.name;
        const num_artist = track_data.artists.length;
        let artistList="";
        
        for(let j=0; j<num_artist; j++){
          artistList += track_data.artists[j].name + " ";
        }

        const img = document.createElement('img');
        img.classList.add('album-icon');

        if(track_data.images)
            img.src = track_data.images[1].url;
        
        const track = document.createElement('a');
        track.href="album.php?id=" + track_data.id;
        track.classList.add('element-show');
  
        const imgWrapper = document.createElement('div');
        imgWrapper.classList.add('image-box');

        imgWrapper.appendChild(img);
  
        const nomeTrack = document.createElement('p');
        nomeTrack.textContent = title;
        nomeTrack.classList.add('artist-name');
        nomeTrack.classList.add('open-sans');
  
        const caption = document.createElement('sapn');
        caption.textContent = artistList;
        caption.classList.add('gray-text');
      
        track.appendChild(imgWrapper);
        track.appendChild(playButton);
        track.appendChild(nomeTrack);
        track.append(caption);

        const discography = document.querySelector("#discography");
        discography.appendChild(track);

        track.addEventListener('mouseenter', onMouseOver);
        track.addEventListener('mouseleave', onMouseLeft);

        }

        
        
    

}

const url = new URL(window.location.href);
const params = new URLSearchParams(url.search);

const id = params.get("id");

fetch("Songs.php?id=" + encodeURIComponent(id)).then(onResponse).then(getSongs);
fetch("Discografia.php?id=" + encodeURIComponent(id)).then(onResponse).then(getAlbum);



