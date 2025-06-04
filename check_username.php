<?php 
   
    require_once 'dbconfig.php';

    if (!isset($_GET["q"])) {
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $username = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT username FROM accounts WHERE username = '$username'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) > 0){
         echo json_encode(array('exists' =>  true));
    }else{
         echo json_encode(array('exists' =>  false));
    }
   

    mysqli_close($conn);
?>