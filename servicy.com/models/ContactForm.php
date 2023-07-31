<?php

require_once __DIR__ . "/../admin/constants.php";
require_once __DIR__ . "/../admin/services/DatabaseService.php";

class ContactForm {

    public function __construct(
        public $fullname,
        public $email,
        public $phone,
        public $message,
        public $id = 0
    ) {}

    public static function getContactForms() {
        $contactForms = [];
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = 'SELECT * FROM contact_forms;';
        $result = $db->executeQuery($sql);
        foreach ($result as $row) {
            $contactForms[] = new ContactForm(
                $row['fullname'],
                $row['email'],
                $row['phone'],
                $row['message'],
                $row['id']
            );
        }
        $db->closeConnection();

        return $contactForms;
    }


    public function save() {
        $sql = 'INSERT INTO contact_forms(`fullname`, `email`, `phone`, `message`) VALUES("' . $this->fullname . '", "' . $this->email . '", "' . $this->phone . '", "' . $this->message . '");';
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $result = $db->executeUpdate($sql);
        $db->closeConnection();
    }
}
