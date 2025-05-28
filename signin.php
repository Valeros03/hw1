<?php

require_once 'auth.php';

    if (checkAuth()) {
        header("Location: homepage.php");
        exit;
    }   


  if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && 
       !empty($_POST["gender"]) && !empty($_POST["birth"]) && !empty($_POST["confirm_password"]))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
          
            $query = "SELECT username FROM accounts WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }
     
        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 
        
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        
        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $birth = mysqli_real_escape_string($conn, $_POST['birth']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO accounts(username, pass, nome, nascita, sesso) VALUES('$username', '$password', '$name', '$birth', '$gender')";
            
            if (mysqli_query($conn, $query)) {

                curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
                $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                $_SESSION["username"] = $_POST["username"];
                $_SESSION["token"] = curl_exec($curl);
                curl_close($curl);
                
                mysqli_close($conn);
                header("Location: homepage.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }





?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="login.css"/>
<script src="signin.js" defer></script>

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
    <h3>Iscriviti a Spotify</h3>

    <input type="text" placeholder="username" name='username'>
    <input type="text" placeholder="nome" name='name'>
    <input type="date" name='birth'>

    <div class="gender-radio">
        <label>Uomo<input type="radio" name="gender" value="uomo"></label>
        <label>Donna<input type="radio" name="gender" value="donna"></label>
        
    </div>

    <div class="gender-radio">
        <label>Non-binary<input type="radio" name="gender" value="non-binary"></label>
        <label>Preferisco non specificare<input type="radio" name="gender" value="preferisco non specificare"></label>
    </div>

    <input type="password" placeholder="Password" name='password'>
    <input type="password" placeholder="Conferma password" id='confermaPassword' name="confirm_password">

    <button class="green-button" type="submit">Conferma</button>
    <div id = 'error'>

   
    <?php 
        if(isset($error)) {

            
            foreach($error as $err) {
                
                echo "<p class'error-message'>".$err."</p>";
                
            }
           
        } 
    ?>

    </div>
    <div class="flex-inline">
        <label class="flex-inline-item">Hai gi&agrave; un account?</label>
        <a class="flex-inline-item" href="login.php">Accedi a Spotify</a>
    </div>

    

</form>
</main>
</body>


<body>
    
</body>

</html>

