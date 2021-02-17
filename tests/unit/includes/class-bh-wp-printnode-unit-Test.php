<?php
/**
 * @package BH_WP_PrintNode_Unit_Name
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BH_WP_PrintNode\includes;

use BH_WP_PrintNode\admin\Admin;
use BH_WP_PrintNode\frontend\Frontend;
use WP_Mock\Matcher\AnyInstance;

/**
 * Class BH_WP_PrintNode_Unit_Test
 */
class BH_WP_PrintNode_Unit_Test extends \Codeception\Test\Unit {

	protected function _before() {
		\WP_Mock::setUp();
	}

	// This is required for `'times' => 1` to be verified.
	protected function _tearDown() {
		parent::_tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * @covers BH_WP_PrintNode::set_locale
	 */
	public function test_set_locale_hooked() {

		\WP_Mock::expectActionAdded(
			'plugins_loaded',
			array( new AnyInstance( I18n::class ), 'load_plugin_textdomain' )
		);

		new BH_WP_PrintNode();
	}

	/**
	 * @covers BH_WP_PrintNode::define_admin_hooks
	 */
	public function test_admin_hooks() {

		\WP_Mock::expectActionAdded(
			'admin_enqueue_scripts',
			array( new AnyInstance( Admin::class ), 'enqueue_styles' )
		);

		\WP_Mock::expectActionAdded(
			'admin_enqueue_scripts',
			array( new AnyInstance( Admin::class ), 'enqueue_scripts' )
		);

		new BH_WP_PrintNode();
	}

	/**
	 * @covers BH_WP_PrintNode::define_frontend_hooks
	 */
	public function test_frontend_hooks() {

		\WP_Mock::expectActionAdded(
			'wp_enqueue_scripts',
			array( new AnyInstance( Frontend::class ), 'enqueue_styles' )
		);

		\WP_Mock::expectActionAdded(
			'wp_enqueue_scripts',
			array( new AnyInstance( Frontend::class ), 'enqueue_scripts' )
		);

		new BH_WP_PrintNode();
	}

}
