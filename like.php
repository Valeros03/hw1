<?php
include 'auth.php';

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_connect_error());

$songId = mysqli_real_escape_string($conn, $_GET['id']);
$queryCheck = 'SELECT * FROM songs WHERE id = "'.$songId.'"';
$result = mysqli_query($conn, $queryCheck);
$num_rows = mysqli_num_rows($result);

if ($num_rows === 0) {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.spotify.com/v1/tracks/'.$songId);
    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $apiResult = json_decode(curl_exec($curl));

    if (!isset($apiResult->id)) {
        exit;
    }

    $artistId = $apiResult->artists[0]->id;
    $artistName = mysqli_real_escape_string($conn, $apiResult->artists[0]->name);

  
    curl_setopt($curl, CURLOPT_URL, 'https://api.spotify.com/v1/artists/'.$artistId);
    $artistResponse = curl_exec($curl);
    curl_close($curl);

    $artistData = json_decode($artistResponse);
    $artistImg = isset($artistData->images[0]->url) ? mysqli_real_escape_string($conn, $artistData->images[0]->url) : '';


    $query = 'INSERT IGNORE INTO artists (id, nome, img) VALUES ("'.$artistId.'", "'.$artistName.'", "'.$artistImg.'")';
    mysqli_query($conn, $query);

    $albumId = $apiResult->album->id;
    $albumName = mysqli_real_escape_string($conn, $apiResult->album->name);
    $albumType = $apiResult->album->album_type;
    $albumImg = mysqli_real_escape_string($conn, $apiResult->album->images[0]->url);

    $songName = mysqli_real_escape_string($conn, $apiResult->name);

    mysqli_query($conn, 'INSERT IGNORE INTO albums (id, artist, nome, tipo, img) VALUES ("'.$albumId.'", "'.$artistId.'", "'.$albumName.'", "'.$albumType.'", "'.$albumImg.'")');
    mysqli_query($conn, 'INSERT INTO songs (id, artist, album, nome) VALUES ("'.$songId.'", "'.$artistId.'", "'.$albumId.'", "'.$songName.'")');
}

$likeQuery = 'INSERT IGNORE INTO likes (username, song) VALUES ("'.$_SESSION['username'].'", "'.$songId.'")';
if(mysqli_query($conn, $likeQuery))
    $_SESSION['liked_songs'][$songId] = true;

mysqli_close($conn);
mysqli_free_result($result);

?>
