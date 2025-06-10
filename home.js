  function onResponse(response) {
   
    return response.json();
  }


function createArtistElement(artist) {

    const artistContainer = document.querySelector('.artist-category');

    const link = document.createElement('a');
    link.classList.add('element-show');
    link.href = 'http://localhost/hw1/artist.php?id=' + artist.artistId;

    const imageBox = document.createElement('div');
    imageBox.classList.add('image-box');

    const img = document.createElement('img');
    img.classList.add('artist-icon');
    img.src = artist.artistImg;
    imageBox.appendChild(img);

    const playButton = document.createElement('button');
    playButton.classList.add('icon-button');
    playButton.classList.add('play-over');
    playButton.classList.add('hidden');

    const playIcon = document.createElement('img');
    playIcon.src = 'https://img.icons8.com/?size=100&id=36067&format=png&color=40C057';
    playIcon.classList.add('icon-image');
    playButton.appendChild(playIcon);

    const namePara = document.createElement('p');
    namePara.classList.add('artist-name'); 
    namePara.classList.add('open-sans');
    namePara.textContent = artist.artistName;

    const typePara = document.createElement('p');
    typePara.classList.add('gray-text');
    typePara.textContent = 'Artista';

    link.appendChild(imageBox);
    link.appendChild(playButton);
    link.appendChild(namePara);
    link.appendChild(typePara);

    artistContainer.appendChild(link);
}

function createAlbumElement(album) {

    const albumContainer = document.querySelector('.album-category');

    const link = document.createElement('a');
    link.classList.add('element-show');
    link.href = 'http://localhost/hw1/album.php?id=' + album.albumId;

    const imageBox = document.createElement('div');
    imageBox.classList.add('image-box');

    const img = document.createElement('img');
    img.classList.add('album-icon');
    img.src = album.albumImg;
    imageBox.appendChild(img);

    const playButton = document.createElement('button');
    playButton.classList.add('icon-button');
    playButton.classList.add('play-over');
    playButton.classList.add('hidden');

    const playIcon = document.createElement('img');
    playIcon.src = 'https://img.icons8.com/?size=100&id=36067&format=png&color=40C057';
    playIcon.classList.add('icon-image');
    playButton.appendChild(playIcon);

    const namePara = document.createElement('p');
    namePara.classList.add('artist-name'); 
    namePara.classList.add('open-sans');
    namePara.textContent = album.albumName;

    const artistPara = document.createElement('p');
    artistPara.classList.add('gray-text');
    artistPara.textContent = album.artistName;

    link.appendChild(imageBox);
    link.appendChild(playButton);
    link.appendChild(namePara);
    link.appendChild(artistPara);

    albumContainer.appendChild(link);
}

function createPlaylistElement(playlist) {

    const playlistContainer = document.querySelector('.playlist-category');
    
    const link = document.createElement('a');
    link.classList.add('element-show');
    link.href = 'http://localhost/hw1/playlist.php?id=' + playlist.playlistId;

    const imageBox = document.createElement('div');
    imageBox.classList.add('image-box');

    const img = document.createElement('img');
    img.classList.add('album-icon');
    img.src = playlist.img;
    imageBox.appendChild(img);

    const playButton = document.createElement('button');
    playButton.classList.add('icon-button');
    playButton.classList.add('play-over');
    playButton.classList.add('hidden');

    const playIcon = document.createElement('img');
    playIcon.src = 'https://img.icons8.com/?size=100&id=36067&format=png&color=40C057';
    playIcon.classList.add('icon-image');
    playButton.appendChild(playIcon);

    const namePara = document.createElement('p');
    namePara.classList.add('artist-name'); 
    namePara.classList.add('open-sans');
    namePara.textContent = playlist.playlistName;

    link.appendChild(imageBox);
    link.appendChild(playButton);
    link.appendChild(namePara);

    playlistContainer.appendChild(link);
}

function createAllData(data) {
    
    if (data.artists) {
        for (let i = 0; i < data.artists.length; i++) {
            createArtistElement(data.artists[i]);
        }
    }
    
    if (data.albums) {
        for (let j = 0; j < data.albums.length; j++) {
            createAlbumElement(data.albums[j]);
        }
    }

    
    if (data.playlists) {
        for (let k = 0; k < data.playlists.length; k++) {
            createPlaylistElement(data.playlists[k]);
        }
    }

    const elementList = document.querySelectorAll('a.element-show');

    for(let element of elementList){
   
        element.addEventListener('mouseenter', onMouseOver);
        element.addEventListener('mouseleave', onMouseLeft);
    }
}



fetch('getHomeData.php').then(onResponse).then(createAllData);