<?php
namespace Sotr\Crypto;

use Psr\Http\Message\RequestInterface;

interface RequestSignerInterface
{
	/**
	 * Returns a signed copy of the
	 * provided request using the given
	 * API key, secret and, optionally, the
	 * customer's ID.
	 *
	 * Exchanges which don't require the
	 * customer's ID for signing might pass
	 * null as this parameter.
	 *
	 * @param	Psr\Http\Message\RequestInterface	$request
	 * @param	string								$key
	 * @param	string								$secret
	 * @param	string								$secret
	 * @param	int									$customerId
	 * @return	Psr\Http\Message\RequestInterface
	 */
	public function sign(RequestInterface $request, $key, $secret, $customerId = null);
}
