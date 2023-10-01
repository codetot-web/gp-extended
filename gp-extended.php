<?php
/**
 * Plugin Name: GP Extended
 * Plugin URI: https://codetot.com
 * Description: Help you boost a GeneratePress theme with more customized settings.
 * Version: 0.0.1
 * Requires at least: 5.2
 * Requires PHP: 7.4
 * Author: CODE TOT JSC
 * Author URI: https://codetot.com
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: gp-extended
 *
 * @package Gp_Extended
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'GP_EXTENDED_VERSION', '0.0.1' );
define( 'GP_EXTENDED_PLUGIN_SLUG', 'gp-extended' );
define( 'GP_EXTENDED_PLUGIN_NAME', esc_html_x('GP Extended', 'plugin name', 'gp-extended'));
define( 'GP_EXTENDED_DIR', plugin_dir_path(__FILE__));
define( 'GP_EXTENDED_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'GP_EXTENDED_AUTHOR', 'Code Tot JSC' );
define( 'GP_EXTENDED_AUTHOR_URI', 'https://codetot.com');
define( 'GP_EXTENDED_PLUGIN_URI', plugins_url('gp-extended'));
define( 'GP_EXTENDED_SETTINGS_KEY', 'gp_extended_settings' );

include_once GP_EXTENDED_DIR . 'inc/helpers.php';
include_once GP_EXTENDED_DIR . 'inc/local-dev.php';

require_once GP_EXTENDED_DIR . 'inc/class-assets.php';
require_once GP_EXTENDED_DIR . 'inc/class-settings.php';

require_once GP_EXTENDED_DIR . 'inc/customize/class-init.php';
include_once GP_EXTENDED_DIR . 'inc/layouts/class-init.php';

