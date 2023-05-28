<?php 
//download composer dependency manager for php
//installed google oauth SDK using composer require google/apiclient:"^2.0" in terminal

require_once 'vendor/autoload.php'; //part of Composer to ensure classes in our script are autoloaded
include "google_db.php";

$clientID = '297150383264-32hmrcg5og671e8hkuks43fd7mevur02.apps.googleusercontent.com';
$clientSecret = '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';
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
    $google_oauth = new Google_Service_Oauth2($client); //intelephense errors method out due to compatibility issues w/ VScode but it still works
    $google_account_info = $google_oauth->userinfo->get();

    $userInfo = [
      'email' => $google_account_info['email'],
      'full_name' => $google_account_info['name'],
      'id' => $google_account_info['id']
    ];

    if( empty($userInfo["email"]) || empty($userInfo['full_name'])) {
      echo "Wrong!";
    }
    $sql = "INSERT INTO google_users (name, email) VALUES (123)";
    $stmt = mysqli_stmt_init($google_conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: /start.php");
          exit();
    }
    mysqli_stmt_execute($stmt);


    $res = mysqli_stmt_get_result($stmt);

    if($res) {
          $_SESSION['user_name'] = $userInfo['name']; 
          $_SESSION['id'] = 1234;
           header('Location: index.php');
           exit();

    } else {
      echo "User is not added";
    }
    // $email =  filter_var($google_account_info->getEmail(), FILTER_SANITIZE_SPECIAL_CHARS);
    // $name =  filter_var($google_account_info->getName(), FILTER_SANITIZE_SPECIAL_CHARS);
    // $id =  filter_var($google_account_info->getId(), FILTER_SANITIZE_SPECIAL_CHARS);
   
    // now you can use this profile info to create account in your website and make user logged in. 

         // checking user already exists or not
        //  $get_user = mysqli_query($db_connection, "SELECT * FROM `google_users` WHERE `name`='$name'");
        //  if(mysqli_num_rows($get_user) > 0){
        //      $_SESSION['id'] = $id; 
        //      header('Location: index.php');
        //      exit();
        //  } 
         //else { //add user if not there
          // $sql = "INSERT INTO google_users (name, email) VALUES ('$name', '$email')";

          // $res = mysqli_query($google_conn, $sql);
          
          // if($res){
          //   $_SESSION['id'] = $id; 
          //   header('Location: index.php');
          //   exit();
          // }
          // else{
          //   echo "Sign up failed! (Something went wrong).";
          // }
          

         //}
    

  } else {
    echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
  }
  ?>