function generatePdf() {
    debugger;
    addSpinner('loadpdf');
    const form_data = [];
    // Here we add our nonce (The one we created on our functions.php. WordPress needs this code to verify if the request comes from a valid source.
    form_data.push({ "name": "security", "value": ajax_nonce });
    form_data.push({ "name": 'action', "value": 'action_generatePdf' });

    jQuery.ajax({
        url: ajax_url, // Here goes our WordPress AJAX endpoint.
        type: 'post',
        data: form_data,
        xhrFields: {
            responseType: 'blob' // to avoid binary data being mangled on charset conversion
        },
        success: function (blob, status, xhr) {
            debugger;
            if (!processAjaxActionError(blob)) {
                removeSpinner('loadpdf');
                var filename = "entrenamiento.pdf";


                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                    // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                    window.navigator.msSaveBlob(blob, filename);
                } else {
                    var URL = window.URL || window.webkitURL;
                    var downloadUrl = URL.createObjectURL(blob);

                    if (filename) {
                        // use HTML5 a[download] attribute to specify filename
                        var a = document.createElement("a");
                        // safari doesn't support this yet
                        if (typeof a.download === 'undefined') {
                            window.location.href = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                        }
                    } else {
                        window.location.href = downloadUrl;
                    }

                    setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
                }
            }
        },
        fail: function (err) {
            // You can craft something here to handle an error if something goes wrong when doing the AJAX request.
            alert("There was an error: " + err);
        }
    });
}