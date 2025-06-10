<?php

include 'userCheck.php';

$_SESSION['id_url'] = $_GET["id"];

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
     
    </div>

        <div class="action-menu">

        </div>

    
        <h3>Popolari</h3>
        <div class="flex-column">

            <div class="flex-column" id="songs">
               

            </div>

            <h3>Discografia</h3>
            <div id="discography">



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


