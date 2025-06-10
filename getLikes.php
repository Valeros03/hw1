<?php

include 'auth.php';
$username = $_SESSION['username'];
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
    $query = 'SELECT songs.id AS songId, songs.nome AS songName, albums.id AS albumId, albums.nome AS albumName, artists.id AS artistId, artists.nome AS artistName, albums.img AS img
              FROM (SELECT * FROM likes WHERE likes.username = "'.$username.'") AS filtered_likes
              JOIN songs ON songs.id = filtered_likes.song
              JOIN albums ON albums.id = songs.album
              JOIN artists ON artists.id = albums.artist';
    $resultLikes = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($resultLikes)) {
        $response['likes'][] = $row;
    }

    echo json_encode($response);
    mysqli_free_result($resultLikes);
    mysqli_close($conn);
?>