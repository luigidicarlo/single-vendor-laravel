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

    $(".add-to-cart").on("submit", e => {
        e.preventDefault();

        var form = $(e.target);
        var button = form.find("[type=submit]");
        const timeoutDuration = 2000;

        $.ajax({
            url: form.attr("action"),
            method: form.attr("method"),
            data: form.serialize(),
            dataType: 'JSON',
            beforeSend: () => {
                button.val("Cargando...");
                button.attr("disabled", "true");
            },
            success: (res) => {
                button.css("background-color", "#00c853").val("Agregado");
                $('span.badge.badge-info').html(Number(res.productsCount));
                restartButton(button);
            },
            error: err => {
                button.css("background-color", "red").val("Hubo un error");
                restartButton(button);
            }
        });

        const restartButton = button => {
            setTimeout(
                () =>
                    button
                        .val("Agregar al carrito")
                        .removeAttr("style")
                        .removeAttr("disabled"),
                timeoutDuration
            );
        };

        return false;
    });
});
