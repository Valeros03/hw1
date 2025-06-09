<?php

include 'userCheck.php';

$albumId = $_GET["id"];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/albums/".$albumId);
    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = json_decode(curl_exec($curl));

?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="mhw3.css"/>
<link rel="stylesheet" href="nav.css"/>
<link rel="stylesheet" href="album.css"/>
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
                  
        echo'<div class="image-box"><img class="album-icon" src="'.$result->images[0]->url.'"></div>';
        echo '<span class="intestazione-album">';
        echo '<h1>'.$result->name.'</h1>';
        echo '<sapn class="info-album"><a href="artist.php?id='.$result->artists[0]->id.'">'.$result->artists[0]->name.'</a>';
        echo '• <div>'.$result->release_date.'</div>•<div>'.$result->total_tracks.' brani</div>';
        echo '</span>';
        echo '</span>';

    ?>

</div>

<header id="header-track-list">
<div>
    <div>#</div>
    <div>Titolo</div>
</div>
    <div><img class="icon-image" src="https://img.icons8.com/?size=100&id=82767&format=png&color=EBEBEB"></div>
</header>

<div class="flex-box-even"><div class="separator"></div></div>

<div id="track-list">
<div id="songs">
<?php

    
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/albums/".$albumId."/tracks");
    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
    $result = json_decode(curl_exec($curl));
    curl_close($curl);

    
        $tracks = $result->items;
        $index = 1;

        foreach ($tracks as $track) {

            $artists = $track->artists;
            echo '<span class="song" data-id="'.$track->id.'">';
            echo '<div><sapn class="number">'.$index.'</sapn>
            <span class="title-artists">'.$track->name;
            echo '<div class="names">';
            foreach($artists as $artist){
                echo '<a href="artist.php?id='.$artist->id.'" class="artist-name space-text">'.$artist->name.'</a>';
            }
            echo '</div>';
            echo '</span>'; 
            echo '</div>';
            echo '<div>';

            $totalSeconds = floor($track->duration_ms / 1000);
            $minutes = floor($totalSeconds / 60);
            $seconds = $totalSeconds % 60;
            echo '<div class="like">';
            if(isset($_SESSION['liked_songs'][$track->id])){

                echo '<a class="liked like-button"><img src="https://img.icons8.com/?size=100&id=85339&format=png&color=C850F2"></a>';
            }else{

                echo '<a class="hidden like-button"><img src="https://img.icons8.com/?size=100&id=1501&format=png&color=737373"></a>';

            }
            echo '</div>';
            
            echo '</div>';
            echo '<span class=duration>'.sprintf('%d:%02d', $minutes, $seconds).'</span>';
            echo '</span>';
            $index++;


        }


?>
</div>
</div>


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


