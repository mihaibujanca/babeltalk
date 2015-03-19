<html>
<head> </head>
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

    // test with a conversation between user 24 and 25
    // play as user 24
    $id = 24;
    $partnerid = 25;
    
    $query = "SELECT * FROM exchanges WHERE (senderID = '$id' AND receiverID = '$partnerid') OR (senderID = '$partnerid' AND receiverID = '$id') ORDER BY id";
    $result = mysqli_query($mysqli, $query) or die($mysqli_error());
    $num_row = mysqli_num_rows($result);
    if($num_row == 0)
    { 
      echo "<p> No messages </p>"; 
    }
    else
    {
      echo "<p> You have messages </p>";
      while ($row = mysqli_fetch_row($result))
      {
	echo $row[0] . "<br>"; 
      }
    }
    
    $result->close();
  ?>
  </body>
</html> 
	  