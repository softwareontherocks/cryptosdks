<?php
namespace Sotr\Crypto;

class AccountBalance
{
	private $balance;

	public function __construct(array $balance = [])
	{
		foreach ($balance as $currency => $value) {
			$this->set($currency, $value);
		}
	}

	public function get($currency)
	{
		return isset($this->balance[$currency]) ? $this->balance[$currency] : null;
	}

	public function set($currency, $value)
	{
		$this->balance[$currency] = $value;
	}
}
