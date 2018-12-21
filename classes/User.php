<?php
require_once "Database.php";

class User extends Database
{

    public function select()
    {
        //query
        $sql = "SELECT * FROM movies ORDER BY movie_id DESC LIMIT 5";
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

    public function store($username, $password, $firstname, $lastname, $itemname, $itemdetails, $itemquantity, $itemprice, $directory, $fileToUpload)
    {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return false;
        } else {
            $password = md5($password);
            $sql = "INSERT INTO movies(movie_id, movie_name) VALUES('$username', '$password', '$firstname','$lastname', '$directory')";
            $result = $this->conn->query($sql);

            if ($result) {
                move_uploaded_file($fileToUpload, $directory);
                $movie_id = mysqli_insert_id($this->conn);
                foreach($subject as $index => $val){
                    $schedule = strtotime($schedule);
                    $date = date("Y/m/d", $schedule);
                    $sql = "INSERT INTO items(user_id, item_name, item_details, item_quantity, item_price) 
                        VALUES('$user_id', '$itemname', '$itemdetails', '$itemquantity', '$itemprice')";
                    $result = $this->conn->query($sql);
                }
                
                if($result) {
                    $reservation_id = mysqli_insert_id($result);
                    header("location: reserve.php?id=$reservation_id");
                }
            } else {
                echo $this->conn->error;
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
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
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

    public function insertMovie($subject){
        $sql = "INSERT INTO movies";
        $result= $this->conn->query($sql);
        if($result){
            $movie_id = mysqli_insert_id($this->conn);
            foreach($cinema as $index => $cinema_id){
                $sql = "INSERT INTO moviecinema(movie_id, cinema_id) VALUES($movie_id, $cinema_id)";
            }
        }
        
    }

    public function confirm($id){
        $sql = "UPDATE reservation SET status='confirm' WHERE reserve_id=$id";
        
    }

    public function selectConfirmation(){
        $sql = "SELECT * FROM reservation WHERE status='pending'";
    }

    public function reserve($movie_id, $cinema_id, $quantity, $date, $user_id){
        $sql = "SELECT * FROM moviecinema WHERE cinema_id=$cinema_id AND movie_id=$movie_id";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $mc_id = $row['moci_id'];
        $mc_quantity = $row['quantity'];
        $new_quantity = $mc_quantity - $quantity;
        $price = $row['price'];
        ($row['status'] == 'admin');
        $total = $price * $quantity;

        $sql = "UPDATE moviecinema SET quantity=$new_quantity WHERE moci_id=$mc_id";
        $result = $this->conn->query($sql);
        if($result){
            $sql = "INSERT INTO reservation(moci_id, quantity, totalprice, status, date)VALUES($mc_id, $quantity, $total, 'pending', $date)";
        }
    }

    public function confirmReceipt($id){
        $sql = "";
        $result = $this->conn->query($sql);
        if($result){
            $row = $result->fetch_assoc();
            return $row;
        }
        else{
            return false;
        }
    }

    public function selectReservation($id){
        $sql = "SELECT * FROM reservation WHERE reserve_id = $id";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function confirmBooking($id){
        $sql = "UPDATE reservation SET status='confirmed' WHERE reserve_id = $id";
        $result = $this->conn->query($sql);
        if($result){
            $getroom = $this->selectReservation($id);
            $roomid = $getroom['room_id'];
            $sql = "UPDATE rooms SET status='pending' WHERE room_id = $id";
            $result = $this->conn->query($sql);
        }
    }
}


$id = $_GET['id'];

$result = $reserve->confirmReceipt($id);

$date1=date_create("2013-03-15");
$date2=date_create("2013-12-12");
$diff=date_diff($date1,$date2);
echo $diff->format("%a");
