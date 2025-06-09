<?php
$client_id = "6ff7a41aaad1448694fea5650531aad1";
$client_secret = "fe88c9457d8c436cb8e8cfd1d0ccd402";

 require_once 'dbconfig.php';
    session_start();

    function checkAuth() {

        if(isset($_SESSION['username'])) {
            return $_SESSION['username'];
        } else 
            return 0;
    }
?>
