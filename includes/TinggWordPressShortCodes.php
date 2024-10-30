<?php

class TinggWordPressShortCodes
{
    public static function createCheckoutPage($checkoutType, $action)
    {
        add_shortcode('tingg_checkout', function () use ($checkoutType, $action) {
            try {
                $cartTotal = WC()->cart->total;
                $cartCurrency = get_woocommerce_currency();
            } catch (Exception $exception) {
                $cartTotal = 0;
                $cartCurrency = '';
            }

            return '<div id="tingg-checkout-section">
                <form id="tingg-checkout-form" action="' . esc_url(admin_url("admin-post.php")) . '" method="POST">
                    <input id="checkout-form-wp-ajax-action" style="display: none;" type="hidden" name="action" value="'. $action .'">
                    <div>
                        <label for="customerFirstName">First name</label>
                        <input class="tingg-checkout-form-field" id="customerFirstName" name="customerFirstName" type="text" required/>
                        <small id="customerFirstNameHelp" style="display: block;">provide your first name</small>
                    </div>
                    <div>
                        <label for="customerLastName">Last name</label>
                        <input class="tingg-checkout-form-field" id="customerLastName" name="customerLastName" type="text" required/>
                        <small id="customerLastNameHelp" style="display: block;">provide your last name</small>
                    </div>
                    <div>
                        <label for="MSISDN">Phone</label>
                        <input class="tingg-checkout-form-field" id="MSISDN" name="MSISDN" type="tel" required/>
                        <small id="MSISDNHelp" style="display: block;">include your country code, excluding the `+` or `brackets`</small>
                    </div>
                    <div>
                        <label for="customerEmail">Email</label>
                        <input class="tingg-checkout-form-field" id="customerEmail" name="customerEmail" type="email" required/>
                        <small id="customerEmailHelp" style="display: block;">provide an active email, to receive invoices & receipts</small>
                    </div>
                    <div>
                        <label for="amount">Amount</label>
                        <input 
                            class="tingg-checkout-form-field" 
                            id="amount" 
                            value="' . $cartCurrency . ' ' . $cartTotal . '" 
                            name="amount" 
                            type="text" 
                            readonly/>
                        <small id="amountHelp" style="display: block;">the amount and currency from the store</small>
                    </div>
                    <br/>
                    <div>
                        <button data-checkout-type="' . $checkoutType . '" class="pay-with-tingg-button"></button>
                    </div>
                </form>
            </div>';
        });
    }
}