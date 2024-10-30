
/*
 * Welcome page vue instance
 */
var welcome = new Vue({
    el: '#wordpress-tingg-checkout-welcome-page',
    computed: {
        instructions () {
            try {
                const content = this.stepper.steps[this.stepper.current].instructions;
                if (typeof content === 'string') {
                    return content;
                } else {
                    return  '';
                }
            } catch {
                return '';
            }
        }
    },
    data: {
        stepper: {
            current: 0,
            steps: [
                {
                    icon: 'how_to_reg',
                    name: 'registration',
                    instructions: '' +
                        '1. Register on our developer portal using this ' +
                        '<a class="purple-mood" style="text-decoration: none; font-weight: bold;" href="https://beep2.cellulant.com:9212/checkout/v2/portal/#/register/user" target="_blank">link</a>.\n' +
                        '2. Ensure you have received a verification email address to activate your account.\n' +
                        '3. Create a service by giving a service name that reflects your online service.\n' +
                        '4. Select the payment options that you would want associated with the service.\n' +
                        '5. Learn more in our <a class="purple-mood" style="text-decoration: none; font-weight: bold;" href="https://tingg.gitbook.io/checkout/" target="_blank">documentation</a>.'
                },
                {
                    icon: 'vpn_key',
                    name: 'integration keys',
                    instructions: '' +
                        '<div id="integration-keys" class="display-flex justify-content-space-between">' +
                            '<div class="flex-one">' +
                                '<strong class="purple-mood">General keys</strong> uniquely identify your service and are useful in troubleshooting issues, when you contact our support team' +
                            '</div>' +
                            '<div class="flex-one">' +
                                '<strong class="purple-mood">Express checkout keys</strong> enable you to create an experience for both modal and redirect express checkout.' +
                            '</div>' +
                            '<div class="flex-one">' +
                                '<strong class="purple-mood">Custom API keys</strong> would be used in accessing our custom APIs. Read more on our API functions that allow you to create a fully custom checkout experience.' +
                            '</div>' +
                        '</div>'
                },
                {
                    icon: 'storefront',
                    name: 'checkout experience',
                    instructions: 'Express checkout comes with two experiences, <strong class="purple-mood">modal &amp; redirect</strong>:\n' +
                        '<strong class="purple-mood">1. Modal experience</strong>\n' +
                        'With the modal experience, the customer gets a pop-up in order to proceed with payment. Therefore they are never moved from your page at the time of checking out.\n' +
                        '<strong class="purple-mood">2. Redirect experience</strong>\n' +
                        'Unlike the modal experience, the redirect experience would navigate the customer to our page in order for them to continue with the payment part of checkout.'
                },
                {
                    icon: 'timer',
                    name: 'expiry period',
                    instructions: 'After setting up the JavaScript library and express checkout keys to be used, you can determine how long you give your customers to pay. ' +
                        'This value is <strong class="purple-mood">measured in minutes</strong> and would be used to determine a future date in which the checkout request would expire. ' +
                        'Any payments made a customer would be reversed if they did not complete their payments in time.'
                },
                {
                    icon: 'public',
                    name: 'country of operation',
                    instructions: 'After you have selected a checkout experience for your integration, the next step is to set the country you wish to process payment from. ' +
                        'The country you select also dictates the payment options displayed. The customer is however able to select another country from which they wish to pay you. ' +
                        'Get a list of all <a href="#" target="_blank" class="purple-mood" style="font-weight: bold; text-decoration: none;">supported countries</a> here.'
                },
                {
                    icon: 'widgets',
                    name: 'checkout page',
                    instructions: 'Finally, embed our checkout page in the checkout page created by WooCommerce. ' +
                        'This is done by changing the short code in the page \n' +
                        '<strong style="width: 42px; display: inline-block;">from:</strong> <strong class="purple-mood">[woocommerce_checkout]</strong>\n' +
                        '<strong style="width: 42px; display: inline-block;">to:</strong> <strong class="purple-mood">[tingg_checkout]</strong>\n\n' +
                        '<button ' +
                            'class="display-inline-flex align-items-center" ' +
                            'style="height: 32px; cursor: pointer; color: #fff; padding: 2px 8px; border-radius: 2px; background: #5b548b; border: 1px solid #5b548b;"' +
                            '@click="carbonCopy(\'[tingg_checkout]\')">' +
                            '<span style="font-size: 14px; line-height: 14px;">copy short code</span>' +
                            '<i class="material-icons" style="margin-left: 8px; font-size: 16px;">file_copy</i>' +
                        '</button> \n'
                }
            ]
        }
    },
    methods: {
        carbonCopy: function (str) {
            var textAreaElement = document.createElement('textarea');
            textAreaElement.value = str;
            textAreaElement.setAttribute('readonly', '');
            textAreaElement.style.position = 'absolute';
            textAreaElement.style.left = '-9999px';

            document.body.appendChild(textAreaElement);
            textAreaElement.select();
            document.execCommand('copy');
            document.body.removeChild(textAreaElement);
        }
    }
});

var settings = new Vue({
    el: '#wordpress-tingg-checkout-options-page',
});