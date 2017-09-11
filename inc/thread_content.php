<?php

    $title = '';
    $content = '';
    $author = '';
    $replies = array();
    $real_id = false;

    $errors = "";
    $success = "";

    if (isset($_GET['tid']) && $_GET['tid'] != '') {

        $id = $_GET['tid'];

        // check post id & select contents
        $query = mysqli_query($db, "SELECT * FROM threads WHERE id='$id'");
        if (mysqli_num_rows($query) > 0) {

            $info = mysqli_fetch_array($query);

            $title = $info['title'];
            $content = $info['content'];
            $author = $info['author'];
            $date = $info['date'];
            $tags = strtolower($info['tags']);
            $real_id = true;

            // check replies & select contents
            $qu = mysqli_query($db, "SELECT * FROM replies WHERE threadID='$id' AND status='1' ORDER BY id DESC");
			if (mysqli_num_rows($qu) > 0) {

				while ($row = mysqli_fetch_array($qu)) {

                    $rid = $row['id'];
                    $reauthor = $row['author'];
                    $recontent = $row['content'];
                    $recontent = nl2br($recontent);

					$replies[$rid]  = "<li class='reply'>";
                    $replies[$rid] .= "<div class='reply-author'><a href='forum.php?user=" . strtolower($reauthor) . "'>" . $reauthor . "</a> Antwortet:</div>";
                    $replies[$rid] .= "<div class='reply-content'>" . $recontent . "</div>";
                    $replies[$rid] .= "</li>";
				}

			}

        } else {
            $errors .= "<p class='error'>Die Thread-ID scheint nicht zu stimmen..</p>";
        }

    } else {
        $errors .= "<p class='error'>Die Thread-ID scheint nicht zu stimmen..</p>";
    }

?>

<!-- thread -->
<?php if ( $real_id == true ): ?>

    <div class="single-thread">

        <div class="thread-rating">
            <?php $rating = calcRating( $info['rating'], $info['totalRatings'] ); ?>
            <?php echo $rating; ?>
        </div>

        <div class="thread-title">
            <h1><?php echo $title; ?></h1>
        </div>

        <div class="thread-content">
            <p><?php echo nl2br($content); ?></p>
            <div class="thread-meta">
                <span class="author">Verfasst von <a href="forum.php?user=<?php echo strtolower($author); ?>"><?php echo $author; ?></a></span>
                <span class="separator"> | </span>
                <span class="date">Veröffentlicht am <?php echo $date ?></span>
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
                <span class="ratingnav">
                	Beitrag bewerten:
                	<a href="<?php echo 'thread.php?tid='.$_GET['tid'].'&rating=1'; ?>">1 </a>
                	<a href="<?php echo 'thread.php?tid='.$_GET['tid'].'&rating=2'; ?>">2 </a>
                	<a href="<?php echo 'thread.php?tid='.$_GET['tid'].'&rating=3'; ?>">3 </a>
                	<a href="<?php echo 'thread.php?tid='.$_GET['tid'].'&rating=4'; ?>">4 </a>
                	<a href="<?php echo 'thread.php?tid='.$_GET['tid'].'&rating=5'; ?>">5 </a>
                    <?php require "inc/thread_rating.php"; ?>
                </span>
            </div>
        </div>

        <?php
            echo $errors;
            echo $success;
            $errors = "";
            $success = "";
        ?>

        <!-- subscription form -->
        <?php if (isset($_SESSION['user']) && isset($_SESSION['email'])): ?>

            <?php require "inc/forms/subscriptionform.php"; ?>

        <?php endif; ?>

        <!-- replies -->
        <?php
            if ( $replies != array() ){
                echo "<h3>Kommentare:</h3>";
                echo "<ul class='replies'>";
                foreach ( $replies as $reply ) {
                    echo $reply;
                }
                echo "</ul>";
            }
        ?>

    </div>

<?php endif; ?>
