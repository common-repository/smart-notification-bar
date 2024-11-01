<?php
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}
?>

<div class="wrap">

  <h1 class="wp-heading-inline">Smart Notification Bar</h1>
  <a href="admin.php?page=smart-notification-bar-create" class="page-title-action">Add New Notification Bar</a>

  <hr class="wp-header-end" />

  <?php
  /**
   * Display plugin related system messages, eg deleted, updated, duplicated
   */
  $plugin_message = "";
  $plugin_message_content = "";
  if( isset( $_GET["msg"] ) ){
    $plugin_message = $_GET["msg"];
  }
  switch ( $plugin_message ) {
    case "deleted":
      $plugin_message_content = 'Notification Bar deleted.';
      break;

    case "duplicated":
      $plugin_message_content = 'Notification Bar duplicated.';
      break;
    
    default:
      $plugin_message_content = "";
      break;
  }

  if ( $plugin_message != "" && $plugin_message_content != "" ) {
    ?>
    <div id="message" class="updated notice is-dismissible"><p><?php echo esc_html( $plugin_message_content ); ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>
    <?php
  }
  ?>

  <ul class="subsubsub">
    <li>
      <?php
      if ( count( $smart_notification_bars ) > 1 ) {
        echo count( $smart_notification_bars ) . " Notification Bars";
      } elseif ( count( $smart_notification_bars ) == 1 ) {
        echo "1 Notification Bar";
      } elseif ( count( $smart_notification_bars ) == 0 ) {
        echo "You haven't created any Notification Bars yet";
      }
      ?>
    </li>
  </ul>

  <div class="tablenav top">
  </div>

  <?php
  if ( $smart_notification_bars ) {
    ?>
    <table class="wp-list-table widefat fixed striped posts">
      <thead>
        <tr>
          <th scope="col" class="column-title manage-column column-primary" width="300">
            Name
          </th>

          <th scope="col" class="column-title manage-column" width="100">
            Status
          </th>

          <th scope="col" class="column-title manage-column">
            Visible from
          </th>

          <th scope="col" class="column-title manage-column">
            Visible to
					</th>
					
					<th scope="col" class="column-title manage-column" width="200">
            Content
          </th>

          <th scope="col" class="column-title manage-column" width="150">
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach( $smart_notification_bars as $notification_bar ) {
          ?>
          <tr>
            <td>
              <strong>
                <a href="admin.php?page=smart-notification-bar-edit&id=<?php echo esc_attr( $notification_bar->id ); ?>" class="row-title">
                  <?php
                  echo esc_html( $notification_bar->name );
                  ?>
                </a>
              </strong>
            </td>

            <td>
              <?php
              if ( $notification_bar->active == true ) {
                // check notification bar expire date
                $expired = false;
                if( $notification_bar->visible_to < date( "Y-m-d" ) ){
                  $expired = true;
                }
                ?>
                <span class="ep-plugin-badge <?php if( $expired ) {
                  echo "ep-plugin-badge--expired";
                } else {
                  echo "ep-plugin-badge--active";
                } ?>">
                active
                <?php
                if( $expired ){
                  echo " - expired";
                }
                ?>
                </span>
                <?php
              } else {
                ?>
                <span class="ep-plugin-badge ep-plugin-badge--inactive">inactive</span>
                <?php
              }
              ?>              
            </td>

            <td>
              <?php
              // visible from
              echo esc_attr( $notification_bar->visible_from );
              ?>
            </td>

            <td>
              <?php
              // visible to
              echo esc_attr( $notification_bar->visible_to );
              ?>
            </td>

            <td>
							<?php
							// content
							echo esc_html( mb_substr( $notification_bar->content, 0, 30 ) );
							?>...
            </td>

            <td align="right">
              <button class="ep-plugin__link button--notification-bar-duplicate" data-notification-bar-id="<?php echo esc_attr( $notification_bar->id ); ?>">
                Duplicate
                <i class="hidden">
                  <svg class="ep-plugin-spin" width="25" height="15" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M33 20.5C33 22.9723 32.2669 25.389 30.8934 27.4446C29.5199 29.5002 27.5676 31.1024 25.2835 32.0485C22.9995 32.9946 20.4861 33.2421 18.0614 32.7598C15.6366 32.2775 13.4093 31.087 11.6612 29.3388C9.91301 27.5907 8.7225 25.3634 8.24018 22.9386C7.75787 20.5139 8.00541 18.0005 8.95151 15.7165C9.8976 13.4324 11.4998 11.4801 13.5554 10.1066C15.611 8.73311 18.0277 8 20.5 8L20.5 13C19.0166 13 17.5666 13.4399 16.3332 14.264C15.0999 15.0881 14.1386 16.2594 13.5709 17.6299C13.0032 19.0003 12.8547 20.5083 13.1441 21.9632C13.4335 23.418 14.1478 24.7544 15.1967 25.8033C16.2456 26.8522 17.582 27.5665 19.0368 27.8559C20.4917 28.1453 21.9997 27.9968 23.3701 27.4291C24.7406 26.8614 25.9119 25.9001 26.736 24.6668C27.5601 23.4334 28 21.9834 28 20.5H33Z" fill="white">
                    </path>
                  </svg>
                </i>
              </button>
                      
              <a class="button" href="admin.php?page=smart-notification-bar-edit&id=<?php echo intval( $notification_bar->id ); ?>">Edit</a>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>

      <tfoot>
        <tr>
					<th scope="col" class="column-title manage-column column-primary">
            Name
          </th>

          <th scope="col" class="column-title manage-column">
            Status
          </th>

          <th scope="col" class="column-title manage-column">
            Visible from
          </th>

          <th scope="col" class="column-title manage-column">
            Visible to
					</th>
					
					<th scope="col" class="column-title manage-column">
            Content
          </th>

          <th scope="col" class="column-title manage-column">
          </th>
        </tr>
      </tfoot>
    </table>

    <?php
  } else {
    ?>
    <div class="ep-plugin-welcome-panel">
      <div class="ep-plugin-welcome-panel-content">
        <h2>Welcome to Smart Notification Bar!</h2>
        <p class="about-description">
          You haven't created any Notification Bars yet. Click the button below to get started.
        </p>

        <p>&nbsp;</p>

        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/Rha2rawtbKs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        
        <h3>Get started</h3>
        <a class="button button-primary button-hero" href="admin.php?page=smart-notification-bar-create">Add New Notification Bar</a>
        <p>
          or <a href="https://smartnotificationbar.com/create-wordpress-notification-bar.html" target="_blank">learn how to create your first Notification Bar</a>
        </p>
      </div>
    </div>
    <?php
  }
  ?>

  <div class="ep-plugin-helptext">
    <p>
      <span class="ep-plugin-helptext__icon">
        <svg viewBox="0 0 20 20" focusable="false" aria-hidden="true"><circle cx="10" cy="10" r="9" fill="#ffffff"></circle><path d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0m0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8m0-4a1 1 0 1 0 0 2 1 1 0 1 0 0-2m0-10C8.346 4 7 5.346 7 7a1 1 0 1 0 2 0 1.001 1.001 0 1 1 1.591.808C9.58 8.548 9 9.616 9 10.737V11a1 1 0 1 0 2 0v-.263c0-.653.484-1.105.773-1.317A3.013 3.013 0 0 0 13 7c0-1.654-1.346-3-3-3"></path></svg>
      </span>
      Learn more about
      <a href="https://smartnotificationbar.com/#use-cases" target="_blank" class="ep-plugin-link--external">how to use notification bars to grow your business</a>
      <span class="ep-plugin-external-link-icon">
        <svg viewBox="0 0 20 20" focusable="false" aria-hidden="true"><path d="M13 12a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H6c-.575 0-1-.484-1-1V7a1 1 0 0 1 1-1h1a1 1 0 0 1 0 2v5h5a1 1 0 0 1 1-1zm-2-7h4v4a1 1 0 1 1-2 0v-.586l-2.293 2.293a.999.999 0 1 1-1.414-1.414L11.586 7H11a1 1 0 0 1 0-2z"></path></svg>
      </span>
    </p>
  </div>

</div>

<script>
  var notificationBarNonce = '<?php echo wp_create_nonce( "notification-bar-nonce-string" ); ?>';
</script>