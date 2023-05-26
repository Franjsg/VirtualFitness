<?php
  // Simple Table Manager

  defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

  function stm_export( $current_table ) {
    global $wpdb;

    print '<h2>'.__( 'Simple Table Manager - Export CSV', 'simple-table-manager' ).'</h2>'.PHP_EOL;

    $info = stm_get_table_info( $current_table );
    $columns = $info['columns']; // array( 'name' => type )
    $nr_columns = count( $columns );
    $key_name = $info['key_name'];
    $key_is_int = $info['key_is_int'];
    $auto_increment = $info['auto_increment'];
    $hiddens = $info['hiddens'];
    $nr_hiddens = count( $hiddens );
    $nr_showing = $nr_columns - $nr_hiddens;

    $csv_filename = get_option( 'stm_csv_filename' );
    $csv_encoding = get_option( 'stm_csv_encoding' );

    $action = isset( $_GET['action'] ) ? $_GET['action'] : '';

    switch( $action ) {
      case '':
        break;
      case 'save':
        // csv filename
        $csv_filename = isset( $_GET['csv_filename'] ) ? $_GET['csv_filename'] : '';
        update_option( 'stm_csv_filename', $csv_filename );
        // csv_encoding
        $csv_encoding = isset( $_GET['csv_encoding'] ) ? $_GET['csv_encoding'] : '';
        update_option( 'stm_csv_encoding', $csv_encoding );
        // csv_columns
        // setting will be hidden if columns are not filtered
        $csv_columns = isset( $_GET['csv_columns'] ) ? $_GET['csv_columns'] : '';
        if( 'all' == $csv_columns || 'some' == $csv_columns ) {
          update_option( 'stm_csv_columns', $csv_columns );
        }
        $message = __( 'Settings saved', 'simple-table-manager' );
        stm_message( $message, 'success' );
        break;
      default:
        $message = __( 'Error: Invalid action.', 'simple-table-manager' );
        stm_message( $message, 'fail' );
    }

    stm_message( $info['message'], $info['message_type'] );

    // get settings
    $csv_filename = get_option( 'stm_csv_filename' );
    $csv_encoding  = get_option( 'stm_csv_encoding' );
    $csv_columns  = get_option( 'stm_csv_columns' ); // 'all' or 'some'

    print '<form method="get">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">';
    print '<input type="hidden" name="tab" value="export">';
    print '<input type="hidden" name="action" value="save">';

    print '<table class="wp-list-table widefat settings">'.PHP_EOL;
    print '<thead>'.PHP_EOL;
    print '<tr>'.PHP_EOL;
    print '<th>Option</th>'.PHP_EOL;
    print '<th>Value</th>'.PHP_EOL;
    print '</tr>'.PHP_EOL;
    print '</thead>'.PHP_EOL;
    print '<tbody>'.PHP_EOL;
    // csv filename
    print '<tr>'.PHP_EOL;
    print '<td class="simple-table-manager">'.__( 'CSV file name', 'simple-table-manager' ).'</td>'.PHP_EOL;
    print '<td><input type="text" name="csv_filename" value="'.$csv_filename.'"/></td>'.PHP_EOL;
    print '</tr>'.PHP_EOL;
    // csv encoding
    print '<tr>'.PHP_EOL;
    print '<td class="simple-table-manager">'.__( 'CSV encoding', 'simple-table-manager' ).'</td>'.PHP_EOL;
    print '<td><input type="text" name="csv_encoding" value="'.$csv_encoding.'"/></td>'.PHP_EOL;
    print '</tr>'.PHP_EOL;
    // columns
    if( $nr_showing < $nr_columns ) {
      print '<tr>'.PHP_EOL;
      print '<td class="simple-table-manager">'.__( 'Columns', 'simple-table-manager' ).'</td>'.PHP_EOL;
      print '<td>';
      // stm_print_radio_button( $value, $current_value, $name, $text )
      $text = __( 'All columns',' simple-table-manager' );
      stm_print_radio_button( 'all', $csv_columns, 'csv_columns', $text );
      $text = sprintf( __( 'Selected %1$d columns out of %2$d', 'simple-table-manager'), $nr_showing, $nr_columns );
      stm_print_radio_button( 'some', $csv_columns, 'csv_columns', $text );
      print '</td>'.PHP_EOL;
      print '</tr>'.PHP_EOL;
    }
    print '</tbody>'.PHP_EOL;
    print '</table>'.PHP_EOL;

    $message = __( 'The default CSV encoding is: UTF-8', 'simple-table-manager' );
    stm_message( $message, 'help' );

    print '<div class="tablenav bottom">'.PHP_EOL;
    print '<input type="submit" value="'.__( 'Save', 'simple-table-manager' ).'" class="button button-primary" />'.PHP_EOL;
    print '</form>'.PHP_EOL;
    print '</div>'.PHP_EOL; // end tablenav

    print '<div class="tablenav bottom">'.PHP_EOL;
    print '<form method="post" enctype="multipart/form-data">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">'.PHP_EOL;
    print '<input type="hidden" name="tab" value="export">'.PHP_EOL;
    print '<input type="hidden" name="export" value="true">'.PHP_EOL;
    print '<input type="submit" value="'.__( 'Export', 'simple-table-manager' ).'" class="button button-primary" />'.PHP_EOL;
    print '</form>'.PHP_EOL;
    print '</div>'.PHP_EOL; // end tablenav
  } // end function

  function stm_do_export() {
    if( isset( $_POST['export'] ) ) {
      $current_table = get_option( 'stm_table' );
      $info = stm_get_table_info( $current_table);
      $columns = $info['columns'];
      $hiddens = $info['hiddens'];
      $csv_filename = get_option( 'stm_csv_filename' );
      $csv_encoding = get_option( 'stm_csv_encoding' );
      $csv_columns = get_option( 'stm_csv_columns' );

      // output contents
      header( "Content-Type: application/octet-stream" );
      header( "Content-Disposition: attachment; filename=".$csv_filename );
      // column names
      foreach ( $columns as $column_name => $type_code ) {
        if( 'some' == $csv_columns ) {
          if( in_array( $column_name, $hiddens ) ) {
            continue;
          }
        }
        print( $column_name . STM_DELIMITER );
      }
      print( STM_NEW_LINE );
      // fields
      $rows = stm_select_all( $current_table ); // array( object column_name->value, column_name->value ... )
      foreach ( $rows as $row ) {
        foreach ( $row as $column_name => $field_value ) {
          if( 'some' == $csv_columns ) {
            if( in_array( $column_name, $hiddens ) ) {
              continue;
            }
          }
          $string = preg_replace( '/"/', '""', $field_value );
          print( "\"" . mb_convert_encoding( $string, $csv_encoding, 'UTF-8' ) . "\"" . STM_DELIMITER );
        }
        print( STM_NEW_LINE );
      }
      exit;
    }
  } // end function
