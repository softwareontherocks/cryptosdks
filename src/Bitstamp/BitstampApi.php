<?php
namespace Sotr\Crypto\Bitstamp;

use RuntimeException;

use Sotr\Crypto\AbstractApi;
use Sotr\Crypto\CurrencyPair;
use Sotr\Crypto\Ticker;

class BitstampApi extends AbstractApi
{
	public function getPublicBaseUri()
	{
		return 'https://www.bitstamp.net/api';
	}

	public function getTradingBaseUri()
	{
		return 'https://www.bitstamp.net/api';
	}

	public function getTicker(CurrencyPair $pair = null)
	{
		$response = $this->client->request('GET', $this->getPublicBaseUri() . '/ticker');
		$data = json_decode($response->getBody()->getContents());
		return new Ticker(
			$data->last,
			$data->high,
			$data->low,
			$data->bid,
			$data->ask
		);
	}

	public function getBalance()
	{
		return RuntimeException('Method not allowed in this exchange');
	}
}
