<?php

// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

/**
 * Display smart notification bar form
 */
?>

<div class="wrap">
	<?php
	include "smart-notification-bar-form.view.php";
	?>
</div>