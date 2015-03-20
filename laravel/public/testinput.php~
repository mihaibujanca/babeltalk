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
				<li role="presentation" class="active" style="text-align: center;"> Profile <a href="profile.html"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
				<li role="presentation" class="active" style="text-align: center;"> Friends <a href="contacts.php"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-tasks" aria-hidden="true"></span></a></li>
				<li role="presentation" class="active" style="text-align: center;"> Home <a href="home.html"><span style="min-width: 4em; text-align: center;" class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
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
      echo '<div id="scrollarea" class="scrollable" style ="width: 400px;height: 400px;overflow-y: scroll;overflow-x: hidden;">';
      // load configuration for database
      require_once('config.inc.php'); 
      // connect to database
      $mysqli = new mysqli($database_host, $database_user, $database_password, $database_name);   
      
      // pickup cookies
      $id= $_COOKIE["id"];
      $firstname= $_COOKIE["firstname"];
      $lastname= $_COOKIE["lastname"];
      if (isset($_COOKIE["language"])){
	setcookie("language","en");
      } // if language cookie
      $language = $_COOKIE["language"];
      
      $partnerID= $_COOKIE["partnerID"];
      $partnerfirstname= $_COOKIE["partnerfirstname"];
      $partnerlastname = $_COOKIE["partnerlastname"];
      $partnerlanguage = $_COOKIE["partnerlanguage"];
      
      $query = "SELECT * FROM exchanges WHERE (senderID = '$id' AND receiverID = '$partnerID') OR (senderID = '$partnerID' AND receiverID = '$id') ORDER BY id";
      $result = mysqli_query($mysqli, $query) or die($mysqli_error());
      $num_row = mysqli_num_rows($result);
      
      if($num_row == 0)
      { 
        echo " <p> No messages </p> "; 
      } // if there are no messages
      else
      {
	while ($row = mysqli_fetch_row($result))
	{
	  // message originated from this user so display sender_content
	  if ($row[1] == $id)
	  {
	    echo "<p style='text-align: left;'>" . $row[4] . "</p>"; 
	  }
	  // message came from other user so display receiver_content
	  elseif ($row[2] == $id)
	  {
	    $receiver_content = $row[5];
	    // sanitize receiver_content because we are not a n00b
	    $receiver_content = filter_var($receiver_content, FILTER_SANITIZE_STRING);
	    echo "<p style='text-align: right;'>" . $receiver_content . "</p>";	   
	  }	
	} // while row
      } // there are messages
      
      $result->close();
      
      echo '</div>';
    
      echo '<form action="testinput.php" method="post">';
      echo '<input type="text" id="input" name="content" autocomplete="off" style ="width: 150px;height: 20px;"/>';
      echo '</form>';
      
      if (isset($_POST["input"]))
      {
      echo $_POST["content"]; 
      }
      
    ?> 
 <!-- display messages -->











<script>
    // refresh the page every 3 seconds
    setInterval(function () {refresh()}, 3000);
    
    // give focus to the input
    document.getElementById("input").focus();
    
    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
	    var c = ca[i];
	    while (c.charAt(0)==' ') c = c.substring(1);
	    if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	}
      return "";
    } // getCookie
    
  function refresh(){
    storeScroll();
    location.reload();
  } // refresh
  
  
  //function restoreInput() {
    var retrievedcookie=getCookie("inputcookie");
    if (retrievedcookie!="") {       
	document.getElementById("input").value=retrievedcookie;
    } // if not empty cookie
  //} // restoreInput
    
    //function restoreScroll() {
    var retrievedcookie=getCookie("scrollcookie");
    if (retrievedcookie!="") {       
	document.getElementById("scrollarea").scrollTop =retrievedcookie;
    } // if not empty cookie
  //} // restoreInput
    
    
    document.getElementById("input").onkeyup = function() {storeInput()};
    document.getElementById("input").onkeydown = function() {storeInput()};
    
    
  function storeScroll() {
      // get scroll position as var
      var $input = document.getElementById("scrollarea").scrollTop;   
      // start a cookie named inputcookie
      var $scrollcookie = "scrollcookie=";      
      // add actual input value to inputcookie
      $scrollcookie += $input;          
      // plant the cookie 
      document.cookie=$scrollcookie;      
  } // storeInput
  
  function storeInput() {
      // get input element as var
      var $input = document.getElementById("input").value;    
      // start a cookie named inputcookie
      var $inputcookie = "inputcookie=";      
      // add actual input value to inputcookie
      $inputcookie += $input;          
      // plant the cookie 
      document.cookie=$inputcookie;      
  } // storeInput    
    
</script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap.min.js"></script>



</body>
</html>