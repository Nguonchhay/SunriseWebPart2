<?php

require_once __DIR__ . "/../admin/constants.php";
require_once __DIR__ . "/../admin/services/DatabaseService.php";

class User {
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $gender;
    public $isEmailVerified;
    public $rememberToken;


    public function __construct(
        $email,
        $password,
        $id = 0,
        $firstName = '',
        $lastName = '',
        $gender = '',
        $rememberToken = null
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = trim($password);
        $this->gender = $gender;
        $this->isEmailVerified = false;
    }

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function generateToken() {
        return password_hash($this->email, PASSWORD_BCRYPT);
    }

    public function searchByEmail($email) {
        $isExisted = false;
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();

        $sql = 'SELECT * FROM users WHERE email="' . $email . '" LIMIT 1;';
        $result = $db->executeQuery($sql);
        if (count($result) > 0) {
            $isExisted = true;
        }
        $db->closeConnection();

        return $isExisted;
    }

    public function sendVerifyLink() {
        $hash = $this->generateToken();
        $verifyLink = BASE_URL . "/admin/register-verify.php?hash=" > $hash;
        // Send link via email

        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = "UPDATE users SET rememberToken='" . $hash . "' WHERE email='" . $this->email . "';";
        $result = $db->executeUpdate($sql);
        $db->closeConnection();
    }

    public function register($user) {
        $hashPassword = $this->hashPassword($user->password);
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = "INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`) VALUES ('" . $user->firstName . "', '" . $user->lastName . "', '" . $user->email . "', '" . $hashPassword . "');";
        $result = $db->executeUpdate($sql);
        $db->closeConnection();
    }

    public static function login($email, $password) {
        $isExisted = false;
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();

        $sql = 'SELECT password FROM users WHERE isEmailVerified=1 AND email="' . $email . '" LIMIT 1;';
        $result = $db->executeOneQuery($sql);
        if (is_array($result) && count($result) > 0) {
            $dbPassword = $result[0];
            $isExisted = password_verify($password, $dbPassword);
        }
        $db->closeConnection();

        return $isExisted;
    }
}

?>