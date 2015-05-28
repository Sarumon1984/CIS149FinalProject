<?php
    require "includes/dbConnect.php";

$comm_id = $_GET['comm_id'];
$sql = "DELETE FROM comments WHERE comm_id=$comm_id";
$result = $db -> query($sql);

header("Location: admin.php?confirm=commDeleted");
?>