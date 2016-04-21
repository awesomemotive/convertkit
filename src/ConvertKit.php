<?php

namespace AwesomeMotive\ConvertKit;

use AwesomeMotive\ConvertKit\Exception\ServiceNotFoundException;
use AwesomeMotive\ConvertKit\Service\CourseService;
use AwesomeMotive\ConvertKit\Service\FormService;
use AwesomeMotive\ConvertKit\Service\TagService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Subscriber\Retry\RetrySubscriber;

class ConvertKit {

	/**
	 * @var string
	 */
	protected $baseUrl = 'https://api.convertkit.com/v3/';

	/**
	 * @var string
	 */
	protected $apiKey;

	/**
	 * @var \GuzzleHttp\Client
	 */
	protected $httpClient;

	/**
	 * @var array
	 */
	protected $apis = array();

	/**
	 * @var array
	 */
	protected $retryCodes;

	/**
	 * @var int
	 */
	protected $retryDelay;

	/**
	 * @var int
	 */
	protected $retryMax;

	public function __construct( $apiKey = '' ) {

		$this->apiKey = $apiKey;

	}

	/**
	 * @return string
	 */
	public function getApiKey() {

		return $this->apiKey;

	}

	/**
	 * @param string $apiKey
	 */
	public function setApiKey( $apiKey ) {

		$this->apiKey = $apiKey;

	}

	/**
	 * @return array
	 */
	public function getRetryCodes() {

		return $this->retryCodes;

	}

	/**
	 * @param array $retryCodes
	 */
	public function setRetryCodes( $retryCodes ) {

		$this->retryCodes = $retryCodes;

	}

	/**
	 * @return int
	 */
	public function getRetryDelay() {

		return $this->retryDelay;

	}

	/**
	 * @param int $retryDelay
	 */
	public function setRetryDelay( $retryDelay ) {

		$this->retryDelay = $retryDelay;

	}

	/**
	 * @return int
	 */
	public function getRetryMax() {

		return $this->retryMax;

	}

	/**
	 * @param int $retryMax
	 */
	public function setRetryMax( $retryMax ) {

		$this->retryMax = $retryMax;

	}

	/**
	 * @return \GuzzleHttp\Client
	 */
	public function getHttpClient() {
		if ( ! $this->httpClient ) {
			$this->httpClient = new Client( array(
				'base_url' => $this->baseUrl,
			) );

			// retryOptions if set
			if ($this->getRetryCodes() && !empty($this->getRetryCodes())) {
				$retryOptions = array(
					'filter' => RetrySubscriber::createStatusFilter((array) $this->getRetryCodes())
				);

				if ($this->getRetryDelay()) {
					$retryDelay = $this->getRetryDelay();
					$retryOptions['delay'] = function ($number, $event) use ($retryDelay) { 
						return $retryDelay;
					};
				}

				if ($this->getRetryMax()) {
					$retryOptions['max'] = (int) $this->getRetryMax();
				}

				$retry = new RetrySubscriber($retryOptions);
				$this->httpClient->getEmitter()->attach($retry);
			}
		}

		return $this->httpClient;

	}

	/**
	 * @return CourseService
	 * @throws ServiceNotFoundException
	 */
	public function courses() {

		return $this->getApi( 'CourseService' );

	}

	/**
	 * @return FormService
	 * @throws ServiceNotFoundException
	 */
	public function forms() {

		return $this->getApi( 'FormService' );

	}

	/**
	 * @return TagService
	 * @throws ServiceNotFoundException
	 */
	public function tags() {

		return $this->getApi( 'TagService' );

	}

	/**
	 * @return SubscriberService
	 * @throws ServiceNotFoundException
	 */
	public function subscribers() {

		return $this->getApi( 'SubscriberService' );

	}

	/**
	 * @param string $class
	 *
	 * @return mixed
	 * @throws ServiceNotFoundException
	 */
	public function getApi( $class ) {

		$fq_class = '\\AwesomeMotive\\ConvertKit\\Service\\' . $class;

		if ( ! class_exists( $fq_class ) ) {
			throw new ServiceNotFoundException( 'Service: ' . $class . ' could not be found' );
		}

		if ( ! array_key_exists( $fq_class, $this->apis ) ) {
			$this->apis[ $fq_class ] = new $fq_class( $this );
		}

		return $this->apis[ $fq_class ];

	}

	/**
	 * @param string $path
	 * @param string $method
	 * @param array  $data
	 *
	 * @return array|bool|mixed|object|string
	 */
	public function request( $path = '', $method = 'get', $data = array() ) {

		$options = array(
			'query' => array(
				'api_key' => $this->getApiKey()
			)
		);

		switch ( $method ) {
			case 'get' :
				if ( ! empty( $data ) ) {
					foreach ( $data as $key => $value ) {
						$options['query'][ $key ] = $value;
					}
				}
				break;

			case 'put' :
			case 'post' :
				if ( ! empty( $data ) ) {
					$json = array();
					foreach ( $data as $key => $value ) {
						$json[ $key ] = $value;
					}
					$options['json'] = $json;
				}
				break;

			case 'delete' :
				if ( ! empty( $data ) ) {
					foreach ( $data as $key => $value ) {
						$options['query'][ $key ] = $value;
					}
				}
				break;

		}

		try {
			/** @var \GuzzleHttp\Psr7\Response $response **/
			$response = $this->getHttpClient()->{$method}( $path, $options );
			return json_decode( $response->getBody() );
		} catch ( RequestException $e ) {
			if ( $e->hasResponse() ) {
				return $e->getResponse()->getBody()->getContents();
			}
		}

		return false;

	}

}
