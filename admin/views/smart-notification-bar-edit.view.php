<?php

// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

/**
 * Display smart notification bar form
 */
$smart_notification_bar = $smart_notification_bar_data;
?>

<div class="wrap">
	<?php
	include "smart-notification-bar-form.view.php";
	?>
</div>