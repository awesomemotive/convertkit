<?php

namespace AwesomeMotive\ConvertKit\Service;

class SequenceService extends AbstractService {

	/**
	 * @return \stdClass
	 */
	public function all() {

		return $this->client->request( 'sequences' );

	}

	/**
	 * @param int $sequenceId
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function subscribe( $sequenceId, $data ) {

		$path = 'sequences/' . $sequenceId . '/subscribe';

		return $this->client->request( $path, 'post', $data );

	}

	/**
	 * @param int $sequenceId
	 * @param string $sortOrder
	 *
	 * @return \stdClass
	 */
	public function subscriptions( $sequenceId, $sortOrder = null ) {

		$path = 'sequences/' . $sequenceId . '/subscriptions';

		$params = array();

		if (isset($sortOrder)) {
			$params['sort_order'] = $sortOrder;
		}

		return $this->client->request( $path, 'get', $params );

	}

}