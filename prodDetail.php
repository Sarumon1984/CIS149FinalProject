<?php
ob_start();
$title = 'Product Details';
require 'includes/head.php';
require 'includes/functions.php';
require 'includes/dbConnect.php';

$confirm = $_GET['confirm'];
$submit = $_POST['submit'];
$author = addslashes($_POST['author']);
$comm = addslashes($_POST['comm']);
$prod_rating = $_POST['prod_rating'];
$errors = '';
if ($confirm == 'edited'){
    echo "<div class=\"success\"><h3>Product was successfully edited!</h3></div>";
} else if ($confirm == 'added'){
    echo "<div class=\"success\"><h3>Comment was successfully added!</h3></div>";
}



$prod_id = $_GET['prod_id'];
$sql = "SELECT * FROM products WHERE prod_id=$prod_id";
$result = $db->query($sql);


if (!isset($author) || $author === ''){
    $errors .= '-Author must not be blank.<br />';
}

if (!isset($comm) || $comm === ''){
    $errors .= "-You must enter a comment.<br />";
}
list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row();
$product = $prod_id;

if ($submit){
    if ($errors == ''){
        $sql = "INSERT INTO comments (comm_id, comm_author, comment, date_posted, rating, prod_id) VALUES (NULL, '$author', '$comm', CURRENT_TIMESTAMP, '$prod_rating', '$product');";
        $result = $db->query($sql);
        $author = '';
        $comm = '';
        $prod_rating = 1;
        $submit = null;
        ob_clean();
        header("Location: prodDetail.php?prod_id=$product&confirm=added");
    } else {
        echo "<div id='admin' class='error'>$errors</div><br />";
    }
}

?>
    <div id="prod_detail">
        <figure>
            <img src="<?php echo $prod_detail ?>" alt="<?php echo $prod_name ?>" />
        </figure>

        <h3><?php echo $prod_name ?></h3>
        <p>
            <?php echo $prod_description ?>
        </p>
    </div>

    <div id="comments">
        <?php                                           // Print out each comment
        $comment_count = false;
        $sql = "SELECT * FROM comments WHERE prod_id=$prod_id ORDER BY date_posted";
        $result = $db->query($sql);
        while (list($comm_id, $comm_author, $comment, $date_posted, $rating, $prod_id)=$result->fetch_row()){
            echo "<p>";
            echo 'Posted ' . time_ago($date_posted) . "<br />";
            echo "$comm_author says - $comment<br />";
            echo "Rating: ";
            while ($rating != 0){
                echo "<img src='images/star.png' alt='Star' />";
                $rating--;
            }
            echo "</p>";
            $comment_count = true;
        };

                                                        // If no comments are present
        if (!$comment_count){
//            echo "<p>";
            echo "<h3>Be the first to write a comment</h3>";
//            echo "</p>";
        }
        echo "<br /><br /><a href=\"store.php\">Back to Shopping</a>";
        ?>
    </div>

    <form id="rating" action="prodDetail.php?prod_id=<?php echo $product ?>" method="POST">
        <fieldset><legend>Add your comments!</legend>
                <label for="author">Author</label><br />
            <input type="text" name="author" id="author" value="<?php echo $author ?>" maxlength="30" /><br />
                <label for="prod_rating">Rating</label><br />
            <select name="prod_rating" id="prod_rating" size="1">
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
            <label for="comm">Comments: </label><br />
            <textarea name="comm" id="comm" cols="25" rows="3"><?php echo $comm ?></textarea><br />
            <input type="submit" name="submit" id="submit" value="Add Comment" />
        </fieldset>
    </form>

<?php require 'includes/footer.php' ?>