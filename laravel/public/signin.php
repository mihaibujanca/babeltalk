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

     if($dbpassword == $password)
     {
        
        $query = "SLECT id FROM 'users' WHERE email = $email";
	$result = mysqli_query($mysqli,$query)or die(mysqli_error());
	$cookie_name = "id";
	$cookie_value = $result;

	if (isset($_POST['rememberme'])) {
	  /* Set cookie to last 1 year */
	  setcookie($cookie_name, $cookie_value, time()+60*60*24*365, "/");
	} else {
	  /* Cookie expires when browser closes */
	  setcookie($cookie_name, $cookie_value, time()+60*60*24*365, "/");
	}
	// header("Location: http://10.2.234.76/babeltalk/laravel/public/Home1.html");
	 
	  $cookie_name="id";
	  if(!isset($_COOKIE[$cookie_name])) {
	    echo "success";
	    // header("Location: http://10.2.234.76/babeltalk/laravel/public/Home1.html");
  }

     }
     else
     {
       echo "Incorrect password, please enter the correct password.";
     }

  }
?>
</body>
</html> 