<?php 
require_once("classes/User.php");
session_start();

$id = $_SESSION['userid'];
//Create an instance for User
$user = new User;
    $userdetail = $user->selectOne($id);

    echo $userdetail['username'];

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
                    <div class="card-header bg-dark text-white"><h3>Items</h3></div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="bg-dark text-white">
                                <th>ID</th>
                                <th>Seller</th>
                                <th>Item Name</th>
                                <th>Item Quantity</th>
                                <th>Item Price</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                
                                    require_once("classes/Item.php");
                                    $item = new Item;
                                    $result = $item->select();
                                    if($result){
                                        foreach($result as $key=>$row){
                                            $id = $row['item_id'];
                                            echo "<tr>";
                                            echo "<td>" . $row['item_id'] . "</td>";
                                            echo "<td>" . $row['item_quantity'] . "</td>";
                                            echo "<td>" . $row['item_price'] . "</td>";
                                            echo "<td>
                                            <a href='edititem.php?id=$id' class='btn btn-info btn-sm'>Edit</a>
                                            <a href='deleteuser.php?id=$id' class='btn btn-danger btn-sm'>Delete</a>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else{
                                        echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>