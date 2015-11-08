<?php
namespace Sotr\Crypto;

class CurrencyPair
{
	protected $currA;
	protected $currB;

	public function __construct($currA, $currB)
	{
		$this->currA = strtolower($currA);
		$this->currB = strtolower($currB);
	}

	public function getCurrencies()
	{
		return [$this->currA, $this->currB];
	}
}
