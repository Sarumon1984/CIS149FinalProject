<?php
    $title = 'Home';
    require 'includes/dbConnect.php';
    require 'includes/head.php';
    require 'includes/hero.php'
?>
                                                <!-- Final: Latest News - Finished -->
<section id="news">
    <h2>News</h2>
    <?php
    $sql = "SELECT * FROM stories ORDER BY published DESC LIMIT 3";
    $result = $db->query($sql);
    while (list($story_id, $author, $headline,  $content, $published)=$result->fetch_row()){
        $display_date = date_create($published);
        echo '<p>';
        echo date_format($display_date, 'm/d/Y') . '<br />';
        echo '<a href="storyShow.php?story_id=' . $story_id . '">' . $headline . '</a>';
        echo '</p>';
    }

    ?>
</section>
                                                <!-- Final: Featured Product - Finished -->
<section id="weekly_special">
    <h2>Weekly Special</h2>
    <?php
    $sql = "SELECT * FROM products WHERE attribute='special'";
    $result = $db->query($sql);
    list($prod_id,$prod_name,$prod_price,$prod_description,$prod_thumb,$prod_img,$prod_detail,$attribute,$published)=$result->fetch_row();
    echo '<p>';
    echo '<a href="prodDetail.php?prod_id=' . $prod_id . '"><img src="' . $prod_img . '" alt="' . $prod_name . '" /></a><br />';
    echo $prod_description;
    echo '</p>'
    ?>
</section>

<section id="get_in_touch">
    <h2>Get in Touch</h2>
    <p>
        Address<br />
        Phone<br />
        Hours: 8am - 5pm Mon - Fri<br />
        <a href="mailto:sarumon1984@gmail.com">sarumon1984@gmail.com</a><br />

    </p>
</section>

<? require 'includes/footer.php' ?>