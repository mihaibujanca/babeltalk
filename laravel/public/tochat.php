<?php
  $receiverID = $_POST["receiverID"];
  $setcookie("receiverID");
  header("Location: https://web.cs.manchester.ac.uk/mbax4ab4/babeltalk/laravel/public/chat.php");
?>