<?php

include 'auth.php';

                $curl = curl_init();

                curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
                $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);      

                $_SESSION["token"] = json_decode(curl_exec($curl))->access_token;

                curl_close($curl);


?>