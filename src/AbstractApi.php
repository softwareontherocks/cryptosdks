<?php
namespace Sotr\Crypto;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

use Sotr\Crypto\CurrencyPair;

abstract class AbstractApi implements ExchangeApiInterface
{
	/**
	 * The Guzzle client.
	 *
	 * @var	GuzzleHttp\Client
	 */
	protected $client;

	/**
	 * The currency pair resolver.
	 *
	 * @var Sotr\Crypto\CurrencyPairResolverInterface
	 */
	protected $resolver = null;


	public function __construct()
	{
		$this->setClient(new Client());
	}

	abstract public function getPublicBaseUri();

	abstract public function getTradingBaseUri();

	abstract public function getTicker(CurrencyPair $pair = null);

	public function setClient(ClientInterface $client)
	{
		$this->client = $client;
	}

	public function setCurrencyPairResolver(CurrencyPairResolverInterface $resolver)
	{
		$this->resolver = $resolver;
	}
}
