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
  $url = "http://itranslate4.eu/api/Translate?auth=785f2f42-eab1-461d-8a72-a1867112458a&src=" . $senderlang . "&trg=" . $recieverlang . "&dat=" . $newstring . ".";
  $contents = url_get_contents($url);
  echo $contents;
  echo $url;

  $json = json_decode($contents, true);
  
  $json = json_decode($contents, true);   

  $translation = $json['dat'][0]['text'][0];
  
  echo "The translated text is: " . $translation;
  
            
  function url_get_contents ($Url) {
      if (!function_exists('curl_init')){ 
          die('CURL is not installed!');
      }
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $Url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $output = curl_exec($ch);
      curl_close($ch);
      return $output;
  }       
?>

</body>

</html>
