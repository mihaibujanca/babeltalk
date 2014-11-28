<html lang="en">
<head>
    <meta http-equiv="refresh" content="5">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BabelTalk - Chat</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="chatstyle.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- navbar css-->

    <link href="css/navbar.css" rel="stylesheet">

    <link rel="stylesheet" href="css/images"/>

    <!--Pulling Awesome Font -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!--<link rel="stylesheet" href="loginform"/>-->
</head>
<body>
    <!-- Wrap all page content here -->
    <div id="wrap">
	<div class="container navbar">
	    <header>
		<nav class="navbar-default navbar-fixed-top">
		    <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			    </button>
			    <a class="navbar-brand" href="home.html">Babel Talk</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav nav-pills navbar-right">
				<li role="presentation" class="active" style="text-align: center;"> Chat <a href="chat.php"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-comment" aria-hidden="true"></span></a></li>
				<li role="presentation" class="active" style="text-align: center;"> Profile <a href="signout.php"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
				<li role="presentation" class="active" style="text-align: center;"> Friends <a href="contacts.php"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a></li>
				<li role="presentation" class="active" style="text-align: center;"> Home <a href="Home1.html"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
				<li role="presentation" class="active" style="text-align: center;"> Quit <a href="signout.php"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
			  </ul>
			  

			    <!-- <ul class="nav navbar-nav navbar-right">                               
				<li><a href="contacts.php">Contacts</a></li>
				<li><a href="signout.php">Sign Out</a></li> -->
			    </ul>
			</div><!-- /.navbar-collapse -->
		    </div><!-- /.container-fluid -->
		</nav>
	    </header>
	</div>

	<!-- Begin page content -->
	<div class="container">
	  <div class="page-header">
	    <h1>Chat</h1>   
	  </div>







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
   
    // test with a conversation between this user and 25
    
    // get id
    $id= $_COOKIE["id"];
    $firstname = $_COOKIE["firstname"];
    // this will be got using post on a page refresh
    if (isset($_POST["partnerid"]))
    {
      $partnerid = $_POST["partnerid"];
      setcookie("partnerid", $partnerid, time() + (86400 * 365), "/");
    } elseif (isset($_COOKIE["partnerid"])) 
    {
      $partnerid = $_COOKIE["partnerid"];
    } else 
    { $partnerid = "null"; }

    $needtoscroll = False;

    // send a message if required
    if (isset($_POST["content"]) and !isset($COOKIE["wait"]))
    {
       
      if((! isset($_COOKIE["lastcontent"])) or( ! isset($_COOKIE["lastreceiver"])))
      {
	setcookie("lastcontent", 'null' , time() + (86400 * 365), "/");
	setcookie("lastreceiver", 'null', time() + (86400 * 365), "/");
      }
      
      
      
      $content = $_POST["content"];
      $receiverID = $partnerid;

      if ($_COOKIE["lastcontent"] != $content or $_COOKIE["lastreceiver"] != $receiverID)
       {
	// send message to databse
	$senderID = $id;
	$time = time();
	
	// sanitize input
	$content = filter_var($content, FILTER_SANITIZE_STRING);
	$insert_row = $mysqli->query("INSERT INTO exchanges (senderID, receiverID, time, content) 
				    VALUES  ('$senderID', '$receiverID', '$time', '$content')");
	setcookie("lastcontent", $content , time() + (86400 * 365), "/");
	setcookie("lastreceiver", $partnerid, time() + (86400 * 365), "/");
        } // check not refresehed
      $needtoscroll = True;
    }

    echo '<div class="container">';

    if ($partnerid != "null")
    {
    // get partner details
    $query = "SELECT * FROM users WHERE id = '$partnerid'";
    $result = mysqli_query($mysqli, $query) or die($mysqli_error());
    $row = $result->fetch_assoc();
    $partnerfirstname = $row['first_name'];
    $partnerlastname = $row['last_name'];
    $partnerlanaguage = $row['language'];
    
    
    
    echo '<p style="text-align: right">' . $firstname . '</p>';
    echo '<p style="text-align: right">' . $partnerfirstname . '</p>';
    

    echo '<div class = "messageandinput">';

    echo '<form action="chat.php" method="post">';
    echo '<input type="text" name="content" id="typemessage" autocomplete="off" class="typemessage"/>';
    echo '<input type="hidden" name="senderID" value="' . $id . '"/>';
    echo '<input type="hidden" name="receiverID" value="' . $partnerid . '"/>';
   echo '</form>';


    echo '<div class="scrolly" id="messagebox">';
    
    $query = "SELECT * FROM exchanges WHERE (senderID = '$id' AND receiverID = '$partnerid') OR (senderID = '$partnerid' AND receiverID = '$id') ORDER BY id DESC";
    $result = mysqli_query($mysqli, $query) or die($mysqli_error());
    $num_row = mysqli_num_rows($result);
    if($num_row == 0)
    { 
      echo "<p> No messages </p>"; 
    }
    else
    {
      // echo "<p> You have messages </p>";
      while ($row = mysqli_fetch_row($result))
      {
	// message originated from this user so display as is
	if ($row[1] == $id)
	{
          echo "<p class='sent'>" . $row[4] . "</p>"; 
	}
	// message came from other user, should be translated first
	elseif ($row[2] == $id)
	{
	  $translatedreceived = $row[4];
	  // code to translate message goes here !!!
          $translatedreceived = filter_var($translatedreceived, FILTER_SANITIZE_STRING);	  
	  echo "<p class='received'>" . $translatedreceived . "</p>"; 
	}	
      }
    }    
      
      
    echo '</div>';

	
     echo '</div>';
     echo '</div>';   
    $result->close();
   }
   else
   { 
     echo '<div class="scrolly" id="messagebox"> </div>';
    }
   
    
    // buttons for selecting chat
    // echo "<div class='scrollx'>";
    // echo "</div>";
   
   // ends container for scrollx and scroll y box
   echo '</div>';

   if ($needtoscroll)
   {
     // scroll to bottom of chat
     // echo '<script> document.getElementById("messagebox").scrollTop =document.getElementById("messagebox").scrollHeight; </script>';
   }

    // make sure the users focus is on input
    echo '<script> document.getElementById("typemessage").focus(); </script>';
  ?>




      
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>
  </body>
</html>












	  
