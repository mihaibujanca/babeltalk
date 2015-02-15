<?php
header("Access-Control-Allow-Origin: *");
$clientID="b4bel_t4lk";
$clientSecret="UH95Y81hIT+Xhc0HK3fpnqxN4vgi67ut8kAy36hiT/4=";

$clientSecret = urlencode ($clientSecret);
$clientID = urlencode($clientID);

// Get a 10-minute access token for Microsoft Translator API.
$url = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13";
$postParams = "grant_type=client_credentials&client_id=$clientID&client_secret=$clientSecret&scope=http://api.microsofttranslator.com";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  
$rsp = curl_exec($ch); 

print $rsp;
