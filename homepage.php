


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="mhw3.css"/>
<link rel="stylesheet" href="nav.css"/>
<script src="homepage.js" defer></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Spotify</title>

</head>


<?php

include 'userCheck.php';
include 'nav.php';

 $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
 $queryArtist = 'SELECT * FROM artists LIMIT 6';
 $queryAlbum = 'SELECT * FROM albums JOIN artists ON albums.artist = artists.id LIMIT 6';
 $queryPlaylist = 'SELECT * FROM playlist LIMIT 6';

 $resultArtist = mysqli_query($conn, $queryArtist);
 $resultAlbum = mysqli_query($conn, $queryAlbum);
 $resultPlaylist = mysqli_query($conn, $queryPlaylist);


?>
<nav id="dashboard">
        <div id="content-show">
        <section class="group-content">
            <header class="section-header-dashboard">
                <p class="open-sans section-text"><strong>Artisti più popolari</strong></p>
                <a href="#"><P class="gray-text">Mostra tutto</P></a>
            </header>
            <div class="show-category artist-category">

            <?php

                while( $row = mysqli_fetch_array($resultArtist) ) {
                    echo '<a href="http://localhost/artist.php?id='.$row["id"].'">
                        <div class="element-show" data-type="artist" data-id="'.$row["id"].'">';
                    echo '<div class="image-box"><img class="artist-icon" src="'.$row["img"].'"></div>
                          <button class="icon-button play-over hidden"><img src="https://img.icons8.com/?size=100&id=36067&format=png&color=40C057" class="icon-image"></button>
                          <p class="artist-name open-sans" id="casa">'.$row["nome"].'</p>
                          <p class="gray-text">Artista</p>';
                    echo '</div>
                        </a>';
                }
                mysqli_free_result($resultArtist);
                

            ?>
            
            </div>
        </section>

        <section class="group-content">
            <header class="section-header-dashboard">
                <p class="open-sans section-text"><strong>Album e singoli più popolari</strong></p>
                <a href="#"><P class="gray-text">Mostra tutto</P></a>
            </header>
            <div class="show-category" class="album-category">

            <?php

                while( $row = mysqli_fetch_array($resultAlbum) ) {
                    echo '<a href="http://localhost/album.php?id='.$row["id"].'"><div class="element-show" data-type="album" data-id="'.$row["id"].'>';
                    echo '<div class="image-box"><img class="album-icon" src="'.$row["image"].'"></div>
                          <button class="icon-button play-over hidden"><img src="https://img.icons8.com/?size=100&id=36067&format=png&color=40C057" class="icon-image"></button>
                          <p class="artist-name open-sans">'.$row["nome"].'</p>
                          <p class="gray-text">'.$row["artist.nome"].'</p>';
                    echo '</div></a>';
                }
                mysqli_free_result($resultAlbum);
                

            ?>

            </div>
        </section>
        
        <section class="group-content">
            <header class="section-header-dashboard">
                <p class="open-sans section-text"><strong>Stazioni radio più popolari</strong></p>
                <a href="#"><P class="gray-text">Mostra tutto</P></a>
            </header>
            <div class="show-category" class="playlist-category">
                
            <?php

                while($row = mysqli_fetch_array($resultPlaylist) ){

                    $queryArtistPlaylist = 'SELECT artists.nome FROM playlist 
                                            JOIN songsPlaylist ON playlist.id = songsPlaylists.playlistID
                                            JOIN songs ON songsPlaylists.songID = songs.ID
                                            JOIN artists ON songs.artist = artists.id
                                            LIMIT 3';
                    $res = mysqli_query($conn, $queryArtistPlaylist);

                    echo'<a href="http://localhost/artist.php?id='.$row["id"].'"><div class="image-box"><img class="album-icon" src="https://pickasso.spotifycdn.com/image/ab67c0de0000deef/dt/v1/img/radio/artist/4q3ewBCX7sLwd24euuV69X/it"></div>
                            <button class="icon-button play-over hidden"><img src="https://img.icons8.com/?size=100&id=36067&format=png&color=40C057" class="icon-image"></button>
                            <p class="gray-text">Con';
                            
                while( $row = mysqli_fetch_array($res) ) {
                    echo $row['artist.name'];
                }     
                           echo 'e molti altri</p></a>';

                }



            ?>

            </div>
        </section>
        </div>

        <div id="search-show" class="hidden">
            <section class="group-content">
                <header class="section-header-dashboard">
                    <a href="#" id="more-track" class="open-sans section-text"><strong>Brani</strong></a>
                </header>
                <div class="show-category" class="track-category">
                    
                </div>
                
            </section>
            <section class="group-content">
                <header class="section-header-dashboard">
                    <a href="#" id="more-artist" class="open-sans section-text"><strong>Artisti</strong></a>
                </header>
                <div class="show-category" class="artist-category">
                    
                </div>
                
            </section>
            <section class="group-content">
                <header class="section-header-dashboard">
                    <a href="#" id="more-album" class="open-sans section-text"><strong>Album</strong></a>
                </header>
                <div class="show-category" class="album-category">
                    
                </div>
                
            </section>
            
        </div>

        <div id="footer-dash-section">
            <div class="spotify-information">

                <p class="white-text open-sans"><strong>Azienda</strong></p>
                <a href="#" class="gray-link open-sans">Chi siamo</a>
                <a href="#" class="gray-link open-sans">Opportunità di lavoro</a>
                <a href="#" class="gray-link open-sans">For the Record</a>

            </div>

            <div class="spotify-information">

                <p class="white-text open-sans"><strong>Comunity</strong></p>
                <a href="#" class="gray-link open-sans">Per artisti</a>
                <a href="#" class="gray-link open-sans">Sviluppatori</a>
                <a href="#" class="gray-link open-sans">Pubblicità</a>
                <a href="#" class="gray-link open-sans">Investitori</a>
                <a href="#" class="gray-link open-sans">Venditori</a>

            </div>

            <div class="spotify-information">

                <p class="white-text open-sans"><strong>Link utili</strong></p>
                <a href="#" class="gray-link open-sans">Assistenza</a>
                <a href="#" class="gray-link open-sans">App per cellulare gratuita</a>
                <a href="#" class="gray-link open-sans">Diritti del consumatore</a>

            </div>

            <div class="spotify-information">

                <p class="white-text open-sans"><strong>Piani Spotify</strong></p>
                <a href="#" class="gray-link open-sans">Premium Individual</a>
                <a href="#" class="gray-link open-sans">Premium Duo</a>
                <a href="#" class="gray-link open-sans">Premium Family</a>
                <a href="#" class="gray-link open-sans">Premium Student</a>
                <a href="#" class="gray-link open-sans">Spotify Free</a>

            </div>

            <div class="flex-box-right">
                <button class="icon-button gray-back">
                    <img src="https://img.icons8.com/?size=100&id=32292&format=png&color=737373" class="searching-icon">
                </button>
                <button class="icon-button gray-back">
                    <img src="https://img.icons8.com/?size=100&id=fJp7hepMryiw&format=png&color=737373" class="searching-icon">
                </button>
                <button class="icon-button gray-back">
                    <img src="https://img.icons8.com/?size=100&id=118466&format=png&color=737373" class="searching-icon">
                </button>
            </div>

        </div>

    </nav>
    </div>

</div>

</body>

</html>
