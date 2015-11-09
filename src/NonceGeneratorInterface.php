<?php
namespace Sotr\Crypto;

interface NonceGeneratorInterface
{
	/**
	 * Generates a nonce.
	 *
	 * @return	string
	 */
	public function generateNonce();
}
