<?php

    include 'auth.php';
    
    $artistId = $_SESSION['id_url'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$artistId."/top-tracks?market=IT");
    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $popularSongs = json_decode(curl_exec($curl), true);
    curl_close($curl);



    foreach ($popularSongs['tracks'] as &$track) {
        $track_id = $track['id'];
        $track['liked'] = isset($_SESSION['liked_songs'][$track_id]);
    }

    echo json_encode($popularSongs);
?>