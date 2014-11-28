<html> 

<head>

</head>

<body>

<?php

<<<<<<< HEAD
  $message = "this is a test message";
  
  $newstring = implode("+", preg_split("/[\s]+/", $message));
=======
  $contents = file_get_contents("http://itranslate4.eu/api/Translate?auth=df287e5e-6b1f-4319-90c7-9bc3ba3e45c4&src=de&trg=en&dat=Andreas hat seine Aufgabe erledigt.&dat=Er+kann+jetzt+nach+Hause+gehen.");
>>>>>>> 857ade1e57f8d6658b1526fdad4b697f8d59531e

  echo $newstring;

<<<<<<< HEAD
  
 
  $contents = file_get_contents("http://itranslate4.eu/api/Translate?auth=df287e5e-6b1f-4319-90c7-9bc3ba3e45c4&src=de&trg=en&dat=Andreas+hat+seine+Aufgabe+erledigt.&dat=Er+kann+jetzt+nach+Hause+gehen.");
=======
  $json = json_decode($contents, true);
   
 
  
>>>>>>> 857ade1e57f8d6658b1526fdad4b697f8d59531e

  $json = json_decode($contents, true);   

  $rest = $json['dat'][0]['text'][0];

  echo $rest;
?>

</body>

</html>
