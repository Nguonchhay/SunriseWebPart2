<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: task6.php");
    exit();
}

$isRedirect = false;
if (empty($_POST['fullname'])) {
    $_SESSION['errorFullName'] = true;
    $isRedirect = true;
} else {
    $_SESSION['errorFullName'] = false;
}
$_SESSION['fullname'] = $_POST['fullname'];

if (empty($_POST['email'])) {
    $_SESSION['errorEmail'] = true;
    $isRedirect = true;
} else {
    $_SESSION['errorEmail'] = false;
}
$_SESSION['email'] = $_POST['email'];

if (empty($_POST['message'])) {
    $_SESSION['errorMessage'] = true;
    $isRedirect = true;
} else {
    $_SESSION['errorMessage'] = false;
}
$_SESSION['message'] = $_POST['message'];

if ($isRedirect) {
    header("Location: task6.php");
    exit();
}


unset($_SESSION['fullname']);
unset($_SESSION['email']);
unset($_SESSION['message']);
unset($_SESSION['errorFullName']);
unset($_SESSION['errorEmail']);
unset($_SESSION['errorMessage']);
$_SESSION['submittedFullName'] = $_POST['fullname'];
header("Location: thank-you.php");
exit();


?>