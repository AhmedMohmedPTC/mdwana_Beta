<?php
session_start();
require_once('dashboard/include/connection.php');
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدونة الشسمو</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="layout/images/icon.png">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="layout/css/bootstrap.min.css">
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="layout/css/bootstrap-rtl.css">
    <!--  Custom css  -->
    <link rel="stylesheet" href="layout/css/custom.css?v=<?php echo time(); ?>">
    <!-- Font -->
    <link rel="stylesheet" href="layout/font/droid-kufi.css">

    <link rel="stylesheet" href="layout/css/lightbox.min.css">

    <script type="text/javascript" src="layout/js/lightbox-plus-jquery.min.js"></script>

</head>

<body>

    <!--    Start navbar    -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">
            <a href="index.php" class="navbar-brand">المدونة الالكترونية</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="about.php" class="nav-link">من نحن</a>
                    </li>
                    <li class="nav-item">
                        <a href="callUs.php" class="nav-link">اتصل بنا</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['adminInfo']) && !isset($_SESSION['userInfo'])){
                            ?>
                            <a href="dashboard/index.php" class="nav-link" style="color: var(--main-color)">تسجيل الدخول</a>

                            <?php
                        }
                        ?>

                    </li>
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['userInfo']) && !isset($_SESSION['adminInfo'])) {
                            ?>
                            <a href="dashboard/signin.php" class="nav-link">مستخدم جديد</a>


                            <?php
                        }
                        ?>
                    </li>

                    <?php
                    if (isset($_SESSION['adminInfo'])) {
                    ?>
                        <a href="dashboard/dashboard.php" target="_blank" class="dashboard-btn">لوحة التحكم</a>
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
                                         <!--  <a class="dropdown-item" href="../../dashboard/edit-user.php?id=<?php

                                           $query = "SELECT * FROM users ORDER BY id";
                                           $result = mysqli_query($con, $query);
                                           $row = mysqli_fetch_assoc($result);
                                           if (isset($_GET['id'])) {
                                               $id = $_GET['id'];
                                           }
                                               echo $row['id'];?>">تعديل البيانات الشخصية</a> -->

                                        <a class="dropdown-item" href="dashboard/logout.php">تسجيل الخروج</a>
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