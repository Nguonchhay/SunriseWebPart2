<?php

require_once __DIR__ . "/../admin/constants.php";
require_once __DIR__ . "/../admin/services/DatabaseService.php";

class PortfolioType {

    public function __construct(
        public $title,
        public $id = 0
    ) {}


    public static function getPortfolioTypes() {
        $portfolioTypes = [];
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = 'SELECT * FROM portfolio_types;';
        $result = $db->executeQuery($sql);
        foreach ($result as $row) {
            $portfolioTypes[] = new PortfolioType(
                $row['title'],
                $row['id']
            );
        }
        $db->closeConnection();

        return $portfolioTypes;
    }

    public static function findById($id) {
        $portfolioType = null;
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = 'SELECT id, title FROM portfolio_types WHERE id=' . $id . ' LIMIT 1;';
        $row = $db->executeOneQuery($sql);
        
        if (is_array($row) && count($row)) {
            $portfolioType = new PortfolioType(
                $row[1],
                $row[0]
            );
        }
        $db->closeConnection();

        return $portfolioType;
    }

    public function save() {
        $sql = 'INSERT INTO portfolio_types(`title`) VALUES("' . $this->title . '");';
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $result = $db->executeUpdate($sql);
        $db->closeConnection();
    }

    public function update() {
        $sql = 'UPDATE portfolio_types SET `title`="' . $this->title . '" WHERE id=' . $this->id;
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $result = $db->executeUpdate($sql);
        $db->closeConnection();
    }

    public static function deleteById($id) {
        $result = 0;
        $db = new DatabaseService(DB_HOST, DB_USER, DB_PASSWORD);
        $db->openConnection();
        $sql = 'DELETE FROM portfolio_types WHERE id=' . $id;
        $result = $db->executeUpdate($sql);
        $db->closeConnection();

        return $result;
    }

}

?>