<?php

ini_set ('display_errors', 1);  
ini_set ('display_startup_errors', 1);  
error_reporting (E_ALL);  

require_once __DIR__ . "/../../models/User.php";
require_once __DIR__ . "/../services/DatabaseService.php";

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


if (User::login($_SESSION['email'], $password,)) {
    // Mark email is verified
    $sql = "UPDATE users SET rememberToken='" . time() . "' WHERE email='" . $_SESSION['email'] . "';";
    $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
    $db->openConnection();
    $result = $db->executeUpdate($sql);
    $db->closeConnection();

    // Auto login after success registration
    $_SESSION['isAuth'] = true;

    unset($_SESSION['email']);

    header("Location: ../../index.php");
    exit();
} else {
    $isRedirect = true;
    $_SESSION['errorUserMessage'] = 'Invalid credentials!';
}

if ($isRedirect) {
    header("Location: ../login.php");
    exit();
}

?>