<?php

// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

/**
 * Display smart notification bar subpages
 */
$smart_notification_bar_subpage = "list-smart-notification-bars";

if( isset( $_GET["page"] ) ){
  $smart_notification_bar_subpage = sanitize_title( $_GET["page"] );
}

$smart_notification_bar = new Smart_Notification_Bar();

$smart_notification_bar_page_path = $smart_notification_bar_subpage . ".view.php";

switch ( $smart_notification_bar_subpage ) {
  /**
   * Display the list of smart notification bars
   */
  case "smart-notification-bars-list":
    if ( file_exists( dirname( __FILE__ ) . "/" . $smart_notification_bar_page_path ) ) {
      /**
       * Get smart notification bars from the database
       */
      $smart_notification_bars = $smart_notification_bar->get_smart_notification_bars();
      include $smart_notification_bar_page_path;
    } else {
      // display 404
      include "smart-notification-bar-404.view.php";
    }
    
    break;

  /**
   * Display form to create a notificaiton bar
   */
  case "smart-notification-bar-create":
    if ( file_exists( dirname( __FILE__ ) . "/" . $smart_notification_bar_page_path ) ) {
      /**
       * Get smart notification bars from the database
       */
      $smart_notification_bars = $smart_notification_bar->get_smart_notification_bars();
      include $smart_notification_bar_page_path;
    } else {
      // display 404
      include "smart-notification-bar-404.view.php";
    }
    
    break;

  /**
   * Display form to edit notification bar
   */
  case "smart-notification-bar-edit":
    if ( file_exists( dirname( __FILE__ ) . "/" . $smart_notification_bar_page_path ) ) {
      /**
       * Get smart notification bars from the database
       */
      $selected_notification_bar_ID = intval( $_GET["id"] );
      $smart_notification_bar_data = $smart_notification_bar->get_smart_notification_bar( $selected_notification_bar_ID );

      if( !$smart_notification_bar_data ){
        include "smart-notification-bar-404.view.php";
        break;
      }

      include $smart_notification_bar_page_path;
    } else {
      // display 404
      include "smart-notification-bar-404.view.php";
    }
    
    break;
  
  default:
    /**
     * Display the list of smart notification bars
     */
    if ( file_exists( dirname( __FILE__ ) . "/" . $smart_notification_bar_page_path ) ) {
      /**
       * Get smart notification bars from the database
       */
      $smart_notification_bars = $smart_notification_bar->get_smart_notification_bars();
      include $smart_notification_bar_page_path;
    } else {
      // display 404
      include "smart-notification-bar-404.view.php";
    }

    break;
}

?>