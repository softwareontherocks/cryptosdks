<?php
namespace Sotr\Crypto;

use Sotr\Crypto\CurrencyPair;

interface ExchangeApiInterface
{
	/**
	 * Returns the base URI of this exchange's
	 * public API.
	 *
	 * @return	string
	 */
	public function getPublicBaseUri();

	/**
	 * Returns the base URI of this exchange's
	 * private and/or trading API.
	 *
	 * @return	string
	 */
	public function getTradingBaseUri();

	/**
	 * Gets the latest ticker for the given
	 * currency pair.
	 *
	 * @param	Sotr\Crypto\CurrencyPair	$pair
	 * @return	Sotr\Crypto\Ticker
	 */
	public function getTicker(CurrencyPair $pair = null);
}
