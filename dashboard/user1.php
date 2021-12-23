<?php
session_start();
include 'include/connection.php';
include 'include/header.php';
if (!isset($_SESSION['adminInfo'])) {
    header('Location:index.php');
    exit;
} else {


    ?>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->

    <!-- Start Delete category -->
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM users WHERE id = '$id'";
        $delete = mysqli_query($con, $query);
    }
    ?>
    <!-- End Delete category -->



    <div class="container-fluid">
        <!-- Start categories section -->
        <div class="categories">
            <div class="show-cat">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">الرقم</th>
                        <th scope="col">اسم المستخدم</th>
                        <th scope="col">الهاتف</th>
                        <th scope="col">البريد الالكتروني</th>
                        <th scope="col">تاريخ الإنضمام</th>
                           <th scope="col">الاجراء</th>

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
                    $limit = 10;
                    $start = ($page - 1) * $limit;
                    $query = "SELECT * FROM users ORDER BY id DESC LIMIT $start, $limit";
                    $res = mysqli_query($con, $query);
                    $sNo = 0;

                    while ($row = mysqli_fetch_assoc($res)) {
                        $sNo++;
                        ?>

                        <tr>
                            <td><?php echo $sNo; ?></td>
                            <td><?php echo $row['userName']; ?></td>
                            <td><?php echo $row['userNum']; ?></td>
                            <td><?php echo $row['userEmail']; ?></td>
                            <td><?php echo $row['userDate']; ?></td>
                               <td>

                                <a href="user1.php?id=<?php echo $row['id']; ?>" class="custom-btn confirm">حذف المستخدم</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <!-- Start pagination -->
                <?php
                $query = "SELECT * FROM users";
                $result = mysqli_query($con, $query);
                $total_cat = mysqli_num_rows($result);
                $total_pages = ceil($total_cat / $limit);
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="user1.php?page=<?php if (($page - 1) > 0) {
                                echo  $page - 1;
                            } else {
                                echo 1;
                            }

                            ?>">السابق</a></li>
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            ?>
                            <li class="page-item"><a class="page-link" href="user1.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                        ?>
                        <li class="page-item"><a class="page-link" href="user1.php?page=<?php
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
        <!-- End categories section -->
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