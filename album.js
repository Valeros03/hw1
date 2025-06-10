function mouseEntered(event){

        
        let likeButton = event.currentTarget.querySelector("a.like-button");
        likeButton.classList.remove("hidden");

}


function mouseLeave(event){

        let likeButton = event.currentTarget.querySelector("a.like-button");
        likeButton.classList.add("hidden");
    
}

function onResponse(response) {
   
    return response.json();
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


function generateTrackList(json) {


    const container = document.getElementById('songs');
    const tracks = json.items;
    let index = 1;

    for (let i = 0; i < tracks.length; i++) {
        const track = tracks[i];
        const songSpan = document.createElement('span');
        songSpan.className = 'song';
        songSpan.dataset.id = track.id;

        const mainDiv = document.createElement('div');

        const numberSpan = document.createElement('span');
        numberSpan.className = 'number';
        numberSpan.textContent = index;

        const titleArtistsSpan = document.createElement('span');
        titleArtistsSpan.className = 'title-artists';
        titleArtistsSpan.textContent = track.name;

        const namesDiv = document.createElement('div');
        namesDiv.className = 'names';

        for (let j = 0; j < track.artists.length; j++) {
            const artist = track.artists[j];
            const artistLink = document.createElement('a');
            artistLink.href = 'artist.php?id=' + artist.id;
            artistLink.className = 'artist-name space-text';
            artistLink.textContent = artist.name;
            namesDiv.appendChild(artistLink);
        }

        titleArtistsSpan.appendChild(namesDiv);
        mainDiv.appendChild(numberSpan);
        mainDiv.appendChild(titleArtistsSpan);

        const rightDiv = document.createElement('div');

        const totalSeconds = Math.floor(track.duration_ms / 1000);
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;

        const likeDiv = document.createElement('div');
        likeDiv.className = 'like';

        const likeButton = document.createElement('a');
        likeButton.className = 'like-button';

        const likeImg = document.createElement('img');

        if (track.liked === true) {
            likeButton.classList.add('liked');
            likeImg.src = 'https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2';
        } else {
            likeButton.classList.add('hidden');
            likeImg.src = 'https://img.icons8.com/?size=100&id=1501&format=png&color=737373';
        }

        likeButton.appendChild(likeImg);
        likeDiv.appendChild(likeButton);
        rightDiv.appendChild(likeDiv);

        const durationSpan = document.createElement('span');
        durationSpan.className = 'duration';
        durationSpan.textContent = minutes + ':' + (seconds < 10 ? '0' + seconds : seconds);

        songSpan.appendChild(mainDiv);
        songSpan.appendChild(rightDiv);
        songSpan.appendChild(durationSpan);

        container.appendChild(songSpan);
        index++;
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

}

function generateAlbumHeader(json) {
    

    const album = json;
    const container = document.querySelector('.header-album');

    const imageBox = document.createElement('div');
    imageBox.className = 'image-box';

    const albumImage = document.createElement('img');
    albumImage.className = 'album-icon';
    albumImage.src = album.images[0].url;

    imageBox.appendChild(albumImage);

    const spanHeader = document.createElement('span');
    spanHeader.className = 'intestazione-album';

    const title = document.createElement('h1');
    title.textContent = album.name;

    const infoAlbum = document.createElement('span');
    infoAlbum.className = 'info-album';

    const artistLink = document.createElement('a');
    artistLink.href = 'artist.php?id=' + album.artists[0].id;
    artistLink.textContent = album.artists[0].name;

    const releaseDiv = document.createElement('div');
    releaseDiv.textContent = '• ' + album.release_date;

    const tracksDiv = document.createElement('div');
    tracksDiv.textContent = '• ' + album.total_tracks + ' brani';

    infoAlbum.appendChild(artistLink);
    infoAlbum.appendChild(releaseDiv);
    infoAlbum.appendChild(tracksDiv);

    spanHeader.appendChild(title);
    spanHeader.appendChild(infoAlbum);

    container.appendChild(imageBox);
    container.appendChild(spanHeader);
}


fetch('loadAlbum.php').then(onResponse).then(generateAlbumHeader);
fetch('loadAlbumTracks.php').then(onResponse).then(generateTrackList);


