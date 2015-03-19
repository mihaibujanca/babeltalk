<html> 

<head>

</head>

<body>


  <form action="test.php" method="post">
  Enter a message:  <input type="text" name="message"><br>
  <input type="submit">
  </form>
<?php

  
  $message = $_POST["message"];
  $newstring = implode("+", preg_split("/[\s]+/", $message));

  $contents = file_get_contents("http://itranslate4.eu/api/Translate?auth=df287e5e-6b1f-4319-90c7-9bc3ba3e45c4&src=de&trg=en&dat=Andreas hat seine Aufgabe erledigt.&dat=Er+kann+jetzt+nach+Hause+gehen.");

  echo $
 
  $contents = file_get_contents("http://itranslate4.eu/api/Translate?auth=df287e5e-6b1f-4319-90c7-9bc3ba3e45c4&src=de&trg=en&dat=Andreas+hat+seine+Aufgabe+erledigt.&dat=Er+kann+jetzt+nach+Hause+gehen.");

  $json = json_decode($contents, true);
   
 
 

  $json = json_decode($contents, true);   

  $rest = $json['dat'][0]['text'][0];

  echo $rest;
?>

</body>

</html>
