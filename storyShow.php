<?php
    require "includes/head.php";
    require "includes/dbConnect.php";

$story_id = $_GET['story_id'];
$sql = "SELECT * FROM stories WHERE story_id=$story_id";                          // Sql string
$result = $db->query($sql);
$edited = $_GET['edited'];
if ($db->connect_error) {
    $data_error = $db->connect_error;
}
if (isset($edited)){
    echo "<div class=\"success\">Story was successfully Updated</div>";
}
list($story_id, $author, $headline,  $content, $published)=$result->fetch_row();

?>

<div class="show">
<h3> <?php echo $headline ?> </h3>
<h5> <?php echo $author . ' -- ' . $published ?> </h5>
<p> <?php echo $content ?> </p><br /><br />
<a href="news.php">Back to News</a>
</div>

<?php
mysqli_close($db);
require "includes/footer.php" ?>