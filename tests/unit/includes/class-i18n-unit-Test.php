<?php
/**
 * Tests for the root plugin file.
 *
 * @package BH_WP_PrintNode
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BH_WP_PrintNode;

use BH_WP_PrintNode\includes\BH_WP_PrintNode;

/**
 * Class Plugin_WP_Mock_Test
 *
 * @coversNothing
 */
class I18n_Unit_Test extends \Codeception\Test\Unit {

	protected function _before() {
		\WP_Mock::setUp();
	}

	// This is required for `'times' => 1` to be verified.
	protected function _tearDown() {
		parent::_tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * Verify load_plugin_textdomain is correctly called.
	 *
	 * @covers I18n::load_plugin_textdomain
	 */
	public function test_load_plugin_textdomain() {

		global $plugin_root_dir;

		\WP_Mock::userFunction(
			'load_plugin_textdomain',
			array(
				'args'   => array(
					'bh-wp-printnode',
					false,
					$plugin_root_dir . '/languages/',
				)
			)
		);
	}
}
