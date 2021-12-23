<?php
include 'layout/include/header.php';

if (!isset($_SESSION['userInfo'])) {
    header('Location:dashboard/index.php');
    exit;
}
else{
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!--    End navbar    -->

<!-- Start show book -->
<div class="books">
    <div class="container">
        <div class="book">
            <div class="row">
                <?php
                $query = "SELECT * FROM posts WHERE id='$id'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="col-md-4">
                    <div class="book-cover">
                        <img src="uploads\Covers/<?php echo $row['postCover']; ?>" alt=" post cover">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="book-content">
                        <h4><?php echo $row['postTitle']; ?></h4>

                        <hr>
                        <p><?php echo $row['postContent']; ?></p>
                       <!-- <p><?php echo $row['postNum']; ?></p> -->
                        <p>تم النشر في <?php echo $row['postDate'];?></p>



                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End show book -->

<!-- Start Related Books -->
<div class="related-books">
    <div class="container">
        <h4>ذات صلة</h4>
        <hr>
        <div class="row">
            <?php
            if(isset($_GET['category'])){
                $postCat = $_GET['category'];
            }
            // fetch related books
            $query = "SELECT * FROM posts WHERE postCat = '$postCat' AND id !='$id'";
            $res = mysqli_query($con,$query);
            while($row = mysqli_fetch_assoc($res)){
                ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="related-book text-center">
                        <div class="cover">
                            <a href="post.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['postCat']; ?>">
                                <img src="uploads/Covers/<?php echo $row['postCover']; ?>" alt="post Cover">
                            </a>
                        </div>
                        <div class="title">
                            <h5>
                                <a href="post.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['postCat'];?>"><?php echo $row['postTitle']; ?></a>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- End Related Books -->

<!-- Start Footer -->
<?php
include 'layout/include/footer.php';
        }
?>
