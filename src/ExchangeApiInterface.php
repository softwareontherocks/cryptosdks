<?php
namespace Sotr\Crypto;

use Sotr\Crypto\CurrencyPair;

interface ExchangeApiInterface
{
	/**
	 * Return the base URI for this API.
	 *
	 * @return	string
	 */
	public function getBaseUri();

	/**
	 * Gets the latest ticker for the given
	 * currency pair.
	 *
	 * @param	Sotr\Crypto\CurrencyPair	$pair
	 * @return	Sotr\Crypto\Ticker
	 */
	public function getTicker(CurrencyPair $pair = null);
}
