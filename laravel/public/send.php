<?php
  // load configuration for database
  require_once('config.inc.php'); 
  // connect to database
  $mysqli = new mysqli($database_host, $database_user, $database_password, $database_name); 

  $content = $_POST["content"];

  // pickup cookies
  $id= $_COOKIE["id"];
  $firstname= $_COOKIE["firstname"];
  $lastname= $_COOKIE["lastname"];
  if (isset($_COOKIE["language"])){
    setcookie("language","en");
  } // if language cookie
  $language = $_COOKIE["language"];
  
  $partnerID= $_COOKIE["partnerID"];
  $partnerfirstname= $_COOKIE["partnerfirstname"];
  $partnerlastname = $_COOKIE["partnerlastname"];
  $partnerlanguage = $_COOKIE["partnerlanguage"];
  $time = time();
  setcookie("noclear", "whocares", time()+1);
  $insert_row = $mysqli->query("INSERT INTO exchanges (senderID, receiverID, time, sender_content, receiver_content) 
				    VALUES  ('$id', '$partnerID', '$time', '$content', '$content')");
      
  header("Location: https://web.cs.manchester.ac.uk/mbax4ab4/babeltalk/laravel/public/testinput.php");
?>