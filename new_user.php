<?php 
//download composer dependency manager for php
//installed google oauth SDK using composer require google/apiclient:"^2.0" in terminal

require_once 'vendor/autoload.php'; //part of Composer to ensure classes in our script are autoloaded

$clientID = '';
$clientSecret = '';
$redirectUri = 'http://localhost/SuperHeroUI.PHP/index.php';

//create client request to access GOOGLE API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow 
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    
    // get profile info 
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;
   
    // now you can use this profile info to create account in your website and make user logged in. 
  } else {
    echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
  }
  ?>