<?php
    session_start();
    include 'include/connection.php';
    // check if session isset
    if(isset($_SESSION['adminInfo'])){
        header('Location:dashboard.php');
    }
    else{
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول</title>
    <!-- Bootstrap and Bootstrap Rtl -->
    <link rel="icon" type="image/png" href="../layout/images/icon.png">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="../layout/css/bootstrap-rtl.css">
    <!--  Custom css  -->
    <link rel="stylesheet" href="../layout/css/custom.css?v=<?php echo time(); ?>">
    <!-- Font -->
    <link rel="stylesheet" href="../layout/font/droid-kufi.css">

    <link rel="stylesheet" href="../layout/css/lightbox.min.css">

    <script type="text/javascript" src="../layout/js/lightbox-plus-jquery.min.js"></script>
  


</head>

<body>
        <nav class="navbar navbar-expand-sm navbar-light">
            <div class="container">
                <a href="../index.php" class="navbar-brand">المدونة الالكترونية</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav ml-auto">
                       
                        <li class="nav-item">
                            <a href="../about.php" class="nav-link">من نحن</a>
                        </li>
                        <li class="nav-item">
                            <a href="../callUs.php" class="nav-link">اتصل بنا</a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (!isset($_SESSION['adminInfo']) && !isset($_SESSION['userInfo'])){
                                ?>
                                <a href="../dashboard/index.php" class="nav-link" style="color: var(--main-color)">تسجيل الدخول</a>


                                <?php
                            }
                            ?>

                        </li>
                        <li class="nav-item">
                            <?php
                            if (!isset($_SESSION['userInfo']) && !isset($_SESSION['adminInfo'])) {
                                ?>
                                <a href="../dashboard/signin.php" class="nav-link">مستخدم جديد</a>


                                <?php
                            }
                            ?>
                        </li>

                        <?php
                        if (isset($_SESSION['adminInfo'])) {
                            ?>
                            <a href="../dashboard/dashboard.php" target="_blank" class="dashboard-btn">لوحة التحكم</a>
                            <?php
                        }
                        ?>

                        <?php
                        if (isset($_SESSION['userInfo'])) {
                            ?>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <!-- Show user Name  -->
                                            <?php
                                            $query = "SELECT userName FROM users";
                                            $result = mysqli_query($con, $query);
                                            $row = mysqli_fetch_assoc($result);
                                            echo $_SESSION['userInfo'];
                                            ?>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="edit-user.php?id=<?php
                                            if (isset($_GET['id'])) {
                                                $id = $_GET['id'];
                                                $query = "SELECT * FROM users WHERE id = '$id'";
                                                $result = mysqli_query($con, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                echo $row['id'];}?>">تعديل البيانات الشخصيه</a>
                                            <!--  <a class="dropdown-item" href="#">الطلبيات</a> -->
                                            <a class="dropdown-item" href="logout.php">تسجيل الخروج</a>
                                        </div>


                                    </li>


                                </ul>
                            </div>

                            <?php


                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!--    End navbar    -->

  <div class="login">
<!-- Log to dashboard  -->
   <?php 
        if(isset($_POST['log']))  {
            $adminInfo = $_POST['adminInfo'];
            $adminPass = $_POST['password'];
            $userInfo  = $_POST['adminInfo'];
            $userPass  = $_POST['password'];

            //check if inputs are not empty
            if(empty($adminInfo) || empty($adminPass)){
                echo "<div class='alert alert-danger'>" . "الرجاء مل الحقول أدناه" . "</div>";
            }
            // check if values are match
            else{
                $query = "SELECT * FROM admin WHERE (adminName='$adminInfo' OR adminEmail='$adminInfo') AND adminPass='$adminPass '";
                $result = mysqli_query($con,$query);
                $row = mysqli_num_rows($result);
                
                if($row > 0){
                    $_SESSION['adminInfo'] = $adminInfo;
                    header('Location:dashboard.php');
                }
                else{
                    if(isset($_POST['log'])){
                        $query = "SELECT * FROM users WHERE (userName='$userInfo' OR userEmail='$userInfo') AND userPass='$userPass '";
                        $result = mysqli_query($con,$query);
                        $row = mysqli_num_rows($result);
                        if($row > 0){
                            $_SESSION['userInfo'] = $userInfo;
                            header('Location:../index.php');
                        }
                    }
                    else{
                        echo "<div class='alert alert-danger'>" . "البيانات غير متطابقة الرجاء المحاولة مرة أخرى" . "</div>";
                    }

                }
            }
        }
    ?>

    
    <div class="container" style="width: 60%; ">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card mt-5">
                <div class="card-title">
                    <h2 class="text-center py-2">تسجيل الدخول</h2>
                    <hr>
                    <?php
                    if (isset($error)) {
                        echo $error;
                    } elseif (isset($success)) {
                        echo $success;
                    }

                    ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <label for="title">إسم المستخدم أو البريد الإلكتروني </label>
                        <input type="text" id="title" class="form-control mb-2"  name="adminInfo">
                        <div class="form-group">
                            <label for="pass">كلمة السر</label>
                            <input type="password" class="form-control"  id="pass" name="password"/>
                          </div>

                        <button class="custom-btn" name="log">تسجيل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  <?php
    include 'include/footer.php';
  ?>


<?php
    }
?>