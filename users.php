<?php 
require("classes/User.php");

//Create an instance for User
$user = new User;

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
                    <div class="card-header bg-dark text-white"><h3>Users</h3></div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="bg-dark text-white">
                                <th>ID</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                    $result = $user->select();
                                    if($result){
                                        foreach($result as $key=>$row){
                                            $id = $row['user_id'];
                                            echo "<tr>";
                                            echo "<td>" . $row['user_id'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['firstname'] . "</td>";
                                            echo "<td>" . $row['lastname'] . "</td>";
                                            echo "<td>
                                            <a href='edituser.php?id=$id' class='btn btn-info btn-sm'>Edit</a>
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

    <h1>Hello World!</h1>
</body>
</html>