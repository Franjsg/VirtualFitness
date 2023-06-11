<?php

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'library/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

function javascript_variables()
{ 
	$url = admin_url("admin-ajax.php");

	?>
	<script type="text/javascript">
		var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
		var ajax_nonce = '<?php echo wp_create_nonce("secure_nonce_name"); ?>';
	</script><?php
			}

add_action('wp_enqueue_scripts', 'javascript_variables');

// Incluir Bootstrap CSS
/*function bootstrap_css() {
	wp_enqueue_style( 'bootstrap_css', 
  					get_stylesheet_directory_uri() . '/css/bootstrap.min.css', 
  					array(), 
  					'4.6.1'
  					); 
}
add_action( 'wp_enqueue_scripts', 'bootstrap_css');

// Incluir Bootstrap JS
function bootstrap_js() {
	wp_enqueue_script( 'bootstrap_js', 
  					get_stylesheet_directory_uri() . '/js/bootstrap.min.js', 
  					array('jquery'), 
  					'4.6.1', 
  					true); 
}
add_action( 'wp_enqueue_scripts', 'bootstrap_js');

*/

// Incluir custom csS
function custom_css()
{
	wp_enqueue_style(
		'custom_css',
		get_stylesheet_directory_uri() . '/css/custom.css',
		array(),
		'1.0.0'
	);
}
add_action('wp_enqueue_scripts', 'custom_css');

function spinner_js()
{
	wp_enqueue_script(
		'spinner_js',
		get_stylesheet_directory_uri() . '/js/spinner.js',
		array(),
		'1.0.0'
	);
}
add_action('wp_enqueue_scripts', 'spinner_js');


function security_js()
{
	wp_enqueue_script(
		'security_js',
		get_stylesheet_directory_uri() . '/js/security.js',
		array(),
		'1.0.0'
	);
}
add_action('wp_enqueue_scripts', 'security_js');

function pdf_js()
{
	wp_enqueue_script(
		'pdf_js',
		get_stylesheet_directory_uri() . '/js/pdf.js',
		array(),
		'1.0.0'
	);
}
add_action('wp_enqueue_scripts', 'pdf_js');

function enqueue_styles_child_theme()
{

	$parent_style = 'envo-shopper-style';
	$child_style  = 'envo-shopper-child-style';

	wp_enqueue_style(
		$parent_style,
		get_template_directory_uri() . '/style.css'
	);

	wp_enqueue_style(
		$child_style,
		get_stylesheet_directory_uri() . '/style.css',
		array($parent_style),
		wp_get_theme()->get('Version')
	);
}
add_action('wp_enqueue_scripts', 'enqueue_styles_child_theme');

function diasRestantes($fechaFin){
	$currentDate = new DateTime();
	$currentDate->setTime(0,0,0);
	$date2 = new DateTime($fechaFin);
	$days = 0;
	if ($currentDate <= $date2) {
		$diff = $date2->diff($currentDate)->format("%a");
		$days = intval($diff);   //rounding days
	}
	return $days;
}

function calcularEdad($edadenformatobd)
{
	// Calculo de la edad
	$dateOfBirth = $edadenformatobd;
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	return $diff->format('%y');
}

function activarRenovarPlan()
{
	$activar = false;

	$current_user = wp_get_current_user();
	$plan = planActual($current_user->ID);
	if (count($plan) > 0) {
		$fechaFin = $plan[0]->fechaFin;
		if ($fechaFin != null) {
			$frenovar = date('Y-m-d', strtotime($fechaFin . ' -3 days'));
			$factual = date("Y-m-d");

			if ($frenovar <= $factual) {
				$activar = true;
			}
		}
	}

	return $activar;
}

// cargar tabla personalizada
add_filter('the_content', 'dcms_list_data');

function dcms_list_data($content)
{
	$hasPermision = checkPermisionAccessPage();
	if ($hasPermision) {

		$slug_page = 'miplandeentrenamiento'; //slug de la página en donde se mostrará la tabla

		$rol = rolCurrentUser();
		$current_user = wp_get_current_user();
		$planPagado = planPagado($current_user->ID);

		if (is_page($slug_page) && ($rol == 'administrator' || ($rol == 'subscriber' && count($planPagado) >= 1))) {

			if (is_user_logged_in()) {

				global $wpdb;

				$current_user = wp_get_current_user();

				// Tabla entrenamiento para cargar los datos del plan adquirido por el usuario
				$queryDatosPlanUsuario =
					"SELECT * 
				FROM entrenamiento 
				WHERE id_usuario = $current_user->ID";
				$itemsDatosPlanUsuario = $wpdb->get_results($queryDatosPlanUsuario);

				echo '<h3>Rutina personalizada para: ' . $current_user->user_firstname . '</h3><br />';
				// echo '<p>Todo de current_user: ' . var_dump($current_user) . '</p><br />';
				// echo '<p>entrenamiento: ' . var_dump($itemsDatosPlanUsuario) . '</p><br />';
				//echo '<p>Edad: ' . calcularEdad($current_user->fecha_nacimiento) . '</p><br />';
				if (count($itemsDatosPlanUsuario) > 0) {

					echo '<div class="fechas">';
					echo '<p>Plan actual: ' . $itemsDatosPlanUsuario[0]->plan . '</p>';
					echo '<p>Fecha inicio del plan: ' . $itemsDatosPlanUsuario[0]->fechaInicio . '</p>';
					echo '<p>Fecha finalización del plan: ' . $itemsDatosPlanUsuario[0]->fechaFin . '</p>';

					$days = diasRestantes($itemsDatosPlanUsuario[0]->fechaFin);
					
					echo  '<p>Días restantes: ' . $days . '</p>';
					echo '</div>';

					if ($days == 0) {
						echo '<div class="content-error">Su plan ha caducado. Compre un nuevo plan</div>';
					}


					if (activarRenovarPlan()) {

						$codigo = "<form id=\"form-renovar-plan\" action=\"\" method=\"post\">
    				<input type=\"hidden\" name=\"action\" value=\"action_renovar_plan\" style=\"display: none; visibility: hidden; opacity: 0;\">
    				<button class=\"btn btn-primary wpforms-submit\" type=\"submit\" style=\"background-color: #0069D9; border: 1px solid #291291; box-shadow: 0 3px 0 #630a04; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; cursor: pointer; width: 150px;\">Renovar plan</button>
					</form>

					<div id=\"mensaje-renovar-plan\"></div>

			<script>
    			debugger;
    			jQuery('#form-renovar-plan').on('submit', function () {
        			debugger;
					addSpinner('spinner');
        			var form_data = jQuery(this).serializeArray();

        		// Here we add our nonce (The one we created on our functions.php. WordPress needs this code to verify if the request comes from a valid source.
        		form_data.push({ \"name\": \"security\", \"value\": ajax_nonce });

        		// Here is the ajax petition.
        		jQuery.ajax({
        		    url: ajax_url, // Here goes our WordPress AJAX endpoint.
        		    type: 'post',
        		    data: form_data,
        		    success: function (response) {
						debugger;
						if(!processAjaxActionError(response)){
							var data = JSON.parse(response);
                    		var plan = data.plan;
							removeSpinner('spinner');
							jQuery('#mensaje-renovar-plan').text('¡El plan ha sido renovado con éxito!');
							jQuery('#form-renovar-plan').hide(); // Oculta el botón después de que se muestra el mensaje
							plan = plan.replaceAll('\"','');
							window.location.href = '/wordpress/pasarela-de-pago?plan='+plan;
						}
        		    },
        		    fail: function (err) {
        		        // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
        		        alert(\"There was an error: \" + err);
        		    }
        		});
        		// This return prevents the submit event to refresh the page.
        	return false;
    		});
			</script>";



						echo $codigo;


						echo "<br>";
					}

					if ($days != 0) {

						$codigo2 = "<form id=\"form-cancelar-plan\" action=\"\" method=\"post\">
					<input type=\"hidden\" name=\"action\" value=\"action_cancelar_plan\" style=\"display: none; visibility: hidden; opacity: 0;\">
					<button class=\"btn btn-danger wp-danger\" type=\"submit\" style=\"background-color: #C82333; border: 1px solid #630a04; box-shadow: 0 3px 0 #630a04; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; cursor: pointer; width: 150px;\">Cancelar plan</button>
					</form>

					<div id=\"mensaje-cancelar-plan\"></div>
					<div id=\"spinner\"></div>

			<script>
				debugger;
				jQuery('#form-cancelar-plan').on('submit', function () {
					debugger;
					addSpinner('spinner');
					var form_data = jQuery(this).serializeArray();

					// Here we add our nonce (The one we created on our functions.php. WordPress needs this code to verify if the request comes from a valid source.
					form_data.push({ \"name\": \"security\", \"value\": ajax_nonce });

				// Here is the ajax petition.
				jQuery.ajax({
					url: ajax_url, // Here goes our WordPress AJAX endpoint.
					type: 'post',
					data: form_data,
				success: function (response) {
					if(!processAjaxActionError(response)){
						removeSpinner('spinner');
						// You can craft something here to handle the message return
						jQuery('#mensaje-cancelar-plan').text('¡El plan ha sido cancelado con éxito!');
						window.location.href = '/wordpress/miplandeentrenamiento/';
						setTimeout(() => {
							jQuery('#mensaje-cancelar-plan').text('');
						}, 2000);
					}
				},
			fail: function (err) {
				// You can craft something here to handle an error if something goes wrong when doing the AJAX request.
				alert(\"There was an error: \" + err);
			}
		});
			// This return prevents the submit event to refresh the page.
			return false;
		});
	</script>";


						echo $codigo2;

						echo '<br>';
					}
				}

				// Tabla patologias
				$query3 =
					"SELECT * 
					FROM usuarios_patologias INNER JOIN patologias
					ON usuarios_patologias.patologia_id = patologias.id_patologia
					WHERE usuarios_patologias.usuario_id = $current_user->ID";

				$patologiasUsuario = $wpdb->get_results($query3);
				if (count($patologiasUsuario) >= 1) {
					$result_2 = '';

					$count = 1;
					foreach ($patologiasUsuario as $item_patologia) {
						$result_2 .= '<tr>
							<td class="text-center">' . $count . '</td>
							<td class="text-center" title="patologia_id: ' . $item_patologia->patologia_id . '">' . $item_patologia->patologia . '</td>
							</tr>';
						$count = $count + 1;
					}

					$template_2 = 	'<table id="tablapatologias" class="tabla_patologias tableseparator">
									<tr>
										<th colspan="2" class="centrar-texto custom-bg-patologias">PATOLOGÍAS</th>
									</tr>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Nombre de patología/s</th>
											</tr>
											{data2}
										</table>';

					echo $content . str_replace('{data2}', $result_2, $template_2);
				} 

				// Tabla ejercicios
				if (count($itemsDatosPlanUsuario) > 0) {
					$dataEjer = obtenerDatos($current_user->ID);
					if ($dataEjer['haydatos']) {
						$itemsDatosPlanUsuario = planActual($current_user->ID);

						if (count($itemsDatosPlanUsuario) != 0) {

							$itemsEjercicios = buscarEjercicios($current_user->ID);

							if (count($itemsEjercicios) > 0) {
								$result_2 = '';

								$count = 1;
								foreach ($itemsEjercicios as $item_ejercicio) {

									if (property_exists($item_ejercicio, 'entNumeroYRepeticiones')) {
										$serie = $item_ejercicio->entNumeroYRepeticiones;
									} else {
										$serie = $item_ejercicio->numeroYRepeticiones;
									}

									$result_2 .= '<tr>
									<td>' . $count . '</td>
									<td class="text-center" title="Nombre del ejercicio: ' . $item_ejercicio->nombreEjer . '">' . $item_ejercicio->nombreEjer . '</td>
									<td class="text-center" title="Categoria: ' . $item_ejercicio->nombreCategoria . '">' . $item_ejercicio->nombreCategoria . '</td>
									<td class="text-center"title="Series y repeticiones: ' . $serie . '">' . $serie . '</td>
									</tr>';
									$count = $count + 1;
								}

								$template_2 = 	'<table id="tablaejercicios" class="tabla_ejercicios">
													<tr>
														<th colspan="4" class="centrar-texto custom-bg-ejercicios">PROGRAMA DE ENTRENAMIENTO</th>
													</tr>
													<tr>
														<th class="text-center">#</th>
														<th class="text-center">Nombre del ejercicio</th>
														<th class="text-center">Categoría</th>
														<th class="text-center">Series y repeticiones</th>
													</tr>
													{data2}
												</table>';

								echo $content . str_replace('{data2}', $result_2, $template_2);

								echo '<br>';

								echo '<div onclick="generatePdf()" class="save-as-pdf-pdfcrowd-button-wrap pdfcrowd-remove save-as-pdf-pdfcrowd-reset" style="text-align: center;"><div class="" style="margin-top: 6px; margin-right: 6px; margin-bottom: 6px; margin-left: 6px; padding-top: 6px; padding-right: 6px; padding-bottom: 6px; padding-left: 6px; font-size: 14px; font-weight: bold; color: #fff; background-color: #107e19; border: 1px solid #063e0f; box-shadow: 0 3px 0 #063e0f; border-radius: 3px; text-align: center; text-decoration: none; cursor: pointer;"><img style="width: 24px; height: 24px;" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMjciIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtMTIuNTA5IDAuODR2Ni4yNjU3bDUuNzU0MSAwLjEwNDE0eiIgZmlsbD0iIzY5Njk2OSIgc3Ryb2tlLXdpZHRoPSIwIi8+PGcgdHJhbnNmb3JtPSJtYXRyaXgoMS4wMTE4IDAgMCAxLjAxMDYgLTIuMTYyMSAtMy4yMDI0KSIgZmlsbC1ydWxlPSJldmVub2RkIj48cG9seWxpbmUgcG9pbnRzPSIyMC41IDI5IDMgMjkgMyA0IDE0LjUgNCAxNC41IDEwLjIgMjAuNSAxMC4yIDIwLjUgMjkiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iI2ZmZiIgZmlsbC1ydWxlPSJldmVub2RkIi8+PHBvbHlsaW5lIHBvaW50cz0iMjAgMTQgMzEgMTQgMzEgMjUgMjAgMjUiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZmlsbD0iI2ZmZiIgZmlsbC1ydWxlPSJldmVub2RkIi8+PGcgaWQ9Imljb24tNzAtZG9jdW1lbnQtZmlsZS1wZGYiIGZpbGw9IiM5MjkyOTIiPjxwYXRoIGlkPSJkb2N1bWVudC1maWxlLXBkZiIgZD0ibTI1IDE5di0yaDR2LTFoLTV2N2gxdi0zaDN2LTF6bS0xMy0xdjVoMXYtM2gxLjk5NTFjMS4xMDczIDAgMi4wMDQ5LTAuODg3NzMgMi4wMDQ5LTIgMC0xLjEwNDYtMC44OTM5LTItMi4wMDQ5LTJoLTIuOTk1MXptMS0xdjJoMi4wMDFjMC41NTE3MSAwIDAuOTk4OTYtMC40NDM4NiAwLjk5ODk2LTEgMC0wLjU1MjI4LTAuNDQyNjYtMS0wLjk5ODk2LTF6bTUtMXY3aDIuOTk1MWMxLjEwNzMgMCAyLjAwNDktMC44ODY1NiAyLjAwNDktMi4wMDU5di0yLjk4ODJjMC0xLjEwNzgtMC44OTM5LTIuMDA1OS0yLjAwNDktMi4wMDU5em0xIDF2NWgyLjAwMWMwLjU1MTcxIDAgMC45OTg5Ni0wLjQ0MzcyIDAuOTk4OTYtMC45OTk4MXYtMy4wMDA0YzAtMC41NTIxOC0wLjQ0MjY2LTAuOTk5ODEtMC45OTg5Ni0wLjk5OTgxeiIgZmlsbD0iI2VhNGMzYSIvPjwvZz48L2c+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjkuNjc1IC0uMSkiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGcgZmlsbD0iIzkyOTI5MiI+PHBhdGggZD0ibS0xMC42NzUgMTAuMXYtM2wtNi03aC0xMC45OTdjLTEuMTA2MSAwLTIuMDAyOCAwLjg5ODM0LTIuMDAyOCAyLjAwNzN2MjIuOTg1YzAgMS4xMDg2IDAuODkwOTIgMi4wMDczIDEuOTk3NCAyLjAwNzNoMTUuMDA1YzEuMTAzMSAwIDEuOTk3NC0wLjg5ODIxIDEuOTk3NC0xLjk5MDh2LTIuMDA5Mmg3Ljk5MzJjMS42NjA2IDAgMy4wMDY4LTEuMzQyMyAzLjAwNjgtMi45OTg4di03LjAwMjRjMC0xLjY1NjItMS4zMzYtMi45OTg4LTMuMDA2OC0yLjk5ODh6bS0xIDEzdjIuMDA2NmMwIDAuNTQ4NDUtMC40NDc3IDAuOTkzNC0wLjk5OTk2IDAuOTkzNGgtMTVjLTAuNTQ1MjUgMC0wLjk5OTk2LTAuNDQ1NjgtMC45OTk5Ni0wLjk5NTQ2di0yMy4wMDljMC0wLjU0MDE5IDAuNDQ1NzQtMC45OTU0NiAwLjk5NTU4LTAuOTk1NDZoMTAuMDA0djQuOTk0MWMwIDEuMTE5NCAwLjg5NDUgMi4wMDU5IDEuOTk3OSAyLjAwNTloNC4wMDIxdjJoLTcuOTkzMmMtMS42NjA2IDAtMy4wMDY4IDEuMzQyMy0zLjAwNjggMi45OTg4djcuMDAyNGMwIDEuNjU2MiAxLjMzNiAyLjk5ODggMy4wMDY4IDIuOTk4OHptLTUtMjEuNXY0LjQ5MTJjMCAwLjU1NzE0IDAuNDUwNjUgMS4wMDg4IDAuOTk2NzQgMS4wMDg4aDMuNzAzMnptLTMuMDA1NCA5LjVjLTEuMTAxNiAwLTEuOTk0NiAwLjkwMDE4LTEuOTk0NiAxLjk5MnY3LjAxNmMwIDEuMTAwMiAwLjkwMjM0IDEuOTkyIDEuOTk0NiAxLjk5MmgxNy4wMTFjMS4xMDE2IDAgMS45OTQ2LTAuOTAwMTggMS45OTQ2LTEuOTkydi03LjAxNmMwLTEuMTAwMi0wLjkwMjM0LTEuOTkyLTEuOTk0Ni0xLjk5MnoiLz48L2c+PC9nPjxwYXRoIGQ9Im0zLjE1OTggNC4xMzY3aDciIGZpbGw9IiM2OTY5NjkiIHN0cm9rZT0iIzY5Njk2OSIgc3Ryb2tlLXdpZHRoPSIxcHgiLz48cGF0aCBkPSJtNC4xNTk4IDcuMTM2N2g2IiBmaWxsPSIjNjk2OTY5IiBzdHJva2U9IiM2OTY5NjkiIHN0cm9rZS13aWR0aD0iMXB4Ii8+PC9zdmc+Cg==">&nbsp;Guardar tabla</div></div>';
								echo '<div id="loadpdf"></div>';
							} else {
								echo ("No hay ejercicios registrados.");
							}
						} else {
							echo ("Al estar caducado el plan no se muestra ningún ejercicio.");
						}
					} else {
						echo ("No hay ejercicios registrados.");
					}
				} else {
					echo ("El usuario no tiene contratado ningún plan.");
				}
			} else {
				echo 'Usuario no registrado.';
			}
		}
	}

	return $content;
}

function data2()
{
	$slug_page = 'miplandeentrenamiento'; //slug de la página en donde se mostrará la tabla

	if (is_page($slug_page)) {
		echo "Hola: ";



		$current_user = wp_get_current_user();
		echo ($current_user->user_login);
		//var_dump($user);
	}
}
add_action('wp_head', 'data2');



// Here we register our "send_form" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "send_form" action.
add_action('wp_ajax_send_form', 'send_form'); // This is for authenticated users
add_action('wp_ajax_nopriv_send_form', 'send_form'); // This is for unauthenticated users.

/**
 * In this function we will handle the form inputs and send our email.
 *
 * @return void
 */

function send_form()
{
	if (checkPermisionAjaxAction('send_form')) {
		$hasError = false;
		$errorMessage = [];
		$data = [];

		$dataForm = [];

		$dataForm['nombre'] = $_POST["nombre"];
		if (empty($dataForm['nombre'])) {
			$hasError = true;
			array_push($errorMessage, "Inserta el nombre y el apellido");
		}

		$dataForm['edad'] = $_POST["edad"];
		if (empty($dataForm['edad'])) {
			$hasError = true;
			array_push($errorMessage, 'Inserta la edad');
		}

		$dataForm['genero'] = $_POST["genero"];
		if (empty($dataForm['genero'])) {
			$hasError = true;
			array_push($errorMessage,  "Inserta el género");
		}

		if (empty($_POST["objetivo"])) {
			$hasError = true;
			array_push($errorMessage, "Inserta el objetivo");
		} else {
			$dataForm['objetivo'] = objetivoPorNombre($_POST["objetivo"]);
		}
		$dataForm['enfermedad'] = $_POST["enfermedad"];

		$data['arrayMessage'] = $errorMessage;

		$current_user = wp_get_current_user();
		if (!$hasError && is_user_logged_in()) {
			$itemsDatosPlanUsuario = planPagado($current_user->ID);

			if (count($itemsDatosPlanUsuario) != 0) {

				crearPatologiasUsuario($dataForm['enfermedad']);
				$data['patologiaUsuario'] = patologiasUsuario($current_user->ID);

				$days = diasRestantes($itemsDatosPlanUsuario[0]->fechaFin);
				
				$data['plan'] =  $itemsDatosPlanUsuario[0]->plan;
				$data['fechaInicio'] =  $itemsDatosPlanUsuario[0]->fechaInicio;
				$data['fechaFin'] =  $itemsDatosPlanUsuario[0]->fechaFin;
				$data['diasRestantes'] =  $days;
				$data['activo'] =  $itemsDatosPlanUsuario[0]->activo;
				$data['activo'] =  $itemsDatosPlanUsuario[0]->pagado;
				$data['ejercicios'] =  ejerciciosUsuario($dataForm, $current_user->ID, $itemsDatosPlanUsuario[0]);

				// Guardar los datos con los que el usuario realizó la consulta
				global $wpdb;
				$dataUser['edad'] = $dataForm['edad'];


				$obj = $dataForm['objetivo'];
				$itemsObjetivo =  buscarObjetivo($obj[0]->nombre);
				$dataObjetivo = [];
				$dataObjetivo['id_entrenamiento'] = $itemsDatosPlanUsuario[0]->id_entrenamiento;
				$dataObjetivo['id_objetivo'] = $itemsObjetivo[0]->id_objetivo;

				if (existeEntrenamientoObjetivo($itemsDatosPlanUsuario[0]->id_entrenamiento)) {
					$dataEntrObj = [];
					$dataEntrObj['id_objetivo'] = $itemsObjetivo[0]->id_objetivo;
					$wpdb->update('entrenamiento_objetivo', $dataEntrObj, array('id_entrenamiento' => $itemsDatosPlanUsuario[0]->id_entrenamiento));
				} else {
					$wpdb->insert('entrenamiento_objetivo', $dataObjetivo);
				}

				$wpdb->update($wpdb->users, $dataUser, array('ID' => $current_user->ID));
			} else {
				$data['sinPlan'] = true;
			}
		}
		$data['hasError'] = false;
		echo json_encode($data);
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error = [];
		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
		echo json_encode($error);
	}
	wp_die();
}

function existeEntrenamientoObjetivo($idEntrenamiento)
{
	global $wpdb;

	$queryEntrenamientoObjetivo = 'SELECT * FROM entrenamiento_objetivo WHERE id_entrenamiento = ' . $idEntrenamiento;
	$itemsDatosPlanUsuario = $wpdb->get_results($queryEntrenamientoObjetivo);

	return count($itemsDatosPlanUsuario) > 0;
}

function buscarObjetivo($obj)
{
	global $wpdb;

	$queryObjetivo = 'SELECT * FROM objetivos  WHERE nombre LIKE "' . $obj . '"';

	$itemsObjetivo = $wpdb->get_results($queryObjetivo);

	return $itemsObjetivo;
}

function patologiasUsuario($idUsuario)
{
	global $wpdb;

	$queryPatologiaUsuario = 'SELECT * FROM usuarios_patologias  as up';
	$queryPatologiaUsuario .= ' INNER JOIN patologias AS pat ON pat.id_patologia = up.patologia_id';
	$queryPatologiaUsuario .= ' WHERE up.usuario_id = ' . $idUsuario;

	$itemsPatologiaUsuario = $wpdb->get_results($queryPatologiaUsuario);

	return $itemsPatologiaUsuario;
}

function obtenerPatologia($nombrePat)
{

	global $wpdb;

	$queryPatologia = 'SELECT * FROM patologias WHERE patologia LIKE "' . $nombrePat . '"';
	$itemsPatologia = $wpdb->get_results($queryPatologia);

	return $itemsPatologia;
}

function crearPatologiasUsuario($nombrePat)
{

	global $wpdb;
	$current_user = wp_get_current_user();
	$data = [];

	$patologia = obtenerPatologia($nombrePat);
	$patId = $patologia[0]->id_patologia;

	if ($patId != null) {
		// Datos a insertar
		$data['usuario_id'] = $current_user->ID;
		$data['patologia_id'] = (int)$patId;

		if (usuarioTienePatologia($patId, $current_user->ID) == 0) {
			$wpdb->insert('usuarios_patologias', $data);
		}
	}
}

function usuarioTienePatologia($patId, $idUsuario)
{
	global $wpdb;

	$queryPatologia = 'SELECT count(*) as total FROM usuarios_patologias WHERE patologia_id = ' . $patId. ' AND usuario_id = ' . $idUsuario;
	$itemsPatologia = $wpdb->get_results($queryPatologia);

	return (int)$itemsPatologia[0]->total > 0;
}

function buscarEjercicios($idUsuario)
{
	$plan = planActual($idUsuario);
	if (count($plan) > 0) {
		if (hayEjercicioEntrenador($plan[0]->id_entrenamiento)) {
			$itemsEjercicios = ejerciciosEntrenador($plan);
		} else {
			$dataEjer = obtenerDatos($idUsuario);
			$itemsEjercicios = ejerciciosUsuario($dataEjer, $idUsuario, $plan[0]);
		}
	}
	return $itemsEjercicios;
}

function hayEjercicioEntrenador($idEntrenamiento)
{
	global $wpdb;

	$hay = false;
	$queryEntrenamiento = 'SELECT * FROM entrenamiento WHERE modificado = 1 AND id_entrenamiento = ' . (int)$idEntrenamiento;
	$itemsEntrenamiento = $wpdb->get_results($queryEntrenamiento);
	if (count($itemsEntrenamiento) > 0) {
		$hay = (bool)($itemsEntrenamiento[0]->modificado);
	}

	return $hay;
}

function buscarSerie($idEjercicio, $plan)
{
	global $wpdb;

	$queryEjercicios = 'SELECT *';
	$queryEjercicios .= ' FROM serie AS ser';
	$queryEjercicios .= ' WHERE ser.id_ejercicio = ' . $idEjercicio. ' AND plan LIKE "'.$plan.'"';

	$itemsSerie = $wpdb->get_results($queryEjercicios);

	return $itemsSerie[0]->numeroYRepeticiones;
}

function ejerciciosEntrenador($plan)
{
	global $wpdb;
	$nombrePlan = $plan[0]->plan;
	$idEntrenamiento =  $plan[0]->id_entrenamiento;

	$queryEjercicios = 'SELECT *';
	$queryEjercicios .= ' FROM ejercicio_entrenador AS ejerent';
	$queryEjercicios .= ' INNER JOIN ejercicios AS ejer ON ejer.id_ejercicio = ejerent.id_ejercicio';
	$queryEjercicios .= ' INNER JOIN categoria AS cat ON cat.id_categoria = ejer.id_categoria';
	$queryEjercicios .= ' LEFT JOIN serie AS ser ON ser.id_ejercicio = ejer.id_ejercicio';
	$queryEjercicios .= ' WHERE';
	$queryEjercicios .= ' ser.plan LIKE "' . $nombrePlan . '"';
	$queryEjercicios .= ' AND id_entrenamiento = ' . $idEntrenamiento;

	$itemsEjercicios = $wpdb->get_results($queryEjercicios);

	return $itemsEjercicios;
}

function ejerciciosUsuario($data, $idUsuario, $planActual)
{
	global $wpdb;
	$nombrePlan = $planActual->plan;
	$edad = $data['edad'];
	$itemsObjetivos = $data['objetivo'];
	$objs = '(';
	$i = 0;
	foreach ($itemsObjetivos as $item_obj) {
		if ($i > 0) {
			$objs .= ' OR ';
		}
		$objs .= ' obj.nombre LIKE "' . $item_obj->nombre . '"';
		$i++;
	}
	$objs .= ')';

	$queryEjerciciosIncompatiblePlanUsuario = 'SELECT DISTINCT ejer.*, obj.nombre, cat.nombreCategoria, ser.id_serie, ser.numeroYRepeticiones';
	$queryEjerciciosIncompatiblePlanUsuario .= ' FROM ejercicios AS ejer';
	$queryEjerciciosIncompatiblePlanUsuario .= ' INNER JOIN ejercicio_objetivo AS ejero ON ejero.id_ejercicio = ejer.id_ejercicio';
	$queryEjerciciosIncompatiblePlanUsuario .= ' INNER JOIN objetivos AS obj ON obj.id_objetivo = ejero.id_objetivo';
	$queryEjerciciosIncompatiblePlanUsuario .= ' INNER JOIN categoria AS cat ON cat.id_categoria = ejer.id_categoria';
	$queryEjerciciosIncompatiblePlanUsuario .= ' INNER JOIN serie AS ser ON ser.id_ejercicio = ejer.id_ejercicio';
	$queryEjerciciosIncompatiblePlanUsuario .= ' LEFT JOIN incompatibilidad_ejercicio_patologia AS inc ON inc.id_ejercicio = ejer.id_ejercicio';
	$queryEjerciciosIncompatiblePlanUsuario .= ' LEFT JOIN usuarios_patologias AS upat ON upat.patologia_id = inc.id_patologia';
	$queryEjerciciosIncompatiblePlanUsuario .= ' WHERE';
	$queryEjerciciosIncompatiblePlanUsuario .= ' upat.usuario_id = ' . $idUsuario;
	$queryEjerciciosIncompatiblePlanUsuario .= ' AND rangoini <= ' . $edad;
	$queryEjerciciosIncompatiblePlanUsuario .= ' AND ' . $edad . ' <= rangofin';
	$queryEjerciciosIncompatiblePlanUsuario .= ' AND ser.plan LIKE "' . $nombrePlan . '"';
	$queryEjerciciosIncompatiblePlanUsuario .= ' AND ' . $objs;

	$itemsEjerciciosIncompatibleUsuario = $wpdb->get_results($queryEjerciciosIncompatiblePlanUsuario);

	$qEjer = '';
	$i = 0;
	foreach ($itemsEjerciciosIncompatibleUsuario as $ejercicioIncompatible) {
		if ($i > 0) {
			$qEjer .= ' AND ';
		}
		$qEjer .= ' ejer.id_ejercicio <> "' . $ejercicioIncompatible->id_ejercicio . '"';
		$i++;
	}
	if ($qEjer != '') {
		$qEjer = ' AND (' . $qEjer . ')';
	}

	$queryEjercicios = 'SELECT * FROM ejercicios AS ejer';
	$queryEjercicios .= ' INNER JOIN ejercicio_objetivo AS ejero ON ejero.id_ejercicio = ejer.id_ejercicio';
	$queryEjercicios .= ' INNER JOIN objetivos AS obj ON obj.id_objetivo = ejero.id_objetivo';
	$queryEjercicios .= ' INNER JOIN categoria AS cat ON cat.id_categoria = ejer.id_categoria';
	$queryEjercicios .= ' INNER JOIN serie AS ser ON ser.id_ejercicio = ejer.id_ejercicio';
	$queryEjercicios .= ' WHERE ';
	$queryEjercicios .= ' rangoini <= ' . $edad;
	$queryEjercicios .= ' AND ' . $edad . ' <= rangofin';
	$queryEjercicios .= ' AND ser.plan LIKE "' . $nombrePlan . '"';
	$queryEjercicios .= ' AND ' . $objs;
	$queryEjercicios .= $qEjer;

	$itemsEjercicios = $wpdb->get_results($queryEjercicios);

	return $itemsEjercicios;
}

function planActual($idUsuario)
{
	global $wpdb;

	if ($idUsuario === '') {
		$current_user = wp_get_current_user();
		$idUsuario = $current_user->ID;
	}

	$queryDatosPlanUsuario = 'SELECT * FROM entrenamiento WHERE id_usuario =' . $idUsuario . ' AND fechaFin >= DATE(NOW())';
	$itemsDatosPlanUsuario = $wpdb->get_results($queryDatosPlanUsuario);

	return $itemsDatosPlanUsuario;
}

function planUsuario($idUsuario)
{
	global $wpdb;

	if ($idUsuario === '') {
		$current_user = wp_get_current_user();
		$idUsuario = $current_user->ID;
	}

	$queryDatosPlanUsuario = 'SELECT * FROM entrenamiento WHERE id_usuario =' . $idUsuario;
	$itemsDatosPlanUsuario = $wpdb->get_results($queryDatosPlanUsuario);

	return $itemsDatosPlanUsuario;
}

function guardarEjerciciosActuales($idEntrenamiento, $idUsuario)
{

	if (!hayEjercicioEntrenador($idEntrenamiento)) {
		// Guardarlos
		global $wpdb;
		$itemEjercicios = buscarEjercicios($idUsuario);
		$planUsuario = planUsuario($idUsuario);

		foreach ($itemEjercicios as $ejer) {
			$data = [];

			// Datos a insertar
			$data['id_ejercicio'] = $ejer->id_ejercicio;
			$data['id_entrenamiento'] = (int)$idEntrenamiento;
			$data['entNumeroYRepeticiones'] = buscarSerie($ejer->id_ejercicio, $planUsuario[0]->plan);

			$wpdb->insert('ejercicio_entrenador', $data);
		}

		$dataEntrenamiento = [];
		$dataEntrenamiento['modificado'] = true;
		$wpdb->update('entrenamiento', $dataEntrenamiento, array('id_usuario' => $idUsuario, 'id_entrenamiento' => $idEntrenamiento));
	}
}

add_action('wp_ajax_action_actualizarSerie', 'action_actualizarSerie'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_actualizarSerie', 'action_actualizarSerie'); // This is for unauthenticated users.

function action_actualizarSerie()
{
	if (checkPermisionAjaxAction('action_actualizarSerie')) {

		$idUsuario = $_POST['idUsuario'];
		$idEjercicio = $_POST['idEjercicio'];
		$idEntrenamiento = $_POST['idEntrenamiento'];
		$serie =  $_POST['serie'];

		guardarEjerciciosActuales($idEntrenamiento, $idUsuario);

		if (hayEjercicioEntrenador($idEntrenamiento)) {
			global $wpdb;

			$dataEjercicioEntrenador = [];
			$dataEjercicioEntrenador['entNumeroYRepeticiones'] = $serie;

			$wpdb->update('ejercicio_entrenador', $dataEjercicioEntrenador, array('id_ejercicio' => $idEjercicio, 'id_entrenamiento' => $idEntrenamiento));
		}
	}
}

add_action('wp_ajax_action_borrarEjercicio', 'action_borrarEjercicio'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_borrarEjercicio', 'action_borrarEjercicio'); // This is for unauthenticated users.

function action_borrarEjercicio()
{
	$error = [];
	if (checkPermisionAjaxAction('action_borrarEjercicio')) {
		global $wpdb;

		$idEjercicio = $_POST['idEjercicio'];
		$idEntrenamiento = $_POST['idEntrenamiento'];
		$idUsuario = $_POST['idUsuario'];

		if (!hayEjercicioEntrenador($idEntrenamiento)) {
			// Guardarlos
			$itemEjercicios = buscarEjercicios($idUsuario);
			$planUsuario = planUsuario($idUsuario);

			foreach ($itemEjercicios as $ejer) {
				$data = [];

				// Datos a insertar
				$data['id_ejercicio'] = (int)$ejer->id_ejercicio;
				$data['id_entrenamiento'] = (int)$idEntrenamiento;
				$data['entNumeroYRepeticiones'] = buscarSerie($ejer->id_ejercicio, $planUsuario[0]->plan);
				
				$wpdb->insert('ejercicio_entrenador', $data);
			}

			$dataEntrenamiento = [];
			$dataEntrenamiento['modificado'] = true;
			$wpdb->update('entrenamiento', $dataEntrenamiento, array('id_usuario' => $idUsuario, 'id_entrenamiento' => $idEntrenamiento));
		}

		$data = [];
		$data['id_entrenamiento'] =  $idEntrenamiento;
		$data['id_ejercicio'] =  $idEjercicio;

		$wpdb->delete('ejercicio_entrenador', $data, array('id_entrenamiento' => $idEntrenamiento, 'id_ejercicio' => $idEjercicio));
		$error['hasError'] = false;
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
	}
	echo json_encode($error);
	wp_die();
}


add_action('wp_ajax_action_incluirEjercicio', 'action_incluirEjercicio'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_incluirEjercicio', 'action_incluirEjercicio'); // This is for unauthenticated users.

function action_incluirEjercicio()
{
	$error = [];
	if (checkPermisionAjaxAction('action_incluirEjercicio')) {
		global $wpdb;

		$idEjercicio = $_POST['idEjercicio'];
		$idEntrenamiento = $_POST['idEntrenamiento'];
		$idUsuario = $_POST['idUsuario'];
		$serie = $_POST['serie'];

		guardarEjerciciosActuales($idEntrenamiento, $idUsuario);
		$planUsuario = planUsuario($idUsuario);

		if ($serie == null) {
			$serie = buscarSerie($idEjercicio, $planUsuario[0]->plan);
		}

		$data = [];
		$data['id_entrenamiento'] =  (int)$idEntrenamiento;
		$data['id_ejercicio'] =  (int)$idEjercicio;
		$data['entNumeroYRepeticiones'] = $serie;

		$wpdb->insert('ejercicio_entrenador', $data);

		$error['hasError'] = false;
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
	}
	echo json_encode($error);
	wp_die();
}

add_action('wp_ajax_action_ejercicioPredefinido', 'action_ejercicioPredefinido'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_ejercicioPredefinido', 'action_ejercicioPredefinido'); // This is for unauthenticated users.

function action_ejercicioPredefinido()
{
	$error = [];
	if (checkPermisionAjaxAction('action_ejercicioPredefinido')) {
		global $wpdb;

		$idEntrenamiento = $_POST['idEntrenamiento'];
		$idUsuario = $_POST['idUsuario'];

		$dataPlan = planActual($idUsuario);

		$data = [];
		$data['id_entrenamiento'] =  $dataPlan[0]->id_entrenamiento;
		$wpdb->delete('ejercicio_entrenador', $data, array('id_entrenamiento' => $dataPlan[0]->id_entrenamiento));

		$dataEntrenamiento = [];
		$dataEntrenamiento['modificado'] = false;
		$wpdb->update('entrenamiento', $dataEntrenamiento, array('id_usuario' => $idUsuario, 'id_entrenamiento' => $idEntrenamiento));

		$error['hasError'] = false;
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
	}
	echo json_encode($error);
	wp_die();
}

function ejerciciosParaEntrenador($itemsEjercicios)
{
	global $wpdb;

	$cond = '';
	$index = 0;
	foreach ($itemsEjercicios as $item_ejer) {
		if ($index > 0) {
			$cond .= ' AND ';
		}

		$cond .= ' id_ejercicio <> ' . $item_ejer->id_ejercicio;

		$index++;
	}

	$queryEjercicios = 'SELECT * FROM ejercicios ';
	if ($cond !== '') {
		$queryEjercicios .= ' WHERE ' . $cond;
	}
	$itemsEjercicios = $wpdb->get_results($queryEjercicios);

	return $itemsEjercicios;
}


// Here we register our "action_buscarEjercicios" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_buscarEjercicios" action.
add_action('wp_ajax_action_buscarEjercicios', 'action_buscarEjercicios'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_buscarEjercicios', 'action_buscarEjercicios'); // This is for unauthenticated users.

function action_buscarEjercicios()
{
	if (checkPermisionAjaxAction('action_buscarEjercicios')) {

		$idUsuario = $_POST['idUsuario'];
		$data = [];

		$itemsEjercicios = buscarEjercicios($idUsuario);
		$itemsDatosPlanUsuario = planActual($idUsuario);
		$data['plan'] =  $itemsDatosPlanUsuario[0];
		if($itemsDatosPlanUsuario == null){
			$planUsuario = planUsuario($idUsuario);
			$data['modificado'] = $planUsuario[0]->modificado;
		}else{
			$data['modificado'] = $itemsDatosPlanUsuario[0]->modificado;
		}
		$data['ejercicios'] = $itemsEjercicios;
		$data['patologiaUsuario'] = patologiasUsuario($idUsuario);
		
		$days = diasRestantes($itemsDatosPlanUsuario[0]->fechaFin);
		
		
		
		$data['diasRestantes'] =  $days;
		$data['ejerciciosEntrenador'] = ejerciciosParaEntrenador($itemsEjercicios);
		$data['hasError'] = false;

		echo json_encode($data);
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error = [];
		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
		echo json_encode($error);
	}
	wp_die();
}

function planAnterior($idUsuario)
{
	global $wpdb;

	if ($idUsuario === '') {
		$current_user = wp_get_current_user();
		$idUsuario = $current_user->ID;
	}

	$queryDatosPlanUsuario = 'SELECT * FROM entrenamiento WHERE id_usuario =' . $idUsuario . ' AND (fechaFin < DATE(NOW()) OR fechaFin IS NULL)';
	$itemsDatosPlanUsuario = $wpdb->get_results($queryDatosPlanUsuario);

	return $itemsDatosPlanUsuario;
}

function planPagadoNoActivo($idUsuario)
{
	global $wpdb;

	if ($idUsuario === '') {
		$current_user = wp_get_current_user();
		$idUsuario = $current_user->ID;
	}

	$queryDatosPlanUsuario = 'SELECT * FROM entrenamiento WHERE id_usuario =' . $idUsuario . ' AND pagado = 1 AND activo = 0';
	$itemsDatosPlanUsuario = $wpdb->get_results($queryDatosPlanUsuario);

	return $itemsDatosPlanUsuario;
}

function planPagado($idUsuario)
{
	global $wpdb;

	if ($idUsuario === '') {
		$current_user = wp_get_current_user();
		$idUsuario = $current_user->ID;
	}

	$queryDatosPlanUsuario = 'SELECT * FROM entrenamiento WHERE id_usuario =' . $idUsuario . ' AND pagado = 1 AND activo = 1 AND fechaFin >= DATE(NOW())';
	$itemsDatosPlanUsuario = $wpdb->get_results($queryDatosPlanUsuario);

	return $itemsDatosPlanUsuario;
}


// Here we register our "action_pagar" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_pagar" action.
add_action('wp_ajax_action_pagar', 'action_pagar'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_pagar', 'action_pagar'); // This is for unauthenticated users.

function action_pagar()
{
	$error = [];
	if (checkPermisionAjaxAction('action_pagar')) {
		$plan = $_POST["plan"];
		if (empty($plan)) {
			echo "Inserta el plan ";
			wp_die();
		}

		eliminarDatosFormularioTabla();

		if (is_user_logged_in()) {

			global $wpdb;
			$current_user = wp_get_current_user();
			$data = [];

			// Datos a insertar
			$data['id_usuario'] = $current_user->ID;
			$data['plan'] = $plan;
			$data['activo'] = false;
			$data['pagado'] = true;
			$data['modificado'] = false;

			$plan = planUsuario($current_user->ID);
			if (count($plan) == 0) {
				$data['fechaFin'] = null;
				$data['fechaInicio'] = null;

				$wpdb->insert('entrenamiento', $data);
			} else {
				$wpdb->update('entrenamiento', $data, array('id_usuario' => $plan[0]->id_usuario, 'id_entrenamiento' => $plan[0]->id_entrenamiento));
			}
		}
		$error['hasError'] = false;
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
	}
	echo json_encode($error);
	wp_die();
}


// Here we register our "action_activar_plan" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_activar_plan" action.
add_action('wp_ajax_action_activar_plan', 'action_activar_plan'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_activar_plan', 'action_activar_plan'); // This is for unauthenticated users.

function action_activar_plan()
{
	$error = [];
	if (checkPermisionAjaxAction('action_activar_plan')) {
		global $wpdb;
		$current_user = wp_get_current_user();
		$data = [];
		$plan = planUsuario($current_user->ID);

		if (count($plan) > 0) {
			$data['fechaInicio'] = date("Y/m/d");
			$data['fechaFin'] = date('Y-m-d', strtotime($data['fechaInicio'] . ' +30 days'));
		}
		$data['activo'] = true;
		$data['id_usuario'] =  $current_user->ID;

		$wpdb->update('entrenamiento', $data, array('id_usuario' => $current_user->ID));

		$error['hasError'] = false;
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
	}

	echo json_encode($error);
	wp_die();
}

// Here we register our "action_entrenamiento" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_entrenamiento" action.
add_action('wp_ajax_action_entrenamiento', 'action_entrenamiento'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_entrenamiento', 'action_entrenamiento'); // This is for unauthenticated users.

function action_entrenamiento()
{
	if (checkPermisionAjaxAction('action_entrenamiento')) {
		$current_user = wp_get_current_user();
		$data = [];
		$dataEjer = obtenerDatos($current_user->ID);
		$data['haydatos'] = $dataEjer['haydatos'];
		if ($dataEjer['haydatos']) {
			$itemsDatosPlanUsuario = planActual($current_user->ID);

			if (count($itemsDatosPlanUsuario) != 0) {
				$days = diasRestantes($itemsDatosPlanUsuario[0]->fechaFin);
				
				$data['caducado'] =  false;
				$data['plan'] =  $itemsDatosPlanUsuario[0]->plan;
				$data['fechaInicio'] =  $itemsDatosPlanUsuario[0]->fechaInicio;
				$data['fechaFin'] =  $itemsDatosPlanUsuario[0]->fechaFin;
				$data['diasRestantes'] =  $days;
				$data['activo'] =  $itemsDatosPlanUsuario[0]->activo;
				$data['ejercicios'] = buscarEjercicios($current_user->ID);
				$data['patologiaUsuario'] = patologiasUsuario($current_user->ID);
			}else{
				$data['caducado'] =  true;
			}
		}

		$data['hasError'] = false;
		echo json_encode($data);
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error = [];
		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
		echo json_encode($error);
	}
	wp_die();
}

// Here we register our "action_renovar_plan" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_renovar_plan" action.
add_action('wp_ajax_action_renovar_plan', 'action_renovar_plan'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_renovar_plan', 'action_renovar_plan'); // This is for unauthenticated users.

function action_renovar_plan()
{
	if (checkPermisionAjaxAction('action_renovar_plan')) {
		global $wpdb;

		$current_user = wp_get_current_user();
		$plan = planActual($current_user->ID);
		$currentDate = date("Y-m-d");

		$fecha1 = new DateTime($plan[0]->fechaFin);
		$fecha2 = new DateTime($currentDate);
		$days = $fecha2->diff($fecha1)->days + 30;

		$data = [];
		$data['fechaInicio'] =  $plan[0]->fechaFin;
		$data['fechaFin'] = date('Y-m-d', strtotime($data['fechaInicio'] . ' +' . $days . ' days'));
		$data['pagado'] = false;
		$data['activo'] = false;

		$wpdb->update('entrenamiento', $data, array('id_usuario' => $current_user->ID));

		// Para que al renovar el plan te deje rellenar el formulario de tabla.
		$dataUser = [];
		$dataUser['edad'] = null;
		$wpdb->update('wp_users', $dataUser, array('ID' => $current_user->ID));
		

		$dataR = [];
		$dataR['plan'] = $plan[0]->plan;
		$dataR['hasError'] = false;

		echo json_encode($dataR);
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error = [];
		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
		echo json_encode($error);
	}

	wp_die();
}

// Here we register our "action_planPagado" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_planPagado" action.
add_action('wp_ajax_action_planPagado', 'action_planPagado'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_planPagado', 'action_planPagado'); // This is for unauthenticated users.

function action_planPagado()
{
	if (checkPermisionAjaxAction('action_planPagado')) {
		$data = [];
		$current_user = wp_get_current_user();
		$plan = planActual($current_user->ID);
		if (count($plan) > 0) {
			$data['exist'] = true;
			$data['pagado'] = $plan[0]->pagado;
		} else {
			$data['exist'] = false;
		}
		$data['hasError'] = false;
		echo json_encode($data);
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error = [];
		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
		echo json_encode($error);
	}

	wp_die();
}

function obtenerDatos($idUsuario)
{
	global $wpdb;

	$data = [];

	$queryDatosUsuario = 'SELECT * FROM wp_users WHERE ID =' . $idUsuario;
	$itemsDatosUsuario = $wpdb->get_results($queryDatosUsuario);
	$itemsPatologiaUsuario =  patologiasUsuario($idUsuario);

	$planActual = planActual($idUsuario);
	if (count($planActual) > 0) {
		$itemsObjetivos  = objetivosEntrenamiento($planActual[0]->id_entrenamiento);
		$data['objetivo'] = $itemsObjetivos;
	}

	$data['enfermedad'] = $itemsPatologiaUsuario;

	$data['edad'] = $itemsDatosUsuario[0]->edad;
	if ($itemsDatosUsuario[0]->edad > 0) {
		$data['haydatos'] = true;
	} else {
		$data['haydatos'] = false;
	}

	return $data;
}

function objetivosEntrenamiento($id)
{
	global $wpdb;

	$queryEntrenamientoObjetivo =
		'SELECT * FROM entrenamiento_objetivo AS eo' .
		' INNER JOIN objetivos AS obj ON obj.id_objetivo = eo.id_objetivo' .
		' WHERE eo.id_entrenamiento = ' . $id;
	$itemsEntrenamientoObjetivo = $wpdb->get_results($queryEntrenamientoObjetivo);

	return $itemsEntrenamientoObjetivo;
}

function objetivoPorNombre($nombre)
{
	global $wpdb;

	$queryObjetivo =
		'SELECT * FROM objetivos AS obj' .
		' WHERE obj.nombre LIKE "' . $nombre . '"';
	$itemsObjetivo = $wpdb->get_results($queryObjetivo);

	return $itemsObjetivo;
}

function eliminarDatosFormularioTabla()
{
	$current_user = wp_get_current_user();
	$planActual = planActual($current_user->ID);
	if (count($planActual) ==  0) {
		global $wpdb;
		$dataUser['edad'] = null;
		$wpdb->update('wp_users', $dataUser, array('ID' => $current_user->ID));
	}
}

// Here we register our "action_cancelar_plan" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_cancelar_plan" action.
add_action('wp_ajax_action_cancelar_plan', 'action_cancelar_plan'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_cancelar_plan', 'action_cancelar_plan'); // This is for unauthenticated users.

function action_cancelar_plan()
{
	$error = [];
	if (checkPermisionAjaxAction('action_cancelar_plan')) {
		global $wpdb;
		$current_user = wp_get_current_user();
		$dataPlan = planActual($current_user->ID);

		$data = [];
		$data['id_entrenamiento'] =  $dataPlan[0]->id_entrenamiento;

		$wpdb->delete('entrenamiento_objetivo', $data, array('id_entrenamiento ' => $dataPlan[0]->id_entrenamiento));
		$wpdb->delete('ejercicio_entrenador', $data, array('id_entrenamiento' => $dataPlan[0]->id_entrenamiento));
		$wpdb->delete('entrenamiento', $data, array('id_entrenamiento' => $dataPlan[0]->id_entrenamiento));

		$dataUser['edad'] = null;
		$wpdb->update('wp_users', $dataUser, array('ID' => $current_user->ID));

		$error['hasError'] = false;
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
	}
	echo json_encode($error);
	wp_die();
}

// Here we register our "action_verficarPlan" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_verficarPlan" action.
add_action('wp_ajax_action_verficarPlan', 'action_verficarPlan'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_verficarPlan', 'action_verficarPlan'); // This is for unauthenticated users.

function action_verficarPlan()
{
	if (checkPermisionAjaxAction('action_verficarPlan')) {
		$current_user = wp_get_current_user();
		$dataPlan = planActual($current_user->ID);
		$length = count($dataPlan) > 0;

		$data = [];
		$data['hasError'] = false;
		$data['hayPlan'] = $length;

		echo json_encode($data);
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error = [];
		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
		echo json_encode($error);
	}
	wp_die();
}


add_action('wp_ajax_action_usuariospaginados', 'action_usuariospaginados'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_usuariospaginados', 'action_usuariospaginados'); // This is for unauthenticated users.

function action_usuariospaginados()
{
	if (checkPermisionAjaxAction('action_usuariospaginados')) {
		global $wpdb;
		$page = (int)$_POST["page"];
		$size = 5;

		$data['total'] = 0;
		$data['usuarios'] = [];

		$queryUsuarioEntrenamiento =
			'SELECT * FROM wp_users AS u
			 INNER JOIN entrenamiento AS e ON e.id_usuario = u.ID
			 WHERE e.pagado = 1 AND activo = 1
			 LIMIT ' . $size . ' OFFSET ' . ($page * $size);
		$itemsUsuarioEntrenamiento = $wpdb->get_results($queryUsuarioEntrenamiento);
		$data['usuarios'] = $itemsUsuarioEntrenamiento;

		$queryTotalUsuarioEntrenamiento =
			'SELECT COUNT(*) as total FROM wp_users AS u
			 INNER JOIN entrenamiento AS e ON e.id_usuario = u.ID
			 WHERE e.pagado = 1';
		$itemsTotalUsuarioEntrenamiento = $wpdb->get_results($queryTotalUsuarioEntrenamiento);
		$data['total'] = $itemsTotalUsuarioEntrenamiento[0]->total;
		$data['hasError'] = false;
		echo json_encode($data);
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error = [];
		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
		echo json_encode($error);
	}

	wp_die();
}

add_action('wp_ajax_action_mostrarPlanEntrenamiento', 'action_mostrarPlanEntrenamiento'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_mostrarPlanEntrenamiento', 'action_mostrarPlanEntrenamiento'); // This is for unauthenticated users.
function action_mostrarPlanEntrenamiento()
{
	
	$rol = rolCurrentUser();
	$current_user = wp_get_current_user();
	$planPagado = planPagado($current_user->ID);

	$data['show'] = false;
	if (($rol == 'entrenador' || $rol == 'administrator' || ($rol == 'subscriber' && count($planPagado) >= 1))) {
		$data['show'] = true;
	}
	echo json_encode($data);
	wp_die();
}

// Here we register our "action_generatePdf" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "action_generatePdf" action.
add_action('wp_ajax_action_generatePdf', 'action_generatePdf'); // This is for authenticated users
add_action('wp_ajax_nopriv_action_generatePdf', 'action_generatePdf'); // This is for unauthenticated users.
add_action('action_generatePdf', 'action_generatePdf');

function action_generatePdf()
{
	if (checkPermisionAjaxAction('action_generatePdf')) {
		$current_user = wp_get_current_user();
		$plan = planActual($current_user->ID);
		$ejercicios = buscarEjercicios($current_user->ID);

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$html = '<style>
		.tabla_ejercicios {
			border: 4px solid black;
			background-color: #D7D9DD;
			width: 100%;
			text-align: left;
			border-collapse: collapse;
			box-shadow: 0 1px 0 black;
		  }
		  
		  .tabla_ejercicios td,
		  .tabla_ejercicios th {
			border: 1px solid;
			padding: 3px 2px;
			border: 3px solid #0e0e0e;
		  }
		  
		  .tabla_ejercicios th {
			background-color: black;
			color: white;
		  }
		  
		  .tabla_ejercicios th.custom-bg-ejercicios {
			background-color: #FF593D;
			color: white;
		  }
		  
		  
		  .tabla_patologias {
			border: 4px solid black;
			background-color: #D7D9DD;
			width: 100%;
			text-align: left;
			border-collapse: collapse;
			box-shadow: 0 1px 0 black;
		  }
		  
		  .tabla_patologias td,
		  .tabla_patologias th {
			border: 1px solid;
			padding: 3px 2px;
			border: 3px solid #0e0e0e;
		  }
		  
		  .tabla_patologias th {
			background-color: black;
			color: white;
		  }
		  
		  .centrar-texto {
			text-align: center;
		  }
	</style>';
		$html .= '<div><h3>Rutina personalizada para: ' . $current_user->user_nicename . '</h3></div>';
		$html .= '<div><h3>Plan: ' . $plan[0]->plan . '</h3></div>';
		$html .= '<div><h3>Fecha inicio del plan: ' . $plan[0]->fechaInicio . '</h3></div>';
		$html .= '<div><h3>Fecha finalización del plan: ' . $plan[0]->fechaFin . '</h3></div>';

		$ejerciciosStr = '';
		if (count($ejercicios) > 0) {
			$ejerciciosStr = '<table id="tablaejercicios" class="tabla_ejercicios">';
			$ejerciciosStr .= '<tr>';
			$ejerciciosStr .= '<th colspan="4" class="centrar-texto custom-bg-ejercicios">PROGRAMA DE ENTRENAMIENTO</th>';
			$ejerciciosStr .= '</tr>';
			$ejerciciosStr .= '<tr>';
			$ejerciciosStr .= '<th class="centrar-texto">#</th>';
			$ejerciciosStr .= '<th class="centrar-texto">Nombre del ejercicio</th>';
			$ejerciciosStr .= '<th class="centrar-texto">Categoría</th>';
			$ejerciciosStr .= '<th class="centrar-texto">Series y repeticiones</th>';
			$ejerciciosStr .= '</tr>';

			$index = 0;
			foreach ($ejercicios as $ejer) {
				$ejerciciosStr .= '<tr>';
				$ejerciciosStr .= '<td class="centrar-texto">' . ($index + 1) . '</td>';
				$ejerciciosStr .= '<td class="centrar-texto">' . $ejer->nombreEjer . '</td>';
				$ejerciciosStr .= '<td class="centrar-texto">' . $ejer->nombreCategoria . '</td>';

				if (property_exists($ejer, 'entNumeroYRepeticiones')) {
					$serie = $ejer->entNumeroYRepeticiones;
				} else {
					$serie = $ejer->numeroYRepeticiones;
				}

				$ejerciciosStr .= '<td>' . $serie . '</td>';
				$ejerciciosStr .= '</tr>';

				$index++;
			}
			$ejerciciosStr .= '</table>';
		}
		$html .= $ejerciciosStr;

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
	} else {
		$rol = rolCurrentUser();
		$username = usernameCurrentUser();

		$error = [];
		$error['hasError'] = true;
		$error['code'] = 401;
		$error['rol'] = $rol;
		$error['user'] = $username;
		echo json_encode($error);
	}

	wp_die();
}

function mostrar_menu_lista_usuarios($items, $args)
{
	// Comprobamos si el usuario tiene el rol de "Entrenador"
	if ($args->theme_location == 'main_menu' && is_user_logged_in() && (current_user_can('entrenador') || current_user_can('administrator'))) {
		// Agregamos el enlace de la página de lista de usuarios al menú
		$url = get_permalink('822');
		$items .= '<li><a href="' . esc_url($url) . '" class="nav-link">Lista de usuarios</a></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'mostrar_menu_lista_usuarios', 10, 2);


function mostrar_menu_plan_entrenamiento_personalizado($items, $args)
{
	// Comprobamos si el usuario tiene el rol de "Suscriptor"
	if ($args->theme_location == 'main_menu' && is_user_logged_in() && (current_user_can('suscriptor') || current_user_can('subscriber') || current_user_can('administrator'))) {
		// Agregamos el enlace de la página de lista de usuarios al menú
		$url = get_permalink('678');
		$items .= '<li><a href="' . esc_url($url) . '" class="nav-link">Plan de entrenamiento personalizado</a></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'mostrar_menu_plan_entrenamiento_personalizado', 10, 2);

//Seguridad
//Roles
// administrator, entrenador, subscriber, comercial, cliente
// Devuelve el rol de usuario logado
function rolCurrentUser()
{
	$current_user = wp_get_current_user();
	$rol = '';
	if ($current_user && count($current_user->roles)) {
		$rol = $current_user->roles[0];
	}
	return $rol;
}

// Devuelve el nombre del usuario logado
function usernameCurrentUser()
{
	$current_user = wp_get_current_user();
	$name = $current_user->user_login;

	return $name;
}

// Chekea si el usuario logado tiene permisos para acceder la página solicitada
function checkPermisionAccessPage()
{
	$hasPermission = true;
	$pagename = currentPage();
	$rol = rolCurrentUser();
	$username = usernameCurrentUser();

	// Hay que validar la página a la que se quiere acceder y rol del usuario logado
	// Si el usuario puede acceder a la página se devuelve true y en otro caso false
	// Si no puede acceder además se redirecciona a la página de error.
	if ($pagename == 'planes') {
		// Rol que no puede ver la página planes
		if ($rol == 'comercial') {
			$hasPermission = false;
		}
	}

	if ($pagename == 'lista-de-usuarios') {
		// Rol que no puede ver la página planes
		if ($rol == 'subscriber' || $rol == 'comercial' || $rol == 'cliente') {
			$hasPermission = false;
		}
	}

	if ($pagename == 'miplandeentrenamiento') {
		// Rol que no puede ver la página planes
		if ($rol == 'comercial' || $rol == 'cliente') {
			$hasPermission = false;
		}
	}

	if (!$hasPermission) {
		redirectErrorPage($rol, $username);
	}

	return $hasPermission;
}

// Chequea si el usuario logado tiene permisos para hacer la acción ajax
function checkPermisionAjaxAction($action)
{
	$hasPermission = false;
	if (is_user_logged_in()) {
		$hasPermission = true;
		$rol = rolCurrentUser();

		// Cancelar, pagar el plan
		if (
			$action == 'action_cancelar_plan' ||
			$action == 'action_pagar' ||
			$action == 'action_activar_plan' ||
			$action == 'action_verficarPlan' ||
			$action == 'action_renovar_plan' ||
			$action == 'action_planPagado' ||
			$action == 'action_generatePdf'
		) {
			// Roles que no pueden cancelar el plan
			if ($rol == 'entrenador' || $rol == 'comercial' || $rol == 'cliente') {
				$hasPermission = false;
			}
		}

		//Lista de usuarios
		if (
			$action == 'action_buscarEjercicios' ||
			$action == 'action_borrarEjercicio' ||
			$action == 'action_actualizarSerie' ||
			$action == 'action_usuariospaginados' ||
			$action == 'action_ejercicioPredefinido' ||
			$action == 'action_incluirEjercicio'
		) {
			// Roles que no pueden renovar el plan
			if ($rol == 'subscriber' || $rol == 'comercial' || $rol == 'cliente') {
				$hasPermission = false;
			}
		}
	}

	return $hasPermission;
}

function redirectErrorPage($rol, $username)
{
	wp_redirect('/wordpress/error?code=401&rol=' . $rol . '&user=' . $username, 301);
}

function currentPage()
{
	global $wp_query;
	$post = $wp_query->get_queried_object();
	$pagename = '';
	if ($post) {
		$pagename = $post->post_name;
	}

	return $pagename;
}


