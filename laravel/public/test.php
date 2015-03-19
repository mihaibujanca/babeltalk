<html> 

<head>

</head>

<body>


  <form action="test.php" method="post">
  Enter a message:  <input type="text" name="message" placeholder="Hello world!"><br>
  Enter the language to send in (en, ro, fr) <input type="text" name="senderlang" placeholder="en"><br>
  Enter the language to recieve in (en, ro, fr) <input type="text" name="recieverlang" placeholder="fr"><br>
  <input type="submit">
  </form>

  <?php

  $message = $_POST["message"];
  $senderlang = $_POST["senderlang"];
  $recieverlang = $_POST["recieverlang"];

  $newstring = implode("+", preg_split("/[\s]+/", $message));
  $url = "http://itranslate4.eu/api/Translate?auth=df287e5e-6b1f-4319-90c7-9bc3ba3e45c4&src=" . $senderlang . "&trg=" . $recieverlang . "&dat=" . $newstring . ".";
  $contents = file_get_contents($url);

  $json = json_decode($contents, true);
  
  $json = json_decode($contents, true);   

  $translation = $json['dat'][0]['text'][0];
  
  echo "The translated text is: " . $translation;
?>

</body>

</html>
