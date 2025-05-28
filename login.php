<?php

include 'auth.php';
    if (checkAuth()) {
        header('Location: homepage.php');
        exit;
    }

if(!empty($_POST["username"]) && !empty($_POST["password"])){

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_connect_error());

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    
    $query = "SELECT * FROM accounts WHERE username = '".$username."'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $num_rows = mysqli_num_rows($res);

    if (mysqli_num_rows($res) > 0) {
           
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['pass'])) {

                $curl = curl_init();

                curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
                $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                $_SESSION["username"] = $entry['username'];
                $_SESSION["token"] = curl_exec($curl);
                curl_close($curl);

                header("Location: homepage.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        
        $error = "Username e/o password errati.";

}
 else if (isset($_POST["username"]) || isset($_POST["password"])) {
        
        $error = "Inserisci username e password.";
    }



?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="login.css"/>
<script src="login.js" defer></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Spotify</title>

</head>

<body>



<main>
<form id="form-panel" class="flex-box" method="post">

    <img class="icon-image" src="https://storage.googleapis.com/pr-newsroom-wp/1/2023/05/Spotify_Primary_Logo_RGB_White.png">
    <h3>Accedi a Spotify</h3>

    <input type="text" placeholder="username" name='username'>
    <input type="password" placeholder="password" name='password'>

    <button class="green-button" type="submit">Conferma</button>


    <?php

    if(isset($errore)){

    echo'<div id="error">
            <p class="error-message">Nome utente e/o password errati</p>
         </div>';
    
    }

    ?>

    <div id="error" class="hidden">
        <p class="error-message">compilare correttamente i campi</p>
    </div>

    <div class="flex-inline">
        <label class="flex-inline-item">Non hai un account?</label>
        <a class="flex-inline-item" href="signin.php">Iscriviti a Spotify</a>
    </div>

</form>
</main>
</body>