<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form id="form1" name="form1" method="post">
<input type="checkbox" name="subject[]" value="WD">Web Design <br />
<input type="checkbox" name="subject[]" value="PH">PHP <br />
<input type="checkbox" name="subject[]" value="MY">Mysql <br />
<input type="checkbox" name="subject[]" value="JV">Java <br />
<input type="checkbox" name="subject[]" value="VB">VB.net <br />
<input type="submit" name="submit" value="submit">


</form>

<?php
$_GET['date1'];
$_GET['date2'];

$roomid = $row['room_id'];
echo "<a href='confirmreceipt.php?id=$roomid&date1=$date1&date2=$date2'></a>";

if(isset($_POST['submit'])){
    require("classes/User.php");
    $subject = $_POST['subject'];

    $user = new User;

    $user->showSubject($subject);

}
?>



</body>
</html>