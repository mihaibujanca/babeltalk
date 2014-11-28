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
  
  // check number of rows of results for query
   // if a row is returned, the user must already exist 
  if($num_row == 0)
  {
    echo "User does not exist ";
    header("Location: http://10.2.234.107/babeltalk/laravel/public/index.html");
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
     $query = "SELECT * FROM users WHERE email = '$email'";
     $result = mysqli_query($mysqli, $query) or die($mysqli_error());
     $row = $result->fetch_assoc(); 
   

     $id = $mysqli->real_escape_string($row['id']);
     $firstname = $mysqli->real_escape_string($row['first_name']);
     $lastname = $mysqli->real_escape_string($row['last_name']);
     $language = $mysqli->real_escape_string($row['language']);
	
	// set id as cookie
	if (isset($_POST['rememberme'])) {
	  /* Set cookie to last 1 year */
	  setcookie("id", $id, time()+60*60*24*365, "/");
	} else {
	  /* Cookie expires when browser closes */
	  setcookie("id", $id, false,"/");
	}
	setcookie("firstname", $firstname, time()+60*60*24*365, "/");
	setcookie("lastname", $lastname, time()+60*60*24*365, "/");
	header("Location: http://10.2.234.107/babeltalk/laravel/public/home.html");
	 
	  $cookie_name="id";
	  if(!isset($_COOKIE[$cookie_name])) {
	    echo "success";
	    
  }

     }
     else
     {
       header("Location: http://10.2.234.107/babeltalk/laravel/public/index.html");
     }

  }
?>
</body>
</html> 
