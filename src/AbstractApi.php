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

	/**
	 * The currency pair resolver.
	 *
	 * @var Sotr\Crypto\CurrencyPairResolverInterface
	 */
	protected $resolver;

	/**
	 * The request signer.
	 *
	 * @var	Sotr\Crypto\RequestSignerInterface
	 */
	protected $signer;

	/**
	 * The customer's API key.
	 *
	 * @var	string
	 */
	protected $key;

	/**
	 * The customer's API secret.
	 *
	 * @var string
	 */
	protected $secret;

	public function __construct($key = null, $secret = null)
	{
		$this->key = $key;
		$this->secret = $secret;
		$this->setClient(new Client());
	}

	abstract public function getPublicBaseUri();

	abstract public function getTradingBaseUri();

	abstract public function getTicker(CurrencyPair $pair = null);

	abstract public function getBalance();

	/**
	 * Sets the HTTP client to be used by
	 * this instance when making requests.
	 *
	 * @param	GuzzleHttp\ClientInterface	$client
	 */
	public function setClient(ClientInterface $client)
	{
		$this->client = $client;
	}

	/**
	 * Sets the currency pair resolver to
	 * be used by this instance.
	 *
	 * @param	Sotr\Crypto\CurrencyPairResolverInterface	$resolver
	 */
	public function setCurrencyPairResolver(CurrencyPairResolverInterface $resolver)
	{
		$this->resolver = $resolver;
	}

	/**
	 * Sets the signer to be used by this
	 * instance when signing HTTP requests.
	 *
	 * @param	Sotr\Crypto\RequestSignerInterface	$signer
	 */
	public function setRequestSigner(RequestSignerInterface $signer)
	{
		$this->signer = $signer;
	}
}
