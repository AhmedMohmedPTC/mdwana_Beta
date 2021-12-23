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
    
  <!-- Start Delete Book -->
  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM posts WHERE id = '$id'";
    $delete = mysqli_query($con, $query);
  }
  ?>
  <!-- End Delete book -->

    <div class="container-fluid">
        <div class="show-books">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">الرقم</th>
                        <th scope="col">عنوان المنشور</th>
                        <th scope="col">صورة المنشور</th>
                        <th scope="col">التصنيف</th>
                        <th scope="col">تاريخ النشر</th>
                        <th scope="col">الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fetch categories from database -->
                    <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $limit = 8;
                    $start = ($page - 1) * $limit;
                    $query = "SELECT * FROM posts ORDER BY id DESC LIMIT $start, $limit";
                    $res = mysqli_query($con, $query);
                    $sNu = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $sNu++;
                    ?>

                        <tr>
                            <td><?php echo $sNu; ?></td>
                            <td><?php echo $row['postTitle']; ?></td>
                            <td ><img src="../uploads/Covers/<?php echo $row['postCover']; ?>" width="70px" height="60px"></td>
                            <td><?php echo $row['postCat']; ?></td>
                            <td><?php echo $row['postDate']; ?></td>
                            <td>
                                <!--   <a href="edit-post.php?id=<?php echo $row['id']; ?>" class="custom-btn">تعديل</a> -->
                                <a href="posts.php?id=<?php echo $row['id']; ?>" class="custom-btn confirm">حذف المنشور</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <!-- Start pagination -->
            <?php
            $query = "SELECT * FROM posts";
            $result = mysqli_query($con, $query);
            $total_cat = mysqli_num_rows($result);
            $total_pages = ceil($total_cat / $limit);
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="posts.php?page=<?php if (($page - 1) > 0) {
                            echo  $page - 1;
                        } else {
                            echo 1;
                        }

                        ?>">السابق</a></li>
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        ?>
                        <li class="page-item"><a class="page-link" href="posts.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                    ?>
                    <li class="page-item"><a class="page-link" href="posts.php?page=<?php
                        if (($page + 1) < $total_pages) {
                            echo $page + 1;
                        } elseif (($page + 1) >= $total_pages) {
                            echo $total_pages;
                        }
                        ?>">التالي</a></li>
                </ul>
            </nav>
            <!-- End pagination -->

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