<?php
    require("classes/User.php");
    $user = new User;
    $id = $_GET['id'];
    $deleteuser = $user->delete($id);
?>