<?php

namespace AwesomeMotive\ConvertKit\Service;

class SubscriberService extends AbstractService {

	/**
	 * @return \stdClass
	 */
	public function all($data = array()) {

		return $this->client->request('subscribers', 'get', $data);

	}

	/**
	 * @param int   $subscriber_id
	 *
	 * @return \stdClass
	 */
	public function get($subscriber_id) {

		$path = 'subscribers/' . $subscriber_id;

		return $this->client->request($path, 'get');

	}

	/**
	 * @param int   $subscriber_id
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function update( $subscriber_id, $data ) {

		$path = 'subscribers/' . $subscriber_id;

		return $this->client->request($path, 'post', $data);

	}

	/**
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function unsubscribe( $data ) {

		$path = 'unsubscribe';

		return $this->client->request( $path, 'put', $data);

	}

	/**
	 * @param int   $subscriber_id
	 * @param int   $tag_id
	 *
	 * @return \stdClass
	 */
	public function deleteTag( $subscriber_id, $tag_id) {

		$path = 'subscribers/' . $subscriber_id . '/tags/' . $tag_id;

		return $this->client->request( $path, 'delete');

	}

}