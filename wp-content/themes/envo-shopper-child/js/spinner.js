function addSpinner(layer) {
    var sp = '<img id="loading" alt="Loading" class="" fetchpriority="auto" loading="auto" src="https://i.pinimg.com/originals/f4/ed/7a/f4ed7a58996957266401435585604881.gif">';
    jQuery('#' + layer).html(sp);
}

function removeSpinner(layer) {
    jQuery('#' + layer).html('');
}