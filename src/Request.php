<?php

/**
 * This file is part of toptrans-api-wrapper.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace ToptransApiWrapper;

use GuzzleHttp;
use ToptransApiWrapper\Exceptions\BadResponseException;
use ToptransApiWrapper\Exceptions\ResponseStatusException;

class Request
{

	const API_HOST = 'https://zp.toptrans.cz';
	const API_BASE_PATH = '/api';

	const CONNECTION_TIMEOUT = 2; // sec
	const TIMEOUT = 4; // sec

	/** @var string */
	private $username;

	/** @var string */
	private $password;

	/** @var int in sec */
	private $timeout = self::TIMEOUT;

	/** @var int in sec */
	private $connectionTimeout = self::CONNECTION_TIMEOUT;

	public function __construct(string $username, string $password)
	{
		$this->username = $username;
		$this->password = $password;
	}

	public function sentRequest(array $arrayData, string $methodPath): array
	{
		$client = new GuzzleHttp\Client(['base_uri' => self::API_HOST]);
		$response = $client->request('POST', self::API_BASE_PATH . $methodPath, [
			'auth' => [$this->username, $this->password],
			'connect_timeout' => $this->connectionTimeout,
			'timeout' => $this->timeout,
			'http_errors' => false,
			'body' => json_encode($arrayData),
		]);

		if ($response->getStatusCode() !== 200) {
			throw new ResponseStatusException('Wrong response code: ' . $response->getStatusCode());
		}

		$responseBody = $response->getBody()->getContents();
		$decodedResponse = json_decode($responseBody);
		if (!$decodedResponse) {
			throw new BadResponseException($responseBody);
		}

		return $decodedResponse;
	}

}
