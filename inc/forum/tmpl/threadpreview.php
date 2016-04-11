<?php

    $id = $row['id'];
    $title = $row['title'];
    $content = $row['content'];
    $author = $row['author'];

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
            <span class="author">Verfasst von <a href="user.php?user=<?php echo strtolower($author); ?>"><?php echo $author; ?></a></span>
        </div>
    </div>

</div>
