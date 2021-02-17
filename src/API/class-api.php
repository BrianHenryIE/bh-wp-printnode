<?php

namespace BrianHenryIE\WP_PrintNode\API;

use BrianHenryIE\WP_PrintNode\Mozart\Psr\Psr\Log\LoggerAwareTrait;

class API implements API_Interface {

	use LoggerAwareTrait;

	protected $settings;

	public function __construct( $settings, $logger ) {
		$this->setLogger( $logger );
		$this->settings = $settings;
	}

}
