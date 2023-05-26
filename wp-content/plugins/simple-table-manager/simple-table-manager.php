<?php
  /*
  Plugin Name: Simple Table Manager
  Description: Enables editing table records and exporting them to CSV files through a minimal database interface from your dashboard.
  Version:     1.5.5
  Author:      Ryo Inoue & lorro
  Author URI:  http://www.topcode.co.uk/developments/simple-table-manager/
  License:     GPLv3
  License URI: https://www.gnu.org/licenses/gpl-3.0.html
  Text Domain: simple-table-manager
  Domain Path: /languages/
  */
  
  defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );
  
  $stm_version = '1.5.4';
  
  define( 'STM_PATH', plugin_dir_path( __FILE__ ) );
  // eg: STM_PATH = '/home/.../public_html/my-domain/wp-content/plugins/simple-table-manager/';
  
  define( 'STM_URL', plugin_dir_url( __FILE__ ) );
  // eg: STM_URL = 'http://www.my-domain.co.uk/wp-content/plugins/simple-table-manager/';
    
  define( 'STM_DELIMITER', ',' );
  define( 'STM_NEW_LINE', "\r\n" );
  
  // set default options
  // add_option() will not change the option if it exists
  add_option( 'stm_table', '' );
  add_option( 'stm_rows_per_page', 20 );
  add_option( 'stm_unserialize', 1 );
  add_option( 'stm_csv_filename', 'export.csv' );
  add_option( 'stm_csv_encoding', 'UTF-8' );
  add_option( 'stm_csv_columns', 'all' ); // 'all' or 'some'
  add_option( 'stm_capability', 'edit_posts' ); 
      
  // translations
  add_action( 'plugins_loaded', 'stm_custom_load_textdomain' );
  function stm_custom_load_textdomain() {
    // load_plugin_textdomain( $domain, $abs_rel_path__DEPRECATED, $plugin_rel_path );
    load_plugin_textdomain( 'simple-table-manager', false,  STM_PATH. 'languages' );
  }
  
  // register style
  add_action( 'wp_loaded', 'stm_register_assets' );
  function stm_register_assets() {
    global $stm_version;
    wp_register_style( 'stm_admin_css', STM_URL.'css/admin.css', array(), $stm_version );
  }
  
  // enqueue styles
  add_action( 'admin_enqueue_scripts', 'stm_admin_enqueue_assets' );
  function stm_admin_enqueue_assets() {
    wp_enqueue_style( 'stm_admin_css' );
  }

  require_once( 'includes/add.php' );
  require_once( 'includes/columns.php' );
  require_once( 'includes/edit.php' );
  require_once( 'includes/export-csv.php' );
  require_once( 'includes/functions.php' );
  require_once( 'includes/list.php' );
  require_once( 'includes/main.php' );
  require_once( 'includes/settings.php' );
  require_once( 'includes/tables.php' );
     
  // add custom items to the dashboard
  add_action( 'admin_menu', 'stm_add_menu_item' );
  function stm_add_menu_item() {
    global $stm_page;
    // add_menu_page( page_title, menu_title, capability, menu_slug, callable_function, icon_url, position )
    $plugin_name = __( 'Simple Table Manager', 'simple-table-manager' );
    $stm_page = add_menu_page( $plugin_name, $plugin_name, get_option( 'stm_capability' ), 'simple-table-manager', 'stm_main', '', 76 );
    add_action( "load-$stm_page", 'stm_do_export' );
  } // end function
