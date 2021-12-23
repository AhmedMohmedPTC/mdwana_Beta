<?php
include 'layout/include/header.php';
?>
<!-- Start banar  -->
<div class="banar">
    <div class="overlay"></div>
    <div class="lib-info text-center">
        <h4>المدونة الالكترونية</h4>
        <p>مكانك لمعرفة كل جديد عن عالم التقنية</p>
    </div>
</div>
<!-- End banar -->

<!-- Start post -->
<div class="books">
    <div class="container">
        <div class="row">
            <?php
            $query = "SELECT * FROM posts ORDER BY id DESC";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) { 
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="img-cover">
                                <a href="post.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['postCat']; ?>">
                                    <img src="uploads\Covers/<?php echo $row['postCover']; ?>" alt="post Cover" class="card-img-top">
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="post.php?id=<?php echo $row['id']; ?>&&category=<?php echo $row['postCat']; ?>"><?php echo $row['postTitle']; ?></a>
                                </h4>
                                <p class="card-text"><?php echo mb_substr($row['postContent'], 0, 150, "UTF-8"); ?></p>

                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="text-center">لايوجد أي post</div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- End post -->

<!-- Start Footer -->
<?php
include 'layout/include/footer.php';
?>
