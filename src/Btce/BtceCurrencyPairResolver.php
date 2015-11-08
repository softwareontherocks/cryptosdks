<?php
namespace Sotr\Crypto\Btce;

use RuntimeException;

use Sotr\Crypto\CurrencyPair;
use Sotr\Crypto\CurrencyPairResolverInterface;

class BtceCurrencyPairResolver implements CurrencyPairResolverInterface
{
	public function resolve(CurrencyPair $pair)
	{
		$currencies = $pair->getCurrencies();
		if (in_array('btc', $currencies) && in_array('usd', $currencies)) {
			return 'btc_usd';
		}
		if (in_array('ltc', $currencies) && in_array('usd', $currencies)) {
			return 'ltc_usd';
		}
		if (in_array('btc', $currencies) && in_array('eur', $currencies)) {
			return 'btc_eur';
		}
		if (in_array('ltc', $currencies) && in_array('eur', $currencies)) {
			return 'ltc_eur';
		}
		throw new RuntimeException("Pair {$currencies[0]}-{$currencies[1]} is not supported or is invalid\n");
	}
}
