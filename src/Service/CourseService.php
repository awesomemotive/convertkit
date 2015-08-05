<?php

namespace AwesomeMotive\ConvertKit\Service;

class CourseService extends AbstractService {

	/**
	 * @return array
	 */
	public function all() {

		return $this->client->request( 'courses' );

	}

}