<?php

include 'userCheck.php';

    $_SESSION['id_url'] = $_GET['id'];

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


