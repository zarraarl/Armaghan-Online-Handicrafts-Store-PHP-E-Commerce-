<?php
if(isset($_POST['submit'])) {
    $to = "zahraamrollahi1376@gmail.com";
    $subject = $_POST['name'];
    $message = $_POST['message'];
    
    mail($to, $subject, $message);
    
    echo '<script>alert("پیام با موفقیت ارسال شد")</script>';
    echo '<script>window.location="contact.php"</script>';
}
?>