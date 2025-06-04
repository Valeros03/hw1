<?php

    include 'auth.php';
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$_GET['id']."/albums?market=IT");
    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $discografia = curl_exec($curl);
    curl_close($curl);

    echo $discografia;
?>