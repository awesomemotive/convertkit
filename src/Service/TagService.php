<?php

namespace AwesomeMotive\ConvertKit\Service;

class TagService extends AbstractService {

	/**
	 * @return \stdClass
	 */
	public function all() {

		return $this->client->request( 'tags' );

	}

	/**
	 * @param string   $tagName
	 *
	 * @return \stdClass
	 */
	public function create( $tagName ) {

		$path = 'tags';

		$data = array(
			'name' => $tagName,
		);

		return $this->client->request( $path, 'post', $data );

	}

	/**
	 * @param int   $tagId
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function subscribe( $tagId, $data ) {

		$path = 'tags/' . $tagId . '/subscribe';

		return $this->client->request( $path, 'post', $data );

	}

	/**
	 * @param int $tagId
	 * @param stgrin $sortOrder
	 *
	 * @return \stdClass
	 */
	public function subscriptions( $tagId, $sortOrder = null ) {

		$path = 'tags/' . $tagId . '/subscriptions';

		$params = array();

		if (isset($sortOrder)) {
			$params['sort_order'] = $sortOrder;
		}

		return $this->client->request( $path, 'get', $params );

	}

	/**
	 * @param int   $tagId
	 * @param int   $subscriberId
	 *
	 * @return \stdClass
	 */
	public function delete( $tagId, $subscriberId) {

		$path = 'subscribers/' . $subscriberId . '/tags/' . $tagId;

		return $this->client->request( $path, 'delete');

	}

}