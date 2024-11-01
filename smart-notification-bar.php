<?php
/**
 * @link              https://smartnotificationbar.com
 * @since             1.0.0
 * @package           Smart_Notification_Bar
 *
 * @wordpress-plugin
 * Plugin Name:       🔔 Smart Notification Bar
 * Plugin URI:        https://smartnotificationbar.com
 * Description:       The easiest way to display smart notifications for your visitors to boost sales or display important information
 * Version:           1.0.0
 * Author:            Ecommerce Platforms
 * Author URI:        https://ecommerce-platforms.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smart_notification_bar
 */

// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

define( "SMART_NOTIFICATION_BAR_VERSION", "1.2.0" );
define( "SMART_NOTIFICATION_BAR_CTA_STYLE", ["Default", "Rounded", "Rectangular", "Outlined", "Outlined Rectangular"] );
define( "SMART_NOTIFICATION_BAR_CTA_ANIMATION", ["None", "Jump", "Fade in", "Bounce", "Shake", "Flip"] );
define( "SMART_NOTIFICATION_BAR_FONT_FAMILIES", ["default" => "Default - The default font of your theme", "roboto" => "Roboto", "slabo" => "Slabo", "montserrat" => "Montserrat", "lora" => "Lora", "concert_one" => "Concert One", "rounded" => "Rounded", "courier" => "Courier"] );
define( "SMART_NOTIFICATION_BAR_ALLOWED_HTML", [] );

if( ! class_exists( "Smart_Notification_Bar" ) ){
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-notification-bar.php';
}

/**
 * Plugin has been activated
 */
function activate_smart_notification_bar() {
	$smart_notification_bar = new Smart_Notification_Bar();
  $smart_notification_bar->activate_smart_notification_bar();
}

/**
 * Plugin has been deactivated
 */
function deactivate_smart_notification_bar() {
	$smart_notification_bar = new Smart_Notification_Bar();
  $smart_notification_bar->deactivate_smart_notification_bar();
}

/**
 * Plugin has been uninstalled
 */
function uninstall_smart_notification_bar() {
	$smart_notification_bar = new Smart_Notification_Bar();
  $smart_notification_bar->uninstall_smart_notification_bar();
}

// on activation
register_activation_hook( __FILE__ , "activate_smart_notification_bar" );

// on deactivation
register_deactivation_hook( __FILE__ , "deactivate_smart_notification_bar" );

// on uninstall
register_uninstall_hook( __FILE__ , "uninstall_smart_notification_bar" );

/**
 * Register top level menu
 */
function top_level_menu_smart_notification_bar() {
	add_menu_page(
    "🔔 Notification Bars",
    "Notification Bars",
    "smart_notification_bars",
    'smart-notification-bars',
    "top_level_menu_smart_notification_bar_display",
    "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaWQ9IkxheWVyXzEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDMwIDMwOyIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMzAgMzAiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik0yMiwxNC43NTdWMTJjMC0zLjg2Ni0zLjEzNC03LTctN2gwYy0zLjg2NiwwLTcsMy4xMzQtNyw3djIuNzU3QzgsMTcuNDc0LDYuOTIxLDIwLjA3OSw1LDIybDAsMHYyaDIwdi0ybDAsMCAgQzIzLjA3OSwyMC4wNzksMjIsMTcuNDc0LDIyLDE0Ljc1N3oiLz48cGF0aCBkPSJNMTUsMjljMS42NTcsMCwzLTEuMzQzLDMtM2gtNkMxMiwyNy42NTcsMTMuMzQzLDI5LDE1LDI5eiIvPjxwYXRoIGQ9Ik0xNyw3aC00VjVjMC0xLjEwNSwwLjg5NS0yLDItMmgwYzEuMTA1LDAsMiwwLjg5NSwyLDJWN3oiLz48Y2lyY2xlIGN4PSIyNSIgY3k9IjIzIiByPSIxIi8+PGNpcmNsZSBjeD0iNSIgY3k9IjIzIiByPSIxIi8+PC9zdmc+",
    100
	);
	
  // list notification bars
	add_submenu_page(
    "smart-notification-bars",
    "🔔 Smart Notification Bars",
    "Notification Bars",
    "manage_options",
		"smart-notification-bars-list",
		"top_level_menu_smart_notification_bar_display"
  );

  // create notification bar
  add_submenu_page(
    "smart-notification-bars",
    "🔔 Crete New Notification Bar",
    "Add New",
    "manage_options",
		"smart-notification-bar-create",
		"display_create_smart_notification_bar"
  );

  // edit notification bar
  add_submenu_page(
    "smart-notification-bars",
    "Edit Notification Bar",
    "Edit Notification Bar",
    "manage_options",
		"smart-notification-bar-edit",
		"display_edit_smart_notification_bar"
  );
}

/**
 * Display smart notification bar list
 */
function top_level_menu_smart_notification_bar_display() {
  include "admin/views/smart-notification-bar-layout.view.php";
}

/**
 * Display form to create smart notification bar
 */
function display_create_smart_notification_bar() {
	include "admin/views/smart-notification-bar-layout.view.php";
}

/**
 * Display form to edit smart notification bar
 */
function display_edit_smart_notification_bar() {
	include "admin/views/smart-notification-bar-layout.view.php";
}

add_action( "admin_menu", "top_level_menu_smart_notification_bar" );

/**
 * Hide edit menu from admin navigation
 */
function hide_notification_bar_edit_menu() {
  remove_submenu_page( "smart-notification-bars", "smart-notification-bar-edit" );
}

add_action( "admin_head", "hide_notification_bar_edit_menu" );

/**
 * Load custom CSS for admin
 */
function load_settings_style_smart_notification_bar( $hook ) {
  $smart_notification_bar_hooks_array = [
    "notification-bars_page_smart-notification-bars-list",
    "notification-bars_page_smart-notification-bar-create",
    "notification-bars_page_smart-notification-bar-edit",
  ];

  if ( in_array( $hook, $smart_notification_bar_hooks_array ) ) {
    wp_enqueue_style( "smart_notification_bar_datepicker_css", plugins_url( "admin/assets/css/datepicker.min.css", __FILE__ ) );
    wp_enqueue_style( "smart_notification_bar_spectrum_css", plugins_url( "admin/assets/css/spectrum.min.css", __FILE__ ) );
    wp_enqueue_style( "smart_notification_bar_selectric_css", plugins_url( "admin/assets/css/selectric.min.css", __FILE__ ) );
    wp_enqueue_style( "smart_notification_bar_backend_css", plugins_url( "admin/assets/css/smart-notification-bar.css", __FILE__ ), "", SMART_NOTIFICATION_BAR_VERSION );

    wp_enqueue_script( "smart_notification_bar_spectrum_js", plugins_url( "admin/assets/scripts/spectrum.min.js", __FILE__ ), "", SMART_NOTIFICATION_BAR_VERSION, true );
    wp_enqueue_script( "smart_notification_bar_selectric_js", plugins_url( "admin/assets/scripts/jquery.selectric.min.js", __FILE__ ), "", SMART_NOTIFICATION_BAR_VERSION, true );
    wp_enqueue_script( "smart_notification_bar_backend_js", plugins_url( "admin/assets/scripts/smart-notification-bar.prod.js", __FILE__ ), "", SMART_NOTIFICATION_BAR_VERSION, true );
    wp_enqueue_script( "jquery-ui-datepicker" );
    wp_enqueue_media();
  }
}

add_action( "admin_enqueue_scripts", "load_settings_style_smart_notification_bar" );

function plugin_list_settings_menu_smart_notification_bar( $links ) {
  $smart_notification_bars_link = '<a href="admin.php?page=smart-notification-bars-list">Notification Bars</a>';
  array_push( $links, $smart_notification_bars_link );

  return $links;
}

add_filter( "plugin_action_links_" . plugin_basename( __FILE__ ), "plugin_list_settings_menu_smart_notification_bar" );

/**
 * Process backend ajax requests
 */
function ajax_action_smart_notification_bar() {
  check_ajax_referer( "notification-bar-nonce-string", "nonce", true );
  if (!current_user_can( "manage_options" ) ) {
    wp_die();
  }

  $smart_notification_bar = new Smart_Notification_Bar();

  $notification_bar_action = $_POST["notificationBarAction"];

  switch ( $notification_bar_action ) {
    case "create":
      // create new smart notification bar
      $result = $smart_notification_bar->create_smart_notification_bar();
      wp_send_json( $result );
      break;

    case "update":
      // update smart notification bar
      $result = $smart_notification_bar->update_smart_notification_bar();
      wp_send_json( $result );
      break;

    case "delete":
      // delete smart notification bar
      $result = $smart_notification_bar->delete_smart_notification_bar();
      wp_send_json( $result );
      break;

    case "duplicate":
      // duplicate smart notification bar
      $result = $smart_notification_bar->duplicate_smart_notification_bar();
      wp_send_json( $result );
      break;

    default:
      break;
  }

  wp_die();
}

add_action( "wp_ajax_notification_bar_action", "ajax_action_smart_notification_bar" );

/**
 * Load custom CSS for frontend
 */
function load_frontend_style_smart_notification_bars() {
  wp_enqueue_style( "smart_notification_bar_frontend_css", plugins_url( "public/assets/css/smart-notification-bar.css", __FILE__ ), "", SMART_NOTIFICATION_BAR_VERSION );
  wp_enqueue_script( "smart_notification_bar_frontend_js", plugins_url( "public/assets/scripts/smart-notification-bar.js", __FILE__ ), "", SMART_NOTIFICATION_BAR_VERSION, true );
}

add_action( "wp_enqueue_scripts", "load_frontend_style_smart_notification_bars" );

/**
 * Display smart notificatin bar on the frontend
 */
function display_smart_notification_bar(){
  $smart_notification_bar = new Smart_Notification_Bar();
  $smart_notification_bar->display_smart_notification_bar();
}

add_action( "wp_footer", "display_smart_notification_bar" );