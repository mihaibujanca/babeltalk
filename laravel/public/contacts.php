
<!DOCTYPE html>
<html lang="en">


  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Babel talk| Contacts</title>
</head>

<h1> Contacts </h1>

<p> Friends </p>
<br>

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
  $id = $_COOKIE[$cookie_name];
  echo "your id";
  echo $id;
  $query = "SELECT * FROM friends WHERE user1ID = '$id'";
  // $result = mysqli_query($mysqli, $query) or die($mysqli_error());
  $result = $mysqli->query($query);
  

  while($row = $result->fetch_array())
  {
    $rows[] = $row;
  }

  foreach($rows as $row)
  {
    $query = "SELECT * FROM users WHERE id = '$row['user2ID']'";
    $row2 = $result->fetch_assoc();    
    $email = $row2['email'];
    $rows[] = $email;
  }
  
  echo "<ul>";
  foreach($rows as $row)
  {
    echo "<li>" . $row['user2ID'] . "</li>";
  }
  echo "</ul>";
  $result->close();
?>








<!-- Search for friends by email
<p> Search by email </p>
<form action="se.php" class="form-horizontal" method="post">
<input id="email" name="email" type="text" class="form-control" placeholder="BabelTalk" class="input-medium" required="">
                  </div>
                </div>

-->

</html>