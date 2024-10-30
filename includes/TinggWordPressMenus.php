<?php


class TinggWordPressMenus
{
    public static function createTopLevelMenu($page_title, $menu_title, $menu_slug, $menu_icon, $menu_position)
    {
        add_action('admin_menu', function () use ($page_title, $menu_title, $menu_slug, $menu_icon, $menu_position) {
            add_menu_page(
                $page_title,
                $menu_title,
                'manage_options',
                $menu_slug,
                function () {
                    if (!current_user_can('manage_options')) {
                        return;
                    } ?>
                    <div id="wordpress-tingg-checkout-welcome-page" class="wrap">
                        <h1 class="plugins-page-title">
                            <img src="<?= plugins_url('../public/images/tingg-logo.png', __FILE__) ?>" alt="Tingg"
                                 height="48px"/>
                            <span>WordPress</span>
                        </h1>
                        <header>
                            <p class="bootstrap-lead-paragraph" style="margin-top: 0;">Get a single API to accept
                                payments on your <a href="https://wordpress.com/">WordPress</a> shops from a multitude
                                of payment options in Africa. Experience the wonderful benefits that come with Tingg
                                checkout:</p>
                            <ul>
                                <li class="display-flex align-items-center">
                                    <i class="material-icons purple-mood">account_balance_wallet</i>
                                    <span>Provide unaccountable mobile-money, bank & card options</span>
                                </li>
                                <li class="display-flex align-items-center">
                                    <i class="material-icons green-mood">money</i>
                                    <span>Receive payments in any currency</span>
                                </li>
                                <li class="display-flex align-items-center">
                                    <i class="material-icons yellow-mood">call_split</i>
                                    <span>Customer can make split payments</span>
                                </li>
                                <li class="display-flex align-items-center">
                                    <i class="material-icons blue-mood">extension</i>
                                    <span>Easy to setup, configure, and integrate</span>
                                </li>
                            </ul>
                        </header>
                        <p class="bootstrap-lead-paragraph">Getting started is really easy. Follow the steps below to
                            get your shop up and running with Tingg</p>
                        <main>
                            <div id="integration-stepper">
                                <div id="integration-stepper-bar" class="display-flex">
                                    <div v-for="(step, index) in stepper.steps"
                                         :key="step.name.replace('/\s/g', '')+'#'+index"
                                         :class="[
                                            'stepper-tab-item',
                                            'flex-one',
                                            'display-flex',
                                            'align-items-center',
                                            'justify-content-center',
                                            stepper.current === index ? 'active-step' : ''
                                         ]"
                                         @click="stepper.current = index">
                                        <i class="material-icons purple-mood">{{step.icon}}</i>
                                        <span>{{step.name.toLowerCase()}}</span>
                                    </div>
                                </div>
                                <div v-if="instructions !== ''" id="integration-stepper-content">
                                    <div v-html="instructions"></div>
                                </div>
                                <div v-else id="integration-stepper-content"
                                     class="display-flex align-items-center justify-content-center">
                                    <h1 style="text-align: center;">
                                        <span>Sorry, these instructions seem to be missing.</span>
                                        <a href="#" style="text-decoration: none;"
                                           class="red-mood display-flex align-items-center justify-content-center">
                                            <span>Contact our support team for help</span>
                                            <i class="material-icons">contact_support</i>
                                        </a>
                                    </h1>
                                </div>
                            </div>
                        </main>
                    </div>
                    <?php
                },
                $menu_icon,
                $menu_position
            );
        });
    }

    public static function createSettingsMenu($parent_slug, $page_title, $menu_title, $menu_slug)
    {
        add_action('admin_menu', function () use ($parent_slug, $page_title, $menu_title, $menu_slug) {
            add_submenu_page(
                $parent_slug,
                $page_title,
                $menu_title,
                'manage_options',
                $menu_slug,
                function () {
                    if (!current_user_can('manage_options')) {
                        return;
                    }

                    $active_options_tab = sanitize_key($_GET['tab']);
                    $active_options_tab = is_string($active_options_tab)
                    ? esc_sql($active_options_tab)
                    : 'checkout_experience';

                    ?>
                    <div id="wordpress-tingg-checkout-options-page" class="wrap">
                        <h1 class="plugins-page-title">
                            <img src="<?= plugins_url('../public/images/tingg-logo.png', __FILE__) ?>" alt="Tingg"
                                 height="48px"/>
                            <span>Integration Settings</span>
                        </h1>
                        <br/>
                        <main id="tabbed-plugin-options">
                            <h2 class="nav-tab-wrapper">
                                <a
                                        href="?page=<?= TinggWordPressConstants::SETTINGS_SUB_MENU_SLUG ?>&tab=checkout_experience"
                                        class="nav-tab display-flex align-items-center justify-content-center <?= $active_options_tab == 'checkout_experience' ? 'nav-tab-active' : '' ?>">
                                    <i class="material-icons purple-mood" style="margin-right: 8px;">storefront</i>
                                    <span>Checkout experience</span>
                                </a>
                                <a
                                        href="?page=<?= TinggWordPressConstants::SETTINGS_SUB_MENU_SLUG ?>&tab=integration_keys"
                                        class="nav-tab display-flex align-items-center justify-content-center <?= $active_options_tab == 'integration_keys' ? 'nav-tab-active' : '' ?>">
                                    <i class="material-icons purple-mood" style="margin-right: 8px;">vpn_key</i>
                                    <span>Integration keys</span>
                                </a>
                                <a
                                        href="?page=<?= TinggWordPressConstants::SETTINGS_SUB_MENU_SLUG ?>&tab=expiry_period"
                                        class="nav-tab display-flex align-items-center justify-content-center <?= $active_options_tab == 'expiry_period' ? 'nav-tab-active' : '' ?>">
                                    <i class="material-icons purple-mood" style="margin-right: 8px;">timer</i>
                                    <span>Expiry period</span>
                                </a>
                                <a
                                        href="?page=<?= TinggWordPressConstants::SETTINGS_SUB_MENU_SLUG ?>&tab=country_of_operation"
                                        class="nav-tab display-flex align-items-center justify-content-center <?= $active_options_tab == 'country_of_operation' ? 'nav-tab-active' : '' ?>">
                                    <i class="material-icons purple-mood" style="margin-right: 8px;">public</i>
                                    <span>Country of Operation</span>
                                </a>
                            </h2>
                            <form action="options.php" method="POST">
                                <div id="tabbed-plugin-form-fields">
                                    <?php
                                    switch ($active_options_tab) {
                                        case 'integration_keys':
                                            do_settings_sections('tingg-integration-keys-page');
                                            settings_fields('tingg-integration-keys-fields');
                                            break;
                                        case 'checkout_experience':
                                            do_settings_sections('tingg-checkout-experience-page');
                                            settings_fields('tingg-checkout-experience-fields');
                                            break;
                                        case 'expiry_period':
                                            do_settings_sections('tingg-expiry-period-page');
                                            settings_fields('tingg-expiry-period-fields');
                                            break;
                                        case 'country_of_operation':
                                            do_settings_sections('tingg-country-options-page');
                                            settings_fields('tingg-country-options-fields');
                                            break;
                                        default:
                                            do_settings_sections('tingg-checkout-experience-page');
                                            settings_fields('tingg-checkout-experience-fields');
                                            break;
                                    };
                                    ?>
                                </div>
                                <div id="tabbed-plugin-options-submit-button">
                                    <?php submit_button('Save Configurations'); ?>
                                </div>
                            </form>
                        </main>
                    </div>
                    <?php
                });
        });
    }
}