<?php
namespace Sotr\Crypto;

/**
 * A simple implementation of a nonce
 * generator which returns the current
 * UNIX timestamp as the nonce.
 */
class TimestampNonceGenerator implements NonceGeneratorInterface
{
	public function generateNonce()
	{
		return time();
	}
}
