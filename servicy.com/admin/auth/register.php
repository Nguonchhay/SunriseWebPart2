<?php

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

if ($isRedirect) {
    header("Location: ../register.php");
    exit();
}

$_SESSION['newUser']['password'] = password_hash($password, PASSWORD_BCRYPT);

// Create user in database
var_dump($_SESSION['newUser']);
/**
 * Next actions:
 * 1. Search for existing user by email
 * 1.1. If yes, alert user for existing account and ask them to login instead
 * 1.2. If No, prepare to stor user
 * 2. Prepare SQL statement to insert new user
 * 2.1. If insert success, send link to user email to complete registration
 * 2.2. If insert failed, display failed reason
 */

?>