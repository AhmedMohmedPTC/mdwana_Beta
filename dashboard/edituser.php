<?php
include ('include/connection.php');

$query = "SELECT * FROM users WHERE id = id?" ;
$result = mysqli_query($con ,$query);
$data = mysqli_fetch_array($result);


mysqli_query("UPDATE users SET first=".$_POST['userName']." AND last=".$_POST['userNum']." WHERE id=".$_POST['id']);
mysqli_close();

?>