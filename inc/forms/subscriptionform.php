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
				<p class="nomargin">If you'd like to be notified of new comments by email, click
 <input type="submit" class="submit-inline" name="subscribe" value="Subscribe">.</p>
			<?php else: ?>
				<p class="nomargin">You are following this post. If you do not want to be notified, click
<input type="submit" class="submit-inline" name="unsubscribe" value="Unsubscribe">.</p>
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
				$success .= "<p class='success'>Subscription Success - you will be informed by email about new comments.</p>";
			} else {
				$errors .= "<p class='error'>Subscription failed.</p>";
            }
		} else {
			ob_start();
			$errors .= "<p class='error'>You are already informed about new comments.</p>";
        }

	} else if (isset($_POST['unsubscribe']) && isset($id) || isset($_GET['unsub']) && isset($id)) {

		if (mysqli_num_rows($q) > 0) {
			$qu = mysqli_query($db, "DELETE FROM subscriptions WHERE email='$email' AND threadID='$id'");
			if ($qu) {
				$success .= "<p class='success'>Subscription successfully disabled. You should no longer receive emails.</p>";
			} else {
				$errors .= "<p class='error'>Error.</p>";
            }
		}

	}

	echo $errors;
	echo $success;
	$errors = "";
	$success = "";

?>
