<div class="form-container">

    <h2>Beitrag erstellen:</h2>
    <form id="threadform" class="form" action="forum.php" method="POST">
        <div class="form-row">
            <label>Titel:</label><br>
            <input type="text" name="title" required>
        </div>
        <div class="form-row">
            <label>Beitrag:</label><br>
            <textarea name="description" rows="4" required></textarea>
        </div>
        <div class="form-row">
            <label>Tags (durch Komma getrennt):</label><br>
            <input type="text" name="tags" required>
        </div>
        <div class="form-row">
            <button type="submit" name="createThread"><span>Beitrag Erstellen</span></button>
        </div>
    </form>

</div>

<?php

    if (isset($_POST['createThread'])) {
        if (isset($_POST['title']) && $_POST['title'] != ''
        && isset($_POST['description']) && $_POST['description'] != ''
        && isset($_POST['tags']) && $_POST['tags'] != ''
        && isset($_SESSION['user']) && $_SESSION['user'] != '') {
            $title = cleanInput($_POST['title']);
            $description = cleanInput($_POST['description']);
            $tags = cleanInput($_POST['tags']);
            $tags = strtolower($tags);
            $user = $_SESSION['user'];
            $date = date( 'd.m.y', time() );

            $q = mysqli_query($db, "INSERT INTO threads VALUES ('', '$title', '$description', '$user', '0', '0', '$tags', '$date') ") or die(mysql_error());
            if ($q) {
                echo '<p class="success">Dein Beitrag wurde soeben erstellt.</p>';
            } else {
                echo '<p class="error">Beitrag konnte nicht erstellt werden..</p>';
            }
        }
    }

?>
