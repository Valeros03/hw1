<?php


include 'auth.php';

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_connect_error());

$songId = mysqli_real_escape_string($conn, $_GET['id']);
$queryCheck = 'DELETE FROM likes WHERE song = "'.$songId.'" AND username = "'.$_SESSION['username'].'"';
mysqli_query($conn, $queryCheck);
unset($_SESSION['liked_songs'][$songId]);

mysqli_close($conn);

?>