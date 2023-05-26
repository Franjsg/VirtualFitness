<?php
  // Simple Table Manager

  defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

   function stm_columns( $current_table ) {

    print '<h2>'.__( 'Simple Table Manager - Select Visible Columns', 'simple-table-manager' ).'</h2>'.PHP_EOL;

    $info = stm_get_table_info( $current_table );
    $columns = $info['columns']; // array( 'name' => type )
    $nr_columns = count( $columns );
    $key_name = $info['key_name'];
    $key_is_int = $info['key_is_int'];
    $auto_increment = $info['auto_increment'];
    $hiddens = $info['hiddens'];
    $nr_hiddens = count( $hiddens );
    $nr_showing = $nr_columns - $nr_hiddens;

    $action = isset( $_GET['action'] ) ? $_GET['action'] : '';

    switch( $action ) {
      case '';
        break;
      case 'save':
        $visibles = isset( $_GET['visibles'] ) ? $_GET['visibles'] : array(); // array of visible columns
        $hiddens = array();
        foreach( $columns as $name => $type) {
          if( ! in_array( $name, $visibles ) ) {
            $hiddens[] = $name;
          }
        }
        update_option( 'stm_hiddens_'.$current_table, $hiddens );
        $message = __( 'Visible columns list saved.', 'simple-table-manager' );
        stm_message( $message, 'success' );
        break;
      default:
        $message = __( 'Error: Unknown action', 'simple-table-manager' );
        stm_message( $message, 'fail' );
    }

    stm_message( $info['message'], $info['message_type'] );

    $hiddens = get_option( 'stm_hiddens_'.$current_table, array() );

    print '<form method="get">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">';
    print '<input type="hidden" name="tab" value="columns">';
    print '<input type="hidden" name="action" value="save">';
    print '<table class="wp-list-table widefat settings">'.PHP_EOL;
    print '<thead>'.PHP_EOL;
    print '<th>Name</th>'.PHP_EOL;
    print '<th>Type</th>'.PHP_EOL;
    print '<th>Visible</th>'.PHP_EOL;
    print '</thead>'.PHP_EOL;
    print '<tbody>'.PHP_EOL;
    foreach( $columns as $column_name => $type_code ) {
      $type_name = stm_get_type_name( $type_code );
      print '<tr>'.PHP_EOL;
      if( $column_name == $key_name ) {      
        print '<td>'.$column_name.' *</td>'.PHP_EOL;
        print '<th>'.$type_name.'</th>';
        print '<td><input type="hidden" name="visibles[]" value="'.$column_name.'"></td>'.PHP_EOL;
      } else {
        print '<td>'.$column_name.'</td>'.PHP_EOL;
        print '<th>'.$type_name.'</th>';
        print '<td>'.PHP_EOL;
        // stm_print_checkbox( $value, $checked, $name, $text ) {
        $checked = ! in_array( $column_name, $hiddens );
        stm_print_checkbox( $column_name, $checked, 'visibles[]', '' );
        print '</td>'.PHP_EOL;
      }
      print '</tr>'.PHP_EOL;
    }
    print '</tbody>'.PHP_EOL;
    print '</table>'.PHP_EOL;

    if( $key_name ) {
      $message = __( '* Indicates the primary key. The primary key cannot be hidden.', 'simple-table-manager' );
      stm_message( $message, 'help' );
    }

    print '<div class="tablenav bottom">'.PHP_EOL;
    print '<input type="submit" value="'.__( 'Save', 'simple-table-manager' ).'" class="button button-primary" />'.PHP_EOL;
    print '</div>'.PHP_EOL; // end tablenav

    print '</form>'.PHP_EOL;
  } // end function
