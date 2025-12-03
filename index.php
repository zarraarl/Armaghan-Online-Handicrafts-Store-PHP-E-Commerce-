<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession']) != "") {
    header("Location: success.php");
    exit;
}

if (isset($_POST['btn-login'])) {
    $userName = strip_tags($_POST['username']);
    $userPass = strip_tags($_POST['password']);
    
    $userName = $DBcon->real_escape_string($userName);
    $userPass = $DBcon->real_escape_string($userPass);

    $query = $DBcon->query("SELECT customerID, userName, userPassword FROM Customers WHERE userName='$userName'");
    $row = $query->fetch_array();
    $count = $query->num_rows;

    if (password_verify($userPass, $row['userPassword']) && $count == 1) {
        $_SESSION['userSession'] = $row['customerID'];
        header("Location: success.php");
    } else {
        $msg = "<div><h3 style='color: red'>&nbsp; نام کاربری یا رمز عبور اشتباه است</h3></div>";
    }
    $DBcon->close();
}
?>