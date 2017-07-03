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
	 * @param int   $subscriberId
	 *
	 * @return \stdClass
	 */
	public function get($subscriberId) {

		$path = 'subscribers/' . $subscriberId;

		return $this->client->request($path, 'get');

	}

	/**
	 * @param int   $subscriberId
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function update( $subscriberId, $data ) {

		$path = 'subscribers/' . $subscriberId;

		return $this->client->request($path, 'put', $data);

	}

	/**
	 * @param string $subscriberEmail
	 *
	 * @return \stdClass
	 */
	public function unsubscribe( $subscriberEmail ) {

		$path = 'unsubscribe';

		$data = array(
			'email' => $subscriberEmail,
		);

		return $this->client->request( $path, 'put', $data);

	}

	/**
	 * @param int $subscriberId
	 *
	 * @return \stdClass
	 */
	public function tags( $subscriberId ) {

		$path = 'subscribers/' . $subscriberId . '/tags';

		return $this->client->request( $path );

	}

	/**
	 * @param int   $subscriberId
	 * @param int   $tagId
	 *
	 * @return \stdClass
	 */
	public function deleteTag( $subscriberId, $tagId) {

		$path = 'subscribers/' . $subscriberId . '/tags/' . $tagId;

		return $this->client->request( $path, 'delete');

	}

}