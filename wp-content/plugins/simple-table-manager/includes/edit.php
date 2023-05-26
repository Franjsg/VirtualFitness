<?php
  // Simple Table Manager

  defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

  function stm_edit( $current_table ) {
    global $wpdb;

    print '<h2>'.__( 'Simple Table Manager - Edit Record', 'simple-table-manager' ).'</h2>'.PHP_EOL;

    $info = stm_get_table_info( $current_table );
    $columns = $info['columns']; // array( 'name' => type )
    $nr_columns = count( $columns );
    $key_name = $info['key_name'];
    $key_is_int = $info['key_is_int'];
    $auto_increment = $info['auto_increment'];
    $hiddens = $info['hiddens'];
    $nr_hiddens = count( $hiddens );
    $nr_showing = $nr_columns - $nr_hiddens;
    $unserialize = get_option(' stm_unserialize' );
    
    $action = isset( $_GET['action'] ) ? sanitize_text_field( $_GET['action'] ) : '';
    $key_value = isset( $_GET['key_value'] ) ? sanitize_text_field( $_GET['key_value'] ) : '';

    switch( $action ) {
      case '':
        break;
      case 'save':
        // collect update values and strip slashes
        $update_vals = array();
        $new_key_value = $key_value;
        foreach ( $columns as $column_name => $type ) {
          $encoded_column_name = urlencode( $column_name );
          if( isset( $_GET[$encoded_column_name] ) ) { // no $encoded name for hidden fields
            $field_value = stripslashes_deep( $_GET[$encoded_column_name] );
            $update_vals[$column_name] = $field_value;
            if( $key_name == $column_name ) {
              $new_key_value = $field_value;
            }
          }
        }
        // update
        $outcome = $wpdb->update( $current_table, $update_vals, array( $key_name => $key_value ) );
        // $outcome = number of rows affected by a query. Could be 0, 1 or false if the operation failed
        if( false === $outcome ) {
          $message = __( 'Record not updated.', 'simple-table-manager' );
          stm_message( $message, 'fail' );
        } else {            
          $message = __( 'Record updated.', 'simple-table-manager' );
          stm_message( $message, 'success' );
        }
        // update $key_value
        $key_value = $new_key_value;
        break;
      case 'delete':
        $query = 'DELETE FROM `'.$current_table.'` WHERE `'.$key_name.'`="'.$key_value.'"';
        $outcome = $wpdb->query( $query );
        // $outcome = number of rows deleted. Could be 0, or false if update failed
        if( false === $outcome ) {
          $message = __( 'Record not deleted.', 'simple-table-manager' );
          stm_message( $message, 'fail' );
        } else {            
          $message = __( 'Record deleted.', 'simple-table-manager' );
          stm_message( $message, 'success' );
        }
        $key_value = '';
        break;
      default:
        $message = __( 'Invalid action', 'simple-table-manager' );
        stm_message( $message, 'fail' );
    }

    stm_message( $info['message'], $info['message_type'] );
    if( ! $key_value ) {
      if( 'delete' != $action ) {
        $message = __( 'Error: Key value missing.', 'simple-table-manager');
        stm_message( $message, 'fail' );
      }
      stm_back_button();
      return;
    }
    
    $row = stm_get_row( $current_table, $key_name, $key_value );
    if( is_null( $row ) ) {
      $message = __( 'Record not found.', 'simple-table-manager' );
      stm_message( $message, 'fail' );
      stm_back_button();
      return;
    }  

    $message = ' '.sprintf( __( 'Showing %1$d columns out of %2$d.', 'simple-table-manager'), $nr_showing, $nr_columns );
    stm_message( $message, 'help' );

    print '<form method="get">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">'.PHP_EOL;
    print '<input type="hidden" name="tab" value="edit">'.PHP_EOL;
    print '<input type="hidden" name="action" value="save">'.PHP_EOL;
    print '<input type="hidden" name="key_value" value="'.$key_value.'">'.PHP_EOL;
    print '<table class="wp-list-table widefat settings">'.PHP_EOL;
    print '<thead>'.PHP_EOL;
    print '<th>Name</th>'.PHP_EOL;
    print '<th>Type</th>'.PHP_EOL;
    
    print '<th>Value</th>'.PHP_EOL;
    if( $unserialize ) {
      print '<th></th>'.PHP_EOL;
    }
    print '</thead>'.PHP_EOL;
    print '<tbody>'.PHP_EOL;
    foreach ( $row as $column_name => $field_value ) {
      if( in_array( $column_name, $hiddens ) ) {
        continue;
      }
      $type_code = $columns[$column_name];
      $type_name = stm_get_type_name( $type_code );
      $asterisk = $key_name == $column_name ? '&nbsp;*' : '';
      print '<tr>';
      print '<td>'.$column_name.$asterisk.'</td>';
      print '<td>'.$type_name.'</td>';
      $field_html = stm_input( $column_name, $type_code, $field_value );
      $field_html = apply_filters( 'stm_edit_field_html', $field_html, $current_table, $column_name, $field_value );
      print '<td>'.$field_html.'</td>';
      if( $unserialize ) {
        $valid = false;
        if( 'string' == gettype( $field_value ) ) {
          $classes = array(); // no classes accepted
          $result = @unserialize( $field_value, $classes ); // suppress any E_NOTICE
          ob_start();
          if( false != $result ) {
            $result_type = gettype( $result );
            switch( $result_type ) {
              case 'boolean':
                print $result ? 'True' : 'False';
                $valid = true;
                break;
              case 'integer':
              case 'sring':
                print $result;
                $valid = true;
                break;
              case 'array':
              case 'object':
                print '<pre>';
                print_r( $result );
                print '</pre>';
                $valid = true;
                break;
              default:
                // error, nothing to print
            }
          }
          $html = ob_get_clean();
        }
        if( $valid ) {
          print '<td><div class="unserialized">'.$html.'</div></td>'.PHP_EOL;      
        } else {
          print '<td></td>'.PHP_EOL;      
        }
      }
      print '</tr>'.PHP_EOL;
    }
    print '</tbody>'.PHP_EOL;
    print '</table>'.PHP_EOL;

    if( $key_name ) {
      $message = __( '* Indicates the primary key.', 'simple-table-manager' );
      stm_message( $message, 'help' );
    }

    print '<div class="tablenav bottom">'.PHP_EOL;
    print '<input type="submit" value="' . __( 'Save', 'simple-table-manager' ). '" class="button button-primary">&nbsp;'.PHP_EOL;
    print '</div>'.PHP_EOL;
    print '</form>'.PHP_EOL;

    print '<form method="get">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">'.PHP_EOL;
    print '<input type="hidden" name="tab" value="edit">'.PHP_EOL;
    print '<input type="hidden" name="action" value="delete">'.PHP_EOL;
    print '<input type="hidden" name="key_value" value="'.$key_value.'">'.PHP_EOL;
    print '<div class="tablenav bottom">'.PHP_EOL;
    print '<input type="submit" value="'.__( 'Delete', 'simple-table-manager' ).'" class="button button-primary" onclick="return confirm( '.__( 'Are you sure you want to delete this record?', 'simple-table-manager' ).')">'.PHP_EOL;
    print '</div>'.PHP_EOL;
    print '</form>'.PHP_EOL;
  } // end function

  function stm_back_button() {
    print '<form method="get">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">'.PHP_EOL;
    print '<input type="hidden" name="tab" value="list">'.PHP_EOL;
    print '<input type="submit" value="'.__( 'Return to list', 'simple-table-manager' ).'" class="button button-primary">'.PHP_EOL;
    print '</form>'.PHP_EOL;
  } // end 
