<?php

namespace AwesomeMotive\ConvertKit\Service;

use AwesomeMotive\ConvertKit\ConvertKit;

abstract class AbstractService {

	/**
	 * @var ConvertKit
	 */
	protected $client;

	public function __construct( ConvertKit $client ) {

		$this->client = $client;

	}

}