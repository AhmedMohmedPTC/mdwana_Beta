<?php
session_start();
$mysqli =new mysqli('localhost','root','','mdwanabeta') or die(mysqli_errno($mysqli));
$id= 0;
$userName ='';
$userNum ='';
$userEmail ='';
$userPass ='';


if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM users WHERE id ='$id'") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $userName = $row['userName'];
        $userNum = $row['userNum'];
        $userEmail = $row['userEmail'];
        $userPass = $row['userPass'];
    }

}
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $userName = $_POST['userName'];
    $userNum = $_POST['userNum'];
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];

    $mysqli->query("UPDATE users SET userName='$userName', userNum='$userNum',userEmail='$userEmail',userPass='$userPass' WHERE id =$id") or die($mysqli->error);
}





