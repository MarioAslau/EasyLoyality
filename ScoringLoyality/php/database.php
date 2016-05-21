<?php

include_once "../../config.php";

$db_connection = new DatabaseConnect($servername, $username, $password, $db_name);


class DatabaseConnect {
        private $conn;
        private $result;


        public function __construct($servername, $username, $password, $database) {
                $this->conn = new mysqli($servername, $username, $password, $database);
                if ($this->conn->connect_error) {
                        die("Connection to database failed! " . $this->conn->connect_error);
                }
        }
        
        
        public function query_db($query) {
                $this->result = mysqli_query($this->conn, $query)
                        or die("There was something wrong with the query syntax.");
                return $this->result;
        }
        
        
        public function get_returned_rows() {
                return mysqli_num_rows($this->result);
        }
        
        
        public function close_connection() {
                $this->conn->close();
        }
}
