<?php if (!isset($_SESSION["user"])): ?>
    <p>Melde dich an, um Beiträge verfassen und kommentieren zu können. Jetzt <a href='register.php'>registrieren</a> oder direkt <a href='login.php'>Anmelden</a></p>
<?php else: ?>

    <p>Willkommen, <?php echo $_SESSION["user"]; ?>!</p>

    <div class="form-container">

        <h2>Beitrag erstellen:</h2>
        <form class="form" method="POST">
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
                <input type="submit" value="Beitrag Erstellen" name="createThread">
            </div>
        </form>

        <?php

        	if (isset($_POST['createThread'])) {
        		if (isset($_POST['title']) && $_POST['title'] != ''
                && isset($_POST['description']) && $_POST['description'] != ''
                && isset($_POST['tags']) && $_POST['tags'] != ''
                && isset($_SESSION['user']) && $_SESSION['user'] != '') {
        			$title = $_POST['title'];
        			$description = $_POST['description'];
                    $tags = $_POST['tags'];
                    $tags = strtolower($tags);
        			$user = $_SESSION['user'];

        			$q = mysqli_query($con, "INSERT INTO threads VALUES ('', '$title', '$description', '$user', '0', '0', '$tags') ") or die(mysql_error());
        			if ($q) {
        				echo '<p class="success-inline">Dein Beitrag wurde soeben erstellt.</p>';
        			} else {
                        echo '<p class="error-inline">Beitrag konnte nicht erstellt werden..</p>';
                    }
        		}
        	}
        ?>

    </div>

<?php endif; ?>
