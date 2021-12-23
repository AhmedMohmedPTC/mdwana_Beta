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
        $query = "DELETE FROM message WHERE id = '$id'";
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
                        <th scope="col">الاسم </th>
                        <th scope="col">البريد الإلكتروني</th>
                        <th scope="col">الموضوع</th>
                        <th scope="col">الرسالة</th>

                        <th scope="col">تاريخ الإرسال</th>
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
                    $limit = 5;
                    $start = ($page - 1) * $limit;


                    $query = "SELECT * FROM message ORDER BY id DESC LIMIT $start, $limit";
                    $res = mysqli_query($con, $query);
                    $sNo = 0;

                    while ($row = mysqli_fetch_assoc($res)) {
                        $sNo++;
                        ?>

                        <tr>
                            <td><?php echo $sNo; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['Subject']; ?></td>
                            <td><?php echo $row['Message']; ?></td>
                            <td><?php echo $row['msgDate']; ?></td>
                            <td>

                                <a href="msgs.php?id=<?php echo $row['id']; ?>" class="custom-btn confirm">حذف </a>
                            </td>
                        </tr>
                        <?php
                    }



                    ?>
                    </tbody>
                </table>
                <!-- Start pagination -->
                <?php
                $query = "SELECT * FROM message";
                $result = mysqli_query($con, $query);
                $total_cat = mysqli_num_rows($result);
                $total_pages = ceil($total_cat / $limit);
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="order1.php?page=<?php if (($page - 1) > 0) {
                                echo  $page - 1;
                            } else {
                                echo 1;
                            }

                            ?>">السابق</a></li>
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            ?>
                            <li class="page-item"><a class="page-link" href="order1.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                        ?>
                        <li class="page-item"><a class="page-link" href="order1.php?page=<?php
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