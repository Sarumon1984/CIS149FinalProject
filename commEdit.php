<?php
ob_start();
require 'includes/head.php';
require 'includes/dbConnect.php';

                                        // Get the name of the product the comment is for
$product = $_GET['product'];
$sql = "SELECT * FROM products WHERE prod_id=$product";
$result = $db->query($sql);
list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row();
$product_id = $prod_id;
$product_name = $prod_name;

$comm_id = $_GET['comm_id'];
$submit = $_POST['submit'];
$errors = '';

if ($submit){
    $product = $_GET['product'];
    $comment = addslashes($_POST['comment']);
    $comm_author = addslashes($_POST['comm_author']);
    $rating = addslashes($_POST['prodRating']);
    if (!isset($comment) || $comment === ''){
        $errors .= '-Comment must be filled out.<br />';
    }

    if (!isset($comm_author) || $comm_author === ''){
        $errors .= '-You must enter an authors name<br />';
    }
    if ($errors == ''){
        $sql = "UPDATE comments SET comm_author='$comm_author', comment='$comment', rating='$rating' WHERE comm_id=$comm_id;";
        $result = $db->query($sql);
        ob_clean();
        header("Location: comment.php?comm_id=$comm_id&product=$product&edited=edited");
    } else {
        echo "<div id='admin' class='error'>$errors</div>";
    }
}

$sql = "SELECT * FROM comments WHERE comm_id=$comm_id";
$result = $db->query($sql);
list($comm_id,$comm_author,$comment,$date_posted,$rating,$prod_id)=$result->fetch_row();

?>

<div id="comments">
    <h2><?php echo $product_name ?></h2>
    <form action=commEdit.php?comm_id=<?php echo $comm_id . '&product=' . $product ?> method="POST">
            <label for="comm_author">Author</label><br />
        <input type="text" name="comm_author" id="comm_author" value="<?php echo $comm_author ?>"><br />
            <label for="comment">Comment</label><br />
        <textarea name="comment" id="comment" cols="40" rows="10"><?php echo $comment ?></textarea><br />
            <label for="prodRating">Rating</label><br />
        <select name="prodRating" id="prodRating" size="1">
        <?php
        $star = 1;
        while ($star < 6) {
            if ($rating == $star) {
                echo "<option value='$star' selected>$star star</option>";
            } else {
                echo "<option value='$star'>$star star</option>";
            }
            $star++;
        }
        ?>
        </select><br />
        <input type="submit" name="submit" id="submit" value="Update" />
    </form>
</div>



<?php
ob_end_flush();
require 'includes/footer.php';
?>
