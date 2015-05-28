<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
<title>
    <?php
        if ($title != '')
            print $title;
        else
            print 'Devindelp.com'
    ?>
</title>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="../css/jquery-ui.min.css" />
<link rel="stylesheet" href="../css/jquery-ui.structure.min.css" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="../css/main.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/devindelp.js"></script>
</head>

<body>
<div id="wrapper">
    <header><a href="../index.php"><img src="../images/logo.jpg" alt="devindelp.com Logo" title="Home Page" width="1200" height="232" /></a></header>

    <nav class="hor_nav">

		<ul class="ul_nav">
			<li>
                <a href="../index.php" title="Homepage">Home</a>
			</li>
			<li>
                <a href="../news.php" title="News">News</a>
			</li>
			<li>
                <a href="../store.php" title="Shop">Shop</a>
			</li>
			<li>
                <a href="../contact.php" title="Contact">Contact</a>
			</li>
            <?php
            if ($_SESSION['user_name']){
                echo "<li><a href='../admin.php'>Admin</a></li>";
            } else {
                echo "<li></li>";
            }
            ?>
		</ul>
	</nav>
    <p id="account">
        <?php
        if ($_SESSION['user_name']){
            echo "<a href='../logout.php'>Logout</a>";
        } else {
            echo "<a href='../login.php'>Login</a>";
        }
        ?>
    </p>