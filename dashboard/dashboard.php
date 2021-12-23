<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
  header('Location:index.php');
} else {


?>

  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->

  <div class="container-fluid">
    <div class="content">
      <div class="statistics text-center">
        <div class="row">
          <div class="col-sm-6">
            <div class="statistic">
                <h5>عدد المنشورات</h5>
              <?php
              $query = "SELECT id FROM posts";
              $result = mysqli_query($con, $query);
              $postNum = mysqli_num_rows($result);
              ?>
              <h3><?php echo $postNum; ?></h3>

            </div>
          </div>
          <div class="col-sm-6">
            <div class="statistic">
                <h5>عدد التصنيفات</h5>
              <?php
              $query = "SELECT id FROM categories";
              $result = mysqli_query($con, $query);
              $catNum = mysqli_num_rows($result);
              ?>
              <h3><?php echo $catNum; ?></h3>

            </div>
          </div>
            <div class="col-sm-6">
                <div class="statistic">
                    <h5>عدد الرسائل</h5>
                    <?php
                    $query = "SELECT id FROM message";
                    $result = mysqli_query($con, $query);
                    $msgNum = mysqli_num_rows($result);
                    ?>
                    <h3><?php echo $msgNum; ?></h3>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="statistic">
                    <h5>عدد المستخدمين</h5>
                    <?php
                    $query = "SELECT id FROM users";
                    $result = mysqli_query($con, $query);
                    $orNum = mysqli_num_rows($result);
                    ?>
                    <h3><?php echo $orNum; ?></h3>

                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <?php
  include 'include/footer.php';
  ?>


<?php
}
?>