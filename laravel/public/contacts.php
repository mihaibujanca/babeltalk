<!--
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

-->

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BabelTalk| Home</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

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
	    <h1>Friends</h1>   
	  </div>
	  <p> Search for new friends by email </p>
	  <form name="form1" method="post" action="contacts.php">
	    <input name="search" type="text" /> 
	    <input type="submit" name="submit" value="search" /> 
	  </form> 
	
	

      <?php
      if (isset($_COOKIE['id']))
      {
	  
	  
	  // load configuration for database
	  require_once('config.inc.php'); 
	  // connect to database
	  $mysqli = new mysqli($database_host, $database_user, $database_password, $database_name);
	  // check for error 
	  if($mysqli -> connect_error) 
	  {
	    die('Connection Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
	  }
	  
	  
	  function printFlag($nation)
	  {
	    if($nation == 'fr') {
	      echo "<img src='images/France.png' alt='en' style='width:30px;height:30px'>";
	    }
	    if($nation == 'en') {
	      echo "<img src='images/England.png' alt='en' style='width:30px;height:30px'>";
	    }
	    if($nation == 'ro') {
	      echo "<img src='images/Romania.png' alt='en' style='width:30px;height:30px'>";
	    }
	    return ;
	  }
	  
	  $cookie_name = "id";
	  $id= $_COOKIE[$cookie_name];
	  
	// code to search for new friends
	if(isset($_POST['search']))
	{
	if (strlen (($_POST['search'])) > 1)
	{
	  $search = $_POST['search'];
	  $query = "SELECT * FROM users WHERE email = '$search'";
	  $result = mysqli_query($mysqli, $query) or die($mysqli_error());
	  $num_row = mysqli_num_rows($result);
	  if($num_row == 0)
	  { echo "<p> No results found for ".$search." </p>"; }
	  else
	  { 
	  $row = $result -> fetch_assoc();
	  
	  
	  	  
	  
	  $toaddID = $row['id'];
	  
	  // if searched for self
	  if ($toaddID == $id){	  
	    
	    echo "<h3> "; printFlag($row['language']); echo " ". $row['first_name'] . " " . $row['last_name'] . " (you) " . "</h3> ";
	    echo "<p>" . $row['email'] . "</p> <br>";
	    
	  }  
	  else {
	    // if searched for friend 
	    
	    $query = "SELECT * FROM friends WHERE user1ID = '$id' AND user2ID = $toaddID";
	    $result = $mysqli->query($query);
	    $num_row = mysqli_num_rows($result);
	    if ($num_row > 0){
	      
	      echo "<h3> "; printFlag($row['language']); echo " " .$row['first_name'] . " " . $row['last_name'] . " (friends) " . "</h3> ";
	      echo "<p>" . $row['email'] . "</p> <br>";
	      
	    }
	    else{
	    
	    
	  // new person
	    echo "<h3> "; printFlag($row['language']); echo " ". $row['first_name'] . " " . $row['last_name']  . "</h3> ";

	    echo "<p>" . $row['email'] . "</p> <br>";
	    echo "<form name='addfriend' method='post' action='contacts.php'>"; 
	    echo "<button type='submit' name='add' value='".$row['id']."'>" . "+ add " . $row['first_name'] . "</button>"; ; 
	    echo "</form>";
	  }
	}
	}
	} // strlen > 5
	} // is set search
	  
	  
	// code to add a friend
	if(isset($_POST['add']))
	{
	  $idtoadd = $_POST['add'];
	  $query = "INSERT INTO friends (user1ID, user2ID) VALUES ('$id' ,'$idtoadd')";
	  $result = mysqli_query($mysqli, $query) or die($mysqli_error());
	  $query = "INSERT INTO friends (user1ID, user2ID) VALUES ('$idtoadd' ,'$id')";
	  $result = mysqli_query($mysqli, $query) or die($mysqli_error());
	
	} // is set add





	  
	  
	  // code to load and output friends list	  
	  
	  $cookie_name = "id";
	  $id= $_COOKIE[$cookie_name];
	  echo "<div class='page-header'> <h3>Current Friends</h3> </div>";

	  
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
		echo "<span style='display: inline-block;'>";  
		echo "<form name='chat' method='post' action='contacts.php' style='display: inline-block; margin-right: 10px;'>"; 
		echo "<button type='submit' name='chat' value='".$row2['id']."' style='margin-right:10px;'> <image style='width:14px;height:14px;' src='http://www.famfamfam.com/lab/icons/mini/icons/comment.gif'/> </button>"; ; 
		echo "</form>";
		printFlag($row2['language']);
		echo "<b> " . $row2['first_name'] . " " . $row2['last_name'] . "</b> ";
		echo "</span>";
		echo "<br>";
		echo "<span style='display: inline;'>";		
		echo $row2['email'];
		echo "</span>";
		echo "<hr>";

	      }
	    }
	  } // if results
	  else
	  {
	    echo "You have no friends yet :( <br>";
	    echo "Search for friends to get going! <br>";
	  }
	  $result->close();

	
      }
      ?>

	</div>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>



</body>
</html>
