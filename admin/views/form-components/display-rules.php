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
      Display rules
    </h3>
    <p>This is the section where you can define who will see the notification bar.</p>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label>
        <input type="radio" name="visible_to_visitors" value="every" class="notification-bar-data--radio" <?php if( !$smart_notification_bar->visible_to_visitors || $smart_notification_bar->visible_to_visitors == "every" ){
          echo 'checked="checked"';
        } ?> /> <strong>Visible to every visitor</strong> of the website
      </label>

      <label>
        <input type="radio" name="visible_to_visitors" value="loggedin" class="notification-bar-data--radio" <?php if( $smart_notification_bar->visible_to_visitors == "loggedin" ){
          echo 'checked="checked"';
        } ?> /> <strong>Visible only to logged in visitors</strong> of the website
      </label>

      <label>
        <input type="radio" name="visible_to_visitors" value="anonym" class="notification-bar-data--radio" <?php if( $smart_notification_bar->visible_to_visitors == "anonym" ){
          echo 'checked="checked"';
        } ?> /> <strong>Visible only to anonym visitors</strong> of the website (visitors, who are not logged in)
      </label>
      <p class="ep-plugin-form-group__help-text">
        When you choose the first option, the notification bar will be visible to every visitor of your website. Use this option when you'd like to display some important information for all your visitors.
      </p>
      <p class="ep-plugin-form-group__help-text">
        With the second option, you can target only logged in visitors with the notification bar.
      </p>
      <p class="ep-plugin-form-group__help-text">
        The third option can be used to display a notification bar to visitors who are not logged in. With this setting and with the help of a great message, you can easily convert your anonym visitors to registered users. (eg.: Register now and get 10% off on your first order)
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label>
        <input type="radio" name="display_rule" value="wholesite" class="notification-bar-data--radio" <?php if( $smart_notification_bar->display_rule == "wholesite" ){
          echo 'checked="checked"';
        } ?> /> <strong>Display</strong> the notification bar <strong>on every page</strong>
      </label>

      <label>
        <input type="radio" name="display_rule" value="defined_pages" class="notification-bar-data--radio" <?php if( $smart_notification_bar->display_rule == "defined_pages" ){
          echo 'checked="checked"';
        } ?> /> <strong>Display</strong> the notification bar <strong>only on defined pages</strong>
      </label>

      <label>
        <input type="radio" name="display_rule" value="excluded_pages" class="notification-bar-data--radio" <?php if( $smart_notification_bar->display_rule == "excluded_pages" ){
          echo 'checked="checked"';
        } ?> /> <strong>Hide</strong> the notification bar <strong>on defined pages</strong>
      </label>
      <p class="ep-plugin-form-group__help-text">
        If you choose the first option, the notification bar will be visible on the homepage and every subpage of your website. Use this option to display global notification bars (eg.: Free shipping until next Friday.).
      </p>
      <p class="ep-plugin-form-group__help-text">
        With the second option you can define to display the notification bar only on selected pages. For example, you can use this to display something important on a product page (eg.: Just a few items left. Hurry!)
      </p>
      <p class="ep-plugin-form-group__help-text">
        Or you can use the third option to display the notification bar on every page except a few one.
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section display-rule-defined-pages-section <?php if( $smart_notification_bar->display_rule != "defined_pages" ) {
    echo "hidden";
  } ?>">
    <div class="ep-plugin-form-group">
      <label for="allowed_urls" class="ep-plugin-form-group__label">Display the notification bar on the following pages</label>
      <textarea name="allowed_urls" id="allowed_urls" cols="30" rows="5" class="notification-bar-data"><?php echo esc_textarea( $smart_notification_bar->allowed_urls ); ?></textarea>
      <p class="ep-plugin-form-group__help-text"><strong>Add every URL to a new line.</strong></p>
      
      <p class="ep-plugin-form-group__help-text">Use the full URL of the page (without a trailing slash) where you'd like to <strong>display</strong> the notification bar. For example: https://mysite.com/products/show-notification-bar-nice-product<br />
      Use this setting wisely as the notification bar will only <strong>be visible for those</strong> who visit the exact locations you defined above.</p>
      
      <p class="ep-plugin-form-group__help-text">You can also use use <strong>wildcard domain rules</strong> to display the notification bar on multiple pages. For example: https://mysite.com/category/* By adding a rule like this, the notification bar will be visible on every page where the URL starts with https://mysite.com/category/*</p>

      <p class="ep-plugin-form-group__help-text">You can also define your rule like this: *category* This means, that the notification bar will be visible on every page where the URL contains the word "category".</p>
    </div>
  </div>

  <div class="ep-plugin-card__section display-rule-excluded-pages-section <?php if( $smart_notification_bar->display_rule != "excluded_pages" ) {
    echo "hidden";
  } ?>">
    <div class="ep-plugin-form-group">
      <label for="excluded_urls" class="ep-plugin-form-group__label">Hide the notification bar on the following pages</label>
      <textarea name="excluded_urls" id="excluded_urls" cols="30" rows="5" class="notification-bar-data"><?php echo esc_textarea( $smart_notification_bar->excluded_urls ); ?></textarea>
      <p class="ep-plugin-form-group__help-text">
        <strong>Add every URL to a new line.</strong><br />
        Use the full URL of the page where you'd like to <strong>hide</strong> the notification bar. For example: https://mysite.com/products/dont-show-notification-bar-product<br />
        Use this setting wisely as the notification bar will only <strong>be hidden for those</strong> who visit the exact locations you defined above.
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-card__columns">
      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label>
            <input type="checkbox" name="display_on_desktop" value="1" class="notification-bar-data--checkbox" <?php if( $smart_notification_bar->display_on_desktop == 1 ) {
              echo 'checked="checked"';
            } ?> />
            Display <strong>on desktop</strong>
          </label>
          <p class="ep-plugin-form-group__help-text">
            Choose this option if you'd like to display the notification bar for those who are browsing your site on a desktop device.
          </p>
        </div>
      </div>

      <div class="ep-plugin-card__column">
        <div class="ep-plugin-form-group">
          <label>
            <input type="checkbox" name="display_on_mobile" value="1" class="notification-bar-data--checkbox" <?php if( $smart_notification_bar->display_on_mobile == 1 ) {
              echo 'checked="checked"';
            } ?> />
            Display <strong>on mobile</strong>
          </label>
          <p class="ep-plugin-form-group__help-text">
            Choose this option if you'd like to display the notification bar for those who are browsing your site on a mobile device.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="ep-plugin-card__section">
    <div class="ep-plugin-form-group">
      <label>
        <input type="radio" name="display_for_every_visitor" value="1" class="notification-bar-data--radio" <?php if( $smart_notification_bar->display_for_every_visitor == 1 ) {
          echo 'checked="checked"';
        } ?> /> Display for every visitor
      </label>

      <label>
        <input type="radio" name="display_for_every_visitor" value="0" class="notification-bar-data--radio" <?php if( $smart_notification_bar->display_for_every_visitor == 0 ) {
          echo 'checked="checked"';
        } ?> /> Display for visitors from a <strong>specific source (Facebook, Google, Email campaign, etc)</strong>
      </label>

      <p class="ep-plugin-form-group__help-text">
        Use the first option if you'd like to display the notification bar for every visitor of your site. With the second option, you can choose to display the notification bar only to visitors who came from a specific source.
      </p>
    </div>
  </div>

  <div class="ep-plugin-card__section specific-visitor-settings__section <?php if( $smart_notification_bar->display_for_every_visitor == 1 ){
    echo "hidden";
  } ?>">
    <div class="ep-plugin-form-group">
      <label>
        <input type="checkbox" name="display_for_visitors_from_google" id="display_for_visitors_from_google" value="1" class="notification-bar-data--checkbox" <?php if( $smart_notification_bar->display_for_visitors_from_google == 1 ) {
          echo 'checked="checked"';
        } ?> /> Display for visitors who <strong>came from Google</strong>
      </label>
      <p class="ep-plugin-form-group__help-text">
        Choose this option if you'd like to display the notification bar for those visitors who came from Google.
      </p>
    
      <label>
        <input type="checkbox" name="display_for_visitors_from_facebook" id="display_for_visitors_from_facebook" value="1" class="notification-bar-data--checkbox" <?php if( $smart_notification_bar->display_for_visitors_from_facebook == 1 ) {
          echo 'checked="checked"';
        } ?> /> Display for visitors who <strong>came from Facebook</strong>
      </label>
      <p class="ep-plugin-form-group__help-text">
        Choose this option if you'd like to display the notification bar for those visitors who came from Facebook.
      </p>
    
      <label>
        <input type="checkbox" name="display_for_visitors_with_parameter" id="display_for_visitors_with_parameter" value="1" class="notification-bar-data--checkbox" <?php if( $smart_notification_bar->display_for_visitors_with_parameter == 1 ) {
          echo 'checked="checked"';
        } ?> /> Display for visitors <strong>with a specific URL parameter</strong> (eg.: utm_source=email)
      </label>
      <p class="ep-plugin-form-group__help-text">
        Choose this option to target URL-s with a specific parameter. <strong>This can be really useful when you want to display your notificaiton bar based on UTM parameters.</strong>
      </p>
    </div>

    <div id="specific-parameter-settings" class="<?php if( $smart_notification_bar->display_for_visitors_with_parameter != 1 ){
      echo "hidden";
    } ?>">
      <div class="ep-plugin-form-group">
        <label for="display_parameter_rules" class="ep-plugin-form-group__label">Parameter rules</label>
        <textarea name="display_parameter_rules" id="display_parameter_rules" cols="30" rows="5" class="notification-bar-data"><?php echo esc_textarea( $smart_notification_bar->display_parameter_rules ); ?></textarea>
        <p class="ep-plugin-form-group__help-text">
          <strong>Add every parameter rule to a new line.</strong><br />
          You can add the full parameter (like: utm_source=email) or you can use keywords (like: newsletter2020). The notification bar will be visible for those who visit your site with this parameter or keyword in the URL. You can use this to display a notification bar for those who came from an ad, an edm, etc. Just make sure that you add the right parameters to you URLs and use the same parameters in the field above.
        </p>
      </div>
    </div>
  </div>

</div><!-- end .ep-plugin-card -->