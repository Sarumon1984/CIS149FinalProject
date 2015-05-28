<?php
    $title = 'Store';
    require 'includes/head.php';
    require 'includes/dbConnect.php';

$sql = "SELECT * FROM products";
$result = $db->query($sql);
while (list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row()) {
    echo "<figure>";
    echo "<a href=\"prodDetail.php?prod_id=$prod_id\"><img src='$prod_img' alt='$prod_name' /></a>";
    echo "<figcaption>" . $prod_name . "</figcaption>";
    echo "</figure>";
}

require 'includes/footer.php'
?>