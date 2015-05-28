<?php
ob_start();
require "includes/head.php";
require "includes/dbConnect.php";
$story_id = $_GET['story_id'];
$sql = "SELECT * FROM stories WHERE story_id=$story_id";

$result = $db->query($sql);
list($story_id, $author, $headline,  $content, $published)=$result->fetch_row();

$submit = $_POST['submit'];

$errors = '';

if ($submit){
    $headline = addslashes($_POST['headline']);
    $author = addslashes($_POST['author']);
    $content = addslashes($_POST['content']);
    if (!isset($headline) || $headline === ''){
        $errors .= '-Headline must be filled out.<br />';
    }

    if (!isset($author) || $author === ''){
        $errors .= '-Author must be filled out.<br />';
    }

    if (strlen($content) < 1000){
        $errors .= '-Content must contain a minimum of 1,000 characters';
    }
    if ($errors == ''){
        $sql = "UPDATE stories SET author='$author',headline='$headline',  content='$content' WHERE story_id=$story_id;";
        $result = $db->query($sql);
        ob_clean();
        header("Location: storyShow.php?story_id=$story_id&edited=edited");
    } else {
        echo "<div id='admin' class='error'>$errors</div>";
    }
}

?>

<div class="show">
<form action="storyEdit.php?story_id=<?php echo $story_id ?>" method="POST">
        <label for="headline">Headline:</label><br />
    <input type="text" name="headline" id="headline" value="<?php echo $headline ?>" /><br />
        <label for="author">Author:</label><br />
    <input type="text" name="author" id="author" value="<?php echo $author ?>" /><br />
        <label for="content">Content:</label><br />
    <textarea name="content" id="content" cols="100" rows="20"><?php echo $content ?></textarea><br />
    <input type="submit" name="submit" id="submit" value="Update" />
</form>
</div>

<?php
ob_end_flush();
mysqli_close($db);
require "includes/footer.php"
?>
