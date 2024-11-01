<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}
?>

<div id="smart-notification-bar__editor-preview">
  <div class="preview__container">
    <?php
    $preview_content_style = 'background-color: ' . $smart_notification_bar->background_color . '; ';
    $preview_content_style .= 'height: ' . $smart_notification_bar->height . 'px; ';
    if( strlen( $smart_notification_bar->background_image ) ){
      $preview_content_style .= 'background-image: ' . $smart_notification_bar->background_image . '; ';
    }
    ?>
    <div class="preview__content" style="<?php echo esc_attr( $preview_content_style ); ?>">
    
      <?php
      $preview_body_style = 'font-size: ' . $smart_notification_bar->font_size . ';';
      $preview_body_style .= 'color: ' . $smart_notification_bar->font_color . ';';
      ?>
      <div class="preview__body <?php echo esc_html( $smart_notification_bar->font_family ); ?>" style="<?php echo esc_attr( $preview_body_style ); ?>">
        <?php echo wp_kses( $smart_notification_bar->content, SMART_NOTIFICATION_BAR_ALLOWED_HTML ); ?>
      </div>

      <div class="preview__cta <?php if( ! $smart_notification_bar->display_cta ){
        echo "hidden";
      } ?>">

        <?php
        $preview_cta_style = 'color: ' . $smart_notification_bar->cta_color . ';';
        $preview_cta_style = 'border-color: ' . $smart_notification_bar->cta_background . ';';
        $preview_cta_style .= 'background: ' . $smart_notification_bar->cta_background . ';';
        $preview_cta_style .= 'font-size: ' . $smart_notification_bar->cta_font_size . ';';

        $preview_cta_class = ' ep_smart_notification_bar_cta_style_' . intval( $smart_notification_bar->cta_style );
        $preview_cta_class .= ' ep_smart_notification_bar_cta_animation_' . $smart_notification_bar->cta_animation;
        ?>
        <a 
          class="cta__content <?php echo esc_attr( $preview_cta_class ); ?> <?php echo esc_attr( $smart_notification_bar->cta_font_family ); ?>" 
          href="<?php echo esc_url( $smart_notification_bar->cta_url ); ?>" 
          target="_blank"
          style="<?php echo esc_attr( $preview_cta_style ); ?>">

          <?php echo wp_kses( $smart_notification_bar->cta_content, SMART_NOTIFICATION_BAR_ALLOWED_HTML ); ?>

        </a>
      </div>

      <?php
      $preview_close_button_style = 'color: ' . $smart_notification_bar->close_button_color . ';';
      ?>
      <button
        class="preview__close <?php if( ! $smart_notification_bar->display_close_button ) {
          echo "hidden";
        } ?>"
        style="<?php echo esc_attr( $preview_close_button_style ); ?>">
        &times;
      </button>

    </div>
    <div class="preview__label">
      preview
    </div>
  </div>
</div>