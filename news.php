<?php
$title = 'Latest News';
require 'includes/dbConnect.php';
require 'includes/head.php'
?>
                                                        <!-- Final: Story Page - -->
<div id="news_content">
    <?php
    $sql = "SELECT * FROM stories ORDER BY published DESC LIMIT 3";
    $result = $db->query($sql);
    while (list($story_id, $author, $headline,  $content, $published)=$result->fetch_row()){
        $display_date = date_create($published);
        echo '<h2><a href="storyShow.php?story_id=' . $story_id . '">' . $headline . '</a></h2>';
        echo '<h4>' . date_format($display_date, 'm/d/Y') . '</h4>';
        echo '<h4>' . $author . '</h4>';
        echo '<p>' . substr($content, 0,225) . '...</p>';
    }
    ?>
    <h1>Content Coming Soon!</h1>
</div>
<div id="archive">
    <h3>Archived News</h3>
    <?php
    $sql = "SELECT * FROM stories ORDER BY published DESC LIMIT 8 OFFSET 3";
    $result = $db->query($sql);
    while (list($story_id, $author, $headline,  $content, $published)=$result->fetch_row()){
        $display_date = date_create($published);
        echo '<div>';

        echo '<p>'. date_format($display_date, 'm/d/Y') . '<br />';
        echo '<a href="storyShow.php?story_id=' . $story_id . '">';
        echo $headline . '</a></p>';
        echo '</div>';
    }
    ?>
</div>

<?php require 'includes/footer.php' ?>