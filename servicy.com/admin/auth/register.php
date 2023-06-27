<?php

ini_set ('display_errors', 1);  
ini_set ('display_startup_errors', 1);  
error_reporting (E_ALL);  

require_once __DIR__ . "/../../models/User.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../index.php");
    exit();
}

$_SESSION['newUser'] = [
    'firstName' => $_POST['firstName'],
    'lastName' => $_POST['lastName'],
    'email' => $_POST['email']
];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatPassword'];
$isRedirect = false;


$_SESSION['errorEmailMessage'] = '';
if (empty($_SESSION['newUser']['email'])) {
    $_SESSION['errorEmailMessage'] = 'Email is required!';
    $isRedirect = true;
} else {
    $_SESSION['errorEmailMessage'] = '';
}

$_SESSION['errorPasswordMessage'] = '';
if (empty($password) || empty($repeatPassword)) {
    $isRedirect = true;
    $_SESSION['errorPasswordMessage'] = 'Password and Repeat Password are required!';
} else {
    if ($password !== $repeatPassword) {
        $isRedirect = true;
        $_SESSION['errorPasswordMessage'] = 'Password and Repeat Password must be the same!';
    } else if (strlen($password) < 8 || strlen($repeatPassword) < 8) {
        $isRedirect = true;
        $_SESSION['errorPasswordMessage'] = 'The lenght of Password and Repeat Password have to be at least 8 character!';
    } else {
        $_SESSION['errorPasswordMessage'] = '';
    }
}

$_SESSION['newUser']['password'] = password_hash($password, PASSWORD_BCRYPT);

$newUser = new User(
    $_SESSION['newUser']['email'],
    $_SESSION['newUser']['password'],
    0, 
    $_SESSION['newUser']['firstName'], 
    $_SESSION['newUser']['lastName'],
    ''
);

// Create user in database
 $_SESSION['errorUserMessage'] = '';
 $isExisted = $newUser->searchByEmail($newUser->email);
 if ($isExisted) {
    $isRedirect = true;
    $_SESSION['errorUserMessage'] = 'User already existed!';
 } else {
    $newUser->register($newUser);
    $newUser->sendVerifyLink();
    unset($_SESSION['newUser']);
    $_SESSION['errorUserMessage'] = '';
 }

 if ($isRedirect) {
    header("Location: ../register.php");
    exit();
}


 // Redirect to success registration page
 header("Location: ../register-success.php");
 exit();

?>