<?php

class TinggWordPressUtils {
    /**
     * @param $iv string
     * @param $secret string
     * @param $payload array
     * @return string
     */
    public static function encryptCheckoutRequest($iv, $secret, $payload) {
        $secret_key = hash('sha256', $secret);
        $iv_key = substr(hash('sha256', $iv), 0, 16);

         $encrypted = openssl_encrypt(
            json_encode($payload, true),
            'AES-256-CBC',
            $secret_key,
            0,
            $iv_key
        );

        return base64_encode($encrypted);
    }

        /**
         * Creates a text input field for the plugin settings page
         * @param string $page
         * @param string $section
         * @param string $group
         *
         * @param string $type
         * @param string $identifier
         * @param string $label
         * @param string $help
         */
        public static function createOptionsPageInputField($page, $section, $group, $type, $identifier, $label, $help = '') {
            add_settings_field(
                $identifier,
                '<label for="'.$identifier.'">'.$label.'</label>',
                function() use($type, $identifier, $help){
                    switch ($type):
                        case 'text':
                            echo '<input type="text" class="'. TinggWordPressConstants::BRAND_NAME .'-wordpress-plugin-options-field" name="'.$identifier.'" value="'.get_option($identifier).'" required/>'
                                . '<small class="display-flex purple-mood">'.$help.'</small>';
                            break;
                        case 'number':
                            echo '<input type="number" class="'. TinggWordPressConstants::BRAND_NAME .'-wordpress-plugin-options-field" name="'.$identifier.'" value="'.get_option($identifier).'" required/>'
                                . '<small class="display-flex purple-mood">'.$help.'</small>';
                            break;
                    endswitch;
                },
                $page,
                $section
            );

            register_setting(
                $group,
                $identifier,
                array(
                    'sanitize_callback' => 'sanitize_text_field'
                )
            );
        }

        /**
         * Create a select input for the plugin settings page
         * @param string $page
         * @param string $section
         * @param string $group
         *
         * @param string $identifier
         * @param string $label
         * @param array $choices
         * @param string $help
         */
        public static function createOptionsPageSelectField($page, $section, $group, $identifier, $label, $choices, $help = '') {
            add_settings_field(
                $identifier,
                '<label for="' . $identifier .'">' . $label. '</label>',
                function () use($identifier, $choices, $help) {
                    $options = '<option> -- Select -- </option>';
                    foreach($choices as $key => $choice) {
                        if (get_option($identifier) == $choice["value"]) :
                            $options.='<option selected value="'.$choice["value"].'">'.$choice["name"].'</option>';
                        else:
                            $options.='<option value="'.$choice["value"].'">'.$choice["name"].'</option>';
                        endif;
                    }
                    echo '<select name="'.$identifier.'" class="'. TinggWordPressConstants::BRAND_NAME . '-wordpress-plugin-options-field" required>'.$options.'</select>'
                    . '<small class="display-flex purple-mood">'.$help.'</small>';
                },
                $page,
                $section
            );

            register_setting(
                $group,
                $identifier,
                array(
                    'sanitize_callback' => 'sanitize_text_field'
                )
            );
        }
}