<?php

    $id = $row['id'];
    $title = $row['title'];
    $content = $row['content'];
    $author = $row['author'];
    $date = $row['date'];
    $tags = $row['tags'];

    // limit content & calculate rating
    $content = excerpt( $content );
    $rating = calcRating( $row['rating'], $row['totalRatings'] );

?>

<div class='thread'>

    <div class="thread-rating">
        <?php echo $rating; ?>
    </div>

    <div class='thread-title'>
        <a href='thread.php?tid=<?php echo $id; ?>'>
            <?php echo $title; ?>
        </a>
    </div>

    <div class='thread-content'>
        <?php echo $content; ?>
        <div class='thread-meta'>
            <span class="author">Post By: <a href="forum.php?user=<?php echo strtolower($author); ?>"><?php echo $author; ?></a></span>
            <span class="separator"> | </span>
            <span class="date">Date Posted <?php echo $date ?></span>
            <span class="separator"> | </span>
            <span class="tags">Tags:
                <?php
                    $tags = explode(', ', $tags);
                    $tagstring = "";
                    foreach ($tags as $key => $tag) {
                        $tagstring .= "<a href='search.php?s=$tag'>$tag</a>, ";
                    }
                    echo substr($tagstring, 0, -3);
                ?>
            </span>
        </div>
    </div>

</div>
