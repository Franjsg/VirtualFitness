<?php

  // Simple Table Manager

  defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

  if ( ! function_exists( 'write_log' ) ) {
    function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
        error_log( print_r( $log, true ) );
      } else {
        error_log( $log );
      }
    } // end function
  }

  function stm_message( $message, $type ) {
    if( ! $message ) {
      return;
    }
    switch( $type ) {
      case 'success':
        print '<div class="updated">'.PHP_EOL;
        print '<p class="stm_help">'.$message.'</p>'.PHP_EOL;;
        print '</div>'.PHP_EOL;
        break;
      case 'fail':
        print '<div class="updated">'.PHP_EOL;
        print '<p class="stm_error">'.$message.'</p>'.PHP_EOL;;
        print '</div>'.PHP_EOL;
        break;
      case 'help':
        print '<p class="stm_help">'.$message.'</p>'.PHP_EOL;
        break;
      case 'error':
        print '<p class="stm_error">'.$message.'</p>'.PHP_EOL;
        break;
      default:
        print '<p class="stm_error">'.__( 'Invalid message type.', 'simple-table-manager' ).'</p>'.PHP_EOL;
    }
  } // end function

  // print a radio button
  // if the value is the current_value, the button is selected
  function stm_print_radio_button( $value, $current_value, $name, $text ) {
    print '<p>';
    print '<label>'.PHP_EOL;
    if ( $value == $current_value ) {
      print '<input type="radio" name="'.$name.'" value="'.$value.'" checked="checked" class="radio" />'.PHP_EOL;
    } else {
      print '<input type="radio" name="'.$name.'" value="'.$value.'" class="radio" />'.PHP_EOL;
    }
    print $text.PHP_EOL;
    print '</label>'.PHP_EOL;
    print '</p>'.PHP_EOL;
  } // end function

  // print a checkbox
  // if the value is the current_value, the checkbox is checked
  function stm_print_checkbox( $value, $checked, $name, $text ) {
    if ( $checked ) {
      print '<input type="checkbox" name="'.$name.'" value="'.$value.'" checked="checked" />'.PHP_EOL;
    } else {
      print '<input type="checkbox" name="'.$name.'" value="'.$value.'" />'.PHP_EOL;
    }
    print $text.PHP_EOL;
  } // end function

  function stm_input( $column_name, $type_code, $value ) {
    // $readonly = '' or 'readonly'
    $encoded_name = urlencode( $column_name );
    switch ( $type_code ) {
      // numeric
      case 'int':
      case 'real':
      case '3':
      case '8':
        return '<input type="number" name="'.$encoded_name.'" value="'.$value.'">';
      // date
      case 'date':
      case '10':
        return '<input type="date" name="'.$encoded_name.'" value="'.$value.'">';
      case 'time':
      case '11':
        return '<input type="time" name="'.$encoded_name.'" step="1" value="'.$value.'">';
      case 'datetime':
      case 'timestamp':
      case '7':
      case '12':
        return '<input type="text" name="'.$encoded_name.'" value="'.$value.'">';
      // long text
      case 'blob':
      case '252':
        return '<textarea name="'.$encoded_name.'">'.$value.'</textarea>';
      default:
        // default: text
        return '<input type="text" name="'.$encoded_name.'" value="'.htmlspecialchars( $value, ENT_QUOTES ).'">';
    }
  } // end function

  function stm_get_type_name( $type_code ) {
    switch( $type_code ) {
      case 0:
        $type_name = 'decimal';
        break;
      case 1:
        $type_name = 'tinyint / tiny';
        break;
      case 2:
        $type_name = 'smallint / short';
        break;
      case 3:
        $type_name = 'int / long';
        break;
      case 4:
        $type_name = 'float';
        break;
      case 5:
        $type_name = 'double';
        break;
      case 6:
        $type_name = 'null';
        break;
      case 7:
        $type_name = 'timestamp';
        break;
      case 8:
        $type_name = 'bigint';
        break;
      case 9:
        $type_name = 'mediumint / int24';
        break;
      case 10:
        $type_name = 'date';
        break;
      case 11:
        $type_name = 'time';
        break;
       case 12:
        $type_name = 'datetime';
        break;
      case 13:
        $type_name = 'year';
        break;
      case 14:
        $type_name = 'newdate';
        break;
      case 16:
        $type_name = 'bit';
        break;
      case 246:
        $type_name = 'decimal';
        break;
      case 247:
        $type_name = 'enum';
        break;
      case 248:
        $type_name = 'set';
        break;
      case 249:
        $type_name = 'tiny_blob';
        break;
      case 250:
        $type_name = 'medium_blob';
        break;
      case 251:
        $type_name = 'long_blob';
        break;
      case 252:
        $type_name = 'blob';
        break;
     case 253:
        $type_name = 'varchar';
        break;
      case 254:
        $type_name = 'char / string / boolean';
        break;
      case 255;
        $type_name = 'geometry';
        break;
      default:
        $type_name = $type;
    }
    return '<span class="stm_help">'.$type_name.'</span>';
  } // end function
