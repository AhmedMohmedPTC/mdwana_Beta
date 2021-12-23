<?php

session_start();
include 'include/connection.php';
?>
    <!DOCTYPE html>
    <html lang="ar">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>مدونة الشسمو</title>
        <!-- favicon -->
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

    <!--    Start navbar    -->
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">
            <a href="../index.php" class="navbar-brand">مدونة الشسمو</a>
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

    <?php


if (!isset($_SESSION['userInfo'])) {
    header('Location:../index.php');
} else {


    ?>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <!-- Fetch categoryName form database -->
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    }
    ?>

    <!-- Edit category -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userName = $_POST['userName'];
        $userNum = $_POST['userNum'];
        $userEmail = $_POST['userEmail'];
        $userPass = $_POST['userPass'];
        $query = "UPDATE users SET userName='$userName',userNum='$userNum',userEmail='$userEmail',userPass='$userPass' WHERE id = '$id'";
        $edit = mysqli_query($con, $query);
        header("Location: ../index.php");
        exit();
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5">
                    <div class="card-title">
                        <h2 class="text-center py-2"> تعديل البيانات </h2>
                        <hr>
                    </div>
        <div class="card-body">
            <form action="edit-user.php?id=<?php echo $row['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="user">اسم المستخدم</label>
                    <input type="text" class="form-control mb-2" id="id" value="<?php echo $row['userName']; ?>" name="userName">
                </div>
                <div class="form-group">
                    <label for="user">رقم الهاتف</label>
                    <input type="text" class="form-control mb-2" id="id" value="<?php echo $row['userNum']; ?>" name="userNum">
                </div>
                <div class="form-group">
                    <label for="user">البريد الالكتروني</label>
                    <input type="text" class="form-control mb-2" id="id" value="<?php echo $row['userEmail']; ?>" name="userEmail">
                </div>
                <div class="form-group">
                    <label for="user">كلمة المرور</label>
                    <input type="text" class="form-control mb-2" id="id" value="<?php echo $row['userPass']; ?>" name="userPass">
                </div>
                <button class="custom-btn">تعديل</button>
            </form>
        </div>
                </div>
            </div>
        </div>
    </div>


    <!-- /#page-content-wrapper -->

    </div>
</body>
    <!-- /#wrapper -->
    <?php
    include 'include/footer.php';
    ?>


    <?php
}
?>