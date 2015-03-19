 <?php
 $cookie_name = "id";
 $cookie_value = "";
 // set the expiration date to one hour ago
setcookie($cookie_name, $cookie_value, time() - 3600, "/");
header("Location: https://web.cs.manchester.ac.uk/mbax4ab4/babeltalk/laravel/public/index.html");
?>