<?php

/**
 * Plugin Name: Cellulant Tingg Integration
 * Plugin URI:  https://tingg.africa/services/#developers
 * Description: A WordPress-WooCommerce plugin for merchants to integrate Tingg payment gateway on their online shops offering their customers payment options across Africa.
 * Version:     1.0.3
 * Author:      Cellulant Corporation
 * Author URI:  https://tingg.africa
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/*
 * Required files
 */
require('includes/TinggWordPressConstants.php');
require('includes/TinggWordPressUtils.php');

require('includes/TinggWordPressMenus.php');
require('includes/TinggWordPressShortCodes.php');

/*
 * Enable dashboard notices
 */
add_action('admin_notices', function () {
    settings_errors();
});

/*
 * Enqueue custom JS scripts & styles in the admin dashboard
 */
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script(
        'vue-production-cdn',
        plugins_url('vendor/js/vue.js', __FILE__),
        array(),
        '2.6.0',
        true
    );
    wp_enqueue_script(
        'vue-instances',
        plugins_url('admin/js/vue-instances.js', __FILE__),
        array('vue-production-cdn'),
        '1.0.0',
        true
    );
    wp_enqueue_style(
        'google-material-icons',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        array(),
        '3.0.1',
        'all'
    );
    wp_enqueue_style(
        TinggWordPressConstants::ADMIN_STYLE_HANDLE,
        plugins_url('admin/css/main.css', __FILE__),
        array(),
        '1.0.0',
        'all'
    );
});

/*
 * Enqueue custom JS scripts & styles in public pages
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        TinggWordPressConstants::PUBLIC_STYLE_HANDLE,
        plugins_url('public/css/main.css', __FILE__),
        array(),
        '1.0.0',
        'all'
    );

    wp_enqueue_script(
        TinggWordPressConstants::CHECKOUT_PAGE_JS_SCRIPT,
        plugins_url('public/js/main.js', __FILE__),
        array('jquery'),
        '1.0.0',
        true
    );

    wp_localize_script(
        TinggWordPressConstants::CHECKOUT_PAGE_JS_SCRIPT,
        strtoupper(TinggWordPressConstants::AJAX_OBJECT),
        array(
            "AJAX_URL" => admin_url('admin-ajax.php')
        )
    );
});

add_action('wp_enqueue_scripts', function () {
    if (is_page('checkout')) {
        wp_enqueue_script(
            TinggWordPressConstants::CHECKOUT_LIBRARY,
            get_option(TinggWordPressConstants::JAVASCRIPT_LIBRARY_URL_TEXT),
            array(),
            '1.0.0',
            true
        );
    }
});

/*
 * Create IPN page for the callbacks
 */
add_action('init', function () {
    global $wp_rewrite;
    $plugin_url = plugins_url("tingg-payment-ipn.php", __FILE__);
    $plugin_url = substr($plugin_url, strlen(home_url()) + 1);
    $wp_rewrite->add_external_rule("tingg-payment-ipn.php$", $plugin_url);
});

/*
 * Create plugin main page(top-level menu)
 */
TinggWordPressMenus::createTopLevelMenu(
    'WooCommerce ' . ucfirst(TinggWordPressConstants::BRAND_NAME) . ' Checkout',
    ucfirst(TinggWordPressConstants::BRAND_NAME),
    TinggWordPressConstants::TOP_LEVEL_MENU_SLUG,
    TinggWordPressConstants::MENU_ICON,
    TinggWordPressConstants::MENU_POSITION
);

/*
 * Create plugin settings page(settings sub-menu)
 */
TinggWordPressMenus::createSettingsMenu(
    TinggWordPressConstants::TOP_LEVEL_MENU_SLUG,
    'Tingg Integration Settings',
    'Settings',
    TinggWordPressConstants::SETTINGS_SUB_MENU_SLUG
);

add_action('admin_init', 'create_integration_keys_options_section');
function create_integration_keys_options_section()
{
    add_settings_section('tingg-integration-keys-section', '', null, 'tingg-integration-keys-page');

    TinggWordPressUtils::createOptionsPageInputField(
        'tingg-integration-keys-page',
        'tingg-integration-keys-section',
        'tingg-integration-keys-fields',
        'text',
        TinggWordPressConstants::SERVICE_CODE_TEXT,
        'SERVICE CODE',
        'uniquely identifies your service for this WordPress shop'
    );
    TinggWordPressUtils::createOptionsPageInputField(
        'tingg-integration-keys-page',
        'tingg-integration-keys-section',
        'tingg-integration-keys-fields',
        'text',
        TinggWordPressConstants::ACCESS_KEY_TEXT,
        'ACCESS KEY',
        'express checkout application key'
    );
    TinggWordPressUtils::createOptionsPageInputField(
        'tingg-integration-keys-page',
        'tingg-integration-keys-section',
        'tingg-integration-keys-fields',
        'text',
        TinggWordPressConstants::IV_KEY_TEXT,
        'IV KEY'
    );
    TinggWordPressUtils::createOptionsPageInputField(
        'tingg-integration-keys-page',
        'tingg-integration-keys-section',
        'tingg-integration-keys-fields',
        'text',
        TinggWordPressConstants::SECRET_KEY_TEXT,
        'SECRET KEY'
    );
}

add_action('admin_init', 'create_checkout_experience_options_section');
function create_checkout_experience_options_section()
{
    add_settings_section('tingg-checkout-experience-section', '', null, 'tingg-checkout-experience-page');

    TinggWordPressUtils::createOptionsPageInputField(
        'tingg-checkout-experience-page',
        'tingg-checkout-experience-section',
        'tingg-checkout-experience-fields',
        'text',
        TinggWordPressConstants::JAVASCRIPT_LIBRARY_URL_TEXT,
        'JavaScript Library URL',
        'take note of the two versions: live / sandbox'
    );

    TinggWordPressUtils::createOptionsPageSelectField(
        'tingg-checkout-experience-page',
        'tingg-checkout-experience-section',
        'tingg-checkout-experience-fields',
        TinggWordPressConstants::CHECKOUT_TYPE_SELECT,
        'Checkout Experience',
        array_map(function ($item) {
            return array(
                "name" => ucfirst($item),
                "value" => $item
            );
        }, TinggWordPressConstants::CHECKOUT_TYPES),
        'select the type of checkout experience for your customers'
    );
}

add_action('admin_init', 'create_expiry_period_options_section');
function create_expiry_period_options_section()
{
    add_settings_section('tingg-expiry-period-section', '', null, 'tingg-expiry-period-page');

    TinggWordPressUtils::createOptionsPageInputField(
        'tingg-expiry-period-page',
        'tingg-expiry-period-section',
        'tingg-expiry-period-fields',
        'number',
        TinggWordPressConstants::DUE_DATE_NUMBER,
        'REQUEST EXPIRY PERIOD',
        '(minutes)'
    );
}

add_action('admin_init', 'create_country_options_section');
function create_country_options_section()
{
    add_settings_section('tingg-country-options-section', '', null, 'tingg-country-options-page');

    TinggWordPressUtils::createOptionsPageSelectField(
        'tingg-country-options-page',
        'tingg-country-options-section',
        'tingg-country-options-fields',
        TinggWordPressConstants::COUNTRY_CODE_SELECT,
        'COUNTRY OF OPERATION',
        array_map(function ($item, $key) {
            return array(
                "name" => ucfirst(str_replace('-', ' ', $key)),
                "value" => $item["countryCode"]
            );
        }, TinggWordPressConstants::COUNTRIES, array_keys(TinggWordPressConstants::COUNTRIES))
    );
}

add_action('wp_ajax_' . TinggWordPressConstants::CHECKOUT_REQUEST_XHR_ACTION, 'process_checkout_request');
add_action('wp_ajax_nopriv_' . TinggWordPressConstants::CHECKOUT_REQUEST_XHR_ACTION, 'process_checkout_request');
function process_checkout_request()
{
    $MSISDN = sanitize_text_field($_POST['MSISDN']);
    $customerEmail = sanitize_email($_POST['customerEmail']);
    $customerLastName = sanitize_text_field($_POST['customerLastName']);
    $customerFirstName = sanitize_text_field($_POST['customerFirstName']);

    if (class_exists('WooCommerce')) {
        $currencyCode = strtoupper(get_woocommerce_currency());
        $requestAmount = WC()->cart->get_cart_contents_total();

        try {
            $order_id = WC()->checkout->create_order(array(
                "billing_city" => '',
                "billing_state" => '',
                "billing_company" => '',
                "billing_address_1" => '',
                "billing_address_2" => '',
                "billing_phone" => $MSISDN,
                "billing_email" => $customerEmail,
                "billing_last_name" => $customerLastName,
                "billing_first_name" => $customerFirstName,
                "billing_country" => get_option(TinggWordPressConstants::COUNTRY_CODE_SELECT),

                "payment_method" => 'Tingg'
            ));

            $params = array(
                "MSISDN" => $MSISDN,
                "accountNumber" => $MSISDN,
                "currencyCode" => !empty($currencyCode) && isset($currencyCode) ? $currencyCode : 'USD',
                "requestAmount" => !empty($requestAmount) && isset($currencyCode) ? $requestAmount : 0,
                "customerEmail" => $customerEmail,
                "customerLastName" => $customerLastName,
                "customerFirstName" => $customerFirstName,
                "requestDescription" => get_bloginfo('name'),
                "merchantTransactionID" => 'ORDER#' . $order_id,
                "serviceCode" => get_option(TinggWordPressConstants::SERVICE_CODE_TEXT),
                "paymentWebhookUrl" => home_url() . '/tingg-payment-ipn.php',
                "failRedirectUrl" => get_permalink(get_page_by_path('shop')),
                "successRedirectUrl" => get_permalink(get_page_by_path('shop')),
                "dueDate" => date("Y-m-d H:i:s", strtotime("+" . get_option(TinggWordPressConstants::DUE_DATE_NUMBER) . " minutes"))
            );

            $encryptedParams = TinggWordPressUtils::encryptCheckoutRequest(
                get_option(TinggWordPressConstants::IV_KEY_TEXT),
                get_option(TinggWordPressConstants::SECRET_KEY_TEXT),
                $params
            );

            $checkoutParams = array(
                'params' => $encryptedParams,
                'accessKey' => get_option(TinggWordPressConstants::ACCESS_KEY_TEXT),
                'countryCode' => get_option(TinggWordPressConstants::COUNTRY_CODE_SELECT)
            );

            echo json_encode($checkoutParams);

            die();
        } catch (Exception $exception) {
            echo json_encode(array(
                "error" => array(
                    "code" => $exception->getCode(),
                    "message" => $exception->getMessage()
                )
            ));

            die();
        }
    }
}

/*
 * Create short codes to generate page contents
 */
TinggWordPressShortCodes::createCheckoutPage(
    get_option(TinggWordPressConstants::CHECKOUT_TYPE_SELECT),
    TinggWordPressConstants::CHECKOUT_REQUEST_XHR_ACTION
);



