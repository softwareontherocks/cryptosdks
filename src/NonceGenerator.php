<?php
namespace Sotr\Crypto;

class NonceGenerator implements NonceGeneratorInterface
{
	public function generateNonce()
	{
		return time();
	}
}
