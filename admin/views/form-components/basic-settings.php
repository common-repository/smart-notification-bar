<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}
?>

<div class="ep-plugin-card">
  <div class="ep-plugin-card__section">
    <h3 class="ep-plugin-card__title">
      Notification Bar Basic Settings
    </h3>
    <p>Set the name, and <strong>position</strong> of your notification bar.</p>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label class="ep-plugin-form-group__label" for="name">Notification bar name</label>
      <input type="text" class="ep-plugin-input-field notification-bar-data" name="name" id="name" value="<?php echo esc_html( $smart_notification_bar->name ); ?>" maxlength="250" required data-field-error="Notification bar name is required" />
      <p class="ep-plugin-form-group__help-text">This is just an information for you that you can use to identify your notification bar. It won't be visible for your visitors.</p>
    </div>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label for="position" class="ep-plugin-form-group__label">Notification bar position</label>

      <label>
        <input type="radio" name="position" class="notification-bar-data--radio" value="top" <?php if( $smart_notification_bar->position == "top") {
          echo 'checked="checked"';
        } ?>> Display the notification bar at the <strong>top of the page</strong>
      </label>

      <label>
        <input type="radio" name="position" class="notification-bar-data--radio" value="bottom" <?php if( $smart_notification_bar->position == "bottom" ) {
          echo 'checked="checked"';
        } ?>> Display the notification bar at the <strong>bottom of the page</strong>
      </label>

      <p class="ep-plugin-form-group__help-text">
      You can choose to display the notification bar above or below your content.
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
    <label for="sticky" class="ep-plugin-form-group__label">Sticky notification bar</label>
      <label>
        <input type="checkbox" name="sticky" class="ep-plugin-checkbox notification-bar-data--checkbox" <?php if( $smart_notification_bar->sticky == 1 ) {
          echo 'checked="checked"';
        } ?> /> Sticky
      </label>
      <p class="ep-plugin-form-group__help-text">When this option is selected the notification bar will <strong>always be visible</strong> on the page <strong>while the user scrolls</strong>. Use it wisely, as it can affect the browsing experience of your visitors.</p>
    </div>
  </div>
</div><!-- end .ep-plugin-card -->