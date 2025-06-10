
function mouseEntered(event){

        
        let likeButton = event.currentTarget.querySelector("a.like-button");
        likeButton.classList.remove("hidden");

}
function mouseLeave(event){

        let likeButton = event.currentTarget.querySelector("a.like-button");
        likeButton.classList.add("hidden");
    
}


function createPlaylistHeader(json) {
    const container = document.querySelector('.header-album');

    const imageBox = document.createElement('div');
    imageBox.className = 'image-box';

    const img = document.createElement('img');
    img.className = 'album-icon';
    img.src = json.header.img;
    imageBox.appendChild(img);

    const textBox = document.createElement('span');
    textBox.className = 'intestazione-album';

    const h1 = document.createElement('h1');
    h1.textContent = json.header.nomePlaylist;
    textBox.appendChild(h1);

    const infoAlbum = document.createElement('span');
    infoAlbum.className = 'info-album';

    const ownerDiv = document.createElement('div');
    ownerDiv.className = 'space-text';
    ownerDiv.textContent = 'Playlist di ' + json.header.usr;

    const dotDiv = document.createElement('div');
    dotDiv.className = 'space-text';
    dotDiv.textContent = '•';

    const countDiv = document.createElement('div');
    countDiv.textContent = json.header.song_count + ' brani';

    infoAlbum.appendChild(ownerDiv);
    infoAlbum.appendChild(dotDiv);
    infoAlbum.appendChild(countDiv);

    textBox.appendChild(infoAlbum);
    container.appendChild(imageBox);
    container.appendChild(textBox);
    
}

function createPlaylistTracklist(json) {
    
    const container = document.getElementById('content-show');

   for (let i = 0; i < json.tracks.length; i++) {
    const track = json.tracks[i];

    const song = document.createElement('span');
    song.className = 'song';
    song.dataset.id = track.songId;

    const topDiv = document.createElement('div');

    const num = document.createElement('span');
    num.className = 'number';
    num.textContent = i + 1;

    const img = document.createElement('img');
    img.src = track.albumImg;

    const title = document.createElement('span');
    title.className = 'title-artists';
    title.textContent = track.songName;

    topDiv.appendChild(num);
    topDiv.appendChild(img);
    topDiv.appendChild(title);

    const artistLink = document.createElement('a');
    artistLink.href = 'artist.php?id=' + track.artistId;
    artistLink.className = 'artist-name space-text';
    artistLink.textContent = track.artistName;

    const albumLink = document.createElement('a');
    albumLink.href = 'album.php?id=' + track.albumId;
    albumLink.className = 'artist-name space-text';
    albumLink.textContent = track.albumName;

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

    song.appendChild(topDiv);
    song.appendChild(artistLink);
    song.appendChild(albumLink);
    song.appendChild(likeDiv);

    container.appendChild(song);
}


    setupTrackEvents();
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

function jsonDistribute(json){

    createPlaylistHeader(json);
    createPlaylistTracklist(json);

}

function setupTrackEvents() {
    const songs = document.querySelectorAll('.song');

    for (let i = 0; i < songs.length; i++) {
        const song = songs[i];
        const like = song.querySelector('a.like-button');

        if (!like.classList.contains('liked')) {
            song.addEventListener('mouseenter', mouseEntered);
            song.addEventListener('mouseleave', mouseLeave);
        }

        like.addEventListener('click', toggleLike);
    }
}


fetch('getPlaylist.php').then(onResponse).then(jsonDistribute);