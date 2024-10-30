<?php
/*
 * Add values that you would want centralised through out the plugin
*/

class TinggWordPressConstants {
    const BRAND_NAME = 'tingg';
    
     //menus
    const MENU_POSITION = 20;
    const TOP_LEVEL_MENU_SLUG = self::BRAND_NAME.'_plugin_main_menu';
    const SETTINGS_SUB_MENU_SLUG = self::BRAND_NAME.'_plugin_options_menu';
    const MENU_ICON = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIzLjAuMywgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCA4MTEgNzY4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA4MTEgNzY4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6I0ZGQzkwRDt9Cgkuc3Qxe2ZpbGw6IzVENTM4Qjt9Cgkuc3Qye2ZpbGw6I0Y2NTA1ODt9Cgkuc3Qze2ZpbGw6IzZDRDFFRjt9Cgkuc3Q0e2ZpbGw6IzNCRDIzRDt9Cgkuc3Q1e2ZpbGw6I0Y5ODRDQTt9Cjwvc3R5bGU+CjxnPgoJPHBhdGggY2xhc3M9InN0MCIgZD0iTTU1LjQsMzQ0LjFjNzUuNCwxMS4zLDE1MS4yLTkuOSwyMDIuNy01Ni41QzE5MS4xLDI3NCwxMTUuMywyOTUuMSw1NS40LDM0NC4xIE0zMjQsMjY5CgkJYzE1LDcuNCwzOS42LDI0LjYsNTUuOCw0MS43YzE3LjQsMTguMywzMS42LDM5LjQsNDIuMSw2My4yTDM5Mi40LDM5OWMtOS4xLTIzLjQtMjItNDQtMzguNi02MS40Yy0xNS4zLTE2LjEtMzMuMy0yOC44LTUzLjUtMzgKCQlDMTc3LjgsNDI3LjQsMTMuNiwzNzIuOSwxMy42LDM3Mi45Yy02LjYtMS42LTExLjctNi44LTEzLjQtMTMuNmMtMS43LTYuOCwwLjEtMTQsNS4xLTE4LjhjMCwwLDExNy44LTEzMi40LDI4My40LTg1LjcKCQlDMjg4LjYsMjU0LjgsMzAwLjYsMjU3LjUsMzI0LDI2OSIvPgoJPHBhdGggY2xhc3M9InN0MSIgZD0iTTc1NC4xLDQyMy40Yy03NS40LTExLjMtMTUxLjIsOS45LTIwMi44LDU2LjVDNjE4LjQsNDkzLjQsNjk0LjIsNDcyLjMsNzU0LjEsNDIzLjQgTTQ4Ny41LDQ5Ny43CgkJYy0xNS03LjQtMzkuNi0yNC42LTU1LjgtNDEuN2MtMTcuNC0xOC4zLTMxLjYtMzkuNS00Mi4xLTYzLjJsMjkuNS0yNS4xYzkuMSwyMy40LDIyLDQ0LDM4LjYsNjEuNGMxNS40LDE2LjEsMzMuMywyOC44LDUzLjUsMzgKCQljMTIyLjQtMTI3LjgsMjg2LjctNzMuMiwyODYuNy03My4yYzYuNiwxLjYsMTEuNyw2LjksMTMuNCwxMy42YzEuNyw2LjgtMC4xLDE0LTUuMSwxOC44YzAsMC0xMTcuOSwxMzIuNC0yODMuNCw4NS43CgkJQzUyMi44LDUxMS45LDUxMC44LDUwOS4yLDQ4Ny41LDQ5Ny43Ii8+Cgk8cGF0aCBjbGFzcz0ic3QyIiBkPSJNMTk3LjEsNjc4LjZjNDctNjIuMyw2Ny40LTE0MS4yLDU0LjMtMjEwLjlDMjA2LjYsNTIxLjMsMTg2LjMsNjAwLjIsMTk3LjEsNjc4LjYgTTI2OC41LDQwMS4yCgkJYzEzLjYtOS44LDQwLjMtMjMuMyw2Mi42LTI5LjVjMjMuOS02LjYsNDguNi04LjcsNzMuNy02LjNsNi4xLDM5LjJjLTI0LTMuNS00Ny43LTIuMi03MC40LDQuMWMtMjEsNS44LTQwLjYsMTUuNi01OC40LDI5LjMKCQljNDUuMSwxNzQuMi04Mi40LDI5NC45LTgyLjQsMjk0LjljLTQuNiw1LjEtMTEuNSw3LjEtMTguMSw1LjNjLTYuNS0xLjgtMTEuNS03LjEtMTMuMS0xNGMwLDAtNTEuMy0xNzIuNCw3MC40LTI5OC4yCgkJQzIzOS4xLDQyNS45LDI0Ny4zLDQxNi41LDI2OC41LDQwMS4yIi8+Cgk8cGF0aCBjbGFzcz0ic3QzIiBkPSJNNjEyLjQsODguOGMtNDcuMSw2Mi4zLTY3LjQsMTQxLjItNTQuMywyMTAuOUM2MDIuOSwyNDYuMSw2MjMuMiwxNjcuMiw2MTIuNCw4OC44IE01NDEsMzY4LjEKCQljLTEzLjYsOS44LTQwLjMsMjMuMy02Mi42LDI5LjVjLTIzLjksNi42LTQ4LjYsOC43LTczLjcsNi4zbC02LjEtMzkuMmMyNCwzLjUsNDcuNywyLjIsNzAuNC00LjFjMjEtNS44LDQwLjYtMTUuNiw1OC40LTI5LjMKCQljLTQ1LjItMTc0LjIsODIuNC0yOTQuOSw4Mi40LTI5NC45YzQuNi01LjEsMTEuNS03LjEsMTgtNS4zYzYuNSwxLjgsMTEuNSw3LjEsMTMuMSwxNGMwLDAsNTEuMywxNzIuNC03MC4zLDI5OC4yCgkJQzU3MC41LDM0My40LDU2Mi4yLDM1Mi44LDU0MSwzNjguMSIvPgoJPHBhdGggY2xhc3M9InN0NCIgZD0iTTU0NCw3MTguM2MtMjguMy03My41LTgzLjgtMTMxLjMtMTQ4LjQtMTU0LjRDNDE3LjksNjMxLjEsNDczLjQsNjg4LjgsNTQ0LDcxOC4zIE0zNDguOSw1MTUuMgoJCWMtMS4zLTE3LjIsMC43LTQ3LjksNi44LTcxLjFjNi41LTI0LjgsMTctNDguMiwzMi4zLTcwLjNsMzUuNywxNC4xYy0xNS43LDIwLjYtMjYuMyw0Mi42LTMyLjUsNjYuMmMtNS43LDIxLjktNy4zLDQ0LjQtNC44LDY3LjIKCQljMTY3LjUsNDYuNCwyMDQuMywyMjEuNiwyMDQuMywyMjEuNmMyLDYuNywwLjEsMTQtNC42LDE4LjljLTQuOCw1LTExLjcsNi45LTE4LjIsNC44YzAsMC0xNjkuMi00MC0yMTMuMS0yMTIuNQoJCUMzNTQuNyw1NTQuMSwzNTEsNTQyLDM0OC45LDUxNS4yIi8+Cgk8cGF0aCBjbGFzcz0ic3Q1IiBkPSJNMjYzLjEsNDkuMmMyNi41LDY4LjYsNzYuNSwxMjMuNSwxMzUuNiwxNDkuM2M1LDIuMiwxMC4xLTIuOCw4LjEtNy45QzM4MiwxMjksMzI5LjIsNzYuNywyNjMuMSw0OS4yCgkJIE00NTguMywyNTIuMmMxLjMsMTcuMi0wLjcsNDgtNi44LDcxLjFjLTYuMSwyMy4yLTE1LjcsNDUuMi0yOC44LDY1LjRjLTEuNiwyLjQtNC43LDMuNC03LjMsMi4zbC0yMy45LTkuNAoJCWMtMy42LTEuNC00LjktNS45LTIuNy05LjFjMTIuNi0xOC4yLDIxLjgtMzguMSwyNy4zLTU5LjJjNS40LTIwLjYsNy4xLTQxLjcsNS4yLTYzLjFjLTAuMi0yLjUtMi00LjUtNC40LTUuMgoJCUMyNTIuOCwxOTcsMjE2LjYsMjQuNSwyMTYuNiwyNC41Yy0yLTYuNy0wLjEtMTQsNC42LTE4LjljNC44LTQuOSwxMS43LTYuOCwxOC4yLTQuOGMwLDAsMTY5LjIsMzkuOSwyMTMuMSwyMTIuNQoJCUM0NTIuNSwyMTMuMyw0NTYuMiwyMjUuNSw0NTguMywyNTIuMiIvPgo8L2c+Cjwvc3ZnPgo=';

    //plugin config page slugs
    const SETTINGS_PAGE_SLUG = self::BRAND_NAME.'-settings-page';
    const SETTINGS_PAGE_SECTION = self::BRAND_NAME.'-settings-section';
    const SETTINGS_PAGE_OPTION_GROUP = self::BRAND_NAME.'-settings-option-group';

     //plugin config fields
    const IV_KEY_TEXT = 'WP_'.self::BRAND_NAME.'_plugin_iv_key';
    const DUE_DATE_NUMBER = 'WP_'.self::BRAND_NAME.'_plugin_due_date';
    const SECRET_KEY_TEXT = 'WP_'.self::BRAND_NAME.'_plugin_secret_key';
    const ACCESS_KEY_TEXT = 'WP_'.self::BRAND_NAME.'_plugin_access_key';
//    const WEB_HOOK_URL_TEXT = 'WP_'.self::BRAND_NAME.'_plugin_web_hook_url';
    const SERVICE_CODE_TEXT = 'WP_'.self::BRAND_NAME.'_plugin_service_code';
    const COUNTRY_CODE_SELECT = 'WP_'.self::BRAND_NAME.'_plugin_country_code';
    const CHECKOUT_TYPE_SELECT = 'WP_'.self::BRAND_NAME.'_plugin_checkout_type';
    const JAVASCRIPT_LIBRARY_URL_TEXT = 'WP_'.self::BRAND_NAME.'_plugin_javascript_library_url';

    //WordPress ajax object
    const AJAX_OBJECT = self::BRAND_NAME.'_WORDPRESS_PLUGIN_AJAX_OBJ';
    const CHECKOUT_REQUEST_XHR_ACTION = self::BRAND_NAME.'_checkout_xhr_request_action';

    //stylesheets handles
    const ADMIN_STYLE_HANDLE = self::BRAND_NAME.'-admin-styles';
    const PUBLIC_STYLE_HANDLE = self::BRAND_NAME.'-public-styles';

    const CHECKOUT_LIBRARY = self::BRAND_NAME.'-checkout-library';
    const CHECKOUT_PAGE_JS_SCRIPT = self::BRAND_NAME.'-checkout-page-js';
    const DEVELOPER_PORTAL_REGISTRATION_URL = 'https://beep2.cellulant.com:9212/checkout/v2/portal/#/register/user';

    //checkout types
    const CHECKOUT_TYPES = array('modal', 'redirect');

    //supported countries
    const COUNTRIES = array(
        "kenya" => array(
            "currencyCode" => "KES",
            "countryCode" => "KE"
        ),
        "tanzania" => array(
            "currencyCode" => "TZS",
            "countryCode" => "TZ"
        ),
        "uganda" => array(
            "currencyCode" => "UGX",
            "countryCode" => "UG"
        ),
        "ghana" => array(
            "currencyCode" => "GHS",
            "countryCode" => "GH"
        ),
        "zambia" => array(
            "currencyCode" => "ZMW",
            "countryCode" => "ZM"
        ),
        "zimbabwe" => array(
            "currencyCode" => "USD",
            "countryCode" => "ZW"
        ),
        "mozambique" => array(
            "currencyCode" => "MZN",
            "countryCode" => "MZ"
        ),
        "nigeria" => array(
            "currencyCode" => "NGN",
            "countryCode" => "NG"
        )
    );
}