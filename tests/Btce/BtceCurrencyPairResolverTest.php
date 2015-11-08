<?php
namespace Sotr\Crypto\Tests\Btce;

use PHPUnit_Framework_TestCase;

use Sotr\Crypto\Btce\BtceCurrencyPairResolver;
use Sotr\Crypto\CurrencyPair;

class BtceCurrencyPairResolverTest extends PHPUnit_Framework_TestCase
{
	public function testPairsAreCorrectlyResolved()
	{
		$resolver = new BtceCurrencyPairResolver();
		$btcUsd = new CurrencyPair('btc', 'usd');
		$usdBtc = new CurrencyPair('usd', 'btc');
		$ltcUsd = new CurrencyPair('ltc', 'usd');
		$usdLtc = new CurrencyPair('usd', 'ltc');
		$btcEur = new CurrencyPair('btc', 'eur');
		$eurBtc = new CurrencyPair('eur', 'btc');
		$ltcEur = new CurrencyPair('ltc', 'eur');
		$eurLtc = new CurrencyPair('eur', 'ltc');

		$this->assertEquals('btc_usd', $resolver->resolve($btcUsd));
		$this->assertEquals('btc_usd', $resolver->resolve($usdBtc));
		$this->assertEquals('ltc_usd', $resolver->resolve($ltcUsd));
		$this->assertEquals('ltc_usd', $resolver->resolve($usdLtc));
		$this->assertEquals('btc_eur', $resolver->resolve($btcEur));
		$this->assertEquals('btc_eur', $resolver->resolve($eurBtc));
		$this->assertEquals('ltc_eur', $resolver->resolve($ltcEur));
		$this->assertEquals('ltc_eur', $resolver->resolve($eurLtc));
	}

	/**
	 * @expectedException	RuntimeException
	 */
	public function testExceptionIsThrownIfPairDoesNotExist()
	{
		$resolver = new BtceCurrencyPairResolver();
		$pair = new CurrencyPair('foo', 'bar');

		$resolver->resolve($pair);
	}
}
