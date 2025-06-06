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

require_once 'token.php';
include 'nav.php';


 $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
 $queryArtist = 'SELECT * FROM artists LIMIT 6';
 $queryAlbum = "SELECT albums.id AS 'albums.id',
    albums.nome AS 'albums.nome',
    albums.tipo AS 'albums.tipo',
    albums.img AS 'albums.img',
    artists.id AS 'artists.id',
    artists.nome AS 'artists.nome',
    artists.img AS 'artists.img' FROM albums JOIN artists ON albums.artist = artists.id LIMIT 6";
 $queryPlaylist = 'SELECT * FROM playlistPopolari JOIN playlist ON playlistPopolari.id = playlist.id LIMIT 6';

 $resultArtist = mysqli_query($conn, $queryArtist);
 $resultAlbum = mysqli_query($conn, $queryAlbum);
 $resultPlaylist = mysqli_query($conn, $queryPlaylist);

 $token = isset($_SESSION["token"]) ? $_SESSION["token"] : null;


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
                    echo '
                        <a class="element-show" href="http://localhost/hw1/artist.php?id='.$row["id"].'">';
                    echo '<div class="image-box"><img class="artist-icon" src="'.$row["img"].'"></div>
                          <button class="icon-button play-over hidden"><img src="https://img.icons8.com/?size=100&id=36067&format=png&color=40C057" class="icon-image"></button>
                          <p class="artist-name open-sans" id="casa">'.$row["nome"].'</p>
                          <p class="gray-text">Artista</p>';
                    echo '</a>';
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
                  
                    echo '
                        <a class="element-show" href="http://localhost/hw1/album.php?id='.$row["albums.id"].'">';
                    echo '<div class="image-box"><img class="album-icon" src="'.$row["albums.img"].'"></div>
                          <button class="icon-button play-over hidden"><img src="https://img.icons8.com/?size=100&id=36067&format=png&color=40C057" class="icon-image"></button>
                          <p class="artist-name open-sans">'.$row["albums.nome"].'</p>
                          <p class="gray-text">'.$row["artists.nome"].'</p>';
                    echo '</a>';
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

                    $playlistId = mysqli_real_escape_string($conn, $row["id"]);
                    $queryArtistPlaylist = 'SELECT albums.img AS img FROM playlist 
                                            JOIN songsPlaylist ON playlist.id = songsPlaylist.playlistID
                                            JOIN songs ON songsPlaylist.songID = songs.ID
                                            JOIN albums ON songs.album = albums.id
                                            WHERE playlist.id = "'.$playlistId.'"
                                            LIMIT 1';
                    $res = mysqli_query($conn, $queryArtistPlaylist);
                    $rowImg = mysqli_fetch_array($res);
                    echo'<a href="http://localhost/hw1/playlist.php?id='.$row["id"].'" class="element-show"><div class="image-box"><img class="album-icon" src="'.$rowImg["img"].'"></div>
                            <button class="icon-button play-over hidden"><img src="https://img.icons8.com/?size=100&id=36067&format=png&color=40C057" class="icon-image"></button>
                            <p class="artist-name open-sans">'.$row["nome"].'</p></a>';
                            
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
                <div class="show-category" id="track-view">
                    
                </div>
                
            </section>
            <section class="group-content">
                <header class="section-header-dashboard">
                    <a href="#" id="more-artist" class="open-sans section-text"><strong>Artisti</strong></a>
                </header>
                <div class="show-category" id="artist-view">
                    
                </div>
                
            </section>
            <section class="group-content">
                <header class="section-header-dashboard">
                    <a href="#" id="more-album" class="open-sans section-text"><strong>Album</strong></a>
                </header>
                <div class="show-category" id="album-view">
                    
                </div>
                
            </section>
            
        </div>

        <?php
            include 'footer.php';

        ?>

    </nav>
    </div>

</div>

</body>

</html>
