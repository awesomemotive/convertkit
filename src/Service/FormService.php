<?php

namespace AwesomeMotive\ConvertKit\Service;

class FormService extends AbstractService {

	/**
	 * @return \stdClass
	 */
	public function all() {

		return $this->client->request( 'forms' );

	}

	/**
	 * @param int $course_id
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function subscribe( $course_id, $data ) {

		$path = 'forms/' . $course_id . '/subscribe';

		return $this->client->request( $path, 'post', $data );

	}

}