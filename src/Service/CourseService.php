<?php

namespace AwesomeMotive\ConvertKit\Service;

class CourseService extends AbstractService {

	/**
	 * @return \stdClass
	 */
	public function all() {

		return $this->client->request( 'courses' );

	}

	/**
	 * @param int $course_id
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function subscribe( $course_id, $data ) {

		$path = 'courses/' . $course_id . '/subscribe';

		return $this->client->request( $path, 'post', $data );

	}

}