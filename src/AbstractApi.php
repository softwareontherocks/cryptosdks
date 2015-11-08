<?php
namespace Sotr\Crypto;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

abstract class AbstractApi implements ExchangeApiInterface
{
	/**
	 * The Guzzle client.
	 *
	 * @var	GuzzleHttp\Client
	 */
	protected $client;

	public function __construct(ClientInterface $client = null)
	{
		$this->client = $client ?: new Client();
	}

	abstract public function getBaseUri();

	abstract public function getTicker($pair = null);
}
