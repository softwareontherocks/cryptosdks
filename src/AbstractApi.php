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

	public function __construct()
	{
		$this->setClient(new Client());
	}

	abstract public function getBaseUri();

	abstract public function getTicker($pair = null);

	public function setClient(ClientInterface $client)
	{
		$this->client = $client;
	}
}
