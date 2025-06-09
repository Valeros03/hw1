<?php

include 'auth.php';

    
    $data = http_build_query(array("q" => $_GET["val"], "type" => "album,artist,track"));
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
    $headers = array("Authorization: Bearer ".$_SESSION["token"]);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = json_decode(curl_exec($curl), true);

    foreach ($result['tracks']['items'] as &$track) {
        $track_id = $track['id'];
        $track['liked'] = isset($_SESSION['liked_songs'][$track_id]);
    }

    echo json_encode($result);
    curl_close($curl);


?>