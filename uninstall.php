<?php

require 'includes/TinggWordPressConstants.php';

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

$options = array(
    TinggWordPressConstants::IV_KEY_TEXT,
    TinggWordPressConstants::ACCESS_KEY_TEXT,
    TinggWordPressConstants::SECRET_KEY_TEXT,
    TinggWordPressConstants::DUE_DATE_NUMBER,
    TinggWordPressConstants::SERVICE_CODE_TEXT,
    TinggWordPressConstants::COUNTRY_CODE_SELECT,
    TinggWordPressConstants::CHECKOUT_TYPE_SELECT
);

foreach($options as $key => $option) {
    delete_option($option);
}
