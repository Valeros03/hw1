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
    playButton.classList.remove('hidden');


}

function onMouseLeft(event){

    let playButton = event.currentTarget.querySelector('button.play-over');
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
 
    console.log(json);
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
        const playButton = document.createElement('button');
        playButton.classList.add('icon-button');
        playButton.classList.add('play-over');
        playButton.classList.add('hidden');

        const imagePlay = document.createElement('img');
        imagePlay.src = 'https://img.icons8.com/?size=100&id=36067&format=png&color=40C057';
        imagePlay.classList.add('icon-image');

        playButton.appendChild(imagePlay);
     
        const track_data = trackResults[i]
       
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
        track.href = "http://localhost/hw1/album.php?id=" + track_data.id;
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

    const elementList = document.querySelectorAll('a.element-show');


    for(let element of elementList){
        element.addEventListener('mouseenter', onMouseOver);
        element.addEventListener('mouseleave', onMouseLeft);
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