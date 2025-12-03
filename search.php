<?php
if(isset($_POST['search'])){
    $searchQuery = $_POST['query'];
    $searchQuery = preg_replace("#[^0-9a-z]#i", "", $searchQuery); // Security sanitization implies
    $query = "SELECT * FROM products WHERE productName LIKE '%$searchQuery%'";
    $getUsers = mysqli_query($DBcon, $query);
    
    while($row = mysqli_fetch_array($getUsers)){
        $pro_id = $row['productID'];
        $pro_title = $row['productName'];
        $pro_price = $row['productPrice'];
        $pro_image = $row['productImage'];
        // Display Logic Here (similar to product list)
    }
}
?>