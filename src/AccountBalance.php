<?php
namespace Sotr\Crypto;

/**
 * This class represents the current
 * balance of different currencies in
 * a given user account.
 */
class AccountBalance
{
	/**
	 * The set of currencies and their
	 * related balance.
	 *
	 * @var	array
	 */
	private $balance;

	/**
	 * Constructs a new balance instance,
	 * optionally with the provided starting
	 * balance.
	 *
	 * @param	array	$balance
	 */
	public function __construct(array $balance = [])
	{
		foreach ($balance as $currency => $value) {
			$this->set($currency, $value);
		}
	}

	/**
	 * Returns the balance of the given
	 * currency.
	 *
	 * @param	string	$currency
	 * @return	float
	 */
	public function get($currency)
	{
		return isset($this->balance[$currency]) ? $this->balance[$currency] : null;
	}

	/**
	 * Sets the balance of the given currency.
	 *
	 * @param	string	$currency
	 * @param	float	$value
	 */
	public function set($currency, $value)
	{
		$this->balance[$currency] = $value;
	}
}
