<?php
ob_start();
require 'includes/head.php';
require 'includes/dbConnect.php';

$comm_author = addslashes($_POST['comm_author']);
$comment = addslashes($_POST['comment']);
$prod_rating = $_POST['prodRating'];
$submit = $_POST['submit'];
$product = $_POST['product'];
$errors = '';


if (!isset($comm_author) || $comm_author === ''){
    $errors .= '-Author must not be blank.<br />';
}

if (!isset($comment) || $comment === ''){
    $errors .= "-You must enter a comment.<br />";
}

if($submit){
    if ($errors == ''){
        $sql = "SELECT * FROM products WHERE prod_name = '$product'";
        $result = $db->query($sql);
        list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row();
        $sql = "INSERT INTO comments (comm_id, comm_author, comment, date_posted, rating, prod_id) VALUES (NULL, '$comm_author', '$comment', CURRENT_TIMESTAMP, '$prod_rating', '$prod_id');";
        $result = $db->query($sql);
        ob_clean();
        header("Location: admin.php?confirm=commAdded");
    } else {
        echo "<div id='admin' class='error'>$errors</div><br />";
    }
}
?>

<div class="show">
    <form action="commAdd.php" method="POST">
            <label for="comm_author">Author</label><br />
        <input type="text" name="comm_author" id="comm_author" value="<?php echo $comm_author ?>" /><br />
            <label for="comment">Comment</label><br />
        <textarea name="comment" id="comment" cols="40" rows="10"><?php echo $comment ?></textarea><br />
            <label for="prodRating">Rating</label><br />
        <select name="prodRating" id="prodRating" size="1">
            <?php
            $star = 1;
             while ($star < 6){
                if ($prod_rating == $star){
                    echo "<option value='$star' selected>$star star</option>";
                } else {
                    echo "<option value='$star'>$star star</option>";
                }
                 $star++;
            }
            ?>
        </select><br />
            <label for="product">Product</label><br />
        <select name="product" id="product" size="1">
            <?php
            $sql = "SELECT * FROM products";
            $result = $db->query($sql);
            while (list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row()){
                if ($product == $prod_name){
                    echo "<option selected> $prod_name </option>";
                } else {
                    echo "<option> $prod_name </option>";
                }
            }
            ?>
        </select><br />
        <input type="submit" name="submit" id="submit" value="Add Comment" />
    </form>
</div>

<?php require 'includes/footer.php' ?>