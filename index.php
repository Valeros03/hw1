<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="mhw3.css"/>
<link rel="stylesheet" href="nav.css"/>
<script src="homepage.js" defer></script>
<script src="home.js" defer></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Spotify</title>

</head>


<?php

require_once 'token.php';
include 'nav.php';


?>
<nav id="dashboard">
        <div id="content-show">
        <section class="group-content">
            <header class="section-header-dashboard">
                <p class="open-sans section-text"><strong>Artisti più popolari</strong></p>
                <a href="#"><P class="gray-text">Mostra tutto</P></a>
            </header>
            <div class="show-category artist-category">

            
            
            </div>
        </section>

        <section class="group-content">
            <header class="section-header-dashboard">
                <p class="open-sans section-text"><strong>Album e singoli più popolari</strong></p>
                <a href="#"><P class="gray-text">Mostra tutto</P></a>
            </header>
            <div class="show-category album-category">


          

            </div>
        </section>
        
        <section class="group-content">
            <header class="section-header-dashboard">
                <p class="open-sans section-text"><strong>Stazioni radio più popolari</strong></p>
                <a href="#"><P class="gray-text">Mostra tutto</P></a>
            </header>
            <div class="show-category playlist-category">
                
    
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
