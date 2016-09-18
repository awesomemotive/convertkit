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
	 * @param int   $tag_id
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function subscribe( $tag_id, $data ) {

		$path = 'tags/' . $tag_id . '/subscribe';

		return $this->client->request( $path, 'post', $data );

	}

	/**
	 * @param int   $tag_id
	 * @param int   $subscriber_id
	 *
	 * @return \stdClass
	 */
	public function delete( $tag_id, $subscriber_id) {

		$path = 'subscribers/' . $subscriber_id . '/tags/' . $tag_id;

		return $this->client->request( $path, 'delete');

	}

}