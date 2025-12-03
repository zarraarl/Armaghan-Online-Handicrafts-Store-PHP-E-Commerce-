<?php
session_start();
if (isset($_SESSION['userSession']) != "") {
    header("Location: success.php");
}
require_once 'dbconnect.php';

if(isset($_POST['btn-signup'])) {
    $userName = strip_tags($_POST['username']);
    $userPass = strip_tags($_POST['password']);
    $customerName = strip_tags($_POST['customerName']);
    $customerAddress = strip_tags($_POST['customerAddress']);
    $customerPhone = strip_tags($_POST['customerPhone']);
    $customerEmail = strip_tags($_POST['customerEmail']);

    $userName = $DBcon->real_escape_string($userName);
    $userPass = $DBcon->real_escape_string($userPass);
    $customerName = $DBcon->real_escape_string($customerName);
    $customerAddress = $DBcon->real_escape_string($customerAddress);
    $customerPhone = $DBcon->real_escape_string($customerPhone);
    $customerEmail = $DBcon->real_escape_string($customerEmail);

    $hashed_password = password_hash($userPass, PASSWORD_DEFAULT);

    // بررسی تکراری نبودن ایمیل یا نام کاربری
    $check_username = $DBcon->query("SELECT customerEmail FROM Customers WHERE userName='$userName'");
    $check_email = $DBcon->query("SELECT customerEmail FROM Customers WHERE customerEmail='$customerEmail'");
    $count = $check_email->num_rows + $check_username->num_rows;

    if ($count == 0) {
        $query = "INSERT INTO Customers(userName, userPassword, customerName, customerAddress, customerPhone, customerEmail) VALUES('$userName', '$hashed_password','$customerName', '$customerAddress', '$customerPhone', '$customerEmail')";
        
        if ($DBcon->query($query)) {
            $msg = "<div><h3 style='color: green'>&nbsp ثبت نام با موفقیت انجام شد</h3></div>";
        } else {
            $msg = "<div><h3 style='color: red'>&nbsp در ثبت نام مشکلی وجود دارد</h3></div>";
        }
    } else {
        $msg = "<div><h3 style='color: red'>&nbsp; نام کاربری یا ایمیل قبلا استفاده شده است</h3></div>";
    }
    $DBcon->close();
}
?>

<?php require('header.php'); ?>
<div class="container checkout_area section_padding">
    <center>
        <div class="col-lg-7">
            <form method="post" class="row contact_form" id="register-form">
                <?php if (isset($msg)) echo $msg; ?>
                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" placeholder="نام کاربری" name="username" required />
                </div>
                <div class="col-md-12 form-group p_star">
                    <input type="password" class="form-control" placeholder="رمز عبور" name="password" required />
                </div>
                <div class="col-md-12 form-group">
                    <input type="email" class="form-control" placeholder="ایمیل" name="customerEmail" required />
                </div>
                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" placeholder="نام و نام خانوادگی" name="customerName" required />
                </div>
                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" placeholder="آدرس" name="customerAddress" required />
                </div>
                <div class="col-md-12 form-group p_star">
                    <input type="text" class="form-control" placeholder="شماره تماس" name="customerPhone" required />
                </div>
                <div>
                    <button type="submit" class="btn_1" name="btn-signup">ایجاد حساب کاربری</button>
                    <br><br>
                    <a id="login" href="index.php" class="btn btn-default">آیا حساب کاربری دارید؟ <b>ورود</b></a>
                </div>
            </form>
        </div>
    </center>
</div>
<?php require('footer.php') ?>