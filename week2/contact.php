<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: task6.php");
    exit();
}

if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['message'])) {
    header("Location: task6.php");
    exit();
}


header("Location: thank-you.php");
exit();


?>