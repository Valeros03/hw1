<?php


include 'auth.php';

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_connect_error());

$queryCheck = 'DELETE FROM likes WHERE username = "'.$_SESSION['username'].'"';
mysqli_query($conn, $queryCheck);
$_SESSION['liked_songs'] = [];

mysqli_close($conn);

header('Location: index.php');


?>