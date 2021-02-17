<?php
/**
 * Class Plugin_Test. Tests the root plugin setup.
 *
 * @package BH_WP_PrintNode
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BH_WP_PrintNode;

use BH_WP_PrintNode\includes\BH_WP_PrintNode;

/**
 * Verifies the plugin has been instantiated and added to PHP's $GLOBALS variable.
 */
class Plugin_Integration_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * Test the main plugin object is added to PHP's GLOBALS and that it is the correct class.
	 */
	public function test_plugin_instantiated() {

		$this->assertArrayHasKey( 'bh_wp_printnode', $GLOBALS );

		$this->assertInstanceOf( BH_WP_PrintNode::class, $GLOBALS['bh_wp_printnode'] );
	}

}
