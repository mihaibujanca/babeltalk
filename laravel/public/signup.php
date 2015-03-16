<html>
<head> 
</head> 

<body> 


<?php
  
  // load configuration for database
  require_once('config.inc.php');
 
  // connect to database
  $mysqli = new mysqli($database_host, $database_user, $database_password, $database_name);

  // check for error 
  if($mysqli -> connect_error) 
  {
    die('Connection Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
  }

  // store variables 

  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $reenterpassword = $_POST["reenterpassword"];
  $language = $_POST["language"];
  
  //use escape strings to avoid SQL injection
  $firstname = $mysqli ->real_escape_string($firstname);
  $lastname = $mysqli ->real_escape_string($lastname);
  $email = $mysqli ->real_escape_string($email);
  $password = $mysqli ->real_escape_string($reenterpassword);
  $language = $mysqli ->real_escape_string($language);

  // check that email is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
  {
    $emailErr = "Invalid email format"; 
    echo $emailErr;
  }

  // check passwords match
  if (strcmp($password, $reenterpassword) !== 0) {
    echo "Passwords do not match";
  }

  echo $firstname; 
  echo $lastname;
  echo $email; 
  echo $password; 
  echo $reenterpassword;
  echo $language;

  // check if the user is in the database
  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($mysqli, $query) or die($mysqli_error());
  
  // check number of rows of results for query
  $num_row = mysqli_num_rows($result);
 
  // if a row is returned, the user must already exist 
  if($num_row == 1)
  {
    echo "User already exists with the email. ";
  }
  
  else if($num_row == 0)
  {
    $insert_row = $mysqli->query("INSERT INTO users (first_name, last_name, password, email, language) 
                                 VALUES  ('$firstname', '$lastname', '$password', '$email', '$language')");

  }
  



  

  

?>

</body>
</html>
