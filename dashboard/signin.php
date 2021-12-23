<?php
session_start();
include 'include/connection.php';
// check if session isset



    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>تسجيل الدخول</title>
        <!-- Bootstrap and Bootstrap Rtl -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-rtl.css">
        <!-- Custom css -->
        <link rel="stylesheet" href="css/dashboard.css">
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
<!--    Start navbar    -->
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
        <!-- Log to dashboard  -->


  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $userName = $_POST['userName'];
      $userNum  = $_POST['userNum'];
      $userEmail = $_POST['userEmail'];
      $userPass = $_POST['userPass'];

      if (empty($userName) || empty($userNum) || empty($userEmail)  || empty($userPass)) {
          $error = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
      }
      else {


          $query = "INSERT INTO users(userName,userNum,userEmail,userPass)
            VALUES('$userName','$userNum','$userEmail','$userPass')";
          $res = mysqli_query($con, $query);
          if (isset($res)) {
              $success = "<div class='alert alert-success'>" . "تم التسجيل بنجاح" . "</div>";
          }
      }
  }
  ?>

  <div class="container-fluid">
      <!-- Start new post -->
      <div class="new-book">
          <?php
          if (isset($error)) {
              echo $error;
          } elseif (isset($success)) {
              echo $success;
          }

          ?>
    

  <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card mt-5">
                    <div class="card-title">
                        <h2 class="text-center py-2"> تسجيل مستخدم جديد </h2>
                        <hr>
                    </div>
        <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
                  <label for="title">الاسم</label>
                  <input type="text" id="title" class="form-control" name="userName" >
              </div>
              <div class="form-group">
              <label for="title">الهاتف</label>
              <input type="text" id="title" class="form-control" name="userNum" >
              </div>
              <div class="form-group">
                  <label for="title">الايميل</label>
                  <input type="email" id="title" class="form-control" name="userEmail">
              </div>
              <div class="form-group">
                  <label for="title">كلمة السر</label>
                  <input type="password" id="title" class="form-control" name="userPass" >
              </div>
              <button class="custom-btn" name="log">تسجيل  </button>
            </form>
        </div>
                </div>
            </div>
        </div>
    </div>
  <!-- /#page-content-wrapper -->
   
    <!-- /#wrapper -->
  <?php
  include 'include/footer.php';
  ?>
