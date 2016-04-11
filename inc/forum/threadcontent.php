<?php

    $title = '';
    $content = '';
    $author = '';
    $replies = array();

    if (isset($_GET['tid']) && $_GET['tid'] != '') {

        $id = $_GET['tid'];

        // check post id & select contents
        $query = mysqli_query($con, "SELECT * FROM threads WHERE id='$id'");
        if (mysqli_num_rows($query) > 0) {

            $info = mysqli_fetch_array($query);

            $title = $info['title'];
            $content = $info['content'];
            $author = $info['author'];

            // check replies & select contents
            $qu = mysqli_query($con, "SELECT * FROM replies WHERE threadID='$id' ORDER BY id DESC");
			if (mysqli_num_rows($qu) > 0) {

				while ($row = mysqli_fetch_array($qu)) {

                    $rid = $row['id'];
                    $reauthor = $row['author'];
                    $recontent = $row['content'];
                    $recontent = nl2br($recontent);

					$replies[$rid]  = "<li class='reply'>";
                    $replies[$rid] .= "<div class='reply-author'><a href='user.php?user=" . strtolower($reauthor) . "'>" . $reauthor . "</a> Antwortet:</div>";
                    $replies[$rid] .= "<div class='reply-content'>" . $recontent . "</div>";
                    $replies[$rid] .= "</li>";
				}

			}

        } else {
            echo "<p class='error-inline'>Die Thread-ID fehlt in der URL..</p>";
        }

    } else {
        echo "<p class='error-inline'>Die Thread-ID scheint nicht zu stimmen..</p>";
    }

?>

<!-- thread -->

<div class="single-thread">

    <div class="thread-rating">
        <?php
            $qq = mysqli_query($con, "SELECT * FROM threads WHERE id='$id'");
            if (mysqli_num_rows($qq) > 0) {

                $info = mysqli_fetch_array($qq);
                // calculate rating
                $rating = calcRating( $info['rating'], $info['totalRatings'] );
                echo $rating;
            }
        ?>
    </div>

    <div class="thread-title">
        <h1><?php echo $title; ?></h1>
    </div>

    <div class="thread-content">
        <p><?php echo nl2br($content); ?></p>
        <div class="thread-meta">
            <span class="author">Verfasst von <a href="user.php?user=<?php echo strtolower($author); ?>"><?php echo $author; ?></a></span>
            <span class="ratingnav">
            	Beitrag bewerten:
            	<a href="<?php echo 'rating.php?tid='.$_GET['tid'].'&rating=1'; ?>">1 </a>
            	<a href="<?php echo 'rating.php?tid='.$_GET['tid'].'&rating=2'; ?>">2 </a>
            	<a href="<?php echo 'rating.php?tid='.$_GET['tid'].'&rating=3'; ?>">3 </a>
            	<a href="<?php echo 'rating.php?tid='.$_GET['tid'].'&rating=4'; ?>">4 </a>
            	<a href="<?php echo 'rating.php?tid='.$_GET['tid'].'&rating=5'; ?>">5 </a>
            </span>
        </div>
    </div>

    <!-- subscription form -->
    <?php if (isset($_SESSION['user']) && isset($_SESSION['email'])): ?>

        <div class="form-container subform">
            <?php require "inc/forum/subscriptions.php"; ?>
        </div>

    <?php endif; ?>

    <!-- replies -->
    <?php
        if ( $replies != '' ){
            echo "<h3>Kommentare:</h3>";
            echo "<ul class='replies'>";
            foreach ( $replies as $reply ) {
                echo $reply;
            }
            echo "</ul>";
        }
    ?>

</div>
