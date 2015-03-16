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

  $email = $_POST["email"];
  $password = $_POST["password"];

  // check that email is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
  {
    $emailErr = "Invalid email format"; 
    echo $emailErr;
  }

  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($mysqli, $query) or die($mysqli_error());
  
  $num_row = mysqli_num_rows($result);
  
  echo $num_row;
  // check number of rows of results for query
   // if a row is returned, the user must already exist 
  if($num_row == 0)
  {
    echo "User does not exist ";
  }

  // if a row is returned, the user must already exist
  // so check password 

  if($num_row == 1)
  {
     $query = "SELECT password FROM users WHERE email = '$email'";
     $result = mysqli_query($mysqli, $query) or die($mysqli_error());

     $row = $result->fetch_assoc();    
 
     // concatinates with nothing to make string
     $dbpassword = $row['password'];
     echo $dbpassword;

     if($dbpassword == $password)
     {
       echo "They are the same password"
     }

  }
?>
</body>
</html> 