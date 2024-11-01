<?php

// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}

class Smart_Notification_Bar {
  private $db;
  private $prefix;
  private $smart_notification_bars_table;

  public $id = 0;
  public $name;
  public $active = 0;
  public $visible_from;
  public $visible_to;
  public $position = "top";
  public $sticky = 0;
  public $priority;
  public $height = 50;
  public $font_color = "#ffffff";
  public $font_family = "default";
  public $font_size = 16;
  public $background_color = "#009776";
  public $background_image;
  public $background_image_position;
  public $content = "View our latest deals.";
  public $display_cta = 1;
  public $cta_content = "» View deals";
  public $cta_style = 0;
  public $cta_background = "#ffffff";
  public $cta_color = "#009776";
  public $cta_font_size = 12;
  public $cta_font_family = "default";
  public $cta_url = "https://";
  public $cta_animation = 0;
  public $display_close_button = 1;
  public $close_button_color = "#ffffff";
  public $close_button_style = 0;
  public $hidden_after_closed = 1;
  public $hidden_after_closed_lifetime = 30; // the number of days the notification bar will be hidden after closed
  public $display_rule = "wholesite"; // wholesite, defined_pages
  public $allowed_urls = "";
  public $excluded_urls = "";
  public $display_on_desktop = 1;
  public $display_on_mobile = 1;
  public $display_for_every_visitor = 1;
  public $display_for_visitors_from_google = 0;
  public $display_for_visitors_from_facebook = 0;
  public $display_for_visitors_with_parameter = 0;
  public $display_parameter_rules = "";
  public $visible_to_visitors = "every"; // every: visible to every visitor, loggedin: visible to logged in visitors, anonym: visible to anonym - not logged in - visitors
  public $created_at;
  public $updated_at;


  public function __construct() {
    global $wpdb;

    $this->db = $wpdb;
    $this->prefix = $wpdb->prefix;

    $this->smart_notification_bars_table = $wpdb->prefix . "ep_smart_notification_bars";

    $date = new DateTime("now");
    $this->name = "Smart Notification Bar " . $date->format( "Y-m-d" );

    $this->visible_from = $date->format( "Y-m-d" );

    $date->add( new DateInterval("P30D") );
    $this->visible_to = $date->format( "Y-m-d" );

    $this->cta_url = get_site_url();
  }

  /**
   * Run on plugin activation
   */
  public function activate_smart_notification_bar() {
    /**
     * Check user rights
     */
    if ( !current_user_can( "manage_options" ) ) {
      wp_die( "Unauthorized user" );
    }

    /**
     * Create database tables
     */
    if ( !function_exists( "dbDelta" ) ) { 
      require_once ABSPATH . "/wp-admin/includes/upgrade.php"; 
    }

    $smart_notification_bars_table_name = $this->smart_notification_bars_table;

    /**
     * Create smart notification bars table
     */
    $smart_notification_bars_table_create_query = "CREATE TABLE " . $smart_notification_bars_table_name . " ( 
      id int(11) NOT NULL auto_increment ,
      name varchar(250) NOT NULL ,
      active boolean NOT NULL ,
      visible_from date NOT NULL ,
      visible_to date NOT NULL ,
      position varchar(20) NOT NULL ,
      sticky tinyint(1) ,
      priority int(11) ,
      height varchar(40) ,
      font_color varchar(40) ,
      font_family varchar(40) ,
      font_size varchar(40) ,
      background_color varchar(40) ,
      background_image text ,
      background_image_position text ,
      content text ,
      display_cta tinyint(1) ,
      cta_content varchar(150) ,
      cta_style int(2) ,
      cta_background varchar(40) ,
      cta_color varchar(40) ,
      cta_font_size varchar(40) ,
      cta_font_family varchar(40) ,
      cta_url text ,
      cta_animation varchar(20) NOT NULL ,
      display_close_button tinyint(1) ,
      close_button_color varchar(40) ,
      close_button_style int(2) ,
      hidden_after_closed tinyint(1) ,
      hidden_after_closed_lifetime varchar(40) ,
      display_rule varchar(30) ,
      allowed_urls text ,
      excluded_urls text ,
      display_on_desktop tinyint(1) ,
      display_on_mobile tinyint(1) ,
      display_for_every_visitor tinyint(1) ,
      display_for_visitors_from_google tinyint(1) ,
      display_for_visitors_from_facebook tinyint(1) ,
      display_for_visitors_with_parameter tinyint(1) ,
      display_parameter_rules text ,
      visible_to_visitors varchar(10) ,
      additional_settings text ,
      created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
      updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
      PRIMARY KEY  (id)
      )
      CHARSET=utf8mb4
      COLLATE utf8mb4_unicode_ci";

    dbDelta( $smart_notification_bars_table_create_query );
  }

  /**
   * Run on plugin deactivation
   */
  public function deactivate_smart_notification_bar() {
    // nothing to do here
  }

  /**
   * Run on plugin uninstall
   */
  public function uninstall_smart_notification_bar() {
    /**
     * Check user rights
     */
    if ( !current_user_can( "manage_options" ) ) {
      wp_die( "Unauthorized user" );
    }

    /**
     * Remove database tables
     */
    if ( !function_exists( "dbDelta" ) ) { 
      require_once ABSPATH . "/wp-admin/includes/upgrade.php"; 
    }

    $this->db->query( "DROP TABLE IF EXISTS `" . $this->smart_notification_bars_table . "`" );

    return;

  }

  /**
   * List smart notification bars
   */
  public function get_smart_notification_bars() {
    $smart_notification_bars = $this->db->get_results(
      "
      SELECT id, name, active, visible_from, visible_to, content
      FROM " . $this->smart_notification_bars_table . "
      ORDER BY id DESC
      "
    );

    return stripslashes_deep( $smart_notification_bars );
  }

  /**
   * Get data for a selected notification bar
   */
  public function get_smart_notification_bar( $notification_bar_ID ) {
    $selected_notification_bar_ID = intval( $notification_bar_ID );

    $notification_bar_data = $this->db->get_row(
      "
      SELECT *
      FROM " . $this->smart_notification_bars_table . "
      WHERE id = " . $selected_notification_bar_ID . "
      "
    );

    if( $notification_bar_data == null ){
      return false;
    }

    return stripslashes_deep( $notification_bar_data );
  }

  /**
   * Process notification bar data
   */
  public function process_smart_notification_bar_data() {
    $result = [
      "status"  => "error",
      "data"    => ""
    ];

    $error_count = 0;

    /**
     * Check name
     */
    if ( ! $_POST["notificationBarData"]["name"] || strlen( $_POST["notificationBarData"]["name"] ) < 1 ) {
      $error_count++;
    }

    /**
     * Check height
     */
    if ( ! $_POST["notificationBarData"]["height"] || strlen( $_POST["notificationBarData"]["height"] ) < 1 ) {
      $error_count++;
    }

    /**
     * Check visible from and visible to dates if notification bar is active
     */
    if ( $_POST["notificationBarData"]["active"] == "true" && ( ! $_POST["notificationBarData"]["visible_from"] || !$_POST["notificationBarData"]["visible_to"] ) ) {
      $error_count++;
    }

    if ($error_count) {
      $result["data"] = "Please, fill all required fields to create a new Smart Notification Bar";
      return $result;
    }

    $notification_bar_visible_from = isset( $_POST["notificationBarData"]["visible_from"] ) ? sanitize_text_field( $_POST["notificationBarData"]["visible_from"] ) : $this->visible_from;
    $notification_bar_visible_to = isset( $_POST["notificationBarData"]["visible_to"] ) ? sanitize_text_field( $_POST["notificationBarData"]["visible_to"] ) : $this->visible_to;

    $smart_notification_bar_db_data = [
      "content"                             => sanitize_textarea_field( $_POST["notificationBarData"]["content"] ),
      "name"                                => sanitize_text_field( $_POST["notificationBarData"]["name"] ),
      "height"                              => intval( $_POST["notificationBarData"]["height"] ),
      "font_color"                          => sanitize_text_field( $_POST["notificationBarData"]["font_color"] ),
      "font_size"                           => intval( $_POST["notificationBarData"]["font_size"] ),
      "font_family"                         => sanitize_text_field( $_POST["notificationBarData"]["font_family"] ),
      "background_color"                    => sanitize_text_field( $_POST["notificationBarData"]["background_color"] ),
      "background_image"                    => sanitize_text_field( $_POST["notificationBarData"]["background_image"] ),
      "cta_content"                         => sanitize_text_field( $_POST["notificationBarData"]["cta_content"] ),
      "cta_url"                             => sanitize_url( $_POST["notificationBarData"]["cta_url"] ),
      "cta_color"                           => sanitize_text_field( $_POST["notificationBarData"]["cta_color"] ),
      "cta_font_size"                       => intval( $_POST["notificationBarData"]["cta_font_size"] ),
      "cta_font_family"                     => sanitize_text_field( $_POST["notificationBarData"]["cta_font_family"] ),
      "cta_background"                      => sanitize_text_field( $_POST["notificationBarData"]["cta_background"] ),
      "close_button_color"                  => sanitize_text_field( $_POST["notificationBarData"]["close_button_color"] ),
      "allowed_urls"                        => wp_kses_post( $_POST["notificationBarData"]["allowed_urls"] ),
      "excluded_urls"                       => wp_kses_post( $_POST["notificationBarData"]["excluded_urls"] ),
      "display_parameter_rules"             => wp_kses_post( $_POST["notificationBarData"]["display_parameter_rules"] ),
      "visible_from"                        => $notification_bar_visible_from,
      "visible_to"                          => $notification_bar_visible_to,
      "sticky"                              => intval( $_POST["notificationBarData"]["sticky"] ),
      "display_cta"                         => intval( $_POST["notificationBarData"]["display_cta"] ),
      "display_close_button"                => intval( $_POST["notificationBarData"]["display_close_button"] ),
      "hidden_after_closed"                 => intval( $_POST["notificationBarData"]["hidden_after_closed"] ),
      "display_on_desktop"                  => intval( $_POST["notificationBarData"]["display_on_desktop"] ),
      "display_on_mobile"                   => intval( $_POST["notificationBarData"]["display_on_mobile"] ),
      "display_for_visitors_from_google"    => intval( $_POST["notificationBarData"]["display_for_visitors_from_google"] ),
      "display_for_visitors_from_facebook"  => intval( $_POST["notificationBarData"]["display_for_visitors_from_facebook"] ),
      "display_for_visitors_with_parameter" => intval( $_POST["notificationBarData"]["display_for_visitors_with_parameter"] ),
      "active"                              => intval( $_POST["notificationBarData"]["active"] ),
      "position"                            => sanitize_text_field( $_POST["notificationBarData"]["position"] ),
      "cta_style"                           => intval( $_POST["notificationBarData"]["cta_style"] ),
      "cta_animation"                       => intval( $_POST["notificationBarData"]["cta_animation"] ),
      "display_rule"                        => sanitize_text_field( $_POST["notificationBarData"]["display_rule"] ),
      "display_for_every_visitor"           => intval( $_POST["notificationBarData"]["display_for_every_visitor"] ),
      "visible_to_visitors"                 => sanitize_text_field( $_POST["notificationBarData"]["visible_to_visitors"] ),
      "hidden_after_closed_lifetime"        => intval( $_POST["notificationBarData"]["hidden_after_closed_lifetime"] )
    ];

    if ( isset( $_POST["notificationBarData"]["id"] ) && $_POST["notificationBarData"]["id"] > 0 ) {
      $smart_notification_bar_db_data["id"] = intval( $_POST["notificationBarData"]["id"] );
    }

    return $smart_notification_bar_db_data;
  }

  /**
   * Create new smart notification bar
   */
  public function create_smart_notification_bar() {
    $result = [
      "status"  => "error",
      "data"    => ""
    ];

    $smart_notification_bar_db_data = $this->process_smart_notification_bar_data();

    if ( isset( $smart_notification_bar_db_data["status"] ) ) {
      return $smart_notification_bar_db_data;
    }

    $insert_result = $this->db->insert(
      $this->smart_notification_bars_table,
      $smart_notification_bar_db_data
    );

    $new_notification_bar_id = $this->db->insert_id;

    if ( ! $new_notification_bar_id ) {
      $result["data"] = "Database error. Please, turn off and on the plugin and try again. If you keep seeing this error, feel free to get in touch at hello@smartnotificationbar.com";
      return $result;
    }

    // return new notification bar id
    $result["status"] = "success";
    $result["data"] = $new_notification_bar_id;

    return $result;
  }

  /**
   * Update notification bar data
   */
  public function update_smart_notification_bar() {
    $result = [
      "status"  => "error",
      "data"    => ""
    ];
    
    $smart_notification_bar_db_data = $this->process_smart_notification_bar_data();

    if ( isset( $smart_notification_bar_db_data["status"] ) ) {
      return $smart_notification_bar_db_data;
    }

    $notification_bar_id = $smart_notification_bar_db_data["id"];

    unset( $smart_notification_bar_db_data["id"] );

    // update notification bar data
    $update_result = $this->db->update(
      $this->smart_notification_bars_table,
      $smart_notification_bar_db_data,
      array( "id" => $notification_bar_id )
    );

    if ( $update_result === false ) {
      $result["data"] = "Database error. Please, turn off and on the plugin and try again. If you keep seeing this error, feel free to get in touch at hello@smartnotificationbar.com";
      return $result;
    }

    // return success message
    $result["status"] = "success";
    $result["data"] = "Notification Bar updated successfully";

    return $result;
  }

  /**
   * Delete smart noficiation bar
   */
  public function delete_smart_notification_bar() {
    $result = [
      "status"  => "error",
      "data"    => ""
    ];

    $notification_bar_id = intval( $_POST["id"] );
    
    // delete notification bar
    $notification_bar_delete_result = $this->db->delete( $this->smart_notification_bars_table, array( "id" => $notification_bar_id ), array( '%d' ) );

    if ( $notification_bar_delete_result === FALSE ) {
      $result["data"] = "There was an error during the process. Please, reload the page and try again";
    } else {
      $result["status"] = "success";
    }

    return $result;
  }

  /**
   * Duplicate smart notification bar
   */
  public function duplicate_smart_notification_bar() {
    $result = [
      "status"  => "error",
      "data"    => ""
    ];

    $notification_bar_id = intval( $_POST["id"] );
    
    // get data for selected notification bar
    $notification_bar_data = $this->get_smart_notification_bar( $notification_bar_id );

    // remove id
    unset( $notification_bar_data->id );
    // add copy prefix to name
    $notification_bar_data->name = "COPY - " . $notification_bar_data->name;
    // change status to inactive
    $notification_bar_data->active = 0;

    $new_notification_bar_data = [];

    // convert object to array for the database query
    foreach ($notification_bar_data as $key => $value) {
      $new_notification_bar_data[$key] = $value;
    }

    $insert_result = $this->db->insert(
      $this->smart_notification_bars_table,
      $new_notification_bar_data
    );

    if ( !$insert_result ) {
      $result["data"] = "There was an error during the process. Please, reload the page and try again";
    } else {
      $result["status"] = "success";
    } 

    return $result;
  }

  /**
   * Display smart notification bar on the frontend
   */
  public function display_smart_notification_bar() {
    global $wp;
    $smart_notification_bar_display_content = "";
    $smart_notification_bar_position = "top";
    $smart_notification_bar_sticky = "";  
    $notification_bar_sticky_class = "";
    $valid_notification_bars = [];
    $notification_bar_preview_ID = 0;

    /**
     * Get notification bar for preview
     */
    if( isset( $_GET["smbarprvw"] ) && intval( $_GET["smbarprvw"] ) > 0 ){
      $notification_bar_preview_ID = intval( $_GET["smbarprvw"] );

      $valid_notification_bars[0] = $this->db->get_row(
        "
        SELECT *
        FROM " . $this->smart_notification_bars_table . "
        WHERE id = " . $notification_bar_preview_ID . "
        "
      );
    } else {
      /**
       * Get device type - desktop or mobile
       */
      if ( !class_exists( "Mobile_Detect" ) ) {
        include "class-mobile-detect.php";
      }

      $mobile_detect = new Mobile_Detect();
      $is_mobile = $mobile_detect->isMobile();

      /**
       * Get active notification bars from the database
       */
      $today = date( "Y-m-d" );
      $active_notification_bars = $this->db->get_results(
        "
        SELECT *
        FROM " . $this->smart_notification_bars_table . "
        WHERE active = 1
        AND visible_from <= '" . $today . "'
        AND visible_to >= '" . $today . "'
        ORDER BY id DESC
        "
      );

      $referer = isset( $_SERVER["HTTP_REFERER"] ) ? $_SERVER["HTTP_REFERER"] : false;
      $current_url = home_url( add_query_arg( array($_GET), $wp->request ) );
      $url_data = parse_url( $current_url );

      if( count($active_notification_bars) >= 1 ) {
        $valid_notification_bars = $active_notification_bars;
        foreach ( $active_notification_bars as $key => $notification_bar ) {
          /**
           * Check device
           */
          if( $notification_bar->display_on_mobile == 0 && $is_mobile ){
            // visitors is on mobile, but notificaiton bar is disabled for mobile, remove from array
            unset( $valid_notification_bars[ $key ] );
          }

          /**
           * Check devide - desktop
           */
          if( $notification_bar->display_on_desktop == 0 && !$is_mobile ){
            // visitor is on desktop, but notification bar is disabled for desktop, remove from array
            unset( $valid_notification_bars[ $key ] );
          }

          /**
           * Check referer
           */
          if( ! $notification_bar->display_for_every_visitor ){
            // check google
            if( $notification_bar->display_for_visitors_from_google ){
              if( $referer && preg_match( "/\b(google.|g.co)\b/", $referer ) < 1 ){
                // visitor didn't come from google, remove 
                unset( $valid_notification_bars[ $key ] );
              }
            }

            // check facebook
            if( $notification_bar->display_for_visitors_from_facebook ){
              if( $referer && preg_match( "/\b(facebook.|fb.)\b/", $referer ) < 1 ){
                // visitor didn't come from facebook, remove 
                unset( $valid_notification_bars[ $key ] );
              }
            }

            // check with specific param
            if( $notification_bar->display_for_visitors_with_parameter ){
              $display_parameter_rules = explode( "\n", $notification_bar->display_parameter_rules );

              $parameter_match = false;
              if( count( $display_parameter_rules ) >= 1 ){
                // check parameter in current url
                foreach( $display_parameter_rules as $parameter ){
                  if( strlen( $parameter ) && strpos( $current_url, $parameter ) !== false ){
                    $parameter_match = true;
                  }
                }
              }

              if( !$parameter_match ){
                // url is not containing specified parameter, remove from array
                unset( $valid_notification_bars[ $key ] );
              }
            }
          }

          /**
           * Check allowed URL
           */
          if( $notification_bar->display_rule == "defined_pages" ){
            $allowed_urls = explode( "\n", $notification_bar->allowed_urls );

            $allowed_url_match = false;
            if( count( $allowed_urls ) >= 1 ){
              foreach ( $allowed_urls as $allowed_url ) {
                // check if url rule is wildcard
                if( strpos( $allowed_url, "*" ) !== false ) {
                  // wildcard url
                  $wildcard_url = str_replace( "*", "", $allowed_url );
                  if( strpos( $current_url, $wildcard_url ) !== false ) {
                    $allowed_url_match = true;
                  }
                } else {
                  // check if current url equals to allowed url
                  if( $allowed_url == $current_url ){
                    $allowed_url_match = true;
                  }
                }
              }
            }

            if( !$allowed_url_match ){
              // url doesnt match any allowed parameters, remove from array
              unset( $valid_notification_bars[ $key ] );
            }
          }

          /**
           * Check excluded URL
           */
          if( $notification_bar->display_rule == "excluded_pages" ){
            $excluded_urls = explode( "\n", $notification_bar->excluded_urls );

            $excluded_url_match = false;
            if( count( $excluded_urls ) >=1 ){
              foreach ( $excluded_urls as $excluded_url ) {
                if( $excluded_url == $current_url ){
                  $excluded_url_match = true;
                }
              }
            }

            if( $excluded_url_match ){
              // current url is excluded, remove from array
              unset( $valid_notification_bars[ $key ] );
            }
          }

          /**
           * Check cookies
           */
          if( isset( $_COOKIE["ep-notification-bar-cookie-" . $notification_bar->id ]) && $notification_bar->hidden_after_closed == 1 ){
            // visitor closed the notificaiton bar previously, remove from array
            unset( $valid_notification_bars[ $key ] );
          }

          /**
           * Check logged in status
           */
          if( $notification_bar->visible_to_visitors && $notification_bar->visible_to_visitors != "every" ){
            // check logged in status
            if( $notification_bar->visible_to_visitors == "loggedin" && !is_user_logged_in() ){
              // user is not logged in, but this notification bar is only visible to logged in users
              // remove the notification bar from the array of valid notification bars
              unset( $valid_notification_bars[ $key ] );
            }

            // check logged in state
            if( $notification_bar->visible_to_visitors == "anonym" && is_user_logged_in() ){
              // user is logged in, but this notification bar is only visible to anonym user
              // remove the notification bar from the array of valid notification bars
              unset( $valid_notification_bars[ $key ] );
            }
          }

        }
      }
    }

    if( count( $valid_notification_bars ) >= 1 ){
      $notification_bar_index = array_keys( $valid_notification_bars )[0];
      $notification_bar = stripslashes_deep( $valid_notification_bars[ $notification_bar_index ] );

      $smart_notification_bar_position = $notification_bar->position;
      
      if( $notification_bar->sticky == 1 ){
        $notification_bar_sticky_class = "ep-smart-notification-bar--sticky";
        $smart_notification_bar_sticky = "sticky";
      }

      $notification_bar_style = "";

      // set background color
      if( strlen( $notification_bar->background_color ) > 0 ){
        $notification_bar_style .= "background-color: " . $notification_bar->background_color . ";";
      }

      // set background image
      if( strlen( $notification_bar->background_image ) > 0 ){
        $notification_bar_style .= "background-image: url('" . $notification_bar->background_image . "'); background-position: center center; background-repeat: no-repeat; background-size: cover;";
      }

      // set height
      if( strlen( $notification_bar->height ) > 0 ){
        $notification_bar_style .= "min-height: " . $notification_bar->height . "px;";
      }

      $smart_notification_bar_display_content = '<div class="ep-smart-notification-bar ep-smart-notification-bar--' . esc_attr( $notification_bar->position ) . ' ' . $notification_bar_sticky_class . '" id="ep-smart-notification-bar-' . esc_attr( $notification_bar->id ) . '" style="' . esc_attr( $notification_bar_style ) . '">';

      /**
       * Notification bar body
       */
      $notification_bar_content_style = "";
      
      // set font color
      if( strlen( $notification_bar->font_color ) ){
        $notification_bar_content_style .= "color: " . $notification_bar->font_color . ";";
      }
      // set font size
      if( strlen( $notification_bar->font_size ) ){
        $notification_bar_content_style .= "font-size: " . $notification_bar->font_size . "px;";
      }

      $smart_notification_bar_display_content .= '<div class="ep-smart-notification-bar__body ' . $notification_bar->font_family . '" style="' . esc_attr( $notification_bar_content_style ) . '">' . htmlspecialchars_decode( $notification_bar->content ) . '</div>';

      /**
       * CTA
       */
      if( $notification_bar->display_cta == 1 ){
        $notification_bar_cta_class = "";
        $notification_bar_cta_style = "";

        // color
        if( strlen( $notification_bar->cta_color ) > 0 ){
          $notification_bar_cta_style = 'color: ' . $notification_bar->cta_color . ';';
        }
        // background color
        if( strlen( $notification_bar->cta_background ) ){
          $notification_bar_cta_style .= 'background: ' . $notification_bar->cta_background . ';';
          $notification_bar_cta_style .= 'border-color: ' . $notification_bar->cta_background . ';';
        }
        // font size
        if( strlen( $notification_bar->cta_font_size ) ){
          $notification_bar_cta_style .= 'font-size: ' . $notification_bar->cta_font_size . 'px;';
        }

        $notification_bar_cta_class = ' ep-smart-notification-bar__cta--' . intval( $notification_bar->cta_style );
				$notification_bar_cta_class .= ' ep-smart-notification-bar__cta-animation--' . $notification_bar->cta_animation;

        $smart_notification_bar_display_content .= '<div class="ep-smart-notification-bar__cta"><a href="' . esc_url( $notification_bar->cta_url ) . '" target="_blank" class="' . esc_attr( $notification_bar_cta_class ) . ' ' . esc_attr( $notification_bar->cta_font_family ) . '" style="' . esc_attr( $notification_bar_cta_style ) . '">' . esc_html( $notification_bar->cta_content ) . '</a></div>';
      }

      /**
       * Close button
       */
      if( $notification_bar->display_close_button ){
        $notification_bar_close_button_style = 'color: ' . $notification_bar->close_button_color . ';';
        $hidden_after_closed_lifetime = "";
        if( $notification_bar->hidden_after_closed == 1 ){
          $hidden_after_closed_lifetime = intval( $notification_bar->hidden_after_closed_lifetime );
        }

        $smart_notification_bar_display_content .= '<button class="ep-smart-notification-bar__close" style="' . esc_attr( $notification_bar_close_button_style ) . '" data-id="' . intval( $notification_bar->id ) . '" data-lifetime="' . esc_attr( $hidden_after_closed_lifetime ) . '">&times;</button>';
      }

      $smart_notification_bar_display_content .= '</div>';
    }

    if( count( $valid_notification_bars ) >= 1 ){  
      echo '<script>const epNotificationBarPreviewId = ' . intval( $notification_bar_preview_ID ) . ';</script>';

      echo '<div id="ep_smart_notification_bar_root" class="ep_smart_notification_bar_root--' . esc_attr( $smart_notification_bar_position ) . ' ep_smart_notification_bar_root--' . esc_attr( $smart_notification_bar_sticky ) . '">' . $smart_notification_bar_display_content . '</div>';
    }

    return;
  }
}