<?php

include 'userCheck.php';

$artistId = $_GET["id"];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$artistId);
    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = json_decode(curl_exec($curl));
    curl_close($curl);

?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="mhw3.css"/>
<link rel="stylesheet" href="artist.css"/>
<link rel="stylesheet" href="nav.css"/>
<script src="homepage.js" defer></script>
<script src="artisti.js" defer></script>

</head>
<body>

<?php

 include 'nav.php';


?>

<nav id="dashboard">
<div id="content-show">
    <div class="header-artist">
        <?php
                echo'<div class="image-box"><img class="artist-icon" src="'.$result->images[0]->url.'"></div>';
                echo '<span class=intestazione-artista>';
                echo '<h1>'.$result->name.'</h1>';
                echo ''.$result->followers->total.' Followers';
                echo '</span>';

        ?>
    </div>

        <div class="action-menu">

        </div>

    
        <h3>Popolari</h3>
        <div class="flex-column">

            <div class="flex-column">
                <?php
                
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$artistId."/top-tracks?market=IT");
                    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $result = json_decode(curl_exec($curl));
                    curl_close($curl);
                    $size = count($result->tracks);
                    if($size > 5){
                        $showN = 5;
                    }else{
                        $showN = $size;
                    }
                    for($i = 0; $i<$showN; $i++){

                        $sec = floor($result->tracks[$i]->duration_ms/1000);
                        $min = floor($sec/60);

                        $remainingSeconds = $sec % 60;
                        $formatted = sprintf("%d:%02d", $min, $remainingSeconds);
                        
                        $num = $i + 1;
                    echo '<span class="song">
                    <div>
                        <span class=number>'.$num.'</span>
                        <img class="song-icon" src="'.$result->tracks[$i]->album->images[0]->url.'">
                        <span>'.$result->tracks[$i]->name.'</span>
                    </div>
                    <div>
                        <a class="hidden" href="localhost/hw1/like.php?id=101"><img src="https://img.icons8.com/?size=100&id=1501&format=png&color=737373"></a>
                        <span>'.$formatted.'</span>
                    </div> 

                    </span>';

                    }

               


                ?>

            </div>

            <div class="discography">


            </div>

            <div class="info">

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


