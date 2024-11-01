<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}
?>

<div class="ep-plugin-card">
  <div class="ep-plugin-card__section">
    <h3 class="ep-plugin-card__title">Get started</h3>
    <p>If you need some help on how to create a Smart Notification Bar, take a look at the following page: <a href="https://smartnotificationbar.com/create-wordpress-notification-bar.html" target="_blank">Create your first Smart Notification Bar</a></p>
    <p>You can see the preview of your notification bar above this section. It automatically updates every time you make a change in the settings below.</p>
  </div>
</div>