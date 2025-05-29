<?php

include 'auth.php';

    
    $data = http_build_query(array("q" => $_GET["val"], "type" => "album,artist,track"));
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    echo $result;
    curl_close($curl);

/*
    $data = json_decode($result, true);
    $artists = $data['artists']['items'];
    $albums = $data['albums']['items'];
    $tracks = $data['tracks']['items'];

foreach ($artists as $artist) {
    $id = mysqli_real_escape_string($conn, $artist['id']);
    $nome = mysqli_real_escape_string($conn, $artist['name']);
    $img = isset($artist['images'][0]['url']) ? mysqli_real_escape_string($conn, $artist['images'][0]['url']) : null;

    $query = "INSERT IGNORE INTO artists(id, nome, img) VALUES ('$id', '$nome', '$img')";
    mysqli_query($conn, $query);

   
    }


foreach ($albums as $album) {
    $id = mysqli_real_escape_string($conn, $album['id']);
    $artistID = mysqli_real_escape_string($conn, $album['artists'][0]['id']);
    $nome = mysqli_real_escape_string($conn, $album['name']);
    $tipo = mysqli_real_escape_string($conn, $album['album_type']);
    $img = isset($album['images'][0]['url']) ? mysqli_real_escape_string($conn, $album['images'][0]['url']) : null;

    $query = "INSERT IGNORE INTO albums(id, artist, nome, tipo, img) VALUES ('$id', '$artistID', '$nome', '$tipo', '$img')";
    mysqli_query($conn, $query);

    }

foreach ($tracks as $track) {
    $id = mysqli_real_escape_string($conn, $track['id']);
    $artistID = mysqli_real_escape_string($conn, $track['artists'][0]['id']);
    $albumID = mysqli_real_escape_string($conn, $track['album']['id']);
    $nome = mysqli_real_escape_string($conn, $track['name']);

    $query = "INSERT IGNORE INTO songs(id, artist, album, nome) VALUES ('$id', '$artistID', '$albumID', '$nome')";
    mysqli_query($conn, $query);
}
*/




?>