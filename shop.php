<?php
session_start();
require_once 'dbconnect.php';

if(isset($_POST["add"])){
    if(isset($_SESSION["cart"])){
        $item_array_id = array_column($_SESSION["cart"], "product_id");
        if(!in_array($_GET["id"], $item_array_id)){
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["cart"][$count] = $item_array;
            echo '<script>alert("با موفقیت به سبد خرید اضافه شد")</script>';
            echo '<script>window.location="product.php"</script>';
        } else {
            echo '<script>alert("محصول قبلا به سبد خرید اضافه شده است")</script>';
            echo '<script>window.location="product.php"</script>';
        }
    } else {
        $item_array = array(
            'product_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'product_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );
        $_SESSION["cart"][0] = $item_array;
        echo '<script>alert("با موفقیت به سبد خرید اضافه شد")</script>';
        echo '<script>window.location="product.php"</script>';
    }
}

// حذف محصول از سبد خرید
if(isset($_GET["action"])) {
    if($_GET["action"] == "delete") {
        foreach($_SESSION["cart"] as $keys => $values) {
            if($values["product_id"] == $_GET["id"]) {
                unset($_SESSION['cart'][$keys]);
                echo '<script>alert("محصول از سبد خرید حذف شد")</script>';
                echo '<script>window.location="yourcart.php"</script>';
            }
        }
    }
}
?>