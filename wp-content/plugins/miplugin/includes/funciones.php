<?php

require_once('wp-load.php');

// Agregar campos personalizados al formulario de registro de WooCommerce
add_action( 'woocommerce_register_form', 'agregar_campos_personalizados' );

function agregar_campos_personalizados() {
?>
    <p class="form-row form-row-first">
        <label for="nombre_de_usuario"><?php _e( 'Nombre de usuario', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="nombre_de_usuario" id="nombre_de_usuario" value="<?php if ( ! empty( $_POST['nombre_de_usuario'] ) ) esc_attr_e( $_POST['nombre_de_usuario'] ); ?>" />
    </p>
    <p class="form-row form-row-last">
        <label for="fecha_de_nacimiento"><?php _e( 'Fecha de nacimiento', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="date" class="input-text" name="fecha_de_nacimiento" id="fecha_de_nacimiento" value="<?php if ( ! empty( $_POST['fecha_de_nacimiento'] ) ) esc_attr_e( $_POST['fecha_de_nacimiento'] ); ?>" />
    </p>
    <div class="clear"></div>
<?php
}

// Validar los campos personalizados en el formulario de registro de WooCommerce
add_action( 'woocommerce_register_form', 'validar_campos_personalizados', 10, 3 );

function validar_campos_personalizados( $username, $email, $errors ) {
    if ( empty( $_POST['nombre_de_usuario'] ) ) {
        $errors->add( 'error_nombre_de_usuario', __( 'Por favor, introduce tu nombre de usuario.', 'woocommerce' ) );
    }
    if ( empty( $_POST['fecha_de_nacimiento'] ) ) {
        $errors->add( 'error_fecha_de_nacimiento', __( 'Por favor, introduce tu fecha de nacimiento.', 'woocommerce' ) );
    }
}

var_dump($current_user);

// Guardar los campos personalizados en la base de datos de WordPress
add_action( 'woocommerce_created_customer', 'guardar_campos_personalizados' );

function guardar_campos_personalizados( $current_user ) {
    echo "Tu nombre: "; echo $_POST['nombre_de_usuario']; echo "<br/>";
    if ( isset( $_POST['nombre_de_usuario'] ) ) {
        update_user_meta( $current_user, 'display_name', sanitize_text_field( $_POST['nombre_de_usuario'] ) );
    }
    if ( isset( $_POST['fecha_de_nacimiento'] ) ) {
        update_user_meta( $current_user, 'fecha_nacimiento', $_POST['fecha_de_nacimiento'] );
    }
}



?>
