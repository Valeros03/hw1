<?php

include 'auth.php';

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$playlistId = mysqli_real_escape_string($conn,$_SESSION["id_url"]);

$query = 'SELECT nome AS nomePlaylist, username AS usr FROM playlist where playlist.id = "'.$playlistId.'"';
$result = mysqli_query($conn, $query);
$playlist = mysqli_fetch_assoc($result);

$query = '  SELECT s.id AS songId, s.nome AS songName, a.id AS albumId, a.nome AS albumName, ar.id AS artistId, ar.nome AS artistName, a.img AS albumImg
            FROM (
                    SELECT *
                    FROM songsPlaylist sp
                    WHERE sp.playlistID = "'.$playlistId.'"
            ) AS filtered_sp
            JOIN songs s ON filtered_sp.songID = s.id
            JOIN albums a ON s.album = a.id
            JOIN artists ar ON s.artist = ar.id';

$resultSongs = mysqli_query($conn, $query);
$songNumber = mysqli_num_rows($resultSongs);

$tracks = array();
while ($row = mysqli_fetch_assoc($resultSongs)) {
    $row['liked'] = isset($_SESSION['liked_songs'][$row['songId']]);
    $tracks[] = $row;
}

$response = array();
$playlist['song_count'] = $songNumber;
$playlist['img'] = $tracks[0]['albumImg'];
$response['header'] = $playlist;
$response['tracks'] = $tracks;

echo json_encode($response);

mysqli_close($conn);
mysqli_free_result($result);
mysqli_free_result($resultSongs);

?>