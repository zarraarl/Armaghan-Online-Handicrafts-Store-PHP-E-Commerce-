<?php
require('header.php');
require_once 'dbconnect.php';

$query = "SELECT * FROM Products ORDER BY productID ASC";
$result = $DBcon->query($query);
?>

<section class="product_list section_padding">
    <div class="container">
        <div class="row">
            <center>
            <div class="col-md-12">
                <div class="row">
                <?php
                if($result->num_rows > 0){
                    while($row = $result->fetch_array()) { ?>
                    <div class="col-md-4">
                        <div class="single_product_item">
                            <form method="post" action="shop.php?action=add&id=<?php echo $row["productID"]; ?>">
                                <img src="<?php echo $row["productImage"]; ?>" alt="محصول" class="img-fluid" style="width:25%;">
                                <h3><a href='product.php?productID=<?php echo $row["productID"]; ?>'><?php echo $row["productName"]; ?></a></h3>
                                <p><?php echo $row["productPrice"]; ?> تومان</p>
                                <input type="number" name="quantity" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["productName"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["productPrice"]; ?>">
                                <br><br>
                                <input type="submit" class="btn_1" name="add" value="افزودن به سبد خرید">
                            </form>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
            </center>
        </div>
    </div>
</section>
<?php require('footer.php'); ?>