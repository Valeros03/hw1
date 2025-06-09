const mainContent = document.querySelector('#content-show');
const searchingContent = document.querySelector('#search-show');

const dropDown = document.querySelector('#dropdown-pam');
const artistInfo = document.querySelector('#artist-info');

let isShown = false;
let bSearching = false;

const searchingBlock = document.querySelector('#input-container');
const inputText = searchingBlock.querySelector('input');
const menu = document.querySelector('#menu');

const searchButton = document.querySelector('#search-button');

function onMouseOver(event){

    let playButton = event.currentTarget.querySelector('button.play-over');
    if(!playButton)
        playButton = event.currentTarget.querySelector('button.like-over');

    playButton.classList.remove('hidden');


}

function onMouseLeft(event){

    let playButton = event.currentTarget.querySelector('button.play-over');
    if(!playButton)
        playButton = event.currentTarget.querySelector('button.like-over');

    playButton.classList.add('hidden');


}

function showDropDown(event){

    event.stopPropagation();
    dropDown.classList.remove('hidden');
    dropDownProf.classList.add('hidden');
}

function showProfDropDown(event){
    event.stopPropagation();
    dropDownProf.classList.remove('hidden');
    dropDown.classList.add('hidden');
}

function hideDropDown(){

    dropDown.classList.add('hidden');
    dropDownProf.classList.add('hidden');


}

function toggleLikeCard(event) {
    const card = event.currentTarget;
    const icon = card.querySelector('.like-over').querySelector('img');

    const songId = card.dataset.id;

    if (card.classList.contains('liked')) {
        icon.src = "https://img.icons8.com/?size=100&id=1501&format=png&color=737373"; 
        card.classList.remove('liked');
        card.addEventListener("mouseenter", onMouseOver);
        card.addEventListener("mouseleave", onMouseLeft);
        fetch('dislike.php?id=' + encodeURIComponent(songId));
        
    } else {
        icon.src = "https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2";
        card.classList.add('liked');
        card.removeEventListener("mouseenter", onMouseOver);
        card.removeEventListener("mouseleave", onMouseLeft);
        fetch('like.php?id=' + encodeURIComponent(songId));
    }
}

  function onResponse(response) {
   
    return response.json();
  }

  function onJson(json) {

    const library = document.querySelector('#album-view');
    const artistCollection = document.querySelector('#artist-view');
    const trackCollection = document.querySelector('#track-view');

    library.innerHTML = '';
    artistCollection.innerHTML = '';
    trackCollection.innerHTML = '';
 
    const albumResults = json.albums.items;
    const artistResults = json.artists.items;
    const trackResults = json.tracks.items;


    
    let num_album;
    let num_artist_result;
    let num_track;

    if(albumResults.length > 6){
        num_album = 6;
    }else{
        num_album = albumResults.length;
    }

    if(artistResults.length > 6){
        num_artist_result = 6;
    }else{
        num_artist_result = artistResults.length;
    }

    if(trackResults.length > 6){
        num_track = 6;
    }else{
        num_track = trackResults.length;
    }
    

    for(let i=0; i<num_track; i++)
      {
     
        const track_data = trackResults[i];

        const LikeButton = document.createElement('button');
        LikeButton.classList.add('icon-button');
        LikeButton.classList.add('like-over');
    
        const imagePlay = document.createElement('img');
        
        const title = track_data.name;
        const num_artist = track_data.artists.length;
        let artistList="";
        
        for(let j=0; j<num_artist; j++){
          artistList += track_data.artists[j].name + " ";
        }

        const img = document.createElement('img');
        img.classList.add('album-icon');

        if(track_data.album.images)
            img.src = track_data.album.images[1].url;
        
        const track = document.createElement('a');
        track.classList.add('element-show');
        track.dataset.id = track_data.id;
        
        const imgWrapper = document.createElement('div');
        imgWrapper.classList.add('image-box');

        track.addEventListener('click', toggleLikeCard);
        if(!track_data.liked){
            imagePlay.src = 'https://img.icons8.com/?size=100&id=1501&format=png&color=737373';
            LikeButton.classList.add('hidden');
            track.addEventListener('mouseenter', onMouseOver);
            track.addEventListener('mouseleave', onMouseLeft);
             
        }else{
            imagePlay.src = 'https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2';
            track.classList.add('liked');  
        }
       
        imagePlay.classList.add('icon-image');

        LikeButton.appendChild(imagePlay);
        imgWrapper.appendChild(img);
  
        const nomeTrack = document.createElement('p');
        nomeTrack.textContent = title;
        nomeTrack.classList.add('artist-name');
        nomeTrack.classList.add('open-sans');
  
        const caption = document.createElement('sapn');
        caption.textContent = artistList;
        caption.classList.add('gray-text');
      
        track.appendChild(imgWrapper);
        track.appendChild(LikeButton);
        track.appendChild(nomeTrack);
        track.append(caption);
        trackCollection.appendChild(track);
  
      }

    for(let i=0; i<num_artist_result; i++)
    {
     
        const playButton = document.createElement('button');
        playButton.classList.add('icon-button');
        playButton.classList.add('play-over');
        playButton.classList.add('hidden');

        const imagePlay = document.createElement('img');
        imagePlay.src = 'https://img.icons8.com/?size=100&id=36067&format=png&color=40C057';
        imagePlay.classList.add('icon-image');

        playButton.appendChild(imagePlay);

        const artist_data = artistResults[i]
       
        const title = artist_data.name;

        const img = document.createElement('img');
        img.classList.add('artist-icon')

        if(artist_data.images.length > 0)
            img.src = artist_data.images[0].url;
        
        
        const artist = document.createElement('a');
        artist.href = "http://localhost/hw1/artist.php?id=" + artist_data.id;
        artist.classList.add('element-show');

        artist.addEventListener('mouseenter', onMouseOver);
        artist.addEventListener('mouseleave', onMouseLeft);
        
        artist.dataset.ArtistId = artist_data.id;
  
        const imgWrapper = document.createElement('div');
        imgWrapper.classList.add('image-box');

        imgWrapper.appendChild(img);

        const nomeArtista = document.createElement('p');
        nomeArtista.textContent = title;
        nomeArtista.classList.add('artist-name');
        nomeArtista.classList.add('open-sans');
      
        artist.appendChild(imgWrapper);
        artist.appendChild(playButton);
        artist.appendChild(nomeArtista);
        artistCollection.appendChild(artist);
  
    }


    for(let i=0; i<num_album; i++)
    {
   

        const playButton = document.createElement('button');
        playButton.classList.add('icon-button');
        playButton.classList.add('play-over');
        playButton.classList.add('hidden');

        const imagePlay = document.createElement('img');
        imagePlay.src = 'https://img.icons8.com/?size=100&id=36067&format=png&color=40C057';
        imagePlay.classList.add('icon-image');

        playButton.appendChild(imagePlay);
      const album_data = albumResults[i]
     
      const title = album_data.name;
      const num_artist = album_data.artists.length;
      let artistList="";
      
      for(let j=0; j<num_artist; j++){
        artistList += album_data.artists[j].name + " ";
      }

      const img = document.createElement('img');
      img.classList.add('album-icon');

        if(album_data.images.length > 0)
            img.src = album_data.images[0].url;
      
      const album = document.createElement('a');
      
      album.href = "http://localhost/hw1/album.php?id=" + album_data.id;
      album.classList.add('element-show');

      album.addEventListener('mouseenter', onMouseOver);
      album.addEventListener('mouseleave', onMouseLeft);

      const imgWrapper = document.createElement('div');
      imgWrapper.classList.add('image-box');

      imgWrapper.appendChild(img);

      const nomeAlbum = document.createElement('p');
      nomeAlbum.textContent = title;
      nomeAlbum.classList.add('artist-name');
      nomeAlbum.classList.add('open-sans');

      const caption = document.createElement('sapn');
      caption.textContent = artistList;
      caption.classList.add('gray-text');
    
      album.appendChild(imgWrapper);
      album.appendChild(playButton);
      album.appendChild(nomeAlbum);
      album.append(caption);
      library.appendChild(album);

    }

    
  }

function search(event)
{
 
    const value = event.currentTarget.value;
    if(bSearching === false){
        mainContent.classList.add('hidden');
        searchingContent.classList.remove('hidden');
    }

    bSearching = true;

    if(value === ""){

        searchingContent.classList.add('hidden');
        mainContent.classList.remove('hidden');
        bSearching = false;
        return;
    }

  const search_value = encodeURIComponent(value);
 
  fetch("http://localhost/hw1/search.php?val=" + search_value).then(onResponse).then(onJson);
}

function focusedSearch(){

    searchingBlock.classList.remove('hover-highlighted');
    searchingBlock.classList.add('highlighted-input');
}
function unfocusedSearch(){

    searchingBlock.classList.remove('highlighted-input');
    searchingBlock.classList.add('hover-highlighted');
    
}

function showInputContainer(){

    if(!isShown)
    {    
        searchingBlock.style.display = 'flex';
        focusedSearch();
        inputText.focus();
    }
    else
    {
        searchingBlock.style.display = 'none';
        unfocusedSearch();
    }
    isShown = !isShown;
}

function GetSavedSongs(){

    
}

const elementList = document.querySelectorAll('a.element-show');

for(let element of elementList){
   
    element.addEventListener('mouseenter', onMouseOver);
    element.addEventListener('mouseleave', onMouseLeft);
}



inputText.addEventListener('input', search);
inputText.addEventListener('focus', focusedSearch);
inputText.addEventListener('blur', unfocusedSearch);

document.addEventListener('click', hideDropDown);
menu.addEventListener('click', showDropDown);
searchButton.addEventListener('click', showInputContainer);


const profileButton = document.querySelector('#profile-button');
const dropDownProf = document.querySelector('#dropdown-profile');

if(profileButton){

    profileButton.addEventListener('click', showProfDropDown);

}

function dislike(event){

    const id = event.currentTarget.parentNode.dataset.id;
    event.currentTarget.parentNode.innerHTML = '';
    fetch('dislike.php?id='+ encodeURIComponent(id));
}

const dislikeButtons = document.querySelectorAll('.remove-like');

for(let dislikeButton of dislikeButtons){

    dislikeButton.addEventListener('click', dislike);

}