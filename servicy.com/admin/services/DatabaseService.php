<?php

class DatabaseService {

    public function __construct(
        public $dbHost,
        public $user,
        public $password,
        public $dbName = 'servicy',
        public $dbPort = 3306,
        public $con = null
    ) {}

    public function openConnection() {
        $this->con = new mysqli(
            $this->dbHost,
            $this->user,
            $this->password,
            $this->dbName
        );

        // Check connection
        if ($this->con-> connect_errno) {
          echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
          exit();
        }
    }

    public function closeConnection() {
        if ($this->con) {
            $this->con->close();
        }
    }

    /**
     * Function to execute SQL SELECT statement
     */
    public function executeQuery($sql) {
        $rows = [];
        if ($this->con) {
            $result = $this->con->query($sql);
            // Associative array
            $rows = $result->fetch_all(MYSQLI_ASSOC);
        }
        return $rows;
    }

    /**
     * Function to execute SQL INSERT, UPDATE, and DELETE statement
     */
    public function executeUpdate() {

    }

}

?>