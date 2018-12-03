<?php
require("classes/User.php");
$user = new User;
$id = $_GET['id'];
$row = $user->selectOne($id);

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $updateuser = $user->update($id, $username, $firstname, $lastname);

    if($updateuser == FALSE){
        echo "Username is already taken.";
    }
    else{
        echo "1";
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
                    <div class="card-header bg-dark text-white"><h3>Edit User</h3></div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo $row['firstname']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo $row['lastname']; ?>">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>