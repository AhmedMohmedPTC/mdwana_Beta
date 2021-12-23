
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تعديل بيانات المستخدم</title>
    <!-- Bootstrap and Bootstrap Rtl -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="css/custom.css">

    <style>
        .login{
            width: 300px;
            margin: 80px auto;
            font-family: janna lt;
        }
        .login h5{
            color: #555;
            margin-bottom: 30px;
            margin-top: 10px;
            text-align: center;
        }
        .login button{
            margin-right: 80px;
            padding: 5px;
            width: 140px;
            background: #00b593;
            border: 1px solid #00b593;
            color: #fff;
        }
    </style>

</head>

<body>

<!-- Log to dashboard  -->




<div class="container-fluid">
    <!-- Start new post -->
    <div class="new-book">


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







        $mysqli =new mysqli('localhost','root','','mchro3') or die(mysqli_errno($mysqli));

        ?>
        <div class="login">
            <form action="userprocess.php" method="POST"">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="title">الاسم</label>
                    <input type="text" id="title" class="form-control" name="userName" value="<?php
                        echo $userName;
                   ?>">
                </div>
                <div class="form-group">
                    <label for="title">الهاتف</label>
                    <input type="text" id="title" class="form-control" name="userNum" value="<?php
                        echo $userNum;
                   ?>">
                </div>
                <div class="form-group">
                    <label for="title">الايميل</label>
                    <input type="email" id="title" class="form-control" name="userEmail" value="<?php
                        echo $userEmail;
             ?>">
                </div>
                <div class="form-group">
                    <label for="title">كلمة السر</label>
                    <input type="password" id="title" class="form-control" name="userPass" value="<?php
                        echo $userPass;
                    ?>">
                </div>


                <button class="custom-btn" name="edit">تعديل البيانات</button>
            </form>
        </div>
        <!-- End new pots -->
    </div>
    <!-- /#page-content-wrapper -->



