<?php  

if(isset($_SESSION["username"])){
    $nav = '<div id="profile-button" class="image-background">

                <img id="profile-icon" src="https://img.icons8.com/?size=100&id=pETkiIKt6qBf&format=png&color=000000">

            </div>';
}else{
    $nav = '<div id="authentication">
                <a href="signin.php" class="gray-link open-sans"><strong>Iscriviti</strong></a>
                <a href="login.php"> <button id="accedi" class="white-button open-sans"><strong>Accedi</strong></button></a>
            </div>';
}
echo '<div class="hidden" id=dropdown-profile>
        <a href="Logout.php">
            <div>
                <p class="open-sans">Visualizza Profilo</p>
            </div>
            <div>
                <p class="open-sans">Logout</p>
            </div>
        </a>
        </div>';
                
echo  '<div class="hidden" id="dropdown-pam">
        <a href="#">
            <div>
                <p class="open-sans">Premium</p>
                <img src="https://img.icons8.com/?size=100&id=16139&format=png&color=FFFFFF" class="icon-image">
            </div>
        </a>
        <a href="#">
            <div>
                <p class="open-sans">Assistenza</p>
                <img src="https://img.icons8.com/?size=100&id=16139&format=png&color=FFFFFF" class="icon-image">
            </div>
        </a>
        <a href="#">
            <div>
                <p class="open-sans">Download</p>
                <img src="https://img.icons8.com/?size=100&id=16139&format=png&color=FFFFFF" class="icon-image">
            </div>
        </a>
    </div>

    <section id="modal-view" class="hidden">
        <div id="artist-info">

        </div>
    </section>

    <header class="header-page">
       
        <div class="exploration-group">

        <div id="icon-space">

            <a href="index.php" id="header-spotify-link">
                <img src="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/Spotify_Primary_Logo_RGB_White.png" class="icon-image">
            </a>
        
        </div>

        <div id="searching-bar">

            <a href="index.php" id="home-page-link">
                
                <img src="https://img.icons8.com/?size=100&id=83326&format=png&color=737373" id="home-page-icon">
        
            </a>


            <button class="icon-button" id="search-button">
                <img src="https://img.icons8.com/?size=100&id=7695&format=png&color=737373" class="searching-icon">
            </button>

            <div id="input-container" class="hover-highlighted">
                
                <input type="text" placeholder="Cosa vuoi ascoltare?">

                <div class="splitter"></div>
                <div class="icon-button">
                <img src="https://img.icons8.com/?size=100&id=8UdGJMu2c9dS&format=png&color=737373" class="searching-icon">
                </div>
            </div>

        </div>
        </div>

        <div id="util-group">
        
            <div id="pad-group">
            <a href="#" class="gray-link open-sans"><strong>Premium</strong></a>
            <a href="#" class="gray-link open-sans"><strong>Assistenza</strong></a>
            <a href="#" class="gray-link open-sans"><strong>Download</strong></a>
            </div>
            <div class="splitter"></div>

            <div id="download-area">
                <img src="https://img.icons8.com/?size=100&id=83159&format=png&color=737373" id="download-icon">
                <a href="#" class="gray-link open-sans"><strong>Installa app</strong></a>
            </div>
            '.$nav.'
            
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
                </div>
        </div>
      
       
    </header>

    <div id="center-page">
    <section class="user-panel">

            <header class="header-user-panel">
                <p class="white-text open-sans"><strong>La tua libreria</strong></p>
                <button id="new-playlist"><img src="https://img.icons8.com/?size=100&id=3220&format=png&color=737373" class="searching-icon"/></button>
            
            </header>
    <section class="user-playlists">

                <div class="new-element">
                <div class="text-new-element">
                    <p class="white-text open-sans"><strong>Crea la tua prima playlist</strong></p>
                    <p class="white-text open-sans">è facile, ti aiuteremo</p>
                </div>
                <button>Crea playlist</button>
                </div>

           
                <div class="new-element">
                <div class="text-new-element">
                    <p class="white-text open-sans"><strong>Cerca qualche podacast da seguire</strong></p>
                    <p class="white-text open-sans">Ti aggiorneremo sui nuovi episodi</p>
                </div>
                <button>Sfoglia i podacast</button>
               </div>
    </section>

        <footer class="info">
            <span class="info-group">
                <a href="#">Informazioni legali</a>
                <a href="#">Sicurezza e Centro sulla privacy</a>
            </span>
            <span class="info-group">
                <a href="#">Informativa sulla privacy</a>
                <a href="#">Impostazioni cookie</a>
                <a href="#">Info annunci</a>
            </span>
            <span class="info-group">
            <a href="#">Accessibilità</a>
            <a href="#" id="politica-cookie">Politica sui cookie</a>
            </span>
        </footer>
        
    </section>';

?>