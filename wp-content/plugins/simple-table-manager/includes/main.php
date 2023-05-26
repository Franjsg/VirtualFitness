<?php

  // Simple Table Manager

  defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

  function stm_main() {
    global $wpdb;
    if ( ! current_user_can( get_option( 'stm_capability' ) ) )  {
      wp_die( __( 'You do not have permission to access this page.', 'simple-table-manager' ) );
    }

    // tabs
    $tabs = array(
      'settings' => __( 'Settings', 'simple-table-manager' ),
      'columns'  => __( 'Columns', 'simple-table-manager' ),
      'list'     => __( 'List', 'simple-table-manager' ),
      'edit'     => __( 'Edit', 'simple-table-manager' ),
      'add'      => __( 'Add', 'simple-table-manager' ),
      'export'   => __( 'Export CSV', 'simple-table-manager' ),
    );

    // active tab
    $stm_active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'list';
    // check $table
    $default_table = get_option( 'stm_table' );
    $current_table = isset( $_GET['table'] ) ? $_GET['table'] : $default_table;
    $info = stm_get_table_info( $current_table );
    if( ! $info['valid'] ) {
      $stm_active_tab = 'settings';
    }

    $key_value = isset( $_GET['key_value'] ) ? sanitize_text_field( $_GET['key_value'] ) : '';

    print '<div class="wrap simple-table-manager">';

    $links = array();
    foreach ( $tabs as $slug => $tab_name ) {
      if ( $slug == $stm_active_tab ) {
        $links[] = '<a href="?page=simple-table-manager&tab='.$slug.'" class="nav-tab nav-tab-active">'.$tab_name.'</a>'.PHP_EOL;
      } else {
        if( ! $info['valid'] || ( 'edit' == $slug && '' == $key_value ) ) {
          $links[] = '<span class="nav-tab disabled">'.$tab_name.'</span>'.PHP_EOL;
        } else {
          $links[] = '<a href="?page=simple-table-manager&tab='.$slug.'" class="nav-tab">'.$tab_name.'</a>'.PHP_EOL;
        }
      } // end if
    } // end foreach

    print '<form method="post" enctype="multipart/form-data" novalidate="novalidate">'.PHP_EOL;
    print '<nav class="nav-tab-wrapper">'.PHP_EOL;
    foreach ( $links as $link ) {
      print $link;
    } // end foreach
    print '</nav>'.PHP_EOL; // end tabs nav
    print '</form>'.PHP_EOL;

    switch( $stm_active_tab ) {
      case 'settings':
        stm_settings( $current_table );
        break;
      case 'columns':
        stm_columns( $current_table );
        break;
      case 'list':
        stm_list( $current_table );
        break;
      case'edit':
        stm_edit( $current_table );
        break;
      case 'add':
        stm_add( $current_table );
        break;
      case 'export':
        stm_export( $current_table );
        break;
      default:
        $message = __( 'Error: Invalid tab.', 'simple-table-manager' );
        stm_message( $message, 'error' );
    }
    print '</div>'.PHP_EOL; // end wrap div
  } // end function
