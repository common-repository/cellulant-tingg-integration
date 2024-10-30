jQuery(document).ready(function ($) {
    /** global variables */
    var invalidForm = true;

    var checkoutType = $("button.pay-with-tingg-button").data("checkout-type");

    var fields = [
        {'name': 'MSISDN', 'help': 'include your country code, excluding the `+` or `brackets`'}, 
        {'name': 'currencyCode', 'help': 'the currency you would like to use'},
        {'name': 'customerEmail', 'help': 'provide an active email, to receive invoices & receipts'}, 
        {'name': 'customerLastName', 'help': 'provide your last name'}, 
        {'name': 'customerFirstName', 'help': 'provide your first name'}, 
    ];
    /** global variables */

    if (typeof Tingg !== 'undefined') {
        var checkoutButton = $("button.pay-with-tingg-button");
        var style = checkoutButton.attr('style');
        style += "; background: transparent; text-decoration: none;";
        checkoutButton.attr('style', style);

        Tingg.renderPayButton({
            checkoutType: checkoutType,
            className: "pay-with-tingg-button",
        });
    }

    $(".tingg-checkout-form-field").on('keyup change', function() {
        var fieldValue = $(this).val();
        var fieldName = $(this).attr('name');
        var helpTextElement = $(this).siblings("[id$='Help']");

        if (fieldValue === "" || fieldValue === null) {
            switch (fieldName) {
                case 'MSISDN':
                    helpTextElement.text('provide a valid phone number');
                    break;
                case 'customerEmail':
                    helpTextElement.text('provide a valid email address');
                    break;
                case 'customerLastName':
                    helpTextElement.text('provide a valid last name');
                    break;
                case 'customerFirstName':
                    helpTextElement.text('provide a valid first name');
                    break;
                default:
                    break;
            }

            helpTextElement.addClass('errored-field');
            helpTextElement.removeClass('valid-field');
        } else {
            var iterator = 0;
            while (iterator < fields.length) {
                if (fieldName == fields[iterator]['name']) {
                    helpTextElement.text(fields[iterator]['help']);
                }
                iterator++;
            }

            helpTextElement.addClass('valid-field');
            helpTextElement.removeClass('errored-field');
        }
    });

    $("#tingg-checkout-form").on('submit', function(event) {
        event.preventDefault();

        var iterator = 0;
        var action = $("#checkout-form-wp-ajax-action").val();

        var requestObj = {'action': action};
        while(iterator < fields.length) {
            var field = fields[iterator]['name'];
            requestObj[field] = $("#"+field).val();
            iterator++;
        }

        $.ajax({
            type: "POST",
            dataType: 'json',
            data: requestObj,
            url: TINGG_WORDPRESS_PLUGIN_AJAX_OBJ.AJAX_URL,
            success: function(response) {
                Tingg.renderCheckout({
                    checkoutType: checkoutType,
                    merchantProperties: response
                });
            },
            error: function(error) {
                console.log(error.responseText);
            },
        });
    });
});