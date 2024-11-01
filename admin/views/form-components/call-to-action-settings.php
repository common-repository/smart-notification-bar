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
      Call to action settings
    </h3>
    <p>Drive the attention of your visitors by displaying a Call To Action item in your notification bar. You also have the option to hide the CTA when you only want to display a simple informational text in your notification bar.</p>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label>
        <input type="checkbox" name="display_cta" id="display_cta" class="notification-bar-data--checkbox" <?php
        if( $smart_notification_bar->display_cta == 1 ) {
          echo 'checked="checked"';
        }
        ?> /> Display Call To Action (button) in the notification bar
      </label>
      <p class="ep-plugin-form-group__help-text">
        Choose this option if you'd like to display a Call To Action item in your notification bar.
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section smart-notification-bar-cta-section <?php
  if( ! $smart_notification_bar->display_cta ) {
    echo "hidden";
  } ?>">

    <div class="ep-plugin-form-group">
      <label for="cta_style" class="ep-plugin-form-group__label">Call To Action style</label>
      
      <div id="call-to-action-style-list-container">
        <?php
        foreach( SMART_NOTIFICATION_BAR_CTA_STYLE as $style_key => $style_name ) {
          $selected_class = "";
          $selected = false;
          if( $style_key == $smart_notification_bar->cta_style ){
            $selected_class = "selected";
            $selected = true;
          }
          ?>
          <label class="<?php echo esc_attr( $selected_class ); ?>">
            <input type="radio" name="cta_style" class="notification-bar-data--radio" value="<?php echo esc_attr( $style_key ); ?>" <?php 
            if( $selected ){
              echo "checked='checked'";
            }
            ?> /> <?php echo esc_html( $style_name ); ?>
            <br /><span class="button-style-preview cta_style_<?php echo esc_attr( $style_key ); ?>">Button Content</span>
          </label>
          <?php
        }
        ?>
      </div>

      <p class="ep-plugin-form-group__help-text">
        Choose a style for your Call To Action item. You can try different ones and test which one drives the best results for you.
      </p>
      
    </div>
  </div>

  <div class="ep-plugin-card__section smart-notification-bar-cta-section <?php
  if( ! $smart_notification_bar->display_cta ) {
    echo "hidden";
  } ?>">

    <div class="ep-plugin-form-group">
      <label for="cta_style" class="ep-plugin-form-group__label">Call To Action animation</label>
      <p class="ep-plugin-form-group__help-text">
        Move your <strong>mose over</strong> the options to <strong>preview</strong> the animations.
      </p>
      <div id="call-to-action-animation-list-container">
        <?php
        foreach( SMART_NOTIFICATION_BAR_CTA_ANIMATION as $animation_key => $animation_name ) {
          $selected_class = "";
          $selected = "";
          if( $animation_key == $smart_notification_bar->cta_animation ){
            $selected_class = "selected";
            $selected = true;
          }
          ?>
          <label data-animation="<?php echo esc_attr( $animation_key ); ?>">
            <input type="radio" name="cta_animation" class="notification-bar-data--radio" value="<?php echo esc_attr( $animation_key ); ?>" <?php
            if( $selected ){
              echo 'checked="checked"';
            }
            ?> /> <?php echo esc_html( $animation_name ); ?>
            <span class="cta-animation-preview" data-animation="<?php echo esc_attr( $animation_key ); ?>">
              <span></span>
            </span>
          </label>
          <?php
        }
        ?>
      </div>

      <p class="ep-plugin-form-group__help-text">
        To drive the attention of your visitors to the notification bar and to the call to action item, you can set an animation to it. You can try different ones to see which one works the best for you.
      </p>
      
    </div>
  </div>

  <div class="ep-plugin-card__section smart-notification-bar-cta-section <?php
  if( ! $smart_notification_bar->display_cta ) {
    echo "hidden";
  } ?>">

    <div class="ep-plugin-card__columns">
      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="cta_content" class="ep-plugin-form-group__label">Call To Action text</label>
          <input type="text" name="cta_content" id="cta_content" class="notification-bar-data" value="<?php echo esc_html( $smart_notification_bar->cta_content ); ?>" />
          <p class="ep-plugin-form-group__help-text">The text that will be visible in your call to action item. Make it short.</p>
        </div>
      </div>

      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="cta_url" class="ep-plugin-form-group__label">Call To Action URL</label>
          <input type="url" name="cta_url" id="cta_url" class="notification-bar-data" value="<?php echo esc_url( $smart_notification_bar->cta_url ); ?>" />
          <p class="ep-plugin-form-group__help-text">When a visitors clicks on the call to action, they'll end up on the URL you define here.</p>
        </div>
      </div>
    </div>

    <div class="ep-plugin-card__columns">
      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="cta_color" class="ep-plugin-form-group__label">Call To Action font color</label>
          <input type="text" name="cta_color" id="cta_color" class="colorpicker notification-bar-data" value="<?php echo esc_html( $smart_notification_bar->cta_color ); ?>" />
          <p class="ep-plugin-form-group__help-text">
            The color of the text in your call to action item. Use a color that has great contrast with the background of the button.
          </p>

          <label for="cta_font_size" class="ep-plugin-form-group__label">Call To Action font size</label>
          <input type="number" name="cta_font_size" id="cta_font_size" class="notification-bar-data" value="<?php echo intval( $smart_notification_bar->cta_font_size ); ?>" />
          <p class="ep-plugin-form-group__help-text">
            The size of the text in your call to action item. To make it more promiment, use a higher value than the font size of the content.
          </p>
        </div>
      </div>

      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="cta_background" class="ep-plugin-form-group__label">Call To Action background color</label>
          <input type="text" name="cta_background" id="cta_background" class="colorpicker notification-bar-data" value="<?php echo esc_html( $smart_notification_bar->cta_background ); ?>" />
          <p class="ep-plugin-form-group__help-text">
            The background or the border color of the call to action item, depending on the button style you selected above.
          </p>

          <label for="cta_font_family" class="ep-plugin-form-group__label">Call To Action font family</label>
          <select name="cta_font_family" id="cta_font_family" class="notification-bar-data--select selectric">
            <?php
            foreach ( SMART_NOTIFICATION_BAR_FONT_FAMILIES as $font => $cta_font_family ) {
              $font_selected = "";
              if( $smart_notification_bar->cta_font_family == $font ){
                $font_selected = true;
              }
              ?>
              <option value="<?php echo esc_attr( $font ); ?>" <?php 
              if( $font_selected ){
                echo 'selected="selected"';
              }
              ?>><?php echo esc_html( $cta_font_family ); ?></option>
              <?php
            }
            ?>
          </select>
          <p class="ep-plugin-form-group__help-text">
            Use a font family that fits to the look and feel of your theme and make sure that it's easy to read.
          </p>
        </div>
      </div>
    </div>

  </div>
</div><!-- end .ep-plugin-card -->