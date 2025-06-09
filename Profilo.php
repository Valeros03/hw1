<?php

include 'auth.php';

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_connect_error());
$username = mysqli_real_escape_string($conn,$_SESSION['username']);
$query = 'SELECT * FROM accounts WHERE accounts.username = "'.$username.'"';
$res = mysqli_query($conn, $query); 
$account = mysqli_fetch_assoc($res);


?>





<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="profilo.css"/>
<script src="profilo.js" defer></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Spotify</title>

</head>

<body>


<main>

<section id="modal-view" class="hidden">
        <div id="conferma-pannel">
            <p>Sei sicuro di rimuovere i tuoi mi piace?</p>
            <div>
            <a href="svuotaLike.php"><button>Conferma</button></a>
            <button id="annulla">Annulla</button>
            </div>
        </div>
</section>
<div id="main">


<header>
    <img class="icon-image" src="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/Spotify_Primary_Logo_RGB_White.png">
    <h3>Profilo</h3>
</header>
    <div id="center">
    <div id="profile-information">
        <p>Username: </p>
        <p class="white"><?php echo $username?></p>
        <p>Nome: </p>
        <p class="white"><?php echo $account['nome']?></p>
        <p>Data di nascita: </p>
        <p class="white"><?php echo $account['nascita']?></p>
        <p>Gender: </p>
        <p class="white"><?php echo $account['sesso']?></p>
    </div>

    <div>
        <button id="open-modale">Rimuovi tutte le canzoni salvate</button>
    </div>
   
    </div>


</div>
</main>
</body>