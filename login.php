<?
ob_start();
$title = 'Login';
require 'includes/head.php';
require 'includes/dbConnect.php';

$user_name = $_POST['user_name'];
$password = $_POST['password'];
$submit = $_POST['submit'];

                                                // Final: Login & Admin Area - Finished
if ($submit){
    $password = hash('sha256', $password);
    $sql = "SELECT * FROM users WHERE user_name='$user_name' AND password='$password'";
    $result = $db->query($sql);
    list($user_id, $user_name, $password)=$result->fetch_row();
    if ($user_id){
        $_SESSION['user_name'] = $user_name;
        ob_clean();
        header("Location: admin.php");
    }
}
?>

<form id="login" method="POST" action="login.php">
    <fieldset><legend>Login Information</legend>
        <label for="user_name">Login Name: </label><br />
        <input type="text" name="user_name" id="user_name" value="" /><br />
        <label for="password">Password: </label><br />
        <input type="password" name="password" id="password" value="" /><br />
    </fieldset>
    <input name="submit" type="submit" id="submit"  value="Login" />
</form>

<?php require 'includes/footer.php' ?>