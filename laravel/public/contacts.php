
<!DOCTYPE html>
<html lang="en">


  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Babel talk| Contacts</title>
</head>

<h1> Contacts </h1>

<h2> Friends </h2>

<?php
  // code to load and output friends list
  
  // load configuration for database
  require_once('config.inc.php'); 
  // connect to database
  $mysqli = new mysqli($database_host, $database_user, $database_password, $database_name);
  // check for error 
  if($mysqli -> connect_error) 
  {
    die('Connection Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
  }
  
  $cookie_name = "id";

  $id= $_COOKIE[$cookie_name];

  echo "<hr>";

  
    // ----------------------------------------------------------------------
    // Get all the users who this user added and output them
    $query = "SELECT * FROM friends WHERE user1ID = '$id'";
    $result = mysqli_query($mysqli, $query) or die($mysqli_error());
    
    $num_row = mysqli_num_rows($result);
  
  if($num_row !=0)
  {
    while($row = $result->fetch_array())
    {
      $rows[] = $row;
    }

    foreach($rows as $row)
    {
      $user2ID = $row['user2ID'];
      $query = "SELECT * FROM users WHERE id = '$user2ID'";
      $result = $mysqli->query($query);
      $row2 = $result->fetch_assoc();
      // friend id is  $user2ID;
      if ($user2ID != $id)
      {
	echo "Name  : " . $row2['first_name'] . $row2['last_name'] . "<br>";
	echo "Email : " . $row2['email'] . "<br>";
	echo "<hr>";

      }
    }
  } // if results
  else
  {
    echo "You have no friends yet :( <br>";
    echo "Add some friends below <br>";
  }
  $result->close();
?>

<h2> Add a friend by email </h2>




<form name="form1" method="post" action="contacts.php">
	<input name="search" type="text" /> 
	<input type="submit" name="submit" value="search" /> 


</form>

<?php
if(isset($_POST['search']))
{
if (strlen (($_POST['search'])) > 5)
{
  $search = $_POST['search'];
  $query = "SELECT * FROM users WHERE email = '$search'";
  $result = mysqli_query($mysqli, $query) or die($mysqli_error());
  $num_row = mysqli_num_rows($result);
  if($num_row == 0)
 { echo "No results found"; }
   else
   { 
   $row = $result -> fetch_assoc();

   echo "Name  : " . $row['first_name'] . $row['last_name'] . "<br>";
   echo "Email : " . $row['email'] . "<br>";
    
  }  
}
}

?>



</html>
