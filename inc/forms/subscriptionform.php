<?php
	$email = $_SESSION['email'];
	$id = $_GET['tid'];
?>

<?php if (!isset($_GET['unsub'])): ?>

	<div class="form-container">
		<form name="subscribe" method="POST">
			<input type="hidden" name="email" value="<?php echo $email; ?>" />

			<?php $q = mysqli_query($db, "SELECT * FROM subscriptions WHERE email='$email' AND threadID='$id'"); ?>

			<?php if (mysqli_num_rows($q) <= 0): ?>
				<p class="nomargin">Wenn du per Email über neue Kommentare benachrichtigt werden möchtest, klicke auf
				<input type="submit" class="submit-inline" name="subscribe" value="Beitrag Folgen">.</p>
			<?php else: ?>
				<p class="nomargin">Du folgst diesem Beitrag. Wenn du nicht mehr benachrichtigt werden möchtest, klicke auf
				<input type="submit" class="submit-inline" name="unsubscribe" value="nicht mehr Folgen">.</p>
			<?php endif; ?>
		</form>
	</div>

<?php else: ?>
	<?php $q = mysqli_query($db, "SELECT * FROM subscriptions WHERE email='$email' AND threadID='$id'"); ?>
<?php endif; ?>

<?php

	if (isset($_POST['subscribe']) && isset($id)) {

		if (mysqli_num_rows($q) <= 0) {
			$qu = mysqli_query($db, "INSERT INTO subscriptions VALUES ('', '$id', '$email')");
			if ($qu) {
				$success .= "<p class='success'>Subscription erflogreich - du wirst nun per Email über neue Kommentare informiert.</p>";
			} else {
				$errors .= "<p class='error'>Fehler bei der Subscription..</p>";
            }
		} else {
			ob_start();
			$errors .= "<p class='error'>Du wirst schon über neue Kommentare informiert..</p>";
        }

	} else if (isset($_POST['unsubscribe']) && isset($id) || isset($_GET['unsub']) && isset($id)) {

		if (mysqli_num_rows($q) > 0) {
			$qu = mysqli_query($db, "DELETE FROM subscriptions WHERE email='$email' AND threadID='$id'");
			if ($qu) {
				$success .= "<p class='success'>Subscription erfolgreich deaktiviert. Du solltest nun keine Emails mehr erhalten.</p>";
			} else {
				$errors .= "<p class='error'>Subscription konnte nicht gelöscht werden..</p>";
            }
		}

	}

	echo $errors;
	echo $success;
	$errors = "";
	$success = "";

?>
