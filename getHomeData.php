<?php

require_once 'token.php';


 $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
 $queryArtist = 'SELECT artists.nome AS artistName, artists.id AS artistId, artists.img AS artistImg FROM artists LIMIT 6';
 $queryAlbum = "SELECT albums.id AS 'albumId',
    albums.nome AS 'albumName',
    albums.tipo AS 'albumTipo',
    albums.img AS 'albumImg',
    artists.id AS 'artistId',
    artists.nome AS 'artistName',
    artists.img AS 'artistImg' FROM albums JOIN artists ON albums.artist = artists.id LIMIT 6";
 $queryPlaylist = 'SELECT playlist.nome AS playlistName, playlist.id AS playlistId FROM playlistPopolari JOIN playlist ON playlistPopolari.id = playlist.id LIMIT 6';

 $resultArtist = mysqli_query($conn, $queryArtist);
 $resultAlbum = mysqli_query($conn, $queryAlbum);
 $resultPlaylist = mysqli_query($conn, $queryPlaylist);

$response = array();

$artists = array();
 while( $rowArtist = mysqli_fetch_assoc($resultArtist)){
    $artists[] = $rowArtist;
 }

$albums = array();
 while( $rowAlbum = mysqli_fetch_assoc($resultAlbum)){
     $albums[] = $rowAlbum;
 }

 $playlists = array();
 while( $rowPlaylist = mysqli_fetch_assoc($resultPlaylist)){
    $playlistId = mysqli_real_escape_string($conn, $rowPlaylist["playlistId"]);
    $queryArtistPlaylist = 'SELECT albums.img AS img FROM playlist 
                                            JOIN songsPlaylist ON playlist.id = songsPlaylist.playlistID
                                            JOIN songs ON songsPlaylist.songID = songs.ID
                                            JOIN albums ON songs.album = albums.id
                                            WHERE playlist.id = "'.$playlistId.'"
                                            LIMIT 1';

    $res = mysqli_query($conn, $queryArtistPlaylist);
    $rowImg = mysqli_fetch_array($res);
    $rowPlaylist['img'] = $rowImg['img'];
    $playlists[] = $rowPlaylist;
    mysqli_free_result($res);
 }

$response['artists'] = $artists;
$response['albums'] = $albums;
$response['playlists'] = $playlists;

 $token = isset($_SESSION["token"]) ? $_SESSION["token"] : null;

 echo json_encode($response);
 mysqli_free_result($resultArtist);
 mysqli_free_result($resultAlbum);
 mysqli_free_result($resultPlaylist);
 mysqli_close($conn);

?>