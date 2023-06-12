<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

unset($_SESSION['newUser']);
unset($_SESSION['isAuth']);
header("Location: ../../index.php");
exit();

?>