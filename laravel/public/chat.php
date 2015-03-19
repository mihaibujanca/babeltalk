<html>
<head>
<title> BabelTalk - Chat </title>
<link rel="stylesheet" type="text/css" href="chatstyle.css">
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

    // test with a conversation between user 24 and 25
    // play as user 24
    $id = 24;
    $partnerid = 25;
    
    echo '<div class="scrolly">';
    
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
	// message originated from this user so display as is
	if ($row[1] == $id)
	{
	  echo "<p>" . $row[4] . "</p>"; 
	}
	// message came from other user, should be translated first
	elseif ($row[2] == $id)
	{
	  $translatedreceived = $row[4];
	  // code to translate message goes here !!!
	  
	  echo "<p> <b>" . $translatedreceived . "</b> </p>"; 
	}
      }
    }
    
    $echo '</div>';
    
    $result->close();
  ?>
  </body>
</html> 
	  