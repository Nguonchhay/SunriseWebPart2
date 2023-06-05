<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../index.php");
    exit();
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatPassword'];
$isRedirect = false;

$_SESSION['errorEmailMessage'] = '';
if (empty($email)) {
    $_SESSION['errorEmailMessage'] = 'Email is required!';
    $isRedirect = true;
} else {
    $_SESSION['errorEmailMessage'] = '';
}

$_SESSION['errorPasswordMessage'] = '';
if (empty($password) || empty($repeatPassword)) {
    $_SESSION['errorPasswordMessage'] = 'Password and Repeat Password are required!';
    $isRedirect = true;
} else {
    $_SESSION['errorPasswordMessage'] = '';
}

if ($isRedirect) {
    header("Location: ../register.php");
    exit();
}

// Create user in database
var_dump($_POST);

?>