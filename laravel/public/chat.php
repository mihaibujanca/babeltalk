<html lang="en">
<head>
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
    
    // get ids
    $cookie_name = "id";
    $id= $_COOKIE[$cookie_name];
    // this will be got using post on a page refresh
    $partnerid = 25;
    
    // get partner details
    $query = "SELECT * FROM users WHERE id = '$partnerid'";
    $result = mysqli_query($mysqli, $query) or die($mysqli_error());
    $row = $result->fetch_assoc();
    $partnerfirstname = row['first_name'];
    $partnerlastname = row['last_name'];
    $partnerlanaguage = row['langauge'];
    
    echo '<div class="scrolly" id="messagebox">';
    
    $query = "SELECT * FROM exchanges WHERE (senderID = '$id' AND receiverID = '$partnerid') OR (senderID = '$partnerid' AND receiverID = '$id') ORDER BY id";
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
	  echo "<p class='received'>" . $translatedreceived . "</p>"; 
	}	
      }

    }
    
    echo '</div>';
    $result->close();
    














    
    echo "<div class='scrollx'>";
    echo "</div>";

  ?>




      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>
  </body>
</html>












	  