<?php
require("classes/User.php");
$user = new User;
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $itemname = $_POST['itemname'];
    $itemdetails = $_POST['itemdetails'];
    $itemquantity = $_POST['itemquantity'];
    $itemprice = $_POST['itemprice'];

    $adduser = $user->store($username, $password, $firstname, $lastname, $itemname, $itemdetails, $itemquantity, $itemprice);
    
    if($adduser == FALSE){
        echo "Username is already taken.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card mt-5">
                    <div class="card-header bg-dark text-white"><h3>Add User</h3></div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" name="itemname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Item Details</label>
                                <input type="text" name="itemdetails" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Item Quantity</label>
                                <input type="number" name="itemquantity" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Item Price</label>
                                <input type="text" name="itemprice" class="form-control">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Add User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>