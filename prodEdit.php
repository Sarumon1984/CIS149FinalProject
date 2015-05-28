<?php
ob_start();
require 'includes/head.php';
require 'includes/dbConnect.php';

$prod_id = $_GET['prod_id'];
$sql = "SELECT * FROM products WHERE prod_id=$prod_id";
$result = $db->query($sql);
list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row();
$submit = $_POST['submit'];
$errors = '';

if ($submit){
    $prod_name = addslashes($_POST['prod_name']);
    $prod_price = addslashes($_POST['prod_price']);
    $prod_description = addslashes($_POST['prod_description']);
    $prod_thumb = addslashes($_POST['prod_thumb']);
    $prod_img = addslashes($_POST['prod_img']);
    $prod_detail = addslashes($_POST['prod_det']);

    if (!isset($prod_name) || $prod_name === ''){
        $errors .= '-Name must not be blank.<br />';
    }

    if (!isset($prod_price) || $prod_price === ''){
        $errors .= '-Price must not be blank.<br />';
    }

    if (!isset($prod_description) || $prod_description === '')
        $errors .= '-Description must not be blank.<br />';

    if (!isset($prod_thumb) || $prod_thumb === ''){
        $errors .= '-You must provide a thumbnail URL<br />';
    }

    if (!isset($prod_img) || $prod_img === ''){
        $errors .= '-You must provide a Image URL<br />';
    }

    if (!isset($prod_detail) || $prod_detail === ''){
        $errors .= '-You must provide a Detail URL<br />';
    }
    if ($errors == ''){
        $sql = "UPDATE products SET prod_name='$prod_name',prod_price='$prod_price',prod_description='$prod_description',prod_thumb='$prod_thumb',prod_img='$prod_img', prod_detail='$prod_detail' WHERE prod_id=$prod_id;";
        $result = $db->query($sql);
        ob_clean();
        header("Location: prodDetail.php?confirm=edited&prod_id=$prod_id");
        echo $prod_name;
    } else {
        echo "<div class='error'>$errors</div>";
    }
}
?>

<div id="product">
    <form action="prodEdit.php?prod_id=<?php echo $prod_id ?>" method="POST">
            <label for="prod_name">Name</label><br />
        <input type="text" name="prod_name" id="prod_name" value="<?php echo $prod_name ?>"><br />
            <label for="prod_price">Price</label><br />
        <input type="text" name="prod_price" id="prod_price" value="<?php echo $prod_price ?>"><br />
            <label for="prod_description">Description</label><br />
        <textarea name="prod_description" id="prod_description" cols="50" rows="10"><?php echo $prod_description ?></textarea><br />
            <label for="prod_thumb">Thumbnail(URL)</label><br />
        <input type="text" name="prod_thumb" id="prod_thumb" value="<?php echo $prod_thumb ?>" /><br />
            <label for="prod_img">Image(URL)</label><br />
        <input type="text" name="prod_img" id="prod_img" value="<?php echo $prod_img ?>" /><br />
            <label for="prod_det">Detail(URL)</label><br />
        <input type="text" name="prod_det" id="prod_det" value="<?php echo $prod_detail ?>" /><br />

        <input type="submit" name="submit" id="submit" value="Update" />
    </form>
</div>

<?php require 'includes/footer.php' ?>