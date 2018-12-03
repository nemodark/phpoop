<?php
require_once "Database.php";

class User extends Database
{

    public function select()
    {
        //query
        $sql = "SELECT * FROM users";
        //execute or run the query
        $result = $this->conn->query($sql);
        //initialize an array
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return false;
        }
    }

    public function selectOne($id)
    {
        //query
        $sql = "SELECT * FROM users WHERE user_id=$id";
        //execute or run the query
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }

    public function store($username, $password, $firstname, $lastname, $itemname, $itemdetails, $itemquantity, $itemprice)
    {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return false;
        } else {
            $password = md5($password);
            $sql = "INSERT INTO users(username, password, firstname, lastname) VALUES('$username', '$password', '$firstname','$lastname')";
            $result = $this->conn->query($sql);

            if ($result) {
                //get the last inserted id from users table
                $user_id = mysqli_insert_id($this->conn);
                $sql = "INSERT INTO items(user_id, item_name, item_details, item_quantity, item_price) 
                        VALUES('$user_id', '$itemname', '$itemdetails', '$itemquantity', '$itemprice')";
                $result = $this->conn->query($sql);
                if($result) {
                    header("location: index.php");
                }
            } else {
                return $conn->error;
            }
        }
        $this->conn->close();
    }

    public function update($id, $username, $firstname, $lastname)
    {
        $sql = "SELECT * FROM users WHERE username = '$username' AND user_id != $id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return false;
        } else {
            $sql = "UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname' WHERE user_id=$id";
            $result = $this->conn->query($sql);
            if ($result) {
                header('location: users.php');
            } else {
                echo $this->conn->error;
            }
        }
        $this->conn->close();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE user_id=$id";
        $result = $this->conn->query($sql);
        if ($result) {
            header("location: users.php");
        } else {
            echo $this->conn->error;
        }
        $this->conn->close();
    }

    public function login($username, $password)
    {
        //query
        $sql = "SELECT * FROM users WHERE username = '$username's";
        //execute or run the query
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['userid'] = $row['user_id'];
            header("location: index.php");
        } else {
            return false;
        }
    }
}
