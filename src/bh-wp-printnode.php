<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           BH_WP_PrintNode
 *
 * @wordpress-plugin
 * Plugin Name:       BH WP PrintNode
 * Plugin URI:        http://github.com/brianhenryie/bh-wp-printnode/
 * Description:       Simple PrintNode client for WordPress. Offers to print PDFs via PrintNode when opening them. Provides API to other plugins.
 * Version:           1.0.0
 * Author:            BrianHenryIE
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bh-wp-printnode
 * Domain Path:       /Languages
 */

namespace BrianHenryIE\WP_PrintNode;

use BrianHenryIE\WP_PrintNode\API\API;
use BrianHenryIE\WP_PrintNode\API\Settings;
use BrianHenryIE\WP_PrintNode\Includes\Activator;
use BrianHenryIE\WP_PrintNode\Includes\Deactivator;
use BrianHenryIE\WP_PrintNode\Includes\BH_WP_PrintNode;
use BrianHenryIE\WP_PrintNode\Mozart\Psr\BrianHenryIE\WP_Logger\Logger;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BH_WP_PRINTNODE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function activate_bh_wp_printnode(): void {

	Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
function deactivate_bh_wp_printnode(): void {

	Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'BH_WP_PrintNode\activate_bh_wp_printnode' );
register_deactivation_hook( __FILE__, 'BH_WP_PrintNode\deactivate_bh_wp_printnode' );


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function instantiate_bh_wp_printnode(): API {

	$settings = new Settings();
	$logger   = Logger::instance( $settings );
	$api      = new API( $settings, $logger );

	$plugin = new BH_WP_PrintNode( $api, $settings, $logger );

	return $api;
}

/**
 * @var BrianHenryIE\WP_PrintNode\API\API_Interface
 */
$GLOBALS['bh_wp_printnode'] = instantiate_bh_wp_printnode();

