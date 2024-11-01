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
      Notification Bar Content
    </h3>
    <p>This is where you can define the message you'd like to display in your notification bar.</p>
  </div>
  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label for="content" class="ep-plugin-form-group__label">Content</label>
      <textarea type="text" name="content" id="content" class="notification-bar-data" data-field-error="The content of the notification bar is required" rows="3" cols="2"><?php echo esc_html( $smart_notification_bar->content ); ?></textarea>
      <p class="ep-plugin-form-group__help-text">Try to <strong>keep it short</strong> and easy to understand. You can <strong>use emojis</strong> to make your message pop.</p>
    </div>
  </div>

  <div class="ep-plugin-card__section">
    <h3 class="ep-plugin-card__title">
      Notification Bar Design
    </h3>
    <p>Define the look and feel of your notification bar by changing the settings below.</p>
  </div>

  <div class="ep-plugin-card__section ep-plugin-card__section--closed" id="template-section">
    <div class="ep-plugin-form-group">
      <label class="ep-plugin-form-group__label ep-plugin-form-group__label--accordion">
        <span>
          <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 10V5L13 10L8 15V10Z" fill="#C4C4C4"/>
          </svg>
        </span>
        Templates
      </label>

      <div class="ep-plugin-form-group__body">
        <p class="ep-plugin-form-group__help-text"><strong>Click on the images to preview or use the template</strong></p>

        <div id="ep-plugin__template-list">
          <label data-template="light">
            <span class="template-name">Light</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/light.png", __DIR__ ); ?>" alt="Notification Bar light template">
            </span>
          </label>

          <label data-template="dark">
            <span class="template-name">Dark</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/dark.png", __DIR__ ); ?>" alt="Notification Bar dark template">
            </span>
          </label>

          <label data-template="easter">
            <span class="template-name">Easter</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/easter.png", __DIR__ ); ?>" alt="Notification Bar easter template">
            </span>
          </label>

          <label data-template="summer">
            <span class="template-name">Summer</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/summer.png", __DIR__ ); ?>" alt="Notification Bar summer template">
            </span>
          </label>

          <label data-template="backtoschool">
            <span class="template-name">Back To School</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/backtoschool.png", __DIR__ ); ?>" alt="Notification Bar back to school template">
            </span>
          </label>

          <label data-template="halloween">
            <span class="template-name">Halloween</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/halloween.png", __DIR__ ); ?>" alt="Notification Bar Halloween template">
            </span>
          </label>

          <label data-template="blackfriday">
            <span class="template-name">Black Friday</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/blackfriday.png", __DIR__ ); ?>" alt="Notification Bar Black Friday template">
            </span>
          </label>

          <label data-template="christmas">
            <span class="template-name">Christmas</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/christmas.png", __DIR__ ); ?>" alt="Notification Bar Christmas template">
            </span>
          </label>

          <label data-template="discount">
            <span class="template-name">Discount</span>
            <span class="notification-bar-template-preview">
              <img src="<?php echo plugins_url( "../assets/images/templates/discount.png", __DIR__ ); ?>" alt="Notification Bar discount template">
            </span>
          </label>
          
        </div>
        
      </div>
    </div>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-card__columns">
      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="height" class="ep-plugin-form-group__label">Height</label>
          <input type="number" name="height" id="height" class="notification-bar-data" value="<?php echo intval( $smart_notification_bar->height ); ?>" data-field-error="Height is required" />
        </div>
      </div>
      <div class="ep-plugin-card__column">
        <!-- placeholder -->
      </div>
    </div>
    <p class="ep-plugin-form-group__help-text">Try to keep the height as low as possible, especially when you make the position sticky to avoid content overlapping.</p>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-card__columns">
      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="font_color" class="ep-plugin-form-group__label">Font color</label>
          <input type="text" name="font_color" id="font_color" class="colorpicker notification-bar-data" value="<?php echo esc_html( $smart_notification_bar->font_color ); ?>" />
          <p class="ep-plugin-form-group__help-text">The color of the content in your notification bar. For better readability pick a color that'll have a great contrast with the background color you use.</p>
        
          <label for="font_size" class="ep-plugin-form-group__label">Font size</label>
          <input type="number" name="font_size" id="font_size" class="notification-bar-data" value="<?php echo intval( $smart_notification_bar->font_size ); ?>" />
          <p class="ep-plugin-form-group__help-text">The size of the content in your notification bar. Make sure that it'll be visible on smaller screens as well.</p>
        </div>
      </div>

      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="font_family" class="ep-plugin-form-group__label">Font family</label>
          <select name="font_family" id="font_family" class="notification-bar-data--select selectric">
            <?php
            foreach ( SMART_NOTIFICATION_BAR_FONT_FAMILIES as $font => $font_family ) {
              $font_selected = "";
              if( $smart_notification_bar->font_family == $font ){
                $font_selected = true;
              }
              ?>
              <option value="<?php echo esc_attr( $font ); ?>" <?php
              if( $font_selected ){
                echo 'selected="selected"';
              }
              ?>><?php echo esc_html( $font_family ); ?></option>
              <?php
            }
            ?>
          </select>
          <p class="ep-plugin-form-group__help-text">Use a font family that fits to the look and feel of your theme and make sure that it's easy to read.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-card__columns">
      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="background_color" class="ep-plugin-form-group__label">Background color</label>
          <input type="text" name="background_color" id="background_color" class="colorpicker notification-bar-data" value="<?php echo esc_html( $smart_notification_bar->background_color ); ?>" />
          <p class="ep-plugin-form-group__help-text">The background color of the notification bar. For better readability pick a color that'll have a great contrast with the content color you use.</p>
        </div>
      </div>

      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label for="background_image" class="ep-plugin-form-group__label">Background image</label>

          <button class="button" type="button" id="upload_background_image">Select Background Image</button>

          <input type="hidden" name="background_image" id="background_image" class="notification-bar-data" value="<?php echo esc_html( $smart_notification_bar->background_image ); ?>" />
          <p class="ep-plugin-form-group__help-text">The background image will be positioned to the center of your notification bar and will be stretched to fit the width of it. Ideal size: the height of your notification bar, and min. 1920px width.</p>
        </div>

        <div id="background-image-preview" class="<?php if( strlen( $smart_notification_bar->background_image ) < 3 ) {
          echo "hidden";
        } ?>">
          <div class="ep-plugin-form-group">
            <img src="<?php echo esc_html( $smart_notification_bar->background_image ); ?>" class="img-fluid" />
            <button type="button" class="button button-link-delete" id="background-image-remove">Remove image</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- end .ep-plugin-card -->