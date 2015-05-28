<?php
$title = 'Admin';
require 'includes/head.php';
require 'includes/dbConnect.php';
$data_error = "";

$confirm = $_GET['confirm'];
                                                       // Check and display added/deleted confirmation messages
if ($confirm == 'storyDeleted') {
    echo "<div class=\"success\"><h3>Story was successfully deleted!</h3></div>";
} else if ($confirm == 'storyAdded') {
    echo "<div class=\"success\"><h3>Story was successfully added!</h3></div>";
} else if ($confirm == 'productDeleted') {
    echo "<div class=\"success\"><h3>Product was successfully deleted!</h3></div>";
} else if ($confirm == 'productAdded') {
    echo "<div class=\"success\"><h3>Product was successfully added!</h3></div>";
} else if ($confirm == 'commDeleted'){
    echo "<div class=\"success\"><h3>Comment was successfully deleted</h3></div>";
}else if ($confirm == 'commAdded') {
    echo "<div class=\"success\"><h3>Comment was successfully added!</h3></div>";
}

?>

<div id="admin">
    <h3>Stories</h3>
    <div id="stories">                          <!-- Stories Table -->
        <table>
            <?php
            $sql = "SELECT * FROM stories ORDER BY story_id";
            $result = $db->query($sql);
            if ($db->connect_error){
                $data_error=$db->connect_error;
            }
            // Create Table Heading
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Headline</th>";
            echo "<th>Author</th>";
            echo "<th>Published Date</th>";
            echo "<th>Content</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            // Loop through and print records
            while (list($story_id,$author,$headline,$content,$published)=$result->fetch_row()){
                echo "<tr>";
                echo "<td> $story_id </td>";
                echo "<td><a href=\"storyShow.php?story_id=$story_id\">" . substr($headline, 0, 25) . "</a></td>";
                echo "<td>" . $author . "</td>";
                $new_date = date_create($published);
                echo "<td>" . date_format($new_date, 'm/d/Y') . "</td>";
                echo "<td>" . substr($content,0,75) . "</td>";
                echo "<td><a href=\"storyEdit.php?story_id=$story_id\">Edit</a></td>";
                echo "<td><a href=\"storyDelete.php?story_id=$story_id\">Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table><br /><br />
        <a href="storyAdd.php">Add new story</a>
    </div>

    <h3>Products</h3>
    <div id="products">                           <!-- Products Table -->
        <table>
            <?php

            $sql = "SELECT * FROM products ORDER BY prod_id";
            $result = $db->query($sql);
            if ($db->connect_error){
                $data_error=$db->connect_error;
            }
            // Create Table Heading
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Product Name</th>";
            echo "<th>Thumbnail</th>";
            echo "<th>Product Price</th>";
            echo "<th>Product Description</th>";
            echo "<th>Detail</th>";
            echo "<th>Published</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            // Loop through and print records
            while (list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row()){
                echo "<tr>";
                echo "<td> $prod_id </td>";
                echo "<td><a href=\"prodDetail.php?prod_id=$prod_id\">$prod_name</a></td>";
                echo "<td><a href='$prod_img'><img src='$prod_thumb' alt='Product Thumbnail' /></a></td>";
                echo "<td> $prod_price </td>";
                echo "<td>" . substr($prod_description, 0, 10) . "</td>";
                echo "<td>" . substr($prod_detail, 0, 7) . "</td>";
                $new_date = date_create($published);
                echo "<td>" . date_format($new_date, 'm/d/Y') . "</td>";
                echo "<td><a href=\"prodEdit.php?prod_id=$prod_id\">Edit</a></td>";
                echo "<td><a href=\"prodDelete.php?prod_id=$prod_id\">Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table><br /><br />
        <a href="prodAdd.php">New Product</a><br /><br />
    </div>

    <h3>Comments</h3>
    <div id="admin_comments">                       <!-- Comments Table -->
        <table>
            <?php

            $sql = "SELECT * FROM comments ORDER BY comm_id";
            $result = $db->query($sql);
            if ($db->connect_error){
                $data_error=$db->connect_error;
            }
            // Create Table Heading
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Comment</th>";
            echo "<th>Author</th>";
            echo "<th>Date Posted</th>";
            echo "<th>Rating</th>";
            echo "<th>Product</th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            // Loop through and print records
            while (list($comm_id, $comm_author, $comment, $date_posted, $rating, $prod_id)=$result->fetch_row()){
                echo "<tr>";
                echo "<td> $comm_id </td>";
                echo "<td><a href=\"comment.php?comm_id=$comm_id&amp;product=$prod_id\">" . substr($comment, 0, 20) . "</a></td>";
                echo "<td> $comm_author </td>";
                $comment_date = date_create($date_posted);
                echo "<td>" . date_format($comment_date, 'm/d/Y') . "</td>";
                echo "<td> $rating </td>";
                echo "<td> $prod_id </td>";
                echo "<td><a href=\"commEdit.php?comm_id=$comm_id&amp;product=$prod_id\">Edit</a></td>";
                echo "<td><a href=\"commDelete.php?comm_id=$comm_id\">Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table><br /><br />
        <a href="commAdd.php">Add a comment</a><br /><br />
    </div><br />

</div>

<?php require 'includes/footer.php' ?>

