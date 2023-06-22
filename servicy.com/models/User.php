<?php

require_once "/../admin/services/DatabaseService.php";

class User {
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $password;
    protected $gender;
    protected $isEmailVerified;


    public function __construct(
        $id = 0,
        $firstName = '',
        $lastName = '',
        $email,
        $password,
        $gender = ''
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $this->hashPassword($password);
        $this->gender = $gender;
        $this->isEmailVerified = false;
    }

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function searchByEmail($email) {
        $isExisted = false;
        $db = new DatabaseService('localhost', 'root', 'root');
        $db->openConnection();

        $sql = 'SELECT * FROM users WHERE email="' . $user->email . '" AND password="' . $user->password . '" LIMIT 1;';
        $result = $db->executeQuery($sql);
        if (count($result) > 0) {
            $isExisted = true;
        }
        $db->closeConnection();

        return $isExisted;
    }

    public function register($user) {
        $db = new DatabaseService('localhost', 'root', 'root');
        $db->openConnection();
        $sql = "INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`) VALUES ('" . $user->firstName . "', '" . $user->lastName . "', '" . $user->email . "', '" . $user->password . "');";
        $result = $db->executeUpdate($sql);
        $db->closeConnection();
    }

    public function login($email, $password) {

    }
}

?>