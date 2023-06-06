<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../index.php");
    exit();
}

$_SESSION['email'] = $_POST['email'];
$password = $_POST['password'];
$isRedirect = false;

$_SESSION['errorEmailMessage'] = '';
if (empty($_SESSION['email'])) {
    $_SESSION['errorEmailMessage'] = 'Email is required!';
    $isRedirect = true;
} else {
    $_SESSION['errorEmailMessage'] = '';
}

$_SESSION['errorPasswordMessage'] = '';
if (empty($password)) {
    $isRedirect = true;
    $_SESSION['errorPasswordMessage'] = 'Password is required!';
} else {
    $_SESSION['errorPasswordMessage'] = '';
}

if ($isRedirect) {
    header("Location: ../login.php");
    exit();
}

var_dump($_POST);

?>