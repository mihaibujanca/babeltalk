<html>
<head> 
</head> 

<body> 


<?php
  
  // load configuration for database
  require_once('config.inc.php');
 
  // connect to database
  $mysqli = new mysqli($database_host, $database_user, $database_pass, $database_name);

  // check for error 
  if(mysqli -> connect_error) 
  {
    die('Connection Error ('.$mysqli -> connect.errno.') '.$mysqli -> connect_error);
  }

  // store variables 

  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $reenterpassword = $_POST["reenterpassword"];
  $language = $_POST["languageselect"];
  
  echo $firstname; 
  echo $lastname;
  echo $email; 
  echo $password; 
  echo $reenterpassword;
  echo $language;



  

  

?>

</body>
</html>