<?php

include 'userCheck.php';

$albumId = $_GET["id"];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/albums/".$albumId);
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
<link rel="stylesheet" href="nav.css"/>
<script src="homepage.js" defer></script>

</head>
<body>

<?php

 include 'nav.php';


?>

<nav id="dashboard">
<div id="content-show">


<?php

 echo $result->name;


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


