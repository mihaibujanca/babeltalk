<?php
  // load configuration for database
  require_once('config.inc.php'); 
  // connect to database
  $mysqli = new mysqli($database_host, $database_user, $database_password, $database_name); 

  $content = $_POST["content"];

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
  echo($partnerlanguage);
  $time = time();
  setcookie("noclear", "whocares", time()+1);
  
  
  
  //Translate the message
  $translatedcontent = translate($language, $partnerlanguage, $content);
  
  echo $translatedcontent;
  
  
  $insert_row = $mysqli->query("INSERT INTO exchanges (senderID, receiverID, time, sender_content, receiver_content) 
				    VALUES  ('$id', '$partnerID', '$time', '$content', '$translatedcontent')");
				    
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
  
  
   function translate($senderlang, $recieverlang, $message)
   {
     // Add the plus signs inside the message so it can be send via api request
     $newstring = implode("+", preg_split("/[\s]+/", $message));
     
     // Call the API
     $url = "http://itranslate4.eu/api/Translate?auth=785f2f42-eab1-461d-8a72-a1867112458a&src=" . $senderlang . "&trg=" . $recieverlang . "&dat=" . $message . ".";
     
     // Get the contents of the URL
     $contents = url_get_contents($url);

    
     // Decode the returned JSON object and get the text
     $json = json_decode($contents, true);
     $translation = $json['dat'][0]['text'][0];
     
     return $translation;
     
   }
      
  //header("Location: https://web.cs.manchester.ac.uk/mbax4ab4/babeltalk/laravel/public/testinput.php");
  
?>