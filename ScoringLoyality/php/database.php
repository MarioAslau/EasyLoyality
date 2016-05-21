<?php

include_once "../../config.php";

$db_connection = new DatabaseConnect($servername, $username, $password, $db_name);


class DatabaseConnect {
        private $conn;


        public function __construct($servername, $username, $password, $database) {
                $this->conn = new mysqli($servername, $username, $password, $database);
                if ($this->conn->connect_error) {
                        die("Connection to database failed! " . $this->conn->connect_error);
                }
        }
        
        
        public function close_connection() {
                $this->conn->close();
        }
}
