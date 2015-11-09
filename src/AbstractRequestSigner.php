<?php
namespace Sotr\Crypto;

use Psr\Http\Message\RequestInterface;

use Sotr\Crypto\NonceGenerator;
use Sotr\Crypto\NonceGeneratorInterface;

abstract class AbstractRequestSigner implements RequestSignerInterface
{
	/**
	 * The nonce generator.
	 *
	 * @var	Sotr\Crypto\NonceGeneratorInterface
	 */
	protected $nonceGenerator;

	public function __construct()
	{
		$this->nonceGenerator = new NonceGenerator();
	}

	abstract public function sign(RequestInterface $request, $key, $secret, $customerId = null);

	/**
	 * Set the nonce generator used
	 * by this signer.
	 *
	 * @param	Sotr\Crypto\NonceGeneratorInterface	$generator
	 */
	public function setNonceGenerator(NonceGeneratorInterface $generator)
	{
		$this->nonceGenerator = $generator;
	}
}
