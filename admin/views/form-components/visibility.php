<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}
?>

<div class="ep-plugin-card">
  <div class="ep-plugin-card__section">
    <h3 class="ep-plugin-card__title">Notification bar visibility</h3>
    <p>You can have multiple active notification bars in your site with different display rules.</p>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label>
        <input type="checkbox" name="active" id="active" class="notification-bar-data--checkbox" <?php
        if ( $smart_notification_bar->active ) {
          echo "checked";
        }
        ?> />
        Active
      </label>
      <p class="ep-plugin-form-group__help-text">
        Choose this option if you want to <strong>turn ON</strong> this Notification bar
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section <?php
    if ( ! $smart_notification_bar->active ) {
      echo "hidden";
    }
    ?>" id="visible-from-section">
    <div class="ep-plugin-form-group">
      <label for="visible_from" class="ep-plugin-form-group__label">Notification Bar visible from</label>
      <input type="text" class="ep-plugin-input-field notification-bar-data" id="visible_from" name="visible_from" value="<?php echo esc_html( $smart_notification_bar->visible_from ); ?>" data-field-error="Session start date is required" />
      <p class="ep-plugin-form-group__help-text">If the Notification Bar is Active, it will be visible for your visitors from this date</p>
    </div>
  </div>

  <div class="ep-plugin-card__section <?php
    if ( ! $smart_notification_bar->active ) {
      echo "hidden";
    }
    ?>" id="visible-to-section">
    <div class="ep-plugin-form-group">
      <label for="visible_to" class="ep-plugin-form-group__label">Notification Bar visible to</label>
      <input type="text" class="ep-plugin-input-field notification-bar-data" id="visible_to" name="visible_to" value="<?php echo esc_html( $smart_notification_bar->visible_to ); ?>" data-field-error="Session end date is required" />
      <p class="ep-plugin-form-group__help-text">This is the last day your notification bar will be visible for your visitors</p>
    </div>
  </div>

</div>