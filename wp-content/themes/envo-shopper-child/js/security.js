function processAjaxActionError(errorStr) {
    var hasError = false;
    if (errorStr && typeof errorStr === 'string') {
        var error = JSON.parse(errorStr);
        if (error.hasError) {
            hasError = true;
            var code = error.code;
            var rol = error.rol;
            var user = error.user;

            window.location.href = '/wordpress/error?code=' + code + '&rol=' + rol + '&user=' + user;
        }
    }
    return hasError;
}

function mostrarPlanEntrenamiento() {
    debugger;
    const form_data = [];
    form_data.push({ "name": 'action', "value": 'action_mostrarPlanEntrenamiento' });
    form_data.push({ "name": "security", "value": ajax_nonce });

    jQuery.ajax({
        url: ajax_url, // Here goes our WordPress AJAX endpoint.
        type: 'post',
        data: form_data,
        success: function (response) {
            var data = JSON.parse(response);
            debugger;
            if (data.show) {
                jQuery('#menu-main-menu li:last-child').show();
            }
            
            if(window.location.href.indexOf('miplandeentrenamiento')!== -1 && !data.show){
                jQuery('.single-title').hide();
            }else{
                jQuery('.single-title').show();
            }
        },
        fail: function (err) {
            console.error("There was an error: " + err);
        }
    });
}

mostrarPlanEntrenamiento();