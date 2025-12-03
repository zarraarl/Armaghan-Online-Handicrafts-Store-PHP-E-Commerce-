<?php require('header.php'); session_start(); ?>
<section class="cart_area section_padding">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th class="cart">نام محصول</th>
                        <th class="cart">تعداد</th>
                        <th class="cart">قیمت</th>
                        <th class="cart">قیمت کل</th>
                        <th class="cart">حذف</th>
                    </tr>
                    <?php
                    $total = 0;
                    if(!empty($_SESSION["cart"])){
                        foreach($_SESSION["cart"] as $keys => $values){
                    ?>
                    <tr class="cart">
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td><?php echo $values["product_price"]; ?> تومان</td>
                        <td><?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?> تومان</td>
                        <td><a href="shop.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span>X</span></a></td>
                    </tr>
                    <?php
                        $total = $total + ($values["item_quantity"] * $values["product_price"]);
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <center>
            <div>
                 <p><u>جمع کل:</u> <?php echo number_format($total); ?> تومان</p>
                 <br>
                 <a class="btn_1" href="product.php">ادامه خرید</a>
                 <a class="btn_1" href="checkout.php">پرداخت</a>
            </div>
        </center>
    </div>
</section>
<?php require('footer.php'); ?>