<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    BH_WP_PrintNode
 * @subpackage BH_WP_PrintNode/admin
 */

namespace BrianHenryIE\WP_PrintNode\Admin;

use BrianHenryIE\WP_PrintNode\API\Settings_Interface;
use BrianHenryIE\WP_PrintNode\Mozart\Psr\Psr\Log\LoggerAwareTrait;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BH_WP_PrintNode
 * @subpackage BH_WP_PrintNode/admin
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */
class Admin {

	use LoggerAwareTrait;

	protected Settings_Interface $settings;

	public function __construct( $settings, $logger ) {
		$this->settings = $settings;
		$this->setLogger( $logger );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @hooked admin_enqueue_scripts
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles(): void {

		wp_enqueue_style( $this->settings->get_plugin_slug(), plugin_dir_url( __FILE__ ) . 'css/bh-wp-printnode-admin.css', array(), $this->settings->get_plugin_version(), 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @hooked admin_enqueue_scripts
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts(): void {

		wp_enqueue_script( $this->settings->get_plugin_slug(), plugin_dir_url( __FILE__ ) . 'js/bh-wp-printnode-admin.js', array( 'jquery' ), $this->settings->get_plugin_version(), true );

	}

}
