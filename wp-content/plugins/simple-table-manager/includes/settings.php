<?php
  // Simple Table Manager

  function stm_settings( $current_table ) {

    print '<h2>'.__( 'Simple Table Manager - Settings', 'simple-table-manager' ).'</h2>'.PHP_EOL;

    $info = stm_get_table_info( $current_table );

    $action = isset( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : '';

    switch( $action ) {
      case '':
        break;
      case 'save':
        // table
        $current_table = isset( $_GET['table'] ) ? sanitize_text_field( $_GET['table'] ) : '';
        update_option( 'stm_table', $current_table );
        // rows per page
        $rows_per_page = isset( $_GET['rows_per_page'] ) ? sanitize_text_field( $_GET['rows_per_page'] ): '';
        $rows_per_page = absint( $rows_per_page );
        if( $rows_per_page < 1 ) {
          $rows_per_page = 1;
        }
        if( $rows_per_page > 1000 ) {
          $rows_per_page = 1000;
        }
        update_option( 'stm_rows_per_page', $rows_per_page );
        // unserialize
        $unserialize = isset( $_GET['stm_unserialize'] ) ? 1 : 0;
        update_option( 'stm_unserialize', $unserialize );
        // capability       
        $capability = isset( $_GET['stm_capability'] ) ? sanitize_text_field( $_GET['stm_capability'] ) : '';
        switch ( $capability ) {
          case 'manage_options':
            update_option( 'stm_capability', 'manage_options' );
            break;
          default:
            update_option( 'stm_capability', 'edit_posts' );
        }
        $message = __( 'Settings saved', 'simple-table-manager' );
        stm_message( $message, 'success' );
        break;
      default:
        $message = __( 'Error: Unknown action', 'simple-table-manager' );
        stm_message( $message, 'fail' );
    }

    stm_message( $info['message'], $info['message_type'] );

    // get settings
    $rows_per_page = get_option( 'stm_rows_per_page' );
    $tables = stm_get_tables();

    print '<form method="get">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">';
    print '<input type="hidden" name="tab" value="settings">';
    print '<input type="hidden" name="action" value="save">';
    print '<table class="wp-list-table widefat settings">'.PHP_EOL;
    print '<thead>'.PHP_EOL;
    print '<tr>'.PHP_EOL;
    print '<th>Option</th>'.PHP_EOL;
    print '<th>Value</th>'.PHP_EOL;
    print '</tr>'.PHP_EOL;
    print '</thead>'.PHP_EOL;
    print '<tbody>'.PHP_EOL;
    // table name
    print '<tr>'.PHP_EOL;
    print '<td>' . __( 'Table name', 'simple-table-manager' ) . '</td>'.PHP_EOL;
    print '<td><select name="table">'.PHP_EOL;
    print '<option value="">Select a table ...</option>'.PHP_EOL;
    foreach ( $tables as $table ) {
      if ( $table == $current_table ) {
        print '<option value="'.$table.'" selected>'.$table.'</option>'.PHP_EOL;
      } else {
        print '<option value="'.$table.'">'.$table.'</option>'.PHP_EOL;
      }
    }
    print '</select>'.PHP_EOL;
    print '</tr>'.PHP_EOL;
    // max rows
    print '<tr>'.PHP_EOL;
    print '<td>' . __( 'Max rows per page', 'simple-table-manager' ) . '</td>'.PHP_EOL;
    print '<td><input type="number" name="rows_per_page" value="' . $rows_per_page . '"/></td>'.PHP_EOL;
    print '</tr>'.PHP_EOL;
    // unserialize
    $checked = get_option( 'stm_unserialize' ) ? 'checked' : '' ;
    print '<tr>'.PHP_EOL;
    print '<td style="max-width: 180px;">' . __( 'Edit tab: Show unserialized objects and arrays', 'simple-table-manager' ) . '</td>'.PHP_EOL;
    print '<td><input type="checkbox" name="stm_unserialize" value="1" '.$checked.'/></td>'.PHP_EOL;
    print '</tr>'.PHP_EOL;
    // capability
    $current_value = get_option( 'stm_capability' );
    print '<tr>'.PHP_EOL;
    print '<td>' . __( 'Capability required to use the plugin', 'simple-table-manager' ) . '</td>'.PHP_EOL;
    print '<td>';
    stm_print_radio_button( 'edit_posts', $current_value, 'stm_capability', 'Authors and higher capability' );
    stm_print_radio_button( 'manage_options', $current_value, 'stm_capability', 'Administrators only' );    
    print '</td>';
    print '</tr>'.PHP_EOL;
    print '</tbody>'.PHP_EOL;
    print '</table>'.PHP_EOL;

    $message = __( 'Max rows per page limits: 1 to 1000.', 'simple-table-manager' );
    stm_message( $message, 'help' );

    print '<div class="tablenav bottom">'.PHP_EOL;
    print '<input type="submit" value="' . __( 'Save', 'simple-table-manager' ) . '" class="button button-primary" />'.PHP_EOL;
    print '</div>'.PHP_EOL; // end tablenav

    print '</form>'.PHP_EOL;

  } // end function
