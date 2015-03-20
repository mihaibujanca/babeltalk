<?php
  // set up database    
  require_once('config.inc.php'); // load configuration for database
  $mysqli = new mysqli($database_host, $database_user, $database_password, $database_name); // connect to database 
  if($mysqli -> connect_error) {
    die('Connection Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
  } // check for errors

  $partnerID = $_POST["partnerID"];
  setcookie("partnerID", $partnerID);
  
  $query = "SELECT * FROM users WHERE id = '$partnerID'";
  $result = mysqli_query($mysqli, $query) or die($mysqli_error());  
  $row = $result -> fetch_assoc();	  
	  
  
  setcookie("partnerfirstname",$row["firstname"]);
  setcookie("partnerlastname", $row["lastname"]);  
  setcookie("partnerlanguage", $row["language"]);
  
  header("Location: https://web.cs.manchester.ac.uk/mbax4ab4/babeltalk/laravel/public/testinput.php");
?>