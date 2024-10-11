<?php


echo "logout successfully";
setcookie('jwt_token', 'jwt_token', time() - 3600, "/");

// print("<pre>");
// echo "<a href=" . '/Registro/userlogin.php' . ">" . 'Log in' .  "</a>";
// print("</pre>");

?>

<a href="/Registro/userlogin.php">Log in</a>