<?php
ob_start();
require 'includes/head.php';
require 'includes/dbConnect.php';

$headline = addslashes($_POST['headline']);
$author = addslashes($_POST['author']);
$content = addslashes($_POST['content']);
$submit = $_POST['submit'];

$errors = '';
                                                        // Validate form data
if (!isset($headline) || $headline === ''){
    $errors .= '-Headline must be filled out.<br />';
}

if (!isset($author) || $author === ''){
    $errors .= '-Author must be filled out.<br />';
}

if (strlen($content) < 1000){
    $errors .= '-Content must contain a minimum of 1,000 characters';
}

if ($submit){
    if ($errors == ''){
        $sql = "INSERT INTO stories (story_id, author, headline, content, published) VALUES (NULL, '$author', '$headline', '$content',CURRENT_TIMESTAMP);";
        $result = $db->query($sql);
        ob_clean();
        header("Location: admin.php?confirm=storyAdded");
    } else {
        echo "<div id='admin' class='error'>$errors</div>";
    }
}
?>

<div class="show">
<form action="storyAdd.php" method="POST">
        <label for="headline">Headline:</label><br />
    <input type="text" name="headline" id="headline" value="<?php echo $headline ?>" /><br />
        <label for="author">Author:</label><br />
    <input type="text" name="author" id="author" value="<?php echo $author ?>" /><br />
        <label for="content">Content:</label><br />
    <textarea name="content" id="content" cols="100" rows="20"><?php echo $content ?></textarea><br />
    <input type="submit" name="submit" id="submit" value="Add Story" />
</form>
</div>

<?php
mysqli_close($db);
require 'includes/footer.php';
ob_end_flush()
?>