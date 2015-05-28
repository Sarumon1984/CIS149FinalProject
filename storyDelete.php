<?php
    require "includes/dbConnect.php";

$story_id = $_GET['story_id'];
$sql = "DELETE FROM stories WHERE story_id=$story_id";
$result = $db -> query($sql);

header("Location: admin.php?confirm=storyDeleted");
?>