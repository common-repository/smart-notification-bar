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
      Close button settings
    </h3>
    <p>Let your visitors decide if they want to see the notification all the time our they'd like to hide it.</p>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label>
        <input type="checkbox" name="display_close_button" id="display_close_button" class="notification-bar-data--checkbox" <?php
        if( $smart_notification_bar->display_close_button == 1 ) {
          echo 'checked="checked"';
        }
        ?> /> Display Close button
      </label>
      <p class="ep-plugin-form-group__help-text">
        Choose this option if you'd like to display a button that your visitors can use to close the notification bar.
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section smart-notification-bar-close-button-section <?php
  if( ! $smart_notification_bar->display_close_button ) {
    echo "hidden";
  } ?>">
    <div class="ep-plugin-form-group">
      <label for="close_button_color" class="ep-plugin-form-group__label">Color of the close button</label>
      <input type="text" name="close_button_color" id="close_button_color" class="colorpicker notification-bar-data" value="<?php echo esc_html( $smart_notification_bar->close_button_color ); ?>" />
      <p class="ep-plugin-form-group__help-text">
        Use a color that makes the close button easy to find.
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section smart-notification-bar-close-button-section <?php
  if( ! $smart_notification_bar->display_close_button ) {
    echo "hidden";
  } ?>">
    <label>
      <input type="checkbox" name="hidden_after_closed" id="hidden_after_closed" class="notification-bar-data--checkbox" <?php if( $smart_notification_bar->hidden_after_closed == 1 ) {
        echo 'checked="checked"';
      } ?>> Keep the notification bar hidden after someone closed it
    </label>
    <p class="ep-plugin-form-group__help-text">
      Use this option if you don't want to show the same notification bar to your visitors once they closed it.
    </p>
  </div>

  <div class="ep-plugin-card__section smart-notification-bar-close-button-section smart-notification-bar-hidden-after-closed-section <?php
  if( ! $smart_notification_bar->hidden_after_closed ) {
    echo "hidden";
  } ?>">
    <label for="hidden_after_closed_lifetime" class="ep-plugin-form-group__label">The number of days it should stay hidden once closed</label>
    <div class="ep-plugin-card__columns">
      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <input type="number" name="hidden_after_closed_lifetime" id="hidden_after_closed_lifetime" class="notification-bar-data" value="<?php echo intval( $smart_notification_bar->hidden_after_closed_lifetime ); ?>" />
        </div>
      </div>

      <div class="ep-plugin-card__column"></div>
    </div>
    <p class="ep-plugin-form-group__help-text">
      Use a higher number if you want to keep the notification bar hidden for a longer time.
    </p>
  </div>
</div><!-- end .ep-plugin-card -->