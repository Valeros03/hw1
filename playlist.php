<?php

include 'userCheck.php';


$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$playlistId = mysqli_real_escape_string($conn,$_GET["id"]);

$query = 'SELECT nome AS nomePlaylist, username AS usr FROM playlist where playlist.id = "'.$playlistId.'"';
$result = mysqli_query($conn, $query);
$playlist = mysqli_fetch_assoc($result);
$query = '  SELECT s.id AS songId, s.nome AS songName, a.id AS albumId, a.nome AS albumName, ar.id AS artistId, ar.nome AS artistName, a.img AS albumImg
            FROM (
                    SELECT *
                    FROM songsPlaylist sp
                    WHERE sp.playlistID = "'.$playlistId.'"
            ) AS filtered_sp
            JOIN songs s ON filtered_sp.songID = s.id
            JOIN albums a ON s.album = a.id
            JOIN artists ar ON s.artist = ar.id';

$resultSongs = mysqli_query($conn, $query);
$songNumber = mysqli_num_rows($resultSongs);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="mhw3.css"/>
<link rel="stylesheet" href="nav.css"/>
<link rel="stylesheet" href="playlist.css"/>
<script src="homepage.js" defer></script>
<script src="album.js" defer></script>


</head>
<body>

<?php

 include 'nav.php';


?>

<nav id="dashboard">
<div id="content-show">


<div class="header-album">

    <?php
        $primoElemento = mysqli_fetch_assoc($resultSongs);

        if($primoElemento){

            echo '<div class="image-box"><img class="album-icon" src="'.$primoElemento['albumImg'].'"></div>';
            echo '<span class="intestazione-album">';
            echo '<h1>'.$playlist['nomePlaylist'].'</h1>';
            echo '<sapn class="info-album">';
            echo '<div class="space-text">Playlist di '.$playlist['usr'].'</div><div class="space-text">•</div><div>'.$songNumber.' brani</div>';
            echo '</span>';
            echo '</span>';
        }

    ?>
</div>

<span id="header-track-playlist">
    <div>
        <span class="number">#</span>
        <div class="song-space"></div>
        <span class="title-artists">Titolo</span>
    </div>
    
    <div class="artist-name space-text">Artista</div>
    <div class="artist-name space-text">Album</div>
    <div class="like">
    </div>
</span>

<?php

if($primoElemento){
            echo '<span class="song" data-id="'.$primoElemento['songId'].'">';
            echo '<div>
                    <sapn class="number">1</sapn>
                    <img src="'.$primoElemento['albumImg'].'">
                    <span class="title-artists">'.$primoElemento['songName'].'</span>'; 
            echo '</div>';
            echo '<a href="artist.php?id='.$primoElemento['artistId'].'" class="artist-name space-text">'.$primoElemento['artistName'].'</a>';
            echo '<a href="album.php?id='.$primoElemento['albumId'].'" class="artist-name space-text">'.$primoElemento['albumName'].'</a>';
            echo '<div class="like">';
            
            if(isset($_SESSION['liked_songs'][$primoElemento['songId']])){

                echo '<a class="liked like-button"><img src="https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2"></a>';
            }else{

                echo '<a class="hidden like-button"><img src="https://img.icons8.com/?size=100&id=1501&format=png&color=737373"></a>';
            }
            echo '</div>';
            echo '</span>';
        }

        $index = 2;

        while ($track = mysqli_fetch_assoc($resultSongs)) {

            
            echo '<span class="song" data-id="'.$track['songId'].'">';
            echo '<div>
                    <sapn class="number">'.$index.'</sapn>
                    <img src="'.$track['albumImg'].'">
                    <span class="title-artists">'.$track['songName'].'</span>'; 
            echo '</div>';
            
            echo '<a class="artist-name space-text" href="artist.php?id='.$track['artistId'].'" >'.$track['artistName'].'</a>';
            echo '<a class="artist-name space-text" href="album.php?id='.$track['albumId'].'" >'.$track['albumName'].'</a>';
            
            echo '<div class="like">';
            if(isset($_SESSION['liked_songs'][$track['songId']])){

                echo '<a class="liked like-button"><img src="https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2"></a>';
            }else{

                echo '<a class="hidden like-button"><img src="https://img.icons8.com/?size=100&id=1501&format=png&color=737373"></a>';
            }
            echo '</div>';
            echo '</span>';
            $index++;


        }


?>
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

</body>
</html>


