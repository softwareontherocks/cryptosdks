<?php
namespace Sotr\Crypto;

use Sotr\Crypto\CurrencyPair;

interface CurrencyPairResolverInterface
{
	/**
	 * Returns the exchange-specific text
	 * representation of the given currency
	 * pair.
	 *
	 * @param	Sotr\Crypto\CurrencyPair	$pair
	 * @return	string
	 * @throws	RuntimeException
	 */
	public function resolve(CurrencyPair $pair);
}
