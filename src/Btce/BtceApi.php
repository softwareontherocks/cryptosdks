<?php
namespace Sotr\Crypto\Btce;

use RuntimeException;

use Sotr\Crypto\AbstractApi;
use Sotr\Crypto\Btce\BtceCurrencyPairResolver;
use Sotr\Crypto\CurrencyPair;
use Sotr\Crypto\Ticker;

class BtceApi extends AbstractApi
{
	public function __construct()
	{
		parent::__construct();
		$this->setCurrencyPairResolver(new BtceCurrencyPairResolver());
	}

	public function getBaseUri()
	{
		return 'https://btc-e.com/api/2';
	}

	public function getTicker(CurrencyPair $pair = null)
	{
		if (! $pair) {
			throw new RuntimeException('BTC-e ticker needs a currency pair');
		}

		$pairString = $this->resolver->resolve($pair);
		$response = $this->client->request('GET', $this->getBaseUri() . '/' . $pairString . '/ticker');
		$data = json_decode($response->getBody()->getContents());
		return new Ticker(
			$data->ticker->last,
			$data->ticker->high,
			$data->ticker->low,
			$data->ticker->sell,
			$data->ticker->buy
		);
	}
}
