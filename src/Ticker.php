<?php
namespace Sotr\Crypto;

class Ticker
{
	protected $last;
	protected $high;
	protected $low;
	protected $bid;
	protected $ask;

	public function __construct($last, $high, $low, $bid, $ask)
	{
		$this->last = $last;
		$this->high = $high;
		$this->low = $low;
		$this->bid = $bid;
		$this->ask = $ask;
	}
}
