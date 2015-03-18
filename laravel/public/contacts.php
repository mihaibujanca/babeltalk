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
                            <a class="navbar-brand" href="Home1.html">Babel Talk</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav nav-pills navbar-right">
                                <li role="presentation" class="active" style="text-align: center;"> Quit <a href="signout.php"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                                <li role="presentation" class="active" style="text-align: center;"> Friends <a href="contacts.php"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
                                <li role="presentation" class="active" style="text-align: center;"> Home <a href="Home1.html"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
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
        
	<p> Add a new friend by email : </p>


	<form name="form1" method="post" action="contacts.php">
		<input name="search" type="text" /> 
		<input type="submit" name="submit" value="search" /> 


	</form>
	
	<div class="page-header">
                <h3>Current Friends</h3>
        </div>

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
	  
	  
	  // code to search for new friends
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
	  
	  
	  
	  
	  
	  // code to load and output friends list	  
	  
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
