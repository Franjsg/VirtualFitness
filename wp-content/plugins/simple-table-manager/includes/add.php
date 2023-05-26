<?php
  // Simple Table Manager

  defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

  function stm_add( $current_table ) {
    global $wpdb;

    print '<h2>'.__( 'Simple Table Manager - Add Record', 'simple-table-manager' ).'</h2>'.PHP_EOL;

    $info = stm_get_table_info( $current_table );
    $columns = $info['columns']; // array( 'name' => type )
    $nr_columns = count( $columns );
    $key_name = $info['key_name'];
    $key_is_int = $info['key_is_int'];
    $auto_increment = $info['auto_increment'];
    $hiddens = $info['hiddens'];
    $nr_hiddens = count( $hiddens );
    $nr_showing = $nr_columns - $nr_hiddens;

    $action = isset( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : '';

    switch( $action ) {
      case '':
        break;
      case 'save':
        // collect insert values and strip slashes
        $insert_vals = array();
        foreach ( $columns as $column_name => $type_code ) {
          $encoded_name = urlencode( $column_name );
          if( isset( $_GET[$encoded_name] ) ) { // no $encoded name for hidden or auto_increment fields
            $insert_vals[$column_name] = stripslashes_deep( $_GET[$encoded_name] );
          }
        }
        if( ! $key_name || $auto_increment ) {
          $outcome = $wpdb->insert( $current_table, $insert_vals );
          // $outcome = number of rows affected by a query. Could be 0, 1 or false if the operation failed
          if( false === $outcome ) {
            $message = __( 'Record not saved.', 'simple-table-manager' );
            stm_message( $message, 'fail' );
          } else {            
            $message = __( 'Record saved.', 'simple-table-manager' );
            stm_message( $message, 'success' );
          }
        } else {
          // check if the key exists already
          $query = 'SELECT * FROM `'.$current_table.'` WHERE `'.$key_name.'` = "'.$insert_vals[$key_name].'"';
          $wpdb->get_results( $query );
          $nr_rows = $wpdb->num_rows;
          if ( $nr_rows ) {
            $message = __( 'Key exists. Record not saved', 'simple-table-manager' );
            stm_message( $message, 'fail' );
          } else {
            $outcome = $wpdb->insert( $current_table, $insert_vals );
            // $outcome = number of rows affected by a query. Could be 0, 1 or false if the operation failed
            if( false === $outcome ) {
              $message = __( 'Record not saved.', 'simple-table-manager' );
              stm_message( $message, 'fail' );
            } else {            
              $message = __( 'Record saved.', 'simple-table-manager' );
              stm_message( $message, 'success' );
            }
          }
        }
        break;
      default:
        $message = __( 'Invalid action', 'simple-table-manager' );
        stm_message( $message, 'fail' );
    }

    stm_message( $info['message'], $info['message_type'] );
    $message = ' '.sprintf( __( 'Showing %1$d columns out of %2$d.', 'simple-table-manager'), $nr_showing, $nr_columns );
    stm_message( $message, 'help' );

    print '<form method="get">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">'.PHP_EOL;
    print '<input type="hidden" name="tab" value="add">'.PHP_EOL;
    print '<input type="hidden" name="action" value="save">'.PHP_EOL;
    print '<table class="wp-list-table widefat settings">'.PHP_EOL;
    print '<thead>'.PHP_EOL;
    print '<th>Name</th>'.PHP_EOL;
    print '<th>Type</th>'.PHP_EOL;
    print '<th>Value</th>'.PHP_EOL;
    print '</thead>'.PHP_EOL;
    print '<tbody>'.PHP_EOL;
    foreach ( $columns as $column_name => $type_code ) {
      $type_name = stm_get_type_name( $type_code );
      if ( $column_name == $key_name ) {
        // the key field cannot be hidden
        print '<tr>';
        print '<th>'.$column_name.' *</th>';
        print '<th>'.$type_name.'</th>';
        if( $auto_increment ) {
          print '<td>auto-incrementing field</td>';
        } else {
          if( $key_is_int ) {    
            $max_id = $wpdb->get_var( 'SELECT MAX( `'.$key_name.'` ) FROM `'.$current_table.'`' );
            $new_id = $max_id + 1;
          } else {
           // key cannot be auto-generated  
           $new_id = '';
          }
          $field_html = stm_input( $column_name, $type_code, $new_id );
          $field_html = apply_filters( 'stm_add_field_html', $field_html, $current_table, $column_name, $new_id );
          print '<td>'.$field_html.'</td>';
        }
        print '</tr>'.PHP_EOL;
      } else {
        if( in_array( $column_name, $hiddens ) ) {
          continue;
        }
        print '<tr>';
        print '<td>'.$column_name.'</td>';
        print '<td>'.$type_name.'</td>';
        $field_html = stm_input( $column_name, $type_code, '', '' );
        $field_html = apply_filters( 'stm_add_field_html', $field_html, $current_table, $column_name, '' );
        print '<td>'.$field_html.'</td>';
        print '</tr>'.PHP_EOL;
      }
    }
    print '</tbody>'.PHP_EOL;
    print '</table>'.PHP_EOL;

    if( $key_name ) {
      $message = __( '* Indicates the primary key.', 'simple-table-manager' );
      stm_message( $message, 'help' );
    }

    print '<div class="tablenav bottom">'.PHP_EOL;
    print '<input type="submit" value="' . __( 'Save', 'simple-table-manager' ). '" class="button button-primary">'.PHP_EOL;
    print '</div>'.PHP_EOL;
    print '</form>'.PHP_EOL;
  } // end function
