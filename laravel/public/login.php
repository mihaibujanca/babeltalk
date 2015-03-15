<?php
  require("config.php");

  $email = $_POST["email"];
  $password = $_POST["password"];

  $query = "SELECT * FROM `Members` WHERE `email1 = '$email' AND `password` = '$password'";

  $result = $mysqli->query($query); 


  if(!empty($_POST)) 
    { 
        // Ensure that the user fills out fields 
       if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { die("Invalid E-Mail Address"); } 
        if(empty($_POST['password'])) 
        { die("Please enter your password."); } 
         


?>