 <?php
 $cookie_name = "id";
 $cookie_value = "";
 // set the expiration date to one hour ago
setcookie($cookie_name, $cookie_value, time() - 3600, "/");
header("Location: http://10.2.234.107/babeltalk/laravel/public/home2.html");
?>