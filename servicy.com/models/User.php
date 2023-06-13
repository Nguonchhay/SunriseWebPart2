<?php

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
}

?>