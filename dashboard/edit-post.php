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


    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM posts WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    }
    ?>



    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postTitle = $_POST['postTitle'];
        $postContent = $_POST['postContent'];
        $postCat = $_POST['postCat'];
        $imageName = $_FILES['postCover']['name'];
        $imageTmp = $_FILES['postCover']['tmp_name'];

        // post Cover



        if (empty($postTitle) || empty($postCat)  || empty($postContent)) {
            $error = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
        } elseif (empty($imageName)) {
            $error = "<div class='alert alert-danger'>" . "الرجاء إختيار صورة مناسبة" . "</div>";
        }  else {
            // Book cover
            $postCover = rand(0, 1000) . "_" . $imageName;
            move_uploaded_file($imageTmp, "../uploads/Covers/" . $postCover);

            $id ='';
            $query          = "UPDATE posts SET 
            postTitle      = '$postTitle',
            postContent = '$postContent'
            postCat        = '$postCat',
            postCover    = $postCover',
            WHERE id      ='$id";

            $res = mysqli_query($con, $query);
            header("Location: posts.php");
            exit();
            if (isset($res)) {
                $success = "<div class='alert alert-success'>" . "تم النشر بنجاح" . "</div>";
            }
        }
    }
    ?>

    <div class="container-fluid">
        <!-- Start new book -->
        <div class="new-book">
            <?php
            if (isset($error)) {
                echo $error;
            } elseif (isset($success)) {
                echo $success;
            }

            ?>
            <form action="edit-post.php?id=<?php echo $row['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="title">عنوان المنشور</label>
                    <input type="text" id="title" class="form-control" name="postTitle" value="<?php  echo $row['postTitle']; ?>">
                </div>

                <div class="form-group">
                    <label for="title">التصنيف</label>
                    <select class="form-control" name="postCat">
                        <option></option>
                        <?php
                        $query = "SELECT categoryName FROM categories";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option><?php echo $row['categoryName']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="img">غلاف المنشور</label>
                    <input type="file" class="form-control" name="postCover" value="<?php echo $row['postCover'];?>">
                </div>

                <div class="form-group">
                    <label for="img">نص المنشور</label>
                    <textarea name="postContent" id="content" cols="30" rows="10" class="form-control"><?php echo $row['postContent']; ?></textarea>
                </div>

                <button class="custom-btn">نشر</button>
            </form>
        </div>
        <!-- End new book -->
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