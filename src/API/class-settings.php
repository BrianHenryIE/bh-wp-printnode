<?php

namespace BrianHenryIE\WP_PrintNode\API;

use BrianHenryIE\WP_PrintNode\Mozart\Psr\BrianHenryIE\WP_Logger\API\Logger_Settings_Interface;
use BrianHenryIE\WP_PrintNode\Mozart\Psr\Psr\Log\LogLevel;

class Settings implements Settings_Interface, Logger_Settings_Interface {

	public function get_log_level(): string {
		return LogLevel::NOTICE;
	}

	public function get_plugin_name(): string {
		return "BH WP PrintNode";
	}

	public function get_plugin_slug(): string {
		return "bh-wp-printnode";
	}

	public function get_plugin_basename(): string {
		return "bh-wp-printnode/bh-wp-printnode";
	}

	public function get_plugin_version(): string {
		return '1.0.0';
	}
}
