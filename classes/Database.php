<?php

class Database{
    
    //properties
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "mydatabase";

    public $conn;

    public function __construct(){
        //Create the connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        //Check the connection
        if($this->conn->connect_error){
            die("Connection error: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}