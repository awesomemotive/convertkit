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
	 * @param int $form_id
	 * @param array $data
	 *
	 * @return \stdClass
	 */
	public function subscribe( $form_id, $data ) {

		$path = 'forms/' . $form_id . '/subscribe';

		return $this->client->request( $path, 'post', $data );

	}

}