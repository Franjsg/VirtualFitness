<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');

$current_user = wp_get_current_user();
$data = obtenerDatos($current_user->ID);
$plan = planPagadoNoActivo($current_user->ID);

$viewbt = false;
if (count($plan) > 0) {
	$viewbt = (int)$data['edad'] == 0 && $plan[0]->pagado;
}

?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
				<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
			</li>
		<?php endforeach; ?>
		<?php if ($viewbt) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
				<a id="bt-activar" href="#">Solicitar tabla de ejercicios</a>
				<script>
					debugger;
					jQuery('#bt-activar').click(function(event) {
						debugger;
						event.preventDefault();
						const form_data = [];
        				
						// Here we add our nonce (The one we created on our functions.php. WordPress needs this code to verify if the request comes from a valid source.
        				form_data.push({ "name": "security", "value": ajax_nonce });
        				form_data.push({ "name": 'action', "value": 'action_activar_plan' });

						// Here is the ajax petition.
						jQuery.ajax({
							url: ajax_url, // Here goes our WordPress AJAX endpoint.
							type: 'post',
							data: form_data,
							success: function(response) {
								// You can craft something here to handle the message return
								debugger;
								window.location.href = '/wordpress/formulario-de-tabla/';
							},
							fail: function(err) {
								// You can craft something here to handle an error if something goes wrong when doing the AJAX request.
								alert("There was an error: " + err);
							}
						});

						// This return prevents the submit event to refresh the page.
						return false;
					});
				</script>
			</li>
		<?php endif;  ?>
	</ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>