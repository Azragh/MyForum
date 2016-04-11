<?php
	$email = $_SESSION['email'];
	$id = $_GET['tid'];
?>

<form name="subscribe" method="POST">
	<input type="hidden" name="email" value="<?php $_SESSION['email'] ?>" />

	<?php $q = mysqli_query($con, "SELECT * FROM subscriptions WHERE email='$email' AND threadID='$id'"); ?>

	<?php if (mysqli_num_rows($q) <= 0): ?>
		<p class="nomargin">Wenn du per Email über neue Kommentare benachrichtigt werden möchtest, klicke auf
		<input type="submit" class="submit-inline" name="subscribe" value="Beitrag Folgen">.</p>
	<?php else: ?>
		<p class="nomargin">Du folgst diesem Beitrag. Wenn du nicht mehr benachrichtigt werden möchtest, klicke auf
		<input type="submit" class="submit-inline" name="unsubscribe" value="nicht mehr Folgen">.</p>
	<?php endif; ?>

</form>

<?php

	if (isset($_POST['subscribe']) && isset($id)) {

		if (mysqli_num_rows($q) <= 0) {
			$qu = mysqli_query($con, "INSERT INTO subscriptions VALUES ('', '$id', '$email')");
			if ($qu) {
				echo "<p class='success-inline'>Subscription erflogreich - du wirst nun per Email über neue Kommentare informiert.</p>";
			} else {
				echo "<p class='error-inline'>Fehler bei der Subscription..</p>";
            }
		} else {
			echo "<p class='error-inline'>Du wirst schon über neue Kommentare informiert..</p>";
        }

	} else if (isset($_POST['unsubscribe']) && isset($id)) {

		if (mysqli_num_rows($q) > 0) {
			$qu = mysqli_query($con, "DELETE FROM subscriptions WHERE email='$email' AND threadID='$id'");
			if ($qu) {
				echo "<p class='success-inline'>Subscription erfolgreich deaktiviert. Du solltest nun keine Emails mehr erhalten.</p>";
			} else {
				echo "<p class='error-inline'>Subscription konnte nicht gelöscht werden..</p>";
            }
		} else {
			echo "<p class='error-inline'>Du folgst diesem Beitrag nicht..</p>";
        }

	}

?>
