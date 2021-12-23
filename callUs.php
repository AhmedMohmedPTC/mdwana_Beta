<?php

include 'dashboard/include/connection.php';
include 'layout/include/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Subject = $_POST['Subject'];
$Message = $_POST['Message'];
if (empty($Name) || empty($Email)  || empty($Subject) || empty($Message)) {
    $error = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
}
else {


    $query = "INSERT INTO message(Name,Email,Subject,Message)
            VALUES('$Name','$Email','$Subject','$Message')";


    $res = mysqli_query($con, $query);
    if (isset($res)) {
        $success = "<div class='alert alert-success'>" . "تم إرسال الرسالة بنجاح" . "</div>";
    }
}
}
?>

<div class="container" style="width: 100%; margin-top: 5px; margin-left: 10%; ">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card mt-5">
                <div class="card-title">
                    <h2 class="text-center py-2"> تواصل معنا </h2>
                    <hr>
                    <?php
                    if (isset($error)) {
                        echo $error;
                    } elseif (isset($success)) {
                        echo $success;
                    }

                    ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                        <label for="title">الاسم </label>
                        <input type="text" id="title" class="form-control mb-2"  name="Name" value="<?php if (isset($Name)) {
                            echo $Name;
                        } ?>">
                        <label for="title">البريد الالكتروني</label>
                        <input type="text" id="title" class="form-control mb-2"  name="Email" value="<?php if (isset($Email)) {
                            echo $Email;
                        } ?>">
                        <label for="title">الموضوع</label>
                        <input type="text" id="title" class="form-control mb-2"  name="Subject" value="<?php if (isset($Subject)) {
                            echo $Subject;
                        } ?>">
                        <label for="title">الرسالة</label>
                        <textarea id="title" class="form-control mb-2"  name="Message" ></textarea>

                        <button class="custom-btn" name="log">ارسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php
include 'layout/include/footer.php';
?>
