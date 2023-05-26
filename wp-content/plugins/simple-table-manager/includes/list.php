<?php
  // Simple Table Manager

  defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

  function stm_list( $current_table ) {

    print '<h2>'.__( 'Simple Table Manager - List Records', 'simple-table-manager' ).'</h2>'.PHP_EOL;

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
    $keyword = isset( $_GET['keyword'] ) ? sanitize_text_field( $_GET['keyword'] ) : '';
    $order = isset( $_GET['order'] ) ? sanitize_text_field( $_GET['order'] ) : '';
    $order_by = isset( $_GET['order_by'] ) ? sanitize_text_field( $_GET['order_by'] ) : '';
    $start_row = (int) isset( $_GET['start_row'] ) ? sanitize_text_field( $_GET['start_row'] ) : 0;
    $rows_per_page = (int) get_option( 'stm_rows_per_page' );

    if( 'search' == $action ) {
      $keyword = stripslashes_deep( $keyword );
    }

    // manage record quantity
    $total = stm_count_rows( $current_table, $columns, $keyword ); // count all data rows
    $next_start_row = $start_row + $rows_per_page;
    if ( $total < $next_start_row ) {
      $next_start_row = $total;
    }
    $last_start_row = $rows_per_page * ( floor( ( $total - 1 ) / $rows_per_page ) );

    // get rows to display
    $rows = stm_select( $current_table, $columns, $keyword, $order_by, $order, $start_row, $rows_per_page );

    if ( $keyword ) {
      if( '1' == $total ) {
        $message = sprintf( __( 'Found %1$s result for search term: "%2$s"', 'simple-table-manager' ), $total, $keyword );
      } else {
        $message = sprintf( __( 'Found %1$s results for search term: "%2$s"', 'simple-table-manager' ), $total, $keyword );
      }
      stm_message( $message, 'success' );
    }

    stm_message( $info['message'], $info['message_type'] );
    $message = ' '.sprintf( __( 'Showing %1$d columns out of %2$d.', 'simple-table-manager'), $nr_showing, $nr_columns );
    stm_message( $message, 'help' );

    // search box
    print '<form method="get" class="search">'.PHP_EOL;
    print '<input type="hidden" name="page" value="simple-table-manager">'.PHP_EOL;
    print '<input type="hidden" name="tab" value="list">'.PHP_EOL;
    print '<input type="hidden" name="action" value="search">'.PHP_EOL;
    print '<input type="search" name="keyword" placeholder="'.__( 'Search', 'simple-table-manager' ).'&hellip;" value="" />'.PHP_EOL;
    print '<input type="submit" value="Go" class="button button-secondary">'.PHP_EOL;
    print '</form>'.PHP_EOL;

    if ( ! count( $rows ) ) {
      $message = __( 'No rows found.', 'simple-table-manager' );
      stm_message( $message, 'help' );
      return;
    }

    print '<table class="wp-list-table widefat list">'.PHP_EOL;
    print '<thead>'.PHP_EOL;
    print '<tr>'.PHP_EOL;
    if( $key_name ) {
      print '<th></th>'.PHP_EOL; // empty column for edit link
    }
    // column names
    $condition = array( 'search' => $keyword );
    foreach ( $columns as $column_name => $type_code ) {
      if( in_array( $column_name, $hiddens ) ) {
        continue;
      }
      $condition['order_by'] = $column_name;
      if ( $column_name == $order_by and 'ASC' == $order ) {
        print '<th scope="col" class="manage-column sortable asc">';
        $condition['order'] = 'DESC';
      } else {
        print '<th scope="col" class="manage-column sortable desc">';
        $condition['order'] = 'ASC';
      }
      $url = '?page=simple-table-manager&tab=list&#038'.http_build_query( $condition );
      print '<a href="'.$url.'">';
      $asterisk = $column_name == $key_name ? '&nbsp;*' : '';
      print '<span>'.$column_name.$asterisk.'</span><span class="sorting-indicator"></span></a></th>';
    }
    print '</tr>'.PHP_EOL;
    print '</thead>'.PHP_EOL;
    // rows
    print '<tbody>'.PHP_EOL;
    foreach ( $rows as $row ) { // $row = object( $column_name => $field_value ... )
      print '<tr>';
      $key_value = isset( $row->$key_name ) ? $row->$key_name : '';
      if( $key_name ) {
        // edit link in first column
        $url = '?page=simple-table-manager&#038tab=edit&#038key_value='.$key_value;
        print '<td><a href="'.$url.'">'.__( 'Edit', 'simple-table-manager' ).'</a></td>';
      }
      // values
      foreach ( $row as $column_name => $field_value ) {
        if( in_array( $column_name, $hiddens ) ) {
          continue;
        }
        $field_value = apply_filters( 'stm_list_field', $field_value, $current_table, $column_name, $key_value );
        print '<td>' . htmlspecialchars( $field_value ) . '</td>';
      }
      print '</tr>';
    }
    print '</tbody>'.PHP_EOL;
    print '</table>'.PHP_EOL;

    if( $key_name ) {
      $message = __( '* Indicates the primary key.', 'simple-table-manager' );
      stm_message( $message, 'help' );
    }

    $message = sprintf( __( 'Total %s records.', 'simple-table-manager' ), number_format( $total ) );
    stm_message( $message, 'help' );

    // table footer
    print '<div class="tablenav bottom">'.PHP_EOL;
    print '<div class="tablenav-pages">'.PHP_EOL;
      print '<span class="pagination-links">'.PHP_EOL;
      // navigation
      if( ! isset( $order_by ) ) {
        $order_by = '';
        $order = '';
      }
      $condition = array( 'search' => $keyword, 'order_by' => $order_by, 'order' => $order );
      $query = http_build_query( $condition );
      if ( 0 < $start_row) {
        $url = '?page=simple-table-manager&#038tab=list&#038start_row=0&038'.$query;
        print '<a href="'.$url.'" title="first page" class="first-page disabled button button-secondary">&laquo;</a>';
        $url = '?page=simple-table-manager&#038tab=list&#038start_row='.( $start_row - $rows_per_page ).'&038'.$query;
        print '<a href="'.$url.'" title="previous page" class="first-page disabled button button-secondary">&lsaquo;</a>';
      } else {
        print '<a title="first page" class="first-page disabled button button-secondary">&laquo;</a>';
        print '<a title="previous page" class="prev-page disabled button button-secondary">&lsaquo;</a>';
      }
      print "<span class='paging-input'> " . number_format($start_row + 1) . " - <span class='total-pages'>" . number_format($next_start_row) . " </span></span>";
      if ( $next_start_row < $total ) {
        $url = '?page=simple-table-manager&#038tab=list&#038start_row='.$next_start_row.'&038'.$query;
        print '<a href="'.$url.'" title="next page" class="next-page button button-secondary">&rsaquo;</a>';
        $url = '?page=simple-table-manager&#038tab=list&#038start_row='.$last_start_row.'&038'.$query;
        print '<a href="'.$url.'" title="last page" class="last-page button button-secondary">&raquo;</a>';
      } else {
        print '<a title="next page" class="next-page disabled button button-secondary">&rsaquo;</a>';
        print '<a title="last page" class="last-page disabled button button-secondary">&raquo;</a>';
      }
    print '</span>'.PHP_EOL; // end pagination-links
    print '</div>'.PHP_EOL; // end tablenav-pages
  } // end function
