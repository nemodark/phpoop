<?php
require_once "Database.php";

class Item extends Database{

    public function select(){
        //query
        $sql = "SELECT * FROM items INNER JOIN users ON items.user_id=users.user_id
                INNER JOIN hotels ON items.hotel_id=hotel.hotel_id";
        //execute or run the query
        $result = $this->conn->query($sql);
        //initialize an array
        $rows = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return false;
        }
    }
    
    public function selectOne($id){
        //query
        $sql = "SELECT * FROM items WHERE item_id=$id";
        //execute or run the query
        $result = $this->conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }
        else{
            return false;
        }
    }

    public function store($itemname, $password, $firstname, $lastname, $target_file, $tmp_name){
        $sql = "SELECT * FROM items WHERE item_name = '$itemname'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return false;
        }
        else{
            $password = md5($password);
            $sql = "INSERT INTO users(username, password, firstname, lastname, profile_pic) VALUES('$username', '$password', '$firstname','$lastname', '$target_file')";
            $result = $this->conn->query($sql);
            if($result){
                move_uploaded_file($tmp_name, $target_file);
                header("location: users.php");
            }
            else{
                return $conn->error;
            }
        }
        $this->conn->close();
    }

    public function update($id, $username, $firstname, $lastname){
        $sql = "SELECT * FROM users WHERE username = '$username' AND user_id != $id";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return false;
        }
        else{
            $sql = "UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname' WHERE user_id=$id";
            $result = $this->conn->query($sql);
            if($result){
                header('location: users.php');
            }
            else{
                echo $this->conn->error;
            }
        }
        $this->conn->close();
    }

    public function delete($id){
        $sql = "DELETE FROM users WHERE user_id=$id";
        $result = $this->conn->query($sql);
        if($result){
            header("location: users.php");
        }
        else{
            echo $this->conn->error;
        }
        $this->conn->close();
    }

    public function checkinRoom(){
        $sql = "SELECT * FROM rooms WHERE roomstatus='pending' OR roomstatus='occupied'";
        $result = $this->conn->query($sql);
        $rows = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        else{
            return false;
        }
    }
}



