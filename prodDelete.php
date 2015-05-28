<?php
    require "includes/dbConnect.php";

$prod_id = $_GET['prod_id'];
$sql = "DELETE FROM products WHERE prod_id=$prod_id";
$result = $db -> query($sql);

header("Location: admin.php?confirm=productDeleted");
?>