<?php
/**
 * Tests for Admin.
 *
 * @see Admin
 *
 * @package bh-wp-printnode
 * @author Brian Henry <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WP_PrintNode\Admin;

use BrianHenryIE\WP_PrintNode\API\Settings;
use BrianHenryIE\WP_PrintNode\API\Settings_Interface;
use BrianHenryIE\WP_PrintNode\Mozart\Psr\Psr\Log\NullLogger;

/**
 * Class Admin_Test
 *
 * @covers \BH_WP_PrintNode\Admin\Admin
 */
class Admin_Test extends \Codeception\Test\Unit {

	protected function _before() {
		\WP_Mock::setUp();
	}

	// This is required for `'times' => 1` to be verified.
	protected function _tearDown() {
		parent::_tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * The plugin name. Unlikely to change.
	 *
	 * @var string Plugin name.
	 */
	private $plugin_name = 'bh-wp-printnode';

	/**
	 * The plugin version, matching the version these tests were written against.
	 *
	 * @var string Plugin version.
	 */
	private $version = '1.0.0';

	/**
	 * Verifies enqueue_styles() calls wp_enqueue_style() with appropriate parameters.
	 * Verifies the .css file exists.
	 *
	 * @covers Admin::enqueue_styles
	 * @see wp_enqueue_style()
	 */
	public function test_enqueue_styles() {

		global $plugin_root_dir;

		// Return any old url.
		\WP_Mock::userFunction(
			'plugin_dir_url',
			array(
				'return' => $plugin_root_dir . '/admin/',
			)
		);

		$css_file = $plugin_root_dir . '/admin/css/bh-wp-printnode-admin.css';

		\WP_Mock::userFunction(
			'wp_enqueue_style',
			array(
				'times' => 1,
				'args'  => array( $this->plugin_name, $css_file, array(), $this->version, 'all' ),
			)
		);

		$settings = $this->make( Settings::class );
		$logger = new NullLogger();

		$admin = new Admin( $settings, $logger );

		$admin->enqueue_styles();

		$this->assertFileExists( $css_file );
	}

	/**
	 * Verifies enqueue_scripts() calls wp_enqueue_script() with appropriate parameters.
	 * Verifies the .js file exists.
	 *
	 * @covers Admin::enqueue_scripts
	 * @see wp_enqueue_script()
	 */
	public function test_enqueue_scripts() {

		global $plugin_root_dir;

		// Return any old url.
		\WP_Mock::userFunction(
			'plugin_dir_url',
			array(
				'return' => $plugin_root_dir . '/admin/',
			)
		);

		$handle    = $this->plugin_name;
		$src       = $plugin_root_dir . '/admin/js/bh-wp-printnode-admin.js';
		$deps      = array( 'jquery' );
		$ver       = $this->version;
		$in_footer = true;

		\WP_Mock::userFunction(
			'wp_enqueue_script',
			array(
				'times' => 1,
				'args'  => array( $handle, $src, $deps, $ver, $in_footer ),
			)
		);



		$settings = $this->make( Settings::class );
		$logger = new NullLogger();

		$admin = new Admin( $settings, $logger );

		$admin->enqueue_scripts();

		$this->assertFileExists( $src );
	}
}
