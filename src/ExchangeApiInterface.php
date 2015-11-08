<?php
namespace Sotr\Crypto;

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
	 * @param	string	$pair
	 * @return	Sotr\Crypto\Ticker
	 */
	public function getTicker($pair = null);
}
