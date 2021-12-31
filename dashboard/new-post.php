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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postTitle = $_POST['postTitle'];

        $postCat = $_POST['postCat'];
        $postContent = $_POST['postContent'];
        // post Cover
        $imageName = $_FILES['postCover']['name'];
        $imageTmp = $_FILES['postCover']['tmp_name'];

        if (empty($postTitle) || empty($postCat)  || empty($postContent)) {
            $error = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
        } elseif (empty($imageName)) {
            $error = "<div class='alert alert-danger'>" . "الرجاء إختيار صورة مناسبة" . "</div>";
        }  else {
            // post cover
            $postCover = rand(0, 1000) . "_" . $imageName;
            move_uploaded_file($imageTmp, "../uploads/Covers/" . $postCover);
            // post cover

            $query = "INSERT INTO posts(postTitle,postCat,postCover,postContent)
            VALUES('$postTitle','$postCat','$postCover','$postContent')";
            $res = mysqli_query($con, $query);
            if (isset($res)) {
                $success = "<div class='alert alert-success'>" . "تم النشر بنجاح" . "</div>";
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
              <?php
                    include '../models/modelPos.php';
                    $model = new Model();
                    $insert = $model->insert();

                    ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">عنوان المنشور</label>
                    <input type="text" id="title" class="form-control" name="postTitle" value="<?php if (isset($postTitle)) {
                        echo $postTitle;
                    } ?>">
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
                    <input type="file" class="form-control" name="postCover">
                </div>
                <div class="form-group">
                    <label for="img">نص المنشور</label>
                    <textarea name="postContent" id="" cols="30" rows="10" class="form-control"><?php if (isset($postContent)) {
                        echo $postContent;
                        } ?></textarea>
                </div>

                <button type="submit" name="submit" class="custom-btn">نشر</button>
            </form>
        </div>
        <!-- End new pots -->
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