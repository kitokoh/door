<?php
// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require WWP_PLUGIN_PATH . '/vendor/autoload.php';
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;


if ( ! class_exists( 'WWP_REST_API' ) ) {

    /**
     * Model that houses the logic of WWPP API.
     *
     * @since 1.12
     */
    class WWP_Rest_API_Client {

        /**
         * Class Properties.
         */

        /**
         * Property that holds single main instance of WWP_Rest_API_Client
         *
         * @since 1.16.1
         * @access private
         * @var WWP_Rest_API_Client
         */
        private static $_instance;

        /**
         * Class Methods.
         */

        /**
         * WWP_Rest_API_Client constructor
         *
         * @since 1.16.1
         * @access public
         *
         * @param array $dependencies array of dependencies.
         */
        public function __construct( $dependencies = array() ) {}

        /**
         * Ensure that only one instance of WWP_Rest_API_Client is loaded (singleton pattern)
         *
         * @since 1.16.1
         * @access public
         *
         * @param array $dependencies array of dependencies.
         * @return WWP_Rest_API_Client
         */
        public static function instance( $dependencies ) {
            if ( ! self::$_instance instanceof self ) {
                self::$_instance = new self( $dependencies );
            }

            return self::$_instance;
        }

        /**
         * Get Items
         *
         * @since 1.16.1
         * @access public
         *
         * @param  array  $args            array of arguments.
         * @param  string $consumer_key    api keys generated.
         * @param  string $consumer_secret api secret key generated.
         * @param  string $endpoint        api endpoint.
         * @return string response from api.
         */
        public function get( $args, $consumer_key, $consumer_secret, $endpoint ) {

            $woocommerce = new Client(
                site_url(),
                $consumer_key,
                $consumer_secret,
                array(
                    'version'           => 'wholesale/v1',
                    'query_string_auth' => is_ssl() ? true : false,
                    'verify_ssl'        => false,
                    'wp_api'            => true,
                )
            );

            try {
                // Array of response results.
                return $woocommerce->get( $endpoint, $args['wholesale_data'] );

            } catch ( HttpClientException $e ) {
                error_log( print_r( $e->getMessage(), true ) ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions
            }
        }

    }
}
