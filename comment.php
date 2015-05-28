<?php
require "includes/head.php";
require "includes/dbConnect.php";

$comm_id = $_GET['comm_id'];
$edited = $_GET['edited'];

                                            // Get the name of the product the comment is for
$product = $_GET['product'];
$sql = "SELECT * FROM products WHERE prod_id=$product";
$result = $db->query($sql);
list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row();
$product_id = $prod_id;
$product_name = $prod_name;


$sql = "SELECT * FROM comments WHERE comm_id=$comm_id";
$result = $db->query($sql);

if ($db->connect_error) {
    $data_error = $db->connect_error;
}

if (isset($edited)){
    echo "<div class=\"success\">Comment was successfully Updated</div>";
}

list($comm_id, $comm_author, $comment, $date_posted, $rating, $prod_id) = $result->fetch_row();
$date = date_create($date_posted);
?>

<div class="show">
    <h3>Product: <?php echo $product_name ?></h3>
    <h3>Author: <?php echo $comm_author ?></h3>
    <h3>Date Posted: <?php echo date_format($date, 'm/d/Y') ?></h3>
    <h4>Rating:
        <?php
            while ($rating != 0){
                echo "<img src='images/star.png' alt='Star' />";
                $rating--;
            }
        ?>
    </h4>
    <p>
        <?php echo $comment ?>
    </p>
    <a href="prodDetail.php?prod_id=<?php echo $product_id ?>">View Product Detail Page</a><br />

    <?php
    if ($_SESSION['user_name']){
        echo "<a href='admin.php'>Back to Admin</a>";
    }
    ?>
</div>

<?php require 'includes/footer.php' ?>