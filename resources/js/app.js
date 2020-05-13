// x-editable configuration
$.fn.editable.defaults.mode = "inline";
$.fn.editable.defaults.ajaxOptions = { type: "PUT" };

$(document).ready(function() {
    $(".order-status-select").editable({
        source: [
            { value: "created", text: "Creado" },
            { value: "sent", text: "Enviado" },
            { value: "received", text: "Recibido" }
        ]
    });
});
